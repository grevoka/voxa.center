@extends('layouts.admin')

@section('title', __('Schedule configuration'))

@section('content')
<style>
.sched-card{background:#fff;border:1.5px solid var(--border);border-radius:16px;padding:32px;max-width:700px}
.sched-card h2{font-family:var(--font);font-size:20px;font-weight:700;color:var(--navy);margin:0 0 6px;display:flex;align-items:center;gap:10px}
.sched-card h2 i{color:var(--mid)}
.sched-card .desc{font-size:13px;color:var(--slate);margin:0 0 24px}
.form-group{margin-bottom:18px}
.form-group label{display:block;font-size:12px;font-weight:600;color:var(--ink3);margin-bottom:6px;text-transform:uppercase;letter-spacing:.04em}
.form-group input,.form-group select{padding:10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:14px;font-family:var(--font);color:var(--ink);background:#fff;transition:border-color .15s}
.form-group input:focus,.form-group select:focus{outline:none;border-color:var(--cyan);box-shadow:0 0 0 3px rgba(59,130,246,.12)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.days-grid{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:4px}
.day-check{position:relative}
.day-check input{position:absolute;opacity:0}
.day-check label{display:flex;align-items:center;justify-content:center;width:48px;height:40px;border:1.5px solid var(--border);border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;color:var(--slate);transition:all .15s}
.day-check input:checked+label{background:var(--navy);color:#fff;border-color:var(--navy)}
.day-check label:hover{border-color:var(--lav-bdr)}
.btn-save{display:inline-flex;align-items:center;gap:8px;padding:10px 24px;background:var(--navy);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s}
.btn-save:hover{background:#1e40af;transform:translateY(-1px)}
.preview-box{background:var(--bg);border-radius:10px;padding:16px;margin-top:24px;font-size:13px;color:var(--ink3)}
.preview-box h4{font-size:13px;font-weight:700;color:var(--navy);margin:0 0 8px;display:flex;align-items:center;gap:6px}
.preview-slots{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}
.preview-slot{background:#fff;border:1px solid var(--border);border-radius:6px;padding:4px 10px;font-size:12px;font-weight:600;color:var(--navy)}
</style>

<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
  <div>
    <h1><i class="bi bi-clock-history" style="color:var(--mid)"></i> {{ __('Schedule configuration') }}</h1>
    <p>{{ __('Set the days and hours of availability for appointments') }}</p>
  </div>
  <a href="{{ route('admin.calendar') }}" class="btn-admin outline"><i class="bi bi-calendar3"></i> {{ __('View calendar') }}</a>
</div>

<div class="sched-card">
  <h2><i class="bi bi-gear-fill"></i> {{ __('Appointment schedule') }}</h2>
  <p class="desc">{{ __('Available slots will be generated automatically based on these settings.') }}</p>

  <form action="{{ route('admin.schedule.update') }}" method="POST">
    @csrf @method('PUT')

    <div class="form-group">
      <label>{{ __('Working days') }}</label>
      <div class="days-grid">
        @php
          $dayNames = [1 => __('Mon'), 2 => __('Tue'), 3 => __('Wed'), 4 => __('Thu'), 5 => __('Fri'), 6 => __('Sat'), 7 => __('Sun')];
          $selectedDays = old('days', $schedule['days']);
        @endphp
        @foreach($dayNames as $num => $name)
        <div class="day-check">
          <input type="checkbox" name="days[]" value="{{ $num }}" id="day{{ $num }}" {{ in_array($num, $selectedDays) ? 'checked' : '' }}>
          <label for="day{{ $num }}">{{ $name }}</label>
        </div>
        @endforeach
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>{{ __('Start time') }}</label>
        <input type="time" name="start" value="{{ old('start', $schedule['start']) }}" style="width:100%">
      </div>
      <div class="form-group">
        <label>{{ __('End time') }}</label>
        <input type="time" name="end" value="{{ old('end', $schedule['end']) }}" style="width:100%">
      </div>
    </div>

    <div class="form-group">
      <label>{{ __('Slot duration') }}</label>
      <select name="slot_duration" style="width:100%">
        <option value="30" {{ $schedule['slot_duration'] == '30' ? 'selected' : '' }}>30 minutes</option>
        <option value="45" {{ $schedule['slot_duration'] == '45' ? 'selected' : '' }}>45 minutes</option>
        <option value="60" {{ $schedule['slot_duration'] == '60' ? 'selected' : '' }}>{{ __('1 hour') }}</option>
        <option value="90" {{ $schedule['slot_duration'] == '90' ? 'selected' : '' }}>1h30</option>
        <option value="120" {{ $schedule['slot_duration'] == '120' ? 'selected' : '' }}>{{ __('2 hours') }}</option>
      </select>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>{{ __('Lunch break — start') }}</label>
        <input type="time" name="lunch_start" value="{{ old('lunch_start', $schedule['lunch_start']) }}" style="width:100%">
      </div>
      <div class="form-group">
        <label>{{ __('Lunch break — end') }}</label>
        <input type="time" name="lunch_end" value="{{ old('lunch_end', $schedule['lunch_end']) }}" style="width:100%">
      </div>
    </div>

    @if($errors->any())
    <div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;padding:10px 14px;margin-bottom:16px;color:#DC2626;font-size:13px">
      @foreach($errors->all() as $error)
        <p style="margin:2px 0">{{ $error }}</p>
      @endforeach
    </div>
    @endif

    <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> {{ __('Save') }}</button>
  </form>

  <div class="preview-box">
    <h4><i class="bi bi-eye"></i> {{ __('Generated slots preview') }}</h4>
    <p>{{ __('With current configuration:') }}</p>
    <div class="preview-slots">
      @php
        $current = \Carbon\Carbon::createFromFormat('H:i', $schedule['start']);
        $endTime = \Carbon\Carbon::createFromFormat('H:i', $schedule['end']);
        $lunchS = \Carbon\Carbon::createFromFormat('H:i', $schedule['lunch_start']);
        $lunchE = \Carbon\Carbon::createFromFormat('H:i', $schedule['lunch_end']);
        $dur = (int) $schedule['slot_duration'];
      @endphp
      @while($current->copy()->addMinutes($dur)->lte($endTime))
        @php $slotEnd = $current->copy()->addMinutes($dur); @endphp
        @if(!($current->lt($lunchE) && $slotEnd->gt($lunchS)))
          <span class="preview-slot">{{ $current->format('H:i') }} - {{ $slotEnd->format('H:i') }}</span>
        @endif
        @php $current->addMinutes($dur); @endphp
      @endwhile
    </div>
  </div>
</div>
@endsection
