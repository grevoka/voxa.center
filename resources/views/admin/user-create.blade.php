@extends('layouts.admin')

@section('title', __('New user'))

@section('content')
<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between">
  <div>
    <h1>{{ __('New user') }}</h1>
    <p>{{ __('Create a new administrator account.') }}</p>
  </div>
  <a href="{{ route('admin.users') }}" class="btn-admin outline"><i class="bi bi-arrow-left"></i> {{ __('Back') }}</a>
</div>

<div class="detail-card" style="max-width:500px">
  @if($errors->any())
    <div style="background:#FEF2F2;border:1.5px solid #FECACA;border-radius:10px;padding:12px 20px;color:#DC2626;font-weight:600;font-size:14px;margin-bottom:20px">
      <i class="bi bi-exclamation-triangle-fill"></i>
      @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif

  <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div style="margin-bottom:18px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('Full name') }}</label>
      <input type="text" name="name" value="{{ old('name') }}" required autocomplete="off"
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none"
        placeholder="{{ __('John Doe') }}">
    </div>

    <div style="margin-bottom:18px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('Email address') }}</label>
      <input type="email" name="email" value="{{ old('email') }}" required autocomplete="off"
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none"
        placeholder="user@voxa.center">
    </div>

    <div style="margin-bottom:18px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('Role') }}</label>
      <select name="role" required
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none;cursor:pointer">
        @foreach(\App\Models\User::ROLES as $value => $label)
          <option value="{{ $value }}" {{ old('role', 'editor') === $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <div style="margin-bottom:18px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('Password') }}</label>
      <input type="password" name="password" required minlength="6" autocomplete="new-password"
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none">
      <div style="font-size:11px;color:var(--slate);margin-top:4px">{{ __('Minimum 6 characters') }}</div>
    </div>

    <div style="margin-bottom:24px">
      <label style="display:block;font-size:13px;font-weight:600;color:#2E3D60;margin-bottom:6px">{{ __('Confirm password') }}</label>
      <input type="password" name="password_confirmation" required autocomplete="new-password"
        style="width:100%;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;font-size:14px;font-family:var(--font);color:var(--ink);outline:none">
    </div>

    <button type="submit" class="btn-admin primary" style="padding:12px 28px">
      <i class="bi bi-person-plus-fill"></i> {{ __('Create user') }}
    </button>
  </form>
</div>
@endsection
