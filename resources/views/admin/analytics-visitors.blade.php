@extends('layouts.admin')
@section('title', __('Visiteurs') . ' — Analytics')

@push('styles')
<style>
.filter-bar{display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:24px}
.filter-bar .period-tabs{display:flex;gap:4px;background:#fff;border:1.5px solid var(--border);border-radius:10px;padding:3px}
.filter-bar .period-tab{padding:6px 12px;font-size:12px;font-weight:600;border-radius:7px;cursor:pointer;color:var(--slate);border:none;background:transparent;font-family:var(--font);transition:all .15s;text-decoration:none;display:inline-block}
.filter-bar .period-tab.active{background:var(--mid);color:#fff}
.filter-bar .period-tab:hover:not(.active){background:var(--bg);color:var(--ink)}

/* VISITOR CARDS */
.visitors-grid{display:flex;flex-direction:column;gap:10px}
.visitor-card{display:grid;grid-template-columns:auto 1fr auto;gap:16px;align-items:center;background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:18px 22px;transition:all .2s;text-decoration:none;color:inherit;cursor:pointer}
.visitor-card:hover{border-color:var(--lav-bdr);box-shadow:0 4px 20px rgba(37,99,235,.06);transform:translateY(-1px)}

/* Left: avatar + IP */
.vc-identity{display:flex;align-items:center;gap:14px;min-width:220px}
.vc-avatar{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.vc-avatar.human{background:linear-gradient(135deg,#ecfdf5,#d1fae5);color:#059669}
.vc-avatar.bot{background:linear-gradient(135deg,#fef2f2,#fecaca);color:#dc2626}
.vc-ip{font-family:var(--mono);font-size:14px;font-weight:700;color:var(--ink)}
.vc-host{font-size:11px;color:var(--slate);font-family:var(--mono);margin-top:1px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px}
.vc-flag{font-size:18px;margin-right:2px}

/* Middle: tags */
.vc-tags{display:flex;flex-wrap:wrap;gap:6px;align-items:center}
.vc-tag{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:8px;font-size:11px;font-weight:600;background:var(--bg);color:var(--slate);border:1px solid var(--border);white-space:nowrap}
.vc-tag.source-search{background:#f5f3ff;color:#6d28d9;border-color:#ddd6fe}
.vc-tag.source-social{background:#fdf4ff;color:#c026d3;border-color:#f0abfc}
.vc-tag.source-referral{background:#ecfeff;color:#0891b2;border-color:#a5f3fc}
.vc-tag.source-direct{background:#f8fafc;color:#64748b;border-color:#e2e8f0}
.vc-tag.type-bot{background:#fef2f2;color:#dc2626;border-color:#fecaca}
.vc-tag.type-human{background:#ecfdf5;color:#059669;border-color:#a7f3d0}

/* Right: stats */
.vc-stats{display:flex;align-items:center;gap:20px;min-width:200px;justify-content:flex-end}
.vc-stat{text-align:center}
.vc-stat-value{font-family:var(--mono);font-size:16px;font-weight:700;color:var(--ink);line-height:1}
.vc-stat-label{font-size:10px;font-weight:600;color:var(--slate);text-transform:uppercase;letter-spacing:.04em;margin-top:3px}
.vc-time{font-size:12px;color:var(--slate);text-align:right;min-width:100px}
.vc-arrow{color:var(--border);font-size:18px;transition:color .15s}
.visitor-card:hover .vc-arrow{color:var(--mid)}

/* Live indicator */
.vc-live{width:8px;height:8px;background:#22c55e;border-radius:50%;animation:livePulse 2s infinite;flex-shrink:0}
@keyframes livePulse{0%,100%{opacity:1}50%{opacity:.3}}

/* Pagination */
.pagination-wrap{display:flex;align-items:center;justify-content:center;gap:4px;margin-top:24px}
.pg-btn{display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 10px;border-radius:8px;font-size:13px;font-weight:600;font-family:var(--font);color:var(--slate);background:#fff;border:1.5px solid var(--border);text-decoration:none;transition:all .15s;cursor:pointer}
.pg-btn:hover:not(.active):not(.disabled){border-color:var(--mid);color:var(--mid);background:#f8fafc}
.pg-btn.active{background:var(--mid);color:#fff;border-color:var(--mid)}
.pg-btn.disabled{opacity:.4;cursor:default}

@media(max-width:900px){
  .visitor-card{grid-template-columns:1fr;gap:12px}
  .vc-stats{justify-content:flex-start}
  .vc-identity{min-width:auto}
}
</style>
@endpush

@section('content')
<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
  <div>
    <h1><i class="bi bi-people" style="color:var(--mid)"></i> {{ __('Visiteurs') }}</h1>
    <p style="margin:4px 0 0">{{ __('Detail par session / IP') }} &mdash; <strong>{{ $visitors->total() }}</strong> {{ __('sessions') }}</p>
  </div>
  <a href="{{ route('admin.analytics') }}" class="btn-admin outline"><i class="bi bi-arrow-left"></i> {{ __('Analytics') }}</a>
</div>

<div class="filter-bar">
  <form method="GET" style="display:flex;gap:8px;align-items:center">
    <div class="search-box">
      <i class="bi bi-search"></i>
      <input type="text" name="search" placeholder="{{ __('Rechercher par IP ou hostname...') }}" value="{{ request('search') }}">
    </div>
    <input type="hidden" name="period" value="{{ request('period', '7d') }}">
    <button type="submit" class="btn-admin primary" style="padding:9px 16px"><i class="bi bi-search"></i></button>
  </form>
  <div class="period-tabs">
    <a href="{{ route('admin.analytics.visitors', ['period' => 'today', 'search' => request('search')]) }}" class="period-tab {{ request('period') === 'today' ? 'active' : '' }}">{{ __('Today') }}</a>
    <a href="{{ route('admin.analytics.visitors', ['period' => '7d', 'search' => request('search')]) }}" class="period-tab {{ request('period', '7d') === '7d' ? 'active' : '' }}">7j</a>
    <a href="{{ route('admin.analytics.visitors', ['period' => '30d', 'search' => request('search')]) }}" class="period-tab {{ request('period') === '30d' ? 'active' : '' }}">30j</a>
  </div>
</div>

<div class="visitors-grid">
  @forelse($visitors as $v)
    @php
      $isBot = (bool) $v->is_bot;
      $isLive = $v->last_seen >= now()->subMinutes(5);
    @endphp
    <a href="{{ route('admin.analytics.visitor', $v->session_id) }}" class="visitor-card">
      {{-- Identity --}}
      <div class="vc-identity">
        <div class="vc-avatar {{ $isBot ? 'bot' : 'human' }}">
          @if($isBot)
            <i class="bi bi-robot"></i>
          @else
            <i class="bi bi-person-fill"></i>
          @endif
        </div>
        <div>
          <div class="vc-ip">
            @if($isLive)<span class="vc-live" title="En ligne"></span> @endif
            @if($v->country)<span class="vc-flag">{{ \App\Models\Visit::countryFlag($v->country) }}</span>@endif
            {{ $v->ip }}
          </div>
          @if($v->hostname)
            <div class="vc-host" title="{{ $v->hostname }}">{{ $v->hostname }}</div>
          @endif
        </div>
      </div>

      {{-- Tags --}}
      <div class="vc-tags">
        @if($isBot)
          <span class="vc-tag type-bot"><i class="bi bi-robot"></i> {{ $v->bot_name ?: 'Bot' }}</span>
        @else
          <span class="vc-tag type-human"><i class="bi bi-person"></i> {{ __('Humain') }}</span>
        @endif

        <span class="vc-tag source-{{ $v->source }}">
          @if($v->source === 'search')<i class="bi bi-search"></i>
          @elseif($v->source === 'social')<i class="bi bi-share"></i>
          @elseif($v->source === 'referral')<i class="bi bi-box-arrow-in-right"></i>
          @else<i class="bi bi-cursor"></i>
          @endif
          {{ $v->source === 'direct' ? __('Direct') : ($v->referrer_host ? \App\Models\Visit::cleanReferrerName($v->referrer_host) : __('Direct')) }}
        </span>

        <span class="vc-tag">
          <i class="bi bi-{{ $v->device === 'mobile' ? 'phone' : ($v->device === 'tablet' ? 'tablet' : 'laptop') }}"></i>
          {{ ucfirst($v->device) }}
        </span>

        @if($v->browser)
          <span class="vc-tag">{{ $v->browser }}</span>
        @endif
        @if($v->os)
          <span class="vc-tag">{{ $v->os }}</span>
        @endif
        @if($v->country)
          <span class="vc-tag">{{ \App\Models\Visit::countryName($v->country) }}</span>
        @endif
      </div>

      {{-- Stats --}}
      <div class="vc-stats">
        <div class="vc-stat">
          <div class="vc-stat-value">{{ $v->pageviews }}</div>
          <div class="vc-stat-label">{{ __('pages') }}</div>
        </div>
        <div class="vc-stat">
          @php $m = floor($v->total_duration / 60); $s = $v->total_duration % 60; @endphp
          <div class="vc-stat-value">{{ $m }}:{{ str_pad($s, 2, '0', STR_PAD_LEFT) }}</div>
          <div class="vc-stat-label">{{ __('Duree') }}</div>
        </div>
        <div class="vc-time">{{ \Carbon\Carbon::parse($v->last_seen)->diffForHumans() }}</div>
        <span class="vc-arrow"><i class="bi bi-chevron-right"></i></span>
      </div>
    </a>
  @empty
    <div style="padding:60px;text-align:center;color:var(--slate);background:#fff;border:1.5px solid var(--border);border-radius:14px">
      <i class="bi bi-people" style="font-size:32px;display:block;margin-bottom:12px;color:var(--border)"></i>
      {{ __('Aucun visiteur pour cette periode.') }}
    </div>
  @endforelse
</div>

@if($visitors->hasPages())
<div class="pagination-wrap">
  @php $pg = $visitors->withQueryString(); @endphp
  @if($pg->onFirstPage())
    <span class="pg-btn disabled">&laquo;</span>
  @else
    <a href="{{ $pg->previousPageUrl() }}" class="pg-btn">&laquo;</a>
  @endif
  @foreach($pg->getUrlRange(1, $pg->lastPage()) as $page => $url)
    <a href="{{ $url }}" class="pg-btn {{ $page == $pg->currentPage() ? 'active' : '' }}">{{ $page }}</a>
  @endforeach
  @if($pg->hasMorePages())
    <a href="{{ $pg->nextPageUrl() }}" class="pg-btn">&raquo;</a>
  @else
    <span class="pg-btn disabled">&raquo;</span>
  @endif
  <span style="font-size:12px;color:var(--slate);margin-left:12px">{{ $pg->firstItem() }}-{{ $pg->lastItem() }} / {{ $pg->total() }}</span>
</div>
@endif
@endsection
