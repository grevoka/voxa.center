<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('My requests') }} &mdash; Voxa Center</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--mid:#2563eb;--navy:#1e293b;--navy-dk:#0f172a;--slate:#64748b;--border:#e2e8f0;--bg:#f8fafc;--ink:#0f172a;--lav-sub:#eff6ff;--lav-bdr:#bfdbfe;--font:'Plus Jakarta Sans',sans-serif}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font);background:var(--bg);color:var(--ink);-webkit-font-smoothing:antialiased}
.topbar{background:#fff;border-bottom:1.5px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px;position:sticky;top:0;z-index:50}
.topbar-brand{display:flex;align-items:center;gap:10px;text-decoration:none}
.topbar-brand .icon{width:34px;height:34px;background:var(--mid);border-radius:9px;display:grid;place-items:center}
.topbar-brand span{font-weight:800;font-size:18px;color:var(--navy);letter-spacing:-.03em}
.topbar-right{display:flex;align-items:center;gap:16px}
.topbar-user{font-size:13px;color:var(--slate);font-weight:500}
.topbar-user strong{color:var(--navy);font-weight:700}
.btn-sm{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;font-family:var(--font);border:1.5px solid var(--border);background:#fff;color:var(--slate);cursor:pointer;text-decoration:none;transition:all .15s}
.btn-sm:hover{border-color:var(--lav-bdr);color:var(--navy)}
.container{max-width:900px;margin:0 auto;padding:32px 24px}
.page-header{margin-bottom:28px}
.page-header h1{font-size:26px;font-weight:800;color:var(--navy);letter-spacing:-.02em}
.page-header p{font-size:14px;color:var(--slate);margin-top:4px}
.alert-success{background:#ECFDF5;border:1.5px solid #A7F3D0;border-radius:10px;padding:12px 20px;color:#059669;font-weight:600;font-size:14px;margin-bottom:20px}
.contact-list{display:flex;flex-direction:column;gap:12px}
.contact-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:20px 24px;text-decoration:none;color:inherit;transition:all .15s;display:block}
.contact-card:hover{border-color:var(--lav-bdr);box-shadow:0 4px 16px rgba(37,99,235,.06);transform:translateY(-1px)}
.contact-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.contact-subject{font-size:15px;font-weight:700;color:var(--navy)}
.contact-date{font-size:12px;color:var(--slate)}
.contact-preview{font-size:13px;color:var(--slate);line-height:1.5;margin-bottom:10px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.contact-meta{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
.badge{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:700;padding:3px 10px;border-radius:100px}
.badge-active{background:var(--lav-sub);color:var(--mid)}
.badge-archived{background:#f1f5f9;color:var(--slate)}
.badge-appointment{background:#FEF3C7;color:#D97706}
.badge-messages{background:#F0FDF4;color:#16A34A}
.empty-state{text-align:center;padding:60px 20px}
.empty-state i{font-size:48px;color:var(--border);margin-bottom:16px;display:block}
.empty-state h3{font-size:18px;font-weight:700;color:var(--navy);margin-bottom:8px}
.empty-state p{font-size:14px;color:var(--slate)}
.locale-form select{background:var(--bg);border:1.5px solid var(--border);border-radius:8px;padding:6px 10px;font-size:12px;font-family:var(--font);color:var(--slate);cursor:pointer;outline:none}
</style>
</head>
<body>
<div class="topbar">
  <a href="{{ route('client.dashboard') }}" class="topbar-brand">
    <span class="icon"><i class="bi bi-telephone-fill" style="color:#fff;font-size:15px"></i></span>
    <span>Voxa Center</span>
  </a>
  <div class="topbar-right">
    <form action="{{ route('client.locale.update') }}" method="POST" class="locale-form">
      @csrf
      @method('PUT')
      <select name="locale" onchange="this.form.submit()">
        <option value="fr" {{ $client->locale === 'fr' ? 'selected' : '' }}>&#127467;&#127479; FR</option>
        <option value="en" {{ $client->locale === 'en' ? 'selected' : '' }}>&#127468;&#127463; EN</option>
      </select>
    </form>
    <div class="topbar-user"><strong>{{ $client->name }}</strong></div>
    <form action="{{ route('client.logout') }}" method="POST" style="margin:0">
      @csrf
      <button type="submit" class="btn-sm"><i class="bi bi-box-arrow-left"></i> {{ __('Sign out') }}</button>
    </form>
  </div>
</div>

<div class="container">
  <div class="page-header">
    <h1>{{ __('My contact requests') }}</h1>
    <p>{{ __('Track the status of your requests and conversations.') }}</p>
  </div>

  @if(session('success'))
    <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
  @endif

  @if($contacts->isEmpty())
    <div class="empty-state">
      <i class="bi bi-inbox"></i>
      <h3>{{ __('No requests yet') }}</h3>
      <p>{{ __('Your contact requests will appear here once submitted.') }}</p>
    </div>
  @else
    <div class="contact-list">
      @foreach($contacts as $contact)
        <a href="{{ route('client.contact.show', $contact) }}" class="contact-card">
          <div class="contact-top">
            <span class="contact-subject">
              {{ __('Request') }} #{{ $contact->id }}
              @if($contact->interests && is_array($contact->interests))
                &mdash; {{ implode(', ', $contact->interests) }}
              @endif
            </span>
            <span class="contact-date">{{ $contact->created_at->translatedFormat('d M Y') }}</span>
          </div>
          <div class="contact-preview">
            @if($contact->messages->isNotEmpty())
              {{ Str::limit($contact->messages->last()->message, 120) }}
            @else
              {{ Str::limit($contact->message, 120) }}
            @endif
          </div>
          <div class="contact-meta">
            @if($contact->isArchived())
              <span class="badge badge-archived"><i class="bi bi-archive"></i> {{ __('Archived') }}</span>
            @else
              <span class="badge badge-active"><i class="bi bi-circle-fill" style="font-size:6px"></i> {{ __('Active') }}</span>
            @endif
            @if($contact->appointment)
              <span class="badge badge-appointment"><i class="bi bi-calendar-check"></i> {{ $contact->appointment->date->translatedFormat('d M Y') }}</span>
            @endif
            @if($contact->messages->count() > 0)
              <span class="badge badge-messages"><i class="bi bi-chat-dots"></i> {{ $contact->messages->count() }} {{ __('messages') }}</span>
            @endif
          </div>
        </a>
      @endforeach
    </div>
  @endif
</div>
</body>
</html>
