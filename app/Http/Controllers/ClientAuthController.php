<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentRescheduled;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Contact;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClientAuthController extends Controller
{
    public function showSetup(string $token)
    {
        $client = Client::where('setup_token', $token)
            ->where('setup_token_expires_at', '>', now())
            ->firstOrFail();

        $login = Client::generateLogin($client->name);

        return view('client.setup', compact('client', 'token', 'login'));
    }

    public function setup(Request $request, string $token)
    {
        $client = Client::where('setup_token', $token)
            ->where('setup_token_expires_at', '>', now())
            ->firstOrFail();

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $login = Client::generateLogin($client->name);

        $client->update([
            'login' => $login,
            'password' => $request->password,
            'setup_token' => null,
            'setup_token_expires_at' => null,
        ]);

        Auth::guard('client')->login($client, true);

        return redirect()->route('client.dashboard');
    }

    public function showLogin()
    {
        return view('client.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'login' => $request->login,
            'password' => $request->password,
        ];

        if (Auth::guard('client')->attempt($credentials, true)) {
            $request->session()->regenerate();
            return redirect()->route('client.dashboard');
        }

        return back()->withErrors([
            'login' => __('Identifiant ou mot de passe incorrect.'),
        ])->withInput($request->only('login'));
    }

    public function dashboard()
    {
        $client = Auth::guard('client')->user();
        $contacts = $client->contacts()->with('messages')->latest()->get();

        return view('client.dashboard', compact('client', 'contacts'));
    }

    public function showContact(Contact $contact)
    {
        $client = Auth::guard('client')->user();
        abort_unless($contact->client_id === $client->id, 403);

        $contact->load('messages', 'appointment');

        return view('client.contact-show', compact('client', 'contact'));
    }

    public function replyToContact(Request $request, Contact $contact)
    {
        $client = Auth::guard('client')->user();
        abort_unless($contact->client_id === $client->id, 403);

        $request->validate(['message' => 'required|string|max:5000']);

        ContactMessage::create([
            'contact_id' => $contact->id,
            'sender_type' => 'client',
            'sender_id' => $client->id,
            'message' => $request->message,
        ]);

        return back()->with('success', __('Message envoye.'));
    }

    public function rescheduleContact(Request $request, Contact $contact)
    {
        $client = Auth::guard('client')->user();
        abort_unless($contact->client_id === $client->id, 403);

        $request->validate([
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|string|max:50',
        ]);

        $oldDate = $contact->preferred_date?->toDateString() ?? '';
        $oldSlot = $contact->preferred_time ?? '';

        Appointment::where('contact_id', $contact->id)->confirmed()->update(['status' => 'cancelled']);

        Appointment::create([
            'contact_id' => $contact->id,
            'date' => $request->preferred_date,
            'time_slot' => $request->preferred_time,
        ]);

        $contact->update([
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
        ]);

        try {
            Mail::to($client->email)->locale($client->locale)->send(
                new AppointmentRescheduled($contact->fresh(), $oldDate, $oldSlot, 'client')
            );
        } catch (\Throwable) {}

        return back()->with('success', __('Creneau modifie avec succes.'));
    }

    public function updateLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|string|in:fr,en,es,de,pl',
        ]);

        $client = Auth::guard('client')->user();
        $client->update(['locale' => $request->locale]);

        return back()->with('success', __('Langue mise a jour.'));
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
