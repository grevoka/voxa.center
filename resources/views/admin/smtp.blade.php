@extends('layouts.admin')

@section('title', __('SMTP Configuration'))

@section('content')
<style>
.smtp-grid{display:grid;grid-template-columns:1fr 1fr;gap:32px;align-items:start}
.smtp-card{background:#fff;border:1.5px solid var(--border);border-radius:16px;padding:32px}
.smtp-card h2{font-family:var(--font);font-size:20px;font-weight:700;color:var(--navy);margin:0 0 6px;display:flex;align-items:center;gap:10px}
.smtp-card h2 i{color:var(--mid)}
.smtp-card .desc{font-size:13px;color:var(--slate);margin:0 0 24px}
.form-group{margin-bottom:18px}
.form-group label{display:block;font-size:12px;font-weight:600;color:var(--ink3);margin-bottom:6px;text-transform:uppercase;letter-spacing:.04em}
.form-group input,.form-group select{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:14px;font-family:var(--font);color:var(--ink);background:#fff;transition:border-color .15s}
.form-group input:focus,.form-group select:focus{outline:none;border-color:var(--cyan);box-shadow:0 0 0 3px rgba(59,130,246,.12)}
.form-group .hint{font-size:11px;color:var(--slate);margin-top:4px}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.toggle-row{display:flex;align-items:center;gap:12px;padding:16px;background:var(--bg);border-radius:10px;margin-bottom:24px}
.toggle-row label{font-size:14px;font-weight:600;color:var(--ink3);margin:0;text-transform:none;letter-spacing:0}
.toggle-row .hint{font-size:12px;color:var(--slate);margin:0}
.toggle-switch{position:relative;width:48px;height:26px;flex-shrink:0}
.toggle-switch input{opacity:0;width:0;height:0}
.toggle-switch .slider{position:absolute;inset:0;background:#CBD5E1;border-radius:13px;cursor:pointer;transition:.2s}
.toggle-switch .slider::before{content:'';position:absolute;height:20px;width:20px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:.2s}
.toggle-switch input:checked+.slider{background:var(--navy)}
.toggle-switch input:checked+.slider::before{transform:translateX(22px)}
.btn-save{display:inline-flex;align-items:center;gap:8px;padding:10px 24px;background:var(--navy);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s}
.btn-save:hover{background:#1e40af;transform:translateY(-1px);box-shadow:0 4px 16px rgba(30,41,59,.2)}
.test-card{background:#fff;border:1.5px solid var(--border);border-radius:16px;padding:32px}
.test-card h2{font-family:var(--font);font-size:20px;font-weight:700;color:var(--navy);margin:0 0 6px;display:flex;align-items:center;gap:10px}
.test-card h2 i{color:var(--cyan)}
.test-card .desc{font-size:13px;color:var(--slate);margin:0 0 24px}
.btn-test{display:inline-flex;align-items:center;gap:8px;padding:10px 24px;background:var(--cyan);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s}
.btn-test:hover{background:#2563eb;transform:translateY(-1px);box-shadow:0 4px 16px rgba(59,130,246,.3)}
.status-box{display:flex;align-items:center;gap:10px;padding:14px 18px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:24px}
.status-box.active{background:#F0FDF4;border:1px solid #BBF7D0;color:#16A34A}
.status-box.inactive{background:#FEF3C7;border:1px solid #FDE68A;color:#92400E}
@media(max-width:900px){.smtp-grid{grid-template-columns:1fr}.form-row{grid-template-columns:1fr}}
</style>

<div class="admin-header" style="margin-bottom:24px">
  <h1><i class="bi bi-envelope-at-fill" style="color:var(--mid)"></i> {{ __('SMTP Configuration') }}</h1>
  <p>{{ __('Configure the mail server for sending emails') }}</p>
</div>

@php
$isActive = ($smtp['smtp_enabled'] ?? '0') === '1' && !empty($smtp['smtp_host']);
@endphp

<div class="status-box {{ $isActive ? 'active' : 'inactive' }}">
  <i class="bi {{ $isActive ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
  @if($isActive)
    {{ __('External SMTP active') }} &mdash; {{ $smtp['smtp_host'] }}:{{ $smtp['smtp_port'] }}
  @else
    {{ __('Local mail server (sendmail)') }} &mdash; {{ __('No external SMTP configured') }}
  @endif
</div>

<div class="smtp-grid">
  <div class="smtp-card">
    <h2><i class="bi bi-gear-fill"></i> {{ __('SMTP Settings') }}</h2>
    <p class="desc">{{ __('Enter your external SMTP server details. If disabled, emails will be sent via the local mail server.') }}</p>

    <form action="{{ route('admin.smtp.update') }}" method="POST">
      @csrf @method('PUT')

      <div class="toggle-row">
        <label class="toggle-switch">
          <input type="hidden" name="smtp_enabled" value="0">
          <input type="checkbox" name="smtp_enabled" value="1" id="smtp-toggle" {{ ($smtp['smtp_enabled'] ?? '0') === '1' ? 'checked' : '' }} onchange="toggleSmtpFields()">
          <span class="slider"></span>
        </label>
        <div>
          <label for="smtp-toggle">{{ __('Enable external SMTP') }}</label>
          <p class="hint">{{ __('Disable to use the local mail server') }}</p>
        </div>
      </div>

      <div id="smtp-fields">
        <div class="form-row">
          <div class="form-group">
            <label for="smtp_host">{{ __('SMTP Server') }}</label>
            <input type="text" name="smtp_host" id="smtp_host" value="{{ old('smtp_host', $smtp['smtp_host']) }}" placeholder="smtp.example.com">
          </div>
          <div class="form-group">
            <label for="smtp_port">{{ __('Port') }}</label>
            <input type="number" name="smtp_port" id="smtp_port" value="{{ old('smtp_port', $smtp['smtp_port']) }}" placeholder="587">
          </div>
        </div>

        <div class="form-group">
          <label for="smtp_encryption">{{ __('Encryption') }}</label>
          <select name="smtp_encryption" id="smtp_encryption">
            <option value="tls" {{ ($smtp['smtp_encryption'] ?? 'tls') === 'tls' ? 'selected' : '' }}>{{ __('TLS (recommended, port 587)') }}</option>
            <option value="ssl" {{ ($smtp['smtp_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL (port 465)</option>
            <option value="none" {{ ($smtp['smtp_encryption'] ?? '') === '' && ($smtp['smtp_encryption'] ?? 'tls') !== 'tls' ? 'selected' : '' }}>{{ __('None (port 25)') }}</option>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="smtp_username">{{ __('Username') }}</label>
            <input type="text" name="smtp_username" id="smtp_username" value="{{ old('smtp_username', $smtp['smtp_username']) }}" placeholder="user@example.com" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="smtp_password">{{ __('Password') }}</label>
            <input type="password" name="smtp_password" id="smtp_password" value="" placeholder="{{ $smtp['smtp_password'] ? '••••••••' : '' }}" autocomplete="new-password">
            <p class="hint">{{ __('Leave blank to keep current password') }}</p>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="smtp_from_address">{{ __('From address') }}</label>
            <input type="email" name="smtp_from_address" id="smtp_from_address" value="{{ old('smtp_from_address', $smtp['smtp_from_address']) }}" placeholder="contact@voxa.center">
          </div>
          <div class="form-group">
            <label for="smtp_from_name">{{ __('From name') }}</label>
            <input type="text" name="smtp_from_name" id="smtp_from_name" value="{{ old('smtp_from_name', $smtp['smtp_from_name']) }}" placeholder="Voxa Center">
          </div>
        </div>
      </div>

      @if($errors->any() && !$errors->has('smtp') && !$errors->has('test_email'))
      <div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;padding:10px 14px;margin-bottom:16px;color:#DC2626;font-size:13px">
        @foreach($errors->all() as $error)
          <p style="margin:2px 0">{{ $error }}</p>
        @endforeach
      </div>
      @endif

      <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> {{ __('Save') }}</button>
    </form>
  </div>

  <div>
    <div class="test-card">
      <h2><i class="bi bi-send-check"></i> {{ __('Test sending') }}</h2>
      <p class="desc">{{ __('Send a test email to verify the configuration works correctly.') }}</p>

      @if($errors->has('smtp'))
      <div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;padding:10px 14px;margin-bottom:16px;color:#DC2626;font-size:13px">
        {{ $errors->first('smtp') }}
      </div>
      @endif

      <form action="{{ route('admin.smtp.test') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="test_email">{{ __('Test address') }}</label>
          <input type="email" name="test_email" id="test_email" value="{{ Auth::user()->email }}" placeholder="test@example.com" required>
        </div>
        <button type="submit" class="btn-test"><i class="bi bi-send-fill"></i> {{ __('Send test') }}</button>
      </form>
    </div>

    <div style="background:var(--lav-sub);border:1.5px solid var(--lav-bdr);border-radius:14px;padding:20px;margin-top:20px">
      <h4 style="font-size:14px;font-weight:700;color:var(--navy);margin:0 0 10px;display:flex;align-items:center;gap:6px"><i class="bi bi-info-circle-fill"></i> {{ __('Help') }}</h4>
      <ul style="margin:0;padding:0 0 0 16px;font-size:13px;color:var(--ink3);line-height:1.8">
        <li><strong>Gmail :</strong> smtp.gmail.com / port 587 / TLS</li>
        <li><strong>OVH :</strong> ssl0.ovh.net / port 587 / TLS</li>
        <li><strong>Ionos :</strong> smtp.ionos.fr / port 587 / TLS</li>
        <li><strong>Outlook :</strong> smtp.office365.com / port 587 / TLS</li>
        <li style="margin-top:6px;color:var(--slate)">{!! __('If disabled, the server uses local <code>sendmail</code>.') !!}</li>
      </ul>
    </div>
  </div>
</div>

<script>
function toggleSmtpFields() {
  const fields = document.getElementById('smtp-fields');
  const toggle = document.getElementById('smtp-toggle');
  fields.style.opacity = toggle.checked ? '1' : '.4';
  fields.style.pointerEvents = toggle.checked ? 'auto' : 'none';
}
toggleSmtpFields();
</script>
@endsection
