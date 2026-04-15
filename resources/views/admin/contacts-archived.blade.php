@extends('layouts.admin')

@section('title', __('Archives'))

@section('content')
<div class="admin-header">
  <div style="display:flex;align-items:center;justify-content:space-between">
    <div>
      <h1><i class="bi bi-archive" style="color:var(--mid)"></i> {{ __('Archived requests') }}</h1>
      <p>{{ $contacts->total() }} {{ __('archived request(s)') }}</p>
    </div>
    <a href="{{ route('admin.contacts') }}" class="btn-admin outline"><i class="bi bi-arrow-left"></i> {{ __('Back to active requests') }}</a>
  </div>
</div>

<div class="table-card">
  <div class="header">
    <h3><i class="bi bi-archive" style="color:var(--slate)"></i> {{ __('Archives') }}</h3>
    <form action="{{ route('admin.contacts.archived') }}" method="GET" class="search-box">
      <i class="bi bi-search"></i>
      <input type="text" name="search" placeholder="{{ __('Search...') }}" value="{{ request('search') }}">
    </form>
  </div>
  <table>
    <thead>
      <tr>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Company') }}</th>
        <th>{{ __('Profile') }}</th>
        <th>{{ __('Archived on') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($contacts as $contact)
      <tr>
        <td style="font-weight:600">{{ $contact->name }}</td>
        <td style="color:var(--slate)">{{ $contact->email }}</td>
        <td>{{ $contact->company ?? '—' }}</td>
        <td style="font-size:13px">{{ $contact->profile ?? '—' }}</td>
        <td style="color:var(--slate);font-size:13px">{{ $contact->archived_at->format('d/m/Y H:i') }}</td>
        <td style="display:flex;gap:6px">
          <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-admin outline" style="padding:5px 12px;font-size:12px">{{ __('View') }}</a>
          <form action="{{ route('admin.contacts.unarchive', $contact) }}" method="POST" style="margin:0">
            @csrf
            <button type="submit" class="btn-admin primary" style="padding:5px 12px;font-size:12px"><i class="bi bi-arrow-counterclockwise"></i> {{ __('Restore') }}</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" style="text-align:center;color:var(--slate);padding:40px">{{ __('No archived requests.') }}</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

@if($contacts->hasPages())
<div class="mt-4 d-flex justify-content-center">
  {{ $contacts->withQueryString()->links() }}
</div>
@endif
@endsection
