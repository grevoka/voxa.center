@extends('layouts.admin')

@section('title', __('Change my password'))

@section('content')
<div class="admin-header">
  <h1>{{ __('Change my password') }}</h1>
  <p>{{ __('Change your administrator account password.') }}</p>
</div>

<div class="detail-card" style="max-width:500px">
  @if($errors->any())
    <div style="background:#FEF2F2;border:1.5px solid #FECACA;border-radius:10px;padding:12px 20px;color:#DC2626;font-weight:600;font-size:14px;margin-bottom:20px">
      <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}
    </div>
  @endif

  <form action="{{ route('admin.password.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div style="margin-bottom:18px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('Current password') }}</label>
      <input type="password" name="current_password" required autocomplete="off"
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none">
    </div>

    <div style="margin-bottom:18px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('New password') }}</label>
      <input type="password" name="password" required minlength="6" autocomplete="new-password"
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none">
      <div style="font-size:11px;color:var(--slate);margin-top:4px">{{ __('Minimum 6 characters') }}</div>
    </div>

    <div style="margin-bottom:24px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('Confirm new password') }}</label>
      <input type="password" name="password_confirmation" required autocomplete="new-password"
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none">
    </div>

    <button type="submit" class="btn-admin primary" style="padding:12px 28px">
      <i class="bi bi-check-lg"></i> {{ __('Change password') }}
    </button>
  </form>
</div>
@endsection
