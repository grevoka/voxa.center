@extends('layouts.admin')

@section('title', __('Request from') . ' ' . $contact->name)

@section('content')
<style>
.contact-layout{display:grid;grid-template-columns:340px 1fr;gap:28px;align-items:start}
.contact-sidebar{position:sticky;top:20px}
.contact-info{background:#fff;border:1.5px solid var(--border);border-radius:16px;padding:24px;font-size:13px}
.contact-info .ci-row{display:flex;gap:8px;padding:10px 0;border-bottom:1px solid #F1F5F9;align-items:center}
.contact-info .ci-row:last-child{border-bottom:none}
.contact-info .ci-label{color:var(--slate);font-weight:600;min-width:100px;flex-shrink:0;font-size:12px}
.contact-info .ci-value{color:var(--ink);font-weight:500}
.contact-info .ci-value a{color:var(--mid);text-decoration:none}
.rdv-badge{display:inline-flex;align-items:center;gap:6px;background:var(--lav-sub);border:1.5px solid var(--lav-bdr);border-radius:8px;padding:6px 12px;font-weight:700;color:var(--navy);font-size:13px}
.thread-panel{background:#fff;border:1.5px solid var(--border);border-radius:16px;overflow:hidden;display:flex;flex-direction:column;min-height:500px}
.thread-header{padding:16px 24px;border-bottom:1.5px solid var(--border);display:flex;align-items:center;justify-content:space-between;background:var(--bg)}
.thread-header h2{font-size:16px;font-weight:700;color:var(--navy);margin:0;display:flex;align-items:center;gap:8px}
.thread-header .msg-count{background:var(--navy);color:#fff;font-size:11px;font-weight:700;padding:2px 10px;border-radius:20px}
.thread-messages{flex:1;padding:24px;overflow-y:auto;max-height:420px;display:flex;flex-direction:column;gap:16px}
.msg-row{display:flex;gap:10px;align-items:flex-start}
.msg-row.admin{flex-direction:row-reverse}
.msg-avatar{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px}
.msg-avatar.av-admin{background:var(--navy);color:#fff}
.msg-avatar.av-client{background:var(--lav-sub);color:var(--navy)}
.msg-content{max-width:75%}
.msg-bubble{padding:12px 16px;font-size:14px;line-height:1.65;white-space:pre-wrap;word-break:break-word}
.msg-bubble.b-admin{background:var(--navy);color:#fff;border-radius:14px 14px 4px 14px}
.msg-bubble.b-client{background:var(--bg);color:var(--ink3);border-radius:14px 14px 14px 4px;border:1px solid var(--border)}
.msg-meta{font-size:11px;color:var(--slate);margin-top:4px}
.msg-row.admin .msg-meta{text-align:right}
.thread-empty{flex:1;display:flex;align-items:center;justify-content:center;flex-direction:column;color:var(--slate);font-size:14px;padding:40px}
.thread-empty i{font-size:36px;color:var(--border);margin-bottom:10px}
.reply-box{border-top:1.5px solid var(--border);padding:20px 24px;background:#fff}
.reply-box textarea{width:100%;padding:12px 16px;border:1.5px solid var(--border);border-radius:10px;font-size:14px;font-family:var(--font);color:var(--ink);resize:none;transition:border-color .15s}
.reply-box textarea:focus{outline:none;border-color:var(--cyan);box-shadow:0 0 0 3px rgba(59,130,246,.12)}
.btn-reply-big{display:inline-flex;align-items:center;gap:8px;padding:10px 24px;background:var(--navy);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s}
.btn-reply-big:hover{background:#1e40af;transform:translateY(-1px);box-shadow:0 4px 16px rgba(30,41,59,.2)}
.btn-reply-header{display:inline-flex;align-items:center;gap:8px;padding:10px 24px;background:var(--cyan);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s;text-decoration:none}
.btn-reply-header:hover{background:#2563eb;transform:translateY(-1px);box-shadow:0 4px 16px rgba(59,130,246,.3);color:#fff}
.client-badge{display:inline-flex;align-items:center;gap:4px;font-family:var(--mono);font-weight:700;color:var(--navy);font-size:12px;background:var(--lav-sub);border:1px solid var(--lav-bdr);border-radius:6px;padding:2px 8px}
.resched-link{font-size:11px;color:var(--mid);text-decoration:none;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:4px;margin-top:4px}
.resched-link:hover{color:var(--navy);text-decoration:underline}
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:1000;align-items:center;justify-content:center}
.modal-overlay.open{display:flex}
.modal-box{background:#fff;border-radius:16px;padding:32px;width:420px;max-width:92vw;box-shadow:0 12px 48px rgba(30,41,59,.2);position:relative;max-height:90vh;overflow-y:auto}
.modal-box h3{font-size:18px;font-weight:700;color:var(--navy);margin:0 0 4px;display:flex;align-items:center;gap:8px}
.modal-box h3 i{color:var(--mid)}
.modal-box .mdesc{font-size:13px;color:var(--slate);margin:0 0 20px}
.modal-close{position:absolute;top:16px;right:16px;background:none;border:none;font-size:20px;color:var(--slate);cursor:pointer;padding:4px}
.modal-close:hover{color:var(--ink)}
.modal-box .fg{margin-bottom:14px}
.modal-box .fg label{display:block;font-size:11px;font-weight:600;color:var(--slate);margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em}
.modal-box .fg input[type="date"]{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:14px;font-family:var(--font);color:var(--ink)}
.modal-box .fg input[type="date"]:focus{outline:none;border-color:var(--cyan);box-shadow:0 0 0 3px rgba(59,130,246,.12)}
.modal-slots{display:flex;flex-wrap:wrap;gap:6px;margin-top:6px}
.modal-slots .slot-radio{display:none}
.modal-slots .slot-label{display:inline-block;padding:7px 14px;background:var(--bg);border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-weight:600;color:var(--ink3);cursor:pointer;transition:all .15s}
.modal-slots .slot-radio:checked+.slot-label{background:var(--navy);color:#fff;border-color:var(--navy)}
.modal-slots .slot-label:hover{border-color:var(--lav-bdr)}
.btn-reschedule{display:inline-flex;align-items:center;gap:6px;padding:10px 20px;background:var(--navy);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s;width:100%;justify-content:center;margin-top:6px}
.btn-reschedule:hover{background:#1e40af;transform:translateY(-1px)}
.btn-reschedule:disabled{opacity:.4;cursor:not-allowed;transform:none}
.slot-msg{font-size:12px;padding:8px;border-radius:6px;text-align:center;margin-top:6px}
@media(max-width:900px){.contact-layout{grid-template-columns:1fr}.contact-sidebar{position:static}}
</style>

<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
  <div>
    <h1 style="display:flex;align-items:center;gap:12px">
      {{ $contact->name }}
      @if(!$contact->read)<span class="badge-unread">{{ __('Unread') }}</span>@endif
    </h1>
    <p>{{ __('Request received on') }} {{ $contact->created_at->format('d/m/Y') }} {{ __('at') }} {{ $contact->created_at->format('H:i') }}
      @if($contact->client && $contact->client->login)
        &middot; <span class="client-badge"><i class="bi bi-person-check-fill"></i> {{ $contact->client->login }}</span>
      @endif
    </p>
  </div>
  <div style="display:flex;gap:8px;align-items:center">
    <a href="#reply-box" class="btn-reply-header" onclick="document.getElementById('reply-textarea').focus()">
      <i class="bi bi-reply-fill"></i> {{ __('Reply') }}
    </a>
    <a href="{{ route('admin.contacts') }}" class="btn-admin outline"><i class="bi bi-arrow-left"></i> {{ __('Back') }}</a>
    @if($contact->isArchived())
    <form action="{{ route('admin.contacts.unarchive', $contact) }}" method="POST" style="margin:0">
      @csrf
      <button type="submit" class="btn-admin primary"><i class="bi bi-arrow-counterclockwise"></i> {{ __('Unarchive') }}</button>
    </form>
    @else
    <form action="{{ route('admin.contacts.archive', $contact) }}" method="POST" onsubmit="return confirm('{{ __('Archive this request?') }}')" style="margin:0">
      @csrf
      <button type="submit" class="btn-admin outline"><i class="bi bi-archive"></i> {{ __('Archive') }}</button>
    </form>
    @endif
  </div>
</div>

<div class="contact-layout">
  <!-- LEFT: Contact info -->
  <div class="contact-sidebar">
    <div class="contact-info">
      <div class="ci-row">
        <div class="ci-label"><i class="bi bi-envelope-fill" style="color:var(--mid)"></i> {{ __('Email') }}</div>
        <div class="ci-value"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div>
      </div>
      @if($contact->phone)
      <div class="ci-row">
        <div class="ci-label"><i class="bi bi-telephone-fill" style="color:var(--mid)"></i> {{ __('Phone') }}</div>
        <div class="ci-value"><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></div>
      </div>
      @endif
      @if($contact->company)
      <div class="ci-row">
        <div class="ci-label"><i class="bi bi-building" style="color:var(--mid)"></i> {{ __('Company') }}</div>
        <div class="ci-value">{{ $contact->company }}</div>
      </div>
      @endif
      @if($contact->profile)
      <div class="ci-row">
        <div class="ci-label"><i class="bi bi-person-badge-fill" style="color:var(--mid)"></i> {{ __('Profile') }}</div>
        <div class="ci-value">{{ $contact->profile }}</div>
      </div>
      @endif
      @if($contact->sites_count)
      <div class="ci-row">
        <div class="ci-label"><i class="bi bi-globe2" style="color:var(--mid)"></i> {{ __('Sites') }}</div>
        <div class="ci-value">{{ $contact->sites_count }}</div>
      </div>
      @endif
      @if($contact->client && $contact->client->locale)
      <div class="ci-row">
        <div class="ci-label"><i class="bi bi-translate" style="color:var(--mid)"></i> {{ __('Language') }}</div>
        <div class="ci-value">{{ strtoupper($contact->client->locale) }}</div>
      </div>
      @endif
      @if($contact->preferred_date)
      <div class="ci-row" style="flex-direction:column;gap:6px;align-items:flex-start">
        <div class="ci-label"><i class="bi bi-calendar-event-fill" style="color:var(--mid)"></i> {{ __('Preferred slot') }}</div>
        <div class="rdv-badge">
          <i class="bi bi-calendar-check-fill" style="color:var(--mid)"></i>
          {{ $contact->preferred_date->translatedFormat('l j F Y') }}
          @if($contact->preferred_time) &mdash; {{ $contact->preferred_time }} @endif
        </div>
        <a href="#" class="resched-link" onclick="event.preventDefault();document.getElementById('reschedModal').classList.add('open')">
          <i class="bi bi-pencil-square"></i> {{ __('Change slot') }}
        </a>
      </div>
      @endif
      @if($contact->infrastructure)
      <div class="ci-row" style="flex-direction:column;gap:6px;align-items:flex-start">
        <div class="ci-label"><i class="bi bi-server" style="color:var(--mid)"></i> {{ __('Need') }}</div>
        <div class="ci-value" style="background:var(--bg);border-radius:8px;padding:10px 12px;line-height:1.6;white-space:pre-wrap;font-size:13px;width:100%">{{ $contact->infrastructure }}</div>
      </div>
      @endif
    </div>
  </div>

  <!-- RIGHT: Conversation thread -->
  <div class="thread-panel" id="thread-panel">
    <div class="thread-header">
      <h2>
        <i class="bi bi-chat-left-text" style="color:var(--mid)"></i> {{ __('Conversation with') }} {{ $contact->name }}
        <span class="msg-count">{{ $contact->messages->count() }}</span>
        <span style="display:inline-flex;align-items:center;gap:4px;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:20px;padding:2px 10px;font-size:10px;font-weight:700;color:#16A34A;margin-left:4px"><i class="bi bi-shield-lock-fill" style="font-size:10px"></i> {{ __('AES-256 encrypted') }}</span>
      </h2>
    </div>

    <div class="thread-messages" id="thread-messages">
      @forelse($contact->messages as $msg)
      <div class="msg-row {{ $msg->isAdmin() ? 'admin' : '' }}">
        <div class="msg-avatar {{ $msg->isAdmin() ? 'av-admin' : 'av-client' }}">
          <i class="bi {{ $msg->isAdmin() ? 'bi-shield-fill' : 'bi-person-fill' }}"></i>
        </div>
        <div class="msg-content">
          <div class="msg-bubble {{ $msg->isAdmin() ? 'b-admin' : 'b-client' }}">{{ $msg->message }}</div>
          <div class="msg-meta">{{ $msg->isAdmin() ? 'Voxa Center (admin)' : $contact->name }} &middot; {{ $msg->created_at->format('d/m/Y H:i') }}</div>
        </div>
      </div>
      @empty
      <div class="thread-empty">
        <i class="bi bi-chat-left"></i>
        {{ __('No messages. Send the first reply below.') }}
      </div>
      @endforelse
    </div>

    <div class="reply-box" id="reply-box">
      @if(session('success'))
      <div style="background:#ECFDF5;border:1px solid #A7F3D0;border-radius:8px;padding:10px 14px;margin-bottom:12px;color:#059669;font-size:13px;font-weight:600">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
      </div>
      @endif
      <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
        @csrf
        <textarea name="message" id="reply-textarea" rows="3" required placeholder="{{ __('Write a message to') }} {{ $contact->name }}..." style="margin-bottom:10px">{{ old('message') }}</textarea>
        @error('message') <p style="color:#dc2626;font-size:13px;margin:0 0 8px">{{ $message }}</p> @enderror
        <div style="display:flex;justify-content:flex-end">
          <button type="submit" class="btn-reply-big"><i class="bi bi-send-fill"></i> {{ __('Send message') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>

@if($contact->preferred_date)
<div class="modal-overlay" id="reschedModal" onclick="if(event.target===this)this.classList.remove('open')">
  <div class="modal-box">
    <button class="modal-close" onclick="document.getElementById('reschedModal').classList.remove('open')">&times;</button>
    <h3><i class="bi bi-calendar2-check"></i> {{ __('Change slot') }}</h3>
    <p class="mdesc">{{ __('The client will be notified by email.') }}</p>
    <form action="{{ route('admin.contacts.reschedule', $contact) }}" method="POST">
      @csrf
      <div class="fg">
        <label>{{ __('New date') }}</label>
        <input type="date" name="preferred_date" id="admin-resched-date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+60 days')) }}" value="{{ $contact->preferred_date->format('Y-m-d') }}" required>
      </div>
      <div class="fg">
        <label>{{ __('Available slot') }}</label>
        <div class="modal-slots" id="admin-resched-slots">
          <div id="admin-resched-placeholder" style="width:100%;text-align:center;color:var(--slate);font-size:12px;padding:10px">
            <i class="bi bi-calendar-event"></i> {{ __('Select a date') }}
          </div>
        </div>
        <div id="admin-resched-closed" class="slot-msg" style="display:none;background:#FEF2F2;color:#DC2626">
          <i class="bi bi-x-circle"></i> {{ __('Closed day') }}
        </div>
        <div id="admin-resched-full" class="slot-msg" style="display:none;background:#FEF3C7;color:#92400E">
          <i class="bi bi-exclamation-circle"></i> {{ __('Fully booked') }}
        </div>
        <div id="admin-resched-loading" class="slot-msg" style="display:none;color:var(--slate)">
          <i class="bi bi-hourglass-split"></i> {{ __('Loading...') }}
        </div>
      </div>
      <button type="submit" class="btn-reschedule" id="admin-resched-btn" disabled>
        <i class="bi bi-check-lg"></i> {{ __('Confirm change') }}
      </button>
    </form>
  </div>
</div>
@endif

<script>
const tm = document.getElementById('thread-messages');
if (tm) tm.scrollTop = tm.scrollHeight;

(function(){
  const dateInput = document.getElementById('admin-resched-date');
  const container = document.getElementById('admin-resched-slots');
  const placeholder = document.getElementById('admin-resched-placeholder');
  const closedMsg = document.getElementById('admin-resched-closed');
  const fullMsg = document.getElementById('admin-resched-full');
  const loadingMsg = document.getElementById('admin-resched-loading');
  const submitBtn = document.getElementById('admin-resched-btn');
  let counter = 0;
  if (!dateInput) return;

  function updateBtn() {
    submitBtn.disabled = !container.querySelector('input[name="preferred_time"]:checked');
  }

  dateInput.addEventListener('change', async function(){
    const date = this.value;
    if (!date) return;
    const myId = ++counter;
    placeholder.style.display = 'none';
    closedMsg.style.display = 'none';
    fullMsg.style.display = 'none';
    loadingMsg.style.display = 'block';
    submitBtn.disabled = true;
    container.querySelectorAll('.slot-item').forEach(el => el.remove());

    try {
      const res = await fetch('/api/available-slots?date=' + encodeURIComponent(date));
      const data = await res.json();
      if (myId !== counter) return;
      loadingMsg.style.display = 'none';
      if (data.closed) { closedMsg.style.display = 'block'; return; }
      if (data.slots.length === 0) { fullMsg.style.display = 'block'; return; }

      data.slots.forEach(function(slot, i){
        const parts = slot.split('-');
        const label = parts[0].replace(':','h') + ' \u2013 ' + parts[1].replace(':','h');
        const id = 'rs_' + i;
        const span = document.createElement('span');
        span.className = 'slot-item';
        span.innerHTML = '<input type="radio" name="preferred_time" value="' + slot + '" id="' + id + '" class="slot-radio" required><label for="' + id + '" class="slot-label">' + label + '</label>';
        span.querySelector('input').addEventListener('change', updateBtn);
        container.appendChild(span);
      });
    } catch(e) {
      if (myId !== counter) return;
      loadingMsg.style.display = 'none';
      placeholder.style.display = 'block';
    }
  });

  if (dateInput.value) dateInput.dispatchEvent(new Event('change'));
})();
</script>
@endsection
