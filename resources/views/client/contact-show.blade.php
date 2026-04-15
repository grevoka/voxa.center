<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('Request') }} #{{ $contact->id }} &mdash; Voxa Center</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--mid:#2563eb;--navy:#1e293b;--navy-dk:#0f172a;--slate:#64748b;--border:#e2e8f0;--bg:#f8fafc;--ink:#0f172a;--lav-sub:#eff6ff;--lav-bdr:#bfdbfe;--font:'Plus Jakarta Sans',sans-serif;--mono:'Fira Code',monospace}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font);background:var(--bg);color:var(--ink);-webkit-font-smoothing:antialiased}
.topbar{background:#fff;border-bottom:1.5px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px;position:sticky;top:0;z-index:50}
.topbar-brand{display:flex;align-items:center;gap:10px;text-decoration:none}
.topbar-brand .icon{width:34px;height:34px;background:var(--mid);border-radius:9px;display:grid;place-items:center}
.topbar-brand span{font-weight:800;font-size:18px;color:var(--navy);letter-spacing:-.03em}
.topbar-right{display:flex;align-items:center;gap:16px}
.btn-sm{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;font-family:var(--font);border:1.5px solid var(--border);background:#fff;color:var(--slate);cursor:pointer;text-decoration:none;transition:all .15s}
.btn-sm:hover{border-color:var(--lav-bdr);color:var(--navy)}
.container{max-width:900px;margin:0 auto;padding:32px 24px}
.back-nav{margin-bottom:20px}
.back-nav a{font-size:13px;color:var(--slate);text-decoration:none;font-weight:500;display:inline-flex;align-items:center;gap:5px}
.back-nav a:hover{color:var(--mid)}
.page-header{margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px}
.page-header h1{font-size:24px;font-weight:800;color:var(--navy);letter-spacing:-.02em}
.badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:700;padding:3px 10px;border-radius:100px}
.badge-active{background:var(--lav-sub);color:var(--mid)}
.badge-archived{background:#f1f5f9;color:var(--slate)}
.alert-success{background:#ECFDF5;border:1.5px solid #A7F3D0;border-radius:10px;padding:12px 20px;color:#059669;font-weight:600;font-size:14px;margin-bottom:20px}
.error-msg{background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;padding:10px 14px;color:#DC2626;font-size:13px;font-weight:600;margin-bottom:16px}
.detail-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:24px 28px;margin-bottom:20px}
.detail-card h3{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:16px;display:flex;align-items:center;gap:8px}
.detail-card h3 i{color:var(--mid);font-size:16px}
.detail-row{display:flex;gap:8px;padding:10px 0;border-bottom:1px solid #F1F5F9}
.detail-row:last-child{border-bottom:none}
.detail-label{font-size:13px;font-weight:600;color:var(--slate);min-width:160px;flex-shrink:0}
.detail-value{font-size:14px;color:var(--ink)}
.interest-tag{display:inline-flex;align-items:center;gap:4px;background:var(--lav-sub);border:1px solid var(--lav-bdr);border-radius:6px;padding:3px 10px;font-size:12px;font-weight:600;color:var(--mid);margin-right:4px;margin-bottom:4px}
.appointment-box{background:#FFFBEB;border:1.5px solid #FDE68A;border-radius:14px;padding:24px 28px;margin-bottom:20px}
.appointment-box h3{font-size:15px;font-weight:700;color:#92400E;margin-bottom:16px;display:flex;align-items:center;gap:8px}
.appointment-box h3 i{color:#D97706;font-size:16px}
.appointment-info{display:flex;align-items:center;gap:24px;margin-bottom:16px;flex-wrap:wrap}
.appointment-date{font-size:16px;font-weight:700;color:#92400E}
.appointment-time{font-size:14px;font-weight:600;color:#B45309;background:#FEF3C7;padding:4px 12px;border-radius:8px}
.reschedule-form{border-top:1px solid #FDE68A;padding-top:16px;margin-top:8px}
.reschedule-form label{display:block;font-size:12px;font-weight:600;color:#92400E;margin-bottom:4px}
.reschedule-row{display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap}
.reschedule-row input,.reschedule-row select{background:#fff;border:1.5px solid #FDE68A;border-radius:8px;padding:8px 12px;font-size:13px;font-family:var(--font);color:var(--ink);outline:none}
.reschedule-row input:focus,.reschedule-row select:focus{border-color:#F59E0B;box-shadow:0 0 0 3px rgba(245,158,11,.12)}
.btn-reschedule{background:#D97706;color:#fff;border:none;border-radius:8px;padding:9px 16px;font-size:13px;font-weight:600;font-family:var(--font);cursor:pointer;transition:all .15s}
.btn-reschedule:hover{background:#B45309}
.thread-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:24px 28px;margin-bottom:20px}
.thread-card h3{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:20px;display:flex;align-items:center;gap:8px}
.thread-card h3 i{color:var(--mid);font-size:16px}
.message-list{display:flex;flex-direction:column;gap:12px;margin-bottom:20px}
.message-bubble{max-width:75%;padding:14px 18px;border-radius:14px;font-size:14px;line-height:1.6;position:relative}
.message-client{align-self:flex-end;background:var(--mid);color:#fff;border-bottom-right-radius:4px}
.message-admin{align-self:flex-start;background:#f1f5f9;color:var(--ink);border-bottom-left-radius:4px}
.message-meta{font-size:11px;margin-top:6px;opacity:.7}
.message-client .message-meta{color:rgba(255,255,255,.7)}
.message-admin .message-meta{color:var(--slate)}
.message-initial{align-self:flex-end;background:#e0e7ff;color:#3730A3;border-bottom-right-radius:4px}
.message-initial .message-meta{color:#6366F1}
.reply-form{border-top:1.5px solid var(--border);padding-top:20px}
.reply-form textarea{width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none;resize:vertical;min-height:100px;transition:all .15s}
.reply-form textarea:focus{border-color:var(--mid);background:#fff;box-shadow:0 0 0 3px rgba(37,99,235,.12)}
.btn-reply{background:var(--mid);color:#fff;border:none;border-radius:10px;padding:10px 24px;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s;display:inline-flex;align-items:center;gap:6px;margin-top:12px}
.btn-reply:hover{background:#1d4ed8}
@media(max-width:600px){.container{padding:20px 16px}.message-bubble{max-width:90%}.appointment-info{flex-direction:column;gap:8px}.reschedule-row{flex-direction:column}.detail-row{flex-direction:column;gap:2px}}
</style>
</head>
<body>
<div class="topbar">
  <a href="{{ route('client.dashboard') }}" class="topbar-brand">
    <span class="icon"><i class="bi bi-telephone-fill" style="color:#fff;font-size:15px"></i></span>
    <span>Voxa Center</span>
  </a>
  <div class="topbar-right">
    <form action="{{ route('client.logout') }}" method="POST" style="margin:0">
      @csrf
      <button type="submit" class="btn-sm"><i class="bi bi-box-arrow-left"></i> {{ __('Sign out') }}</button>
    </form>
  </div>
</div>

<div class="container">
  <div class="back-nav">
    <a href="{{ route('client.dashboard') }}"><i class="bi bi-arrow-left"></i> {{ __('Back to my requests') }}</a>
  </div>

  <div class="page-header">
    <h1>{{ __('Request') }} #{{ $contact->id }}</h1>
    @if($contact->isArchived())
      <span class="badge badge-archived"><i class="bi bi-archive"></i> {{ __('Archived') }}</span>
    @else
      <span class="badge badge-active"><i class="bi bi-circle-fill" style="font-size:6px"></i> {{ __('Active') }}</span>
    @endif
  </div>

  @if(session('success'))
    <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="error-msg"><i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}</div>
  @endif

  {{-- Contact details --}}
  <div class="detail-card">
    <h3><i class="bi bi-person-lines-fill"></i> {{ __('Request details') }}</h3>
    <div class="detail-row">
      <div class="detail-label">{{ __('Name') }}</div>
      <div class="detail-value">{{ $contact->name }}</div>
    </div>
    @if($contact->company)
      <div class="detail-row">
        <div class="detail-label">{{ __('Company') }}</div>
        <div class="detail-value">{{ $contact->company }}</div>
      </div>
    @endif
    <div class="detail-row">
      <div class="detail-label">{{ __('Email') }}</div>
      <div class="detail-value">{{ $contact->email }}</div>
    </div>
    @if($contact->phone)
      <div class="detail-row">
        <div class="detail-label">{{ __('Phone') }}</div>
        <div class="detail-value">{{ $contact->phone }}</div>
      </div>
    @endif
    @if($contact->profile)
      <div class="detail-row">
        <div class="detail-label">{{ __('Profile') }}</div>
        <div class="detail-value">{{ $contact->profile }}</div>
      </div>
    @endif
    @if($contact->interests && is_array($contact->interests))
      <div class="detail-row">
        <div class="detail-label">{{ __('Interests') }}</div>
        <div class="detail-value">
          @foreach($contact->interests as $interest)
            <span class="interest-tag">{{ $interest }}</span>
          @endforeach
        </div>
      </div>
    @endif
    <div class="detail-row">
      <div class="detail-label">{{ __('Submitted on') }}</div>
      <div class="detail-value">{{ $contact->created_at->translatedFormat('d F Y, H:i') }}</div>
    </div>
  </div>

  {{-- Appointment --}}
  @if($contact->appointment)
    <div class="appointment-box">
      <h3><i class="bi bi-calendar-check-fill"></i> {{ __('Scheduled appointment') }}</h3>
      <div class="appointment-info">
        <span class="appointment-date"><i class="bi bi-calendar3"></i> {{ $contact->appointment->date->translatedFormat('l d F Y') }}</span>
        <span class="appointment-time"><i class="bi bi-clock"></i> {{ $contact->appointment->time_slot }}</span>
      </div>
      @if(!$contact->isArchived())
        <div class="reschedule-form">
          <p style="font-size:13px;color:#92400E;margin-bottom:12px">{{ __('Need to change the date? Propose a new time below:') }}</p>
          <form action="{{ route('client.contact.reschedule', $contact) }}" method="POST">
            @csrf
            <div class="reschedule-row">
              <div>
                <label>{{ __('New date') }}</label>
                <input type="date" name="date" required min="{{ now()->addDay()->format('Y-m-d') }}">
              </div>
              <div>
                <label>{{ __('Time slot') }}</label>
                <select name="time_slot" required>
                  <option value="">{{ __('Select...') }}</option>
                  <option value="09:00-10:00">09:00 - 10:00</option>
                  <option value="10:00-11:00">10:00 - 11:00</option>
                  <option value="11:00-12:00">11:00 - 12:00</option>
                  <option value="14:00-15:00">14:00 - 15:00</option>
                  <option value="15:00-16:00">15:00 - 16:00</option>
                  <option value="16:00-17:00">16:00 - 17:00</option>
                </select>
              </div>
              <button type="submit" class="btn-reschedule"><i class="bi bi-arrow-repeat"></i> {{ __('Reschedule') }}</button>
            </div>
          </form>
        </div>
      @endif
    </div>
  @endif

  {{-- Message thread --}}
  <div class="thread-card">
    <h3><i class="bi bi-chat-left-text-fill"></i> {{ __('Conversation') }}</h3>

    <div class="message-list">
      {{-- Original message --}}
      <div class="message-bubble message-initial">
        <div>{{ $contact->message }}</div>
        <div class="message-meta">{{ $contact->name }} &mdash; {{ $contact->created_at->translatedFormat('d/m/Y H:i') }}</div>
      </div>

      {{-- Thread messages --}}
      @foreach($contact->messages as $msg)
        @if($msg->sender_type === 'client')
          <div class="message-bubble message-client">
            <div>{{ $msg->message }}</div>
            <div class="message-meta">{{ __('You') }} &mdash; {{ $msg->created_at->translatedFormat('d/m/Y H:i') }}</div>
          </div>
        @else
          <div class="message-bubble message-admin">
            <div>{{ $msg->message }}</div>
            <div class="message-meta">Voxa Center &mdash; {{ $msg->created_at->translatedFormat('d/m/Y H:i') }}</div>
          </div>
        @endif
      @endforeach
    </div>

    {{-- Reply form --}}
    @if(!$contact->isArchived())
      <div class="reply-form">
        <form action="{{ route('client.contact.reply', $contact) }}" method="POST">
          @csrf
          <textarea name="message" placeholder="{{ __('Write your reply...') }}" required></textarea>
          <button type="submit" class="btn-reply"><i class="bi bi-send-fill"></i> {{ __('Send') }}</button>
        </form>
      </div>
    @endif
  </div>
</div>
</body>
</html>
