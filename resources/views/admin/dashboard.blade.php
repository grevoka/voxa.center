@extends('layouts.admin')

@section('title', __('Dashboard'))

@section('content')
<div class="admin-header">
  <h1>{{ __('Dashboard') }}</h1>
  <p>{{ __('Welcome to the administration panel.') }}</p>
</div>

@if($hasContacts)
<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="card-stat">
      <div class="num" style="color:var(--navy)">{{ $stats['total'] }}</div>
      <div class="label">{{ __('Total requests') }}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card-stat">
      <div class="num" style="color:#DC2626">{{ $stats['unread'] }}</div>
      <div class="label">{{ __('Unread') }}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card-stat">
      <div class="num" style="color:#16A34A">{{ $stats['today'] }}</div>
      <div class="label">{{ __('Today') }}</div>
    </div>
  </div>
</div>

<div class="table-card">
  <div class="header">
    <h3><i class="bi bi-envelope-fill" style="color:var(--mid)"></i> {{ __('Latest requests') }}</h3>
    <a href="{{ route('admin.contacts') }}" class="btn-admin outline">{{ __('View all') }} <i class="bi bi-arrow-right"></i></a>
  </div>
  <table>
    <thead>
      <tr>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Company') }}</th>
        <th>{{ __('Desired appointment') }}</th>
        <th>{{ __('Date') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse(\App\Models\Contact::active()->orderByDesc('created_at')->limit(10)->get() as $contact)
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
        <td colspan="7" style="text-align:center;color:var(--slate);padding:40px">{{ __('No contact requests yet.') }}</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@else
<div class="detail-card" style="text-align:center;padding:60px 32px">
  <i class="bi bi-grid-1x2-fill" style="font-size:40px;color:var(--border);display:block;margin-bottom:12px"></i>
  <p style="font-size:16px;font-weight:600;color:var(--navy);margin:0 0 6px">{{ __('Welcome') }}, {{ Auth::user()->name }}</p>
  <p style="font-size:14px;color:var(--slate);margin:0">{{ __('Use the menu to navigate between sections.') }}</p>
</div>
@endif
@endsection
