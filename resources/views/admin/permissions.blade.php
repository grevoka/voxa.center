@extends('layouts.admin')

@section('title', __('Permissions'))

@section('content')
<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between">
  <div>
    <h1>{{ __('Role permissions') }}</h1>
    <p>{{ __('Define accessible sections for each role. Administrators have access to everything.') }}</p>
  </div>
  <a href="{{ route('admin.users') }}" class="btn-admin outline"><i class="bi bi-arrow-left"></i> {{ __('Users') }}</a>
</div>

<form action="{{ route('admin.permissions.update') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="table-card">
    <div class="header">
      <h3><i class="bi bi-shield-lock" style="color:var(--mid)"></i> {{ __('Permissions matrix') }}</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th style="width:300px">{{ __('Section') }}</th>
          <th style="text-align:center">
            <span class="perm-role-badge" style="background:#EBF3FF;color:#1e293b;border-color:#bfdbfe">
              <i class="bi bi-shield-lock-fill"></i> Admin
            </span>
          </th>
          @foreach($roles as $role)
          <th style="text-align:center">
            <span class="perm-role-badge" style="{{ $role === 'partner' ? 'background:#FFF7ED;color:#C2410C;border-color:#FED7AA' : 'background:#F0FDF4;color:#15803D;border-color:#BBF7D0' }}">
              <i class="bi bi-{{ $role === 'partner' ? 'handshake' : 'pencil-fill' }}"></i>
              {{ \App\Models\User::ROLES[$role] }}
            </span>
          </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($sections as $key => $section)
        <tr>
          <td style="font-weight:600">
            <i class="bi {{ $section['icon'] }}" style="color:var(--mid);margin-right:8px"></i>
            {{ $section['label'] }}
            @if(in_array($key, ['dashboard', 'password']))
              <span style="font-size:10px;color:var(--slate);font-weight:400;margin-left:6px">{{ __('(required)') }}</span>
            @endif
          </td>
          <td style="text-align:center">
            <i class="bi bi-check-circle-fill" style="color:#1e293b;font-size:18px"></i>
          </td>
          @foreach($roles as $role)
          <td style="text-align:center">
            @if(in_array($key, ['dashboard', 'password']))
              <input type="hidden" name="permissions[{{ $role }}][]" value="{{ $key }}">
              <i class="bi bi-check-circle-fill" style="color:#94A3B8;font-size:18px"></i>
            @else
              <label class="perm-toggle">
                <input type="checkbox" name="permissions[{{ $role }}][]" value="{{ $key }}" {{ in_array($key, $current[$role]) ? 'checked' : '' }}>
                <span class="perm-slider"></span>
              </label>
            @endif
          </td>
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div style="margin-top:24px;display:flex;justify-content:flex-end">
    <button type="submit" class="btn-admin primary" style="padding:12px 28px">
      <i class="bi bi-check-lg"></i> {{ __('Save permissions') }}
    </button>
  </div>
</form>

<style>
.perm-role-badge{display:inline-flex;align-items:center;gap:5px;border:1px solid;border-radius:8px;padding:4px 12px;font-size:12px;font-weight:700}
.perm-toggle{position:relative;display:inline-block;width:44px;height:24px;cursor:pointer}
.perm-toggle input{opacity:0;width:0;height:0}
.perm-slider{position:absolute;inset:0;background:#E2E8F0;border-radius:24px;transition:all .2s}
.perm-slider::before{content:'';position:absolute;width:18px;height:18px;border-radius:50%;background:#fff;top:3px;left:3px;transition:all .2s;box-shadow:0 1px 3px rgba(0,0,0,.15)}
.perm-toggle input:checked+.perm-slider{background:var(--mid)}
.perm-toggle input:checked+.perm-slider::before{transform:translateX(20px)}
</style>
@endsection
