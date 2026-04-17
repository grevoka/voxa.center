<?php

namespace App\Http\Controllers;

use App\Mail\ContactConfirmation;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function fonctionnalites()
    {
        return view('pages.fonctionnalites');
    }

    public function tarifs()
    {
        return view('pages.tarifs');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function scenarios()
    {
        return view('pages.scenarios');
    }

    public function softphone()
    {
        return view('pages.softphone');
    }

    public function cgu()
    {
        return view('pages.legal.cgu');
    }

    public function cgv()
    {
        return view('pages.legal.cgv');
    }

    public function confidentialite()
    {
        return view('pages.legal.confidentialite');
    }

    public function submitContact(Request $request)
    {
        // Honeypot
        if ($request->filled('website_url') || $request->filled('fax_number')) {
            return back()->with('success', __('Merci ! Votre demande a bien ete envoyee.'));
        }

        // Timing check
        try {
            $formTime = decrypt($request->input('_form_token'));
            if (time() - $formTime < 3) {
                return back()->with('success', __('Merci ! Votre demande a bien ete envoyee.'));
            }
        } catch (\Throwable) {
            return back()->with('success', __('Merci ! Votre demande a bien ete envoyee.'));
        }

        // Math challenge
        $challengeAnswer = $request->input('_challenge');
        $challengeHash = $request->input('_challenge_hash');
        $expectedHash = hash_hmac('sha256', (string) $challengeAnswer, config('app.key'));
        if ($expectedHash !== $challengeHash) {
            return back()->withInput()->withErrors(['_challenge' => __('Wrong answer, please try again.')]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'profile' => 'nullable|string|max:255',
            'interests' => 'nullable|array',
            'interests.*' => 'string',
            'message' => 'nullable|string|max:5000',
            'preferred_date' => 'nullable|date|after_or_equal:today',
            'preferred_time' => 'nullable|string|max:50',
        ]);

        $locale = app()->getLocale();

        $client = Client::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'] ?? null,
                'company' => $validated['company'] ?? null,
                'locale' => $locale,
            ]
        );

        if (!$client->isSetup()) {
            $client->update([
                'setup_token' => Str::random(64),
                'setup_token_expires_at' => now()->addHours(72),
            ]);
        }

        $contact = Contact::create(array_merge($validated, ['client_id' => $client->id]));

        if (!empty($validated['preferred_date']) && !empty($validated['preferred_time'])) {
            Appointment::create([
                'contact_id' => $contact->id,
                'date' => $validated['preferred_date'],
                'time_slot' => $validated['preferred_time'],
            ]);
        }

        Mail::to($client->email)->locale($client->locale)->send(new ContactConfirmation($client, $contact));

        return back()->with('success', __('Merci ! Votre demande a bien ete envoyee. Nous revenons vers vous sous 24h.'));
    }

    public function visitDuration(Request $request)
    {
        $duration = (int) $request->input('duration', 0);
        $sessionId = $request->session()->getId();

        if ($duration < 1 || $duration > 3600 || !$sessionId) {
            return response()->json(['ok' => false]);
        }

        // Update the last visit in this session
        Visit::where('session_id', $sessionId)
            ->latest('created_at')
            ->limit(1)
            ->update(['duration' => $duration]);

        return response()->json(['ok' => true]);
    }

    public function availableSlots(Request $request)
    {
        $request->validate(['date' => 'required|date|after_or_equal:today']);

        $date = Carbon::parse($request->date);
        $dayOfWeek = $date->dayOfWeekIso;

        $allowedDays = json_decode(Setting::get('schedule_days', '[1,2,3,4,5]'), true);

        if (!in_array($dayOfWeek, $allowedDays)) {
            return response()->json(['slots' => [], 'closed' => true]);
        }

        $start = Setting::get('schedule_start', '09:00');
        $end = Setting::get('schedule_end', '18:00');
        $duration = (int) Setting::get('schedule_slot_duration', '60');
        $lunchStart = Setting::get('schedule_lunch_start', '12:00');
        $lunchEnd = Setting::get('schedule_lunch_end', '13:00');

        $allSlots = [];
        $current = Carbon::createFromFormat('H:i', $start);
        $endTime = Carbon::createFromFormat('H:i', $end);
        $lunchS = Carbon::createFromFormat('H:i', $lunchStart);
        $lunchE = Carbon::createFromFormat('H:i', $lunchEnd);

        while ($current->copy()->addMinutes($duration)->lte($endTime)) {
            $slotEnd = $current->copy()->addMinutes($duration);

            if (!($current->lt($lunchE) && $slotEnd->gt($lunchS))) {
                $allSlots[] = $current->format('H:i') . '-' . $slotEnd->format('H:i');
            }

            $current->addMinutes($duration);
        }

        $booked = Appointment::where('date', $date->toDateString())
            ->confirmed()
            ->pluck('time_slot')
            ->toArray();

        $available = array_values(array_diff($allSlots, $booked));

        return response()->json(['slots' => $available, 'closed' => false]);
    }
}
