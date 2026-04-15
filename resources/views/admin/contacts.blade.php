@extends('layouts.admin')

@section('title', __('Contact requests'))

@section('content')
<div class="admin-header">
  <h1>{{ __('Contact requests') }}</h1>
  <p>{{ __('All demo requests received via the form.') }}</p>
</div>

<div class="table-card">
  <div class="header">
    <div style="display:flex;align-items:center;gap:12px">
      <h3><i class="bi bi-envelope-fill" style="color:var(--mid)"></i> {{ $contacts->total() }} {{ __('request(s)') }}</h3>
      <a href="{{ route('admin.contacts', ['filter' => 'unread']) }}" class="btn-admin {{ request('filter') === 'unread' ? 'primary' : 'outline' }}" style="padding:5px 12px;font-size:12px">
        {{ __('Unread') }}
      </a>
      @if(request('filter'))
        <a href="{{ route('admin.contacts') }}" class="btn-admin outline" style="padding:5px 12px;font-size:12px">{{ __('Show all') }}</a>
      @endif
      @if(isset($archivedCount) && $archivedCount > 0)
        <a href="{{ route('admin.contacts.archived') }}" class="btn-admin outline" style="padding:5px 12px;font-size:12px">
          <i class="bi bi-archive"></i> {{ __('Archives') }} ({{ $archivedCount }})
        </a>
      @endif
    </div>
    <form action="{{ route('admin.contacts') }}" method="GET" class="search-box">
      <i class="bi bi-search"></i>
      <input type="text" name="search" placeholder="{{ __('Search...') }}" value="{{ request('search') }}">
    </form>
  </div>
  <table>
    <thead>
      <tr>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Company') }}</th>
        <th>{{ __('Profile') }}</th>
        <th>{{ __('Preferred slot') }}</th>
        <th>{{ __('Date') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($contacts as $contact)
      <tr>
        <td>
          @if(!$contact->read)
            <span class="badge-unread"><i class="bi bi-circle-fill" style="font-size:6px"></i> {{ __('New') }}</span>
          @else
            <span class="badge-read"><i class="bi bi-check-circle-fill" style="font-size:10px"></i> {{ __('Read') }}</span>
          @endif
        </td>
        <td style="font-weight:600">{{ $contact->name }}</td>
        <td style="color:var(--slate)">{{ $contact->email }}</td>
        <td>{{ $contact->company ?? '—' }}</td>
        <td style="font-size:13px">{{ $contact->profile ?? '—' }}</td>
        <td style="font-size:13px">
          @if($contact->preferred_date)
            <span style="display:inline-flex;align-items:center;gap:4px;background:var(--lav-sub);border:1px solid var(--lav-bdr);border-radius:6px;padding:3px 8px;font-size:11px;font-weight:600;color:var(--navy);white-space:nowrap">
              <i class="bi bi-calendar-check" style="font-size:10px;color:var(--mid)"></i>
              {{ $contact->preferred_date->format('d/m') }} {{ $contact->preferred_time }}
            </span>
          @else
            &mdash;
          @endif
        </td>
        <td style="color:var(--slate);font-size:13px">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
        <td><a href="{{ route('admin.contacts.show', $contact) }}" class="btn-admin outline" style="padding:5px 12px;font-size:12px">{{ __('View') }}</a></td>
      </tr>
      @empty
      <tr>
        <td colspan="8" style="text-align:center;color:var(--slate);padding:40px">{{ __('No matching requests.') }}</td>
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
