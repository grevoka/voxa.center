@extends('layouts.admin')
@section('title', $visitor->ip . ' — Visiteur')

@push('styles')
<style>
.visitor-header{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:28px}
.visitor-ip{font-family:var(--mono);font-size:28px;font-weight:800;color:var(--ink);letter-spacing:-.5px}
.visitor-info-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px}
.vi-card{background:#fff;border:1.5px solid var(--border);border-radius:12px;padding:16px 20px}
.vi-label{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--slate);margin-bottom:4px;display:flex;align-items:center;gap:5px}
.vi-value{font-size:16px;font-weight:700;color:var(--ink)}
.vi-value.mono{font-family:var(--mono)}
.timeline{position:relative;padding-left:28px}
.timeline::before{content:'';position:absolute;left:9px;top:8px;bottom:8px;width:2px;background:var(--border);border-radius:2px}
.tl-item{position:relative;padding:12px 0 12px 20px;display:flex;align-items:flex-start;gap:16px}
.tl-dot{position:absolute;left:-23px;top:16px;width:12px;height:12px;border-radius:50%;background:#fff;border:2.5px solid var(--mid);z-index:1}
.tl-item:first-child .tl-dot{background:var(--mid);border-color:var(--mid)}
.tl-item:last-child .tl-dot{background:var(--mid);border-color:var(--mid)}
.tl-time{font-family:var(--mono);font-size:12px;color:var(--slate);min-width:70px;padding-top:2px}
.tl-content{flex:1}
.tl-path{font-size:14px;font-weight:600;color:var(--ink);word-break:break-all}
.tl-meta{display:flex;gap:8px;margin-top:4px;flex-wrap:wrap}
.tl-tag{font-size:11px;font-weight:600;padding:2px 8px;border-radius:5px;background:var(--bg);color:var(--slate);border:1px solid var(--border)}
.tl-tag.duration{background:#ecfdf5;color:#059669;border-color:#a7f3d0}
.tl-tag.bounce{background:#fef2f2;color:#dc2626;border-color:#fecaca}
.tl-tag.referrer{background:#f5f3ff;color:#6d28d9;border-color:#c4b5fd}
.source-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:8px;font-size:12px;font-weight:700}
.source-badge.search{background:#f5f3ff;color:#6d28d9}
.source-badge.social{background:#fdf4ff;color:#c026d3}
.source-badge.referral{background:#ecfeff;color:#0891b2}
.source-badge.direct{background:#f8fafc;color:#64748b}
@media(max-width:900px){.visitor-info-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.visitor-info-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="visitor-header">
  <div>
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:4px">
      <span class="visitor-ip">
        @if($visitor->country)<span title="{{ \App\Models\Visit::countryName($visitor->country) }}">{{ \App\Models\Visit::countryFlag($visitor->country) }}</span> @endif
        {{ $visitor->ip }}
      </span>
      @if($visitor->is_bot)
        <span class="source-badge" style="background:#fef2f2;color:#dc2626"><i class="bi bi-robot"></i> {{ $visitor->bot_name ?: 'Bot' }}</span>
      @else
        <span class="source-badge" style="background:#ecfdf5;color:#059669"><i class="bi bi-person"></i> {{ __('Humain') }}</span>
      @endif
      <span class="source-badge {{ $visitor->source }}">
        @if($visitor->source === 'search')<i class="bi bi-search"></i> {{ __('Moteurs de recherche') }}
        @elseif($visitor->source === 'social')<i class="bi bi-share"></i> {{ __('Reseaux sociaux') }}
        @elseif($visitor->source === 'referral')<i class="bi bi-box-arrow-in-right"></i> {{ __('Sites referents') }}
        @else<i class="bi bi-cursor"></i> {{ __('Trafic direct') }}
        @endif
      </span>
    </div>
    <p style="font-size:14px;color:var(--slate);margin:0">
      {{ __('Session') }} <code style="font-size:11px;background:var(--bg);padding:2px 6px;border-radius:4px;color:var(--slate)">{{ substr($visitor->session_id, 0, 16) }}...</code>
    </p>
  </div>
  <div style="display:flex;gap:8px">
    <a href="{{ route('admin.analytics.visitors') }}" class="btn-admin outline"><i class="bi bi-arrow-left"></i> {{ __('Visiteurs') }}</a>
    <a href="{{ route('admin.analytics') }}" class="btn-admin outline"><i class="bi bi-graph-up"></i> {{ __('Analytics') }}</a>
  </div>
</div>

<!-- INFO CARDS -->
<div class="visitor-info-grid">
  <div class="vi-card">
    <div class="vi-label"><i class="bi bi-eye"></i> {{ __('Pages vues') }}</div>
    <div class="vi-value mono">{{ $visitor->pageviews }}</div>
  </div>
  <div class="vi-card">
    <div class="vi-label"><i class="bi bi-clock"></i> {{ __('Duree totale') }}</div>
    <div class="vi-value mono">
      @php $m = floor($visitor->total_duration / 60); $s = $visitor->total_duration % 60; @endphp
      {{ $m }}m {{ str_pad($s, 2, '0', STR_PAD_LEFT) }}s
    </div>
  </div>
  <div class="vi-card">
    <div class="vi-label"><i class="bi bi-calendar"></i> {{ __('Premiere visite') }}</div>
    <div class="vi-value" style="font-size:14px">{{ $visitor->first_seen->format('d/m/Y H:i') }}</div>
  </div>
  <div class="vi-card">
    <div class="vi-label"><i class="bi bi-clock-history"></i> {{ __('Derniere activite') }}</div>
    <div class="vi-value" style="font-size:14px">{{ $visitor->last_seen->diffForHumans() }}</div>
  </div>
</div>

<!-- DEVICE & GEO INFO -->
<div class="detail-card" style="margin-bottom:28px">
  <div style="display:flex;gap:32px;flex-wrap:wrap">
    @if($visitor->hostname)
    <div class="detail-row" style="border:none;padding:0">
      <span class="detail-label"><i class="bi bi-hdd-network"></i> Hostname</span>
      <span class="detail-value" style="font-family:var(--mono);font-size:13px">{{ $visitor->hostname }}</span>
    </div>
    @endif
    @if($visitor->country)
    <div class="detail-row" style="border:none;padding:0">
      <span class="detail-label"><i class="bi bi-geo-alt"></i> {{ __('Pays') }}</span>
      <span class="detail-value">{{ \App\Models\Visit::countryFlag($visitor->country) }} {{ \App\Models\Visit::countryName($visitor->country) }}</span>
    </div>
    @endif
    <div class="detail-row" style="border:none;padding:0">
      <span class="detail-label"><i class="bi bi-{{ $visitor->device === 'mobile' ? 'phone' : ($visitor->device === 'tablet' ? 'tablet' : 'laptop') }}"></i> {{ __('Appareil') }}</span>
      <span class="detail-value">{{ ucfirst($visitor->device) }}</span>
    </div>
    <div class="detail-row" style="border:none;padding:0">
      <span class="detail-label"><i class="bi bi-globe"></i> {{ __('Navigateur') }}</span>
      <span class="detail-value">{{ $visitor->browser }} {{ $visitor->browser_version }}</span>
    </div>
    <div class="detail-row" style="border:none;padding:0">
      <span class="detail-label"><i class="bi bi-cpu"></i> {{ __('Systeme') }}</span>
      <span class="detail-value">{{ $visitor->os }}</span>
    </div>
    @if($visitor->referrer_host)
    <div class="detail-row" style="border:none;padding:0">
      <span class="detail-label"><i class="bi bi-box-arrow-in-right"></i> {{ __('Source') }}</span>
      <span class="detail-value">{{ \App\Models\Visit::cleanReferrerName($visitor->referrer_host) }}</span>
    </div>
    @endif
  </div>
</div>

<!-- TIMELINE -->
<div class="table-card">
  <div class="header">
    <h3><i class="bi bi-activity"></i> {{ __('Parcours de navigation') }}</h3>
    <span style="font-size:13px;color:var(--slate)">{{ $visits->count() }} {{ __('pages') }}</span>
  </div>
  <div style="padding:20px 24px">
    <div class="timeline">
      @foreach($visits as $visit)
      <div class="tl-item">
        <span class="tl-dot"></span>
        <span class="tl-time">{{ $visit->created_at->format('H:i:s') }}</span>
        <div class="tl-content">
          <div class="tl-path">{{ $visit->path }}</div>
          <div class="tl-meta">
            @if($visit->duration > 0)
              <span class="tl-tag duration">
                <i class="bi bi-clock"></i>
                @php $vm = floor($visit->duration / 60); $vs = $visit->duration % 60; @endphp
                {{ $vm > 0 ? $vm . 'm ' : '' }}{{ $vs }}s
              </span>
            @endif
            @if($visit->is_bounce)
              <span class="tl-tag bounce"><i class="bi bi-arrow-return-left"></i> Bounce</span>
            @endif
            @if($visit->referrer_host && $loop->first)
              <span class="tl-tag referrer"><i class="bi bi-box-arrow-in-right"></i> {{ \App\Models\Visit::cleanReferrerName($visit->referrer_host) }}</span>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
