@extends('layouts.admin')

@section('title', __('Appointments calendar'))

@section('content')
<style>
.cal-wrap{background:#fff;border:1.5px solid var(--border);border-radius:16px;padding:24px;min-height:600px}
.fc{font-family:var(--font)!important}
.fc .fc-toolbar-title{font-family:var(--font)!important;font-size:20px!important;font-weight:700!important;color:var(--navy)!important}
.fc .fc-button-primary{background:var(--navy)!important;border-color:var(--navy)!important;font-size:13px!important;font-weight:600!important;border-radius:8px!important;padding:6px 14px!important}
.fc .fc-button-primary:not(:disabled):hover{background:#1e40af!important}
.fc .fc-button-primary:not(:disabled).fc-button-active{background:var(--cyan)!important;border-color:var(--cyan)!important;color:#fff!important}
.fc .fc-daygrid-day-number{color:var(--ink3);font-weight:600;font-size:13px}
.fc .fc-col-header-cell-cushion{color:var(--navy);font-weight:700;font-size:12px;text-transform:uppercase}
.fc .fc-event{border-radius:6px!important;padding:2px 6px!important;font-size:12px!important;font-weight:600!important;border:none!important;cursor:pointer!important}
.fc .fc-timegrid-slot{height:40px!important}
.fc .fc-timegrid-slot-label-cushion{font-size:12px;color:var(--slate);font-weight:600}
.fc .fc-day-today{background:rgba(59,130,246,.06)!important}
.fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number{background:var(--cyan);color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center}
.cal-legend{display:flex;gap:16px;margin-bottom:20px;flex-wrap:wrap}
.cal-legend .item{display:flex;align-items:center;gap:6px;font-size:13px;color:var(--ink3);font-weight:500}
.cal-legend .dot{width:12px;height:12px;border-radius:3px}
.cal-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px}
.cal-stat{background:var(--bg);border-radius:10px;padding:16px;text-align:center}
.cal-stat .num{font-family:var(--mono);font-size:28px;font-weight:700;color:var(--navy)}
.cal-stat .lbl{font-size:12px;color:var(--slate);font-weight:600;margin-top:2px}
.upcoming-block{background:#fff;border:1.5px solid var(--border);border-radius:16px;padding:24px;margin-bottom:24px}
.upcoming-block h3{font-family:var(--font);font-size:18px;font-weight:700;color:var(--navy);margin:0 0 16px;display:flex;align-items:center;gap:8px}
.upcoming-block h3 .badge-count{background:var(--cyan);color:#fff;font-size:12px;font-weight:700;padding:2px 10px;border-radius:20px;font-family:var(--font)}
.upcoming-list{list-style:none;padding:0;margin:0}
.upcoming-list li{display:flex;align-items:center;gap:16px;padding:12px 0;border-bottom:1px solid var(--border)}
.upcoming-list li:last-child{border-bottom:none}
.upcoming-date{min-width:100px;font-family:var(--mono);font-size:13px;font-weight:600;color:var(--navy);display:flex;flex-direction:column;gap:2px}
.upcoming-date .day{font-family:var(--font);font-size:11px;color:var(--slate);font-weight:500;text-transform:uppercase}
.upcoming-slot{background:var(--lav-sub);color:var(--navy);font-size:12px;font-weight:700;padding:4px 10px;border-radius:6px;white-space:nowrap}
.upcoming-info{flex:1;min-width:0}
.upcoming-info .name{font-size:14px;font-weight:700;color:var(--navy);margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.upcoming-info .company{font-size:12px;color:var(--slate);margin:2px 0 0}
.upcoming-link{display:inline-flex;align-items:center;gap:4px;font-size:12px;font-weight:600;color:var(--mid);text-decoration:none;white-space:nowrap;transition:color .15s}
.upcoming-link:hover{color:var(--navy);text-decoration:underline}
.upcoming-empty{text-align:center;padding:20px;color:var(--slate);font-size:14px}
</style>

<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
  <div>
    <h1><i class="bi bi-calendar3" style="color:var(--mid)"></i> {{ __('Appointments calendar') }}</h1>
    <p>{{ __('Overview of scheduled demos') }}</p>
  </div>
  <a href="{{ route('admin.schedule') }}" class="btn-admin outline"><i class="bi bi-clock-history"></i> {{ __('Configure schedule') }}</a>
</div>

@php
  $todayCount = \App\Models\Appointment::where('date', today())->confirmed()->count();
  $weekCount = \App\Models\Appointment::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->confirmed()->count();
  $monthCount = \App\Models\Appointment::whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])->confirmed()->count();
  $upcoming = \App\Models\Appointment::with('contact')
      ->confirmed()
      ->where('date', '>=', today())
      ->orderBy('date')
      ->orderBy('time_slot')
      ->limit(10)
      ->get();
@endphp

<div class="cal-stats">
  <div class="cal-stat">
    <div class="num">{{ $todayCount }}</div>
    <div class="lbl">{{ __('Today') }}</div>
  </div>
  <div class="cal-stat">
    <div class="num">{{ $weekCount }}</div>
    <div class="lbl">{{ __('This week') }}</div>
  </div>
  <div class="cal-stat">
    <div class="num">{{ $monthCount }}</div>
    <div class="lbl">{{ __('This month') }}</div>
  </div>
</div>

<div class="upcoming-block">
  <h3>
    <i class="bi bi-calendar-check" style="color:var(--mid)"></i> {{ __('Upcoming appointments') }}
    <span class="badge-count">{{ $upcoming->count() }}</span>
  </h3>
  @if($upcoming->count())
  <ul class="upcoming-list">
    @foreach($upcoming as $appt)
    <li>
      <div class="upcoming-date">
        <span>{{ $appt->date->format('d/m/Y') }}</span>
        <span class="day">{{ $appt->date->translatedFormat('l') }}</span>
      </div>
      <span class="upcoming-slot">{{ $appt->time_slot }}</span>
      <div class="upcoming-info">
        <p class="name">{{ $appt->contact->name ?? '—' }}</p>
        @if($appt->contact->company ?? null)
        <p class="company">{{ $appt->contact->company }}</p>
        @endif
      </div>
      <a href="{{ route('admin.contacts.show', $appt->contact_id) }}" class="upcoming-link">
        <i class="bi bi-arrow-right-circle"></i> {{ __('View profile') }}
      </a>
    </li>
    @endforeach
  </ul>
  @else
  <div class="upcoming-empty">
    <i class="bi bi-calendar-x" style="font-size:24px;display:block;margin-bottom:6px;color:var(--border)"></i>
    {{ __('No upcoming appointments') }}
  </div>
  @endif
</div>

<div class="cal-wrap">
  <div id="calendar"></div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const calEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calEl, {
    initialView: 'timeGridWeek',
    locale: 'fr',
    firstDay: 1,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    slotMinTime: '08:00:00',
    slotMaxTime: '19:00:00',
    allDaySlot: false,
    nowIndicator: true,
    height: 'auto',
    events: {
      url: '{{ route("admin.calendar.events") }}',
      method: 'GET',
    },
    eventClick: function(info){
      if (info.event.url) {
        info.jsEvent.preventDefault();
        window.location.href = info.event.url;
      }
    },
    eventDidMount: function(info){
      const props = info.event.extendedProps;
      info.el.title = info.event.title + '\n' + (props.company ? props.company + '\n' : '') + props.email + '\n' + props.slot;
    }
  });
  calendar.render();
});
</script>
@endsection
