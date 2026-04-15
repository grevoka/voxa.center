<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('Account Setup') }} &mdash; Voxa Center</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--mid:#2563eb;--navy:#1e293b;--navy-dk:#0f172a;--slate:#64748b;--border:#e2e8f0;--bg:#f8fafc;--ink:#0f172a;--font:'Plus Jakarta Sans',sans-serif;--mono:'Fira Code',monospace}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font);background:linear-gradient(135deg,var(--navy-dk) 0%,var(--navy) 50%,#1e40af 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;-webkit-font-smoothing:antialiased}
.setup-card{background:#fff;border-radius:20px;padding:48px 44px;width:100%;max-width:460px;box-shadow:0 20px 60px rgba(30,41,59,.3)}
.setup-brand{text-align:center;margin-bottom:28px}
.setup-brand .brand-icon{width:48px;height:48px;background:var(--mid);border-radius:12px;display:inline-grid;place-items:center;margin-bottom:12px}
.setup-brand h1{font-weight:800;font-size:28px;color:var(--navy);letter-spacing:-.04em}
.setup-brand p{font-size:14px;color:var(--slate);margin-top:8px}
.welcome-box{background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:12px;padding:16px 18px;margin-bottom:24px}
.welcome-box p{font-size:14px;color:var(--navy);line-height:1.5}
.welcome-box strong{font-weight:700}
.fg{margin-bottom:18px}
.fg label{display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px}
.fc{width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none;transition:all .15s}
.fc:focus{border-color:var(--mid);background:#fff;box-shadow:0 0 0 3px rgba(37,99,235,.12)}
.fc-readonly{background:#f1f5f9;color:var(--slate);font-family:var(--mono);font-weight:600;letter-spacing:.02em;cursor:default}
.fc-readonly:focus{border-color:var(--border);background:#f1f5f9;box-shadow:none}
.btn-setup{width:100%;background:var(--mid);color:#fff;border:none;border-radius:10px;padding:14px;font-size:15px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 4px 16px rgba(37,99,235,.25)}
.btn-setup:hover{background:#1d4ed8;transform:translateY(-1px)}
.error-msg{background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;padding:10px 14px;color:#DC2626;font-size:13px;font-weight:600;margin-bottom:16px}
.hint{font-size:12px;color:var(--slate);margin-top:4px}
</style>
</head>
<body>
<div class="setup-card">
  <div class="setup-brand">
    <span class="brand-icon"><i class="bi bi-telephone-fill" style="color:#fff;font-size:22px"></i></span>
    <h1>Voxa Center</h1>
    <p>{{ __('Account Setup') }}</p>
  </div>

  <div class="welcome-box">
    <p>{{ __('Welcome') }}, <strong>{{ $client->name }}</strong>. {{ __('Please choose a password to activate your client area. Your login identifier is shown below — keep it safe.') }}</p>
  </div>

  @if($errors->any())
    <div class="error-msg">
      <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}
    </div>
  @endif

  <form action="{{ route('client.setup', $token) }}" method="POST">
    @csrf
    <div class="fg">
      <label>{{ __('Your login identifier') }}</label>
      <input type="text" class="fc fc-readonly" value="{{ $login }}" readonly>
      <div class="hint">{{ __('Use this identifier to log in to your client area.') }}</div>
    </div>
    <div class="fg">
      <label>{{ __('Password') }}</label>
      <input type="password" name="password" class="fc" placeholder="{{ __('Choose a secure password') }}" required autofocus minlength="8">
    </div>
    <div class="fg">
      <label>{{ __('Confirm password') }}</label>
      <input type="password" name="password_confirmation" class="fc" placeholder="{{ __('Confirm your password') }}" required minlength="8">
    </div>
    <button type="submit" class="btn-setup">
      <i class="bi bi-shield-lock-fill"></i> {{ __('Activate my account') }}
    </button>
  </form>
</div>
</body>
</html>
