<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('Client Login') }} &mdash; Voxa Center</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--mid:#2563eb;--navy:#1e293b;--navy-dk:#0f172a;--slate:#64748b;--border:#e2e8f0;--bg:#f8fafc;--ink:#0f172a;--font:'Plus Jakarta Sans',sans-serif}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font);background:linear-gradient(135deg,var(--navy-dk) 0%,var(--navy) 50%,#1e40af 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;-webkit-font-smoothing:antialiased}
.login-card{background:#fff;border-radius:20px;padding:48px 44px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(30,41,59,.3)}
.login-brand{text-align:center;margin-bottom:32px}
.login-brand .brand-icon{width:48px;height:48px;background:var(--mid);border-radius:12px;display:inline-grid;place-items:center;margin-bottom:12px}
.login-brand h1{font-weight:800;font-size:28px;color:var(--navy);letter-spacing:-.04em}
.login-brand p{font-size:14px;color:var(--slate);margin-top:8px}
.fg{margin-bottom:18px}
.fg label{display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px}
.fc{width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none;transition:all .15s}
.fc:focus{border-color:var(--mid);background:#fff;box-shadow:0 0 0 3px rgba(37,99,235,.12)}
.btn-login{width:100%;background:var(--mid);color:#fff;border:none;border-radius:10px;padding:14px;font-size:15px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 4px 16px rgba(37,99,235,.25)}
.btn-login:hover{background:#1d4ed8;transform:translateY(-1px)}
.check-row{display:flex;align-items:center;gap:8px;margin-bottom:20px}
.check-row input{accent-color:var(--mid)}
.check-row label{font-size:13px;color:var(--slate);cursor:pointer}
.error-msg{background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;padding:10px 14px;color:#DC2626;font-size:13px;font-weight:600;margin-bottom:16px}
.back-link{text-align:center;margin-top:20px}
.back-link a{color:var(--slate);font-size:13px;text-decoration:none}
.back-link a:hover{color:var(--navy)}
.login-hint{font-size:12px;color:var(--slate);margin-top:4px}
</style>
</head>
<body>
<div class="login-card">
  <div class="login-brand">
    <span class="brand-icon"><i class="bi bi-telephone-fill" style="color:#fff;font-size:22px"></i></span>
    <h1>Voxa Center</h1>
    <p>{{ __('Espace Client') }}</p>
  </div>

  @if($errors->any())
    <div class="error-msg">
      <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}
    </div>
  @endif

  <form action="{{ route('client.login') }}" method="POST">
    @csrf
    <div class="fg">
      <label>{{ __('Login') }}</label>
      <input type="text" name="login" class="fc" placeholder="{{ __('Your login (e.g. VX-DUPJEA1B2C)') }}" value="{{ old('login') }}" required autofocus autocomplete="off">
      <div class="login-hint">{{ __('The identifier received by email when your account was created.') }}</div>
    </div>
    <div class="fg">
      <label>{{ __('Password') }}</label>
      <input type="password" name="password" class="fc" placeholder="{{ __('Your password') }}" required>
    </div>
    <div class="check-row">
      <input type="checkbox" name="remember" id="remember">
      <label for="remember">{{ __('Remember me') }}</label>
    </div>
    <button type="submit" class="btn-login">
      <i class="bi bi-box-arrow-in-right"></i> {{ __('Sign in') }}
    </button>
  </form>
  <div class="back-link">
    <a href="{{ route('home') }}"><i class="bi bi-arrow-left"></i> {{ __('Back to website') }}</a>
  </div>
</div>
</body>
</html>
