@extends('layouts.admin')

@section('title', __('Users'))

@section('content')
<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between">
  <div>
    <h1>{{ __('Users') }}</h1>
    <p>{{ __('Manage administrator accounts.') }}</p>
  </div>
  <div style="display:flex;gap:10px">
    @if(Auth::user()->isAdmin())
      <a href="{{ route('admin.permissions') }}" class="btn-admin outline" style="padding:10px 20px">
        <i class="bi bi-shield-lock"></i> {{ __('Permissions') }}
      </a>
    @endif
    <a href="{{ route('admin.users.create') }}" class="btn-admin primary" style="padding:10px 20px">
      <i class="bi bi-person-plus-fill"></i> {{ __('New user') }}
    </a>
  </div>
</div>

<div class="table-card">
  <div class="header">
    <h3><i class="bi bi-people-fill" style="color:var(--mid)"></i> {{ $users->count() }} {{ __('user(s)') }}</h3>
  </div>
  <table>
    <thead>
      <tr>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Role') }}</th>
        <th>{{ __('Created') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td style="font-weight:600">
          {{ $user->name }}
          @if($user->id === Auth::id())
            <span style="display:inline-flex;align-items:center;gap:4px;background:var(--lav-sub);border:1px solid var(--lav-bdr);border-radius:6px;padding:2px 8px;font-size:10px;font-weight:700;color:var(--navy);margin-left:6px">{{ __('You') }}</span>
          @endif
        </td>
        <td style="color:var(--slate)">{{ $user->email }}</td>
        <td>
          @php
            $roleBg = match($user->role) {
              'admin' => 'background:#EBF3FF;color:#1e293b;border-color:#bfdbfe',
              'partner' => 'background:#FFF7ED;color:#C2410C;border-color:#FED7AA',
              'editor' => 'background:#F0FDF4;color:#15803D;border-color:#BBF7D0',
              default => 'background:#F1F5F9;color:#475569;border-color:#CBD5E1',
            };
          @endphp
          <span style="display:inline-flex;align-items:center;gap:4px;{{ $roleBg }};border:1px solid;border-radius:6px;padding:2px 10px;font-size:11px;font-weight:700">
            <i class="bi bi-{{ match($user->role) { 'admin' => 'shield-lock-fill', 'partner' => 'handshake', 'editor' => 'pencil-fill', default => 'person' } }}" style="font-size:10px"></i>
            {{ $user->roleName() }}
          </span>
        </td>
        <td style="color:var(--slate);font-size:13px">{{ $user->created_at->format('d/m/Y H:i') }}</td>
        <td>
          @if($user->id !== Auth::id())
            <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('{{ __('Delete this user?') }}')" style="display:inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-admin danger" style="padding:5px 12px;font-size:12px">
                <i class="bi bi-trash3"></i> {{ __('Delete') }}
              </button>
            </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@if($errors->has('delete'))
  <div style="background:#FEF2F2;border:1.5px solid #FECACA;border-radius:10px;padding:12px 20px;color:#DC2626;font-weight:600;font-size:14px;margin-top:16px">
    <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first('delete') }}
  </div>
@endif
@endsection
