<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\RolePermission;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $hasContacts = $user->isAdmin() || RolePermission::hasAccess($user->role, 'contacts');

        $stats = [];
        if ($hasContacts) {
            $stats = [
                'total' => Contact::active()->count(),
                'unread' => Contact::active()->where('read', false)->count(),
                'today' => Contact::active()->whereDate('created_at', today())->count(),
            ];
        }

        return view('admin.dashboard', compact('stats', 'hasContacts'));
    }

    public function contacts(Request $request)
    {
        $query = Contact::query()->active()->orderByDesc('created_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if ($request->filter === 'unread') {
            $query->where('read', false);
        }

        $contacts = $query->paginate(20);
        $archivedCount = Contact::archived()->count();

        return view('admin.contacts', compact('contacts', 'archivedCount'));
    }

    public function archivedContacts(Request $request)
    {
        $query = Contact::query()->archived()->orderByDesc('archived_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(20);

        return view('admin.contacts-archived', compact('contacts'));
    }

    public function showContact(Contact $contact)
    {
        $contact->update(['read' => true]);
        $contact->load('messages', 'client', 'appointment');

        return view('admin.contact-show', compact('contact'));
    }

    public function replyToContact(Request $request, Contact $contact)
    {
        $request->validate(['message' => 'required|string|max:5000']);

        ContactMessage::create([
            'contact_id' => $contact->id,
            'sender_type' => 'admin',
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back()->with('success', __('Reponse envoyee.'));
    }

    public function rescheduleContact(Request $request, Contact $contact)
    {
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

        if ($contact->email) {
            try {
                $freshContact = $contact->fresh();
                $clientLocale = $freshContact->client?->locale ?? 'fr';
                Mail::to($contact->email)->locale($clientLocale)->send(
                    new \App\Mail\AppointmentRescheduled($freshContact, $oldDate, $oldSlot, 'admin')
                );
            } catch (\Throwable) {}
        }

        return back()->with('success', __('Creneau modifie. Le client a ete notifie par email.'));
    }

    public function archiveContact(Contact $contact)
    {
        $contact->update(['archived_at' => now()]);
        return redirect()->route('admin.contacts')->with('success', __('Demande archivee.'));
    }

    public function unarchiveContact(Contact $contact)
    {
        $contact->update(['archived_at' => null]);
        return redirect()->route('admin.contacts')->with('success', __('Demande desarchivee.'));
    }

    public function updateLocale(Request $request)
    {
        $request->validate(['locale' => 'required|string|in:en,fr']);
        Auth::user()->update(['locale' => $request->locale]);
        return back();
    }

    public function editPassword()
    {
        return view('admin.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => __('Le mot de passe actuel est incorrect.')]);
        }

        Auth::user()->update(['password' => Hash::make($request->password)]);

        return back()->with('success', __('Mot de passe modifie avec succes.'));
    }

    public function users()
    {
        $users = User::orderByDesc('created_at')->get();
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.user-create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:admin,partner,editor',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', __('Utilisateur cree avec succes.'));
    }

    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->withErrors(['delete' => __('Vous ne pouvez pas supprimer votre propre compte.')]);
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', __('Utilisateur supprime.'));
    }

    public function permissions()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $roles = [User::ROLE_PARTNER, User::ROLE_EDITOR];
        $sections = RolePermission::SECTIONS;
        $current = [];
        foreach ($roles as $role) {
            $current[$role] = RolePermission::getSectionsForRole($role);
        }

        return view('admin.permissions', compact('roles', 'sections', 'current'));
    }

    public function updatePermissions(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $roles = [User::ROLE_PARTNER, User::ROLE_EDITOR];
        $validSections = array_keys(RolePermission::SECTIONS);

        foreach ($roles as $role) {
            $sections = $request->input("permissions.{$role}", []);
            $sections = array_intersect($sections, $validSections);
            $sections = array_unique(array_merge($sections, ['dashboard', 'password']));
            RolePermission::syncRole($role, $sections);
        }

        return back()->with('success', __('Permissions mises a jour.'));
    }

    public function smtpSettings()
    {
        $smtp = Setting::getSmtpConfig();
        return view('admin.smtp', compact('smtp'));
    }

    public function updateSmtp(Request $request)
    {
        $request->validate([
            'smtp_enabled' => 'required|in:0,1',
            'smtp_host' => 'required_if:smtp_enabled,1|nullable|string|max:255',
            'smtp_port' => 'required_if:smtp_enabled,1|nullable|integer|min:1|max:65535',
            'smtp_encryption' => 'nullable|in:tls,ssl,none',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_from_address' => 'required_if:smtp_enabled,1|nullable|email|max:255',
            'smtp_from_name' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'smtp_enabled', 'smtp_host', 'smtp_port', 'smtp_encryption',
            'smtp_username', 'smtp_from_address', 'smtp_from_name',
        ]);

        if ($request->filled('smtp_password')) {
            $data['smtp_password'] = $request->smtp_password;
        }

        if ($data['smtp_encryption'] === 'none') {
            $data['smtp_encryption'] = '';
        }

        Setting::setMany($data);

        return back()->with('success', __('Configuration SMTP enregistree.'));
    }

    public function testSmtp(Request $request)
    {
        $request->validate(['test_email' => 'required|email']);

        try {
            Mail::raw(__('Ceci est un email de test envoye depuis l\'administration Voxa Center.'), function ($message) use ($request) {
                $message->to($request->test_email)
                        ->subject('Test SMTP — Voxa Center');
            });

            return back()->with('success', __('Email de test envoye a') . ' ' . $request->test_email);
        } catch (\Throwable $e) {
            return back()->withErrors(['smtp' => __('Erreur SMTP :') . ' ' . $e->getMessage()]);
        }
    }

    public function calendar()
    {
        return view('admin.calendar');
    }

    public function calendarEvents(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $appointments = Appointment::with('contact')
            ->whereBetween('date', [$start, $end])
            ->confirmed()
            ->get();

        $events = $appointments->map(function ($apt) {
            $times = explode('-', $apt->time_slot);
            return [
                'id' => $apt->id,
                'title' => $apt->contact->name ?? 'RDV',
                'start' => $apt->date->format('Y-m-d') . 'T' . $times[0] . ':00',
                'end' => $apt->date->format('Y-m-d') . 'T' . $times[1] . ':00',
                'url' => route('admin.contacts.show', $apt->contact_id),
                'color' => '#2563eb',
                'extendedProps' => [
                    'email' => $apt->contact->email ?? '',
                    'company' => $apt->contact->company ?? '',
                    'slot' => $apt->time_slot,
                ],
            ];
        });

        return response()->json($events);
    }

    public function scheduleSettings()
    {
        $schedule = [
            'days' => json_decode(Setting::get('schedule_days', '[1,2,3,4,5]'), true),
            'start' => Setting::get('schedule_start', '09:00'),
            'end' => Setting::get('schedule_end', '18:00'),
            'slot_duration' => Setting::get('schedule_slot_duration', '60'),
            'lunch_start' => Setting::get('schedule_lunch_start', '12:00'),
            'lunch_end' => Setting::get('schedule_lunch_end', '13:00'),
        ];

        return view('admin.schedule', compact('schedule'));
    }

    public function updateSchedule(Request $request)
    {
        $request->validate([
            'days' => 'required|array|min:1',
            'days.*' => 'integer|between:1,7',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:start',
            'slot_duration' => 'required|integer|in:30,45,60,90,120',
            'lunch_start' => 'required|date_format:H:i',
            'lunch_end' => 'required|date_format:H:i|after:lunch_start',
        ]);

        Setting::setMany([
            'schedule_days' => json_encode(array_map('intval', $request->days)),
            'schedule_start' => $request->start,
            'schedule_end' => $request->end,
            'schedule_slot_duration' => (string) $request->slot_duration,
            'schedule_lunch_start' => $request->lunch_start,
            'schedule_lunch_end' => $request->lunch_end,
        ]);

        return back()->with('success', __('Horaires mis a jour.'));
    }

    public function cancelAppointment(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', __('Rendez-vous annule.'));
    }
}
