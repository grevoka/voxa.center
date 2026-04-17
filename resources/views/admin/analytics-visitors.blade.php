@extends('layouts.admin')
@section('title', __('Visiteurs') . ' — Analytics')

@push('styles')
<style>
.filter-bar{display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:24px}
.filter-bar .period-tabs{display:flex;gap:4px;background:#fff;border:1.5px solid var(--border);border-radius:10px;padding:3px}
.filter-bar .period-tab{padding:6px 12px;font-size:12px;font-weight:600;border-radius:7px;cursor:pointer;color:var(--slate);border:none;background:transparent;font-family:var(--font);transition:all .15s;text-decoration:none;display:inline-block}
.filter-bar .period-tab.active{background:var(--mid);color:#fff}
.filter-bar .period-tab:hover:not(.active){background:var(--bg);color:var(--ink)}
.visitor-row{display:flex;align-items:center;padding:14px 20px;border-bottom:1px solid #f1f5f9;gap:16px;transition:background .1s;text-decoration:none;color:inherit}
.visitor-row:hover{background:#fafbfe}
.visitor-row:last-child{border-bottom:none}
.v-ip{font-family:var(--mono);font-size:13px;font-weight:600;color:var(--ink);min-width:120px}
.v-meta{display:flex;gap:6px;flex-wrap:wrap;flex:1}
.v-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:600;background:var(--bg);color:var(--slate);border:1px solid var(--border)}
.v-badge.search{background:#f5f3ff;color:#6d28d9;border-color:#c4b5fd}
.v-badge.social{background:#fdf4ff;color:#c026d3;border-color:#e879f9}
.v-badge.referral{background:#ecfeff;color:#0891b2;border-color:#67e8f9}
.v-badge.direct{background:#f8fafc;color:#64748b;border-color:#e2e8f0}
.v-pages{font-family:var(--mono);font-size:13px;font-weight:700;color:var(--mid);min-width:50px;text-align:center}
.v-duration{font-family:var(--mono);font-size:13px;color:var(--slate);min-width:60px;text-align:right}
.v-time{font-size:12px;color:var(--slate);min-width:140px;text-align:right}
.v-arrow{color:var(--border);font-size:16px}
.live-dot-sm{width:6px;height:6px;background:#22c55e;border-radius:50%;animation:livePulse 2s infinite;display:inline-block}
@keyframes livePulse{0%,100%{opacity:1}50%{opacity:.3}}
.pagination-wrap{display:flex;align-items:center;justify-content:center;gap:4px;margin-top:24px}
.pg-btn{display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 10px;border-radius:8px;font-size:13px;font-weight:600;font-family:var(--font);color:var(--slate);background:#fff;border:1.5px solid var(--border);text-decoration:none;transition:all .15s;cursor:pointer}
.pg-btn:hover:not(.active):not(.disabled){border-color:var(--mid);color:var(--mid);background:#f8fafc}
.pg-btn.active{background:var(--mid);color:#fff;border-color:var(--mid)}
.pg-btn.disabled{opacity:.4;cursor:default}
</style>
@endpush

@section('content')
<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
  <div>
    <h1><i class="bi bi-people" style="color:var(--mid)"></i> {{ __('Visiteurs') }}</h1>
    <p style="margin:4px 0 0">{{ __('Detail par session / IP') }}</p>
  </div>
  <a href="{{ route('admin.analytics') }}" class="btn-admin outline"><i class="bi bi-arrow-left"></i> {{ __('Analytics') }}</a>
</div>

<div class="filter-bar">
  <form method="GET" style="display:flex;gap:8px;align-items:center">
    <div class="search-box">
      <i class="bi bi-search"></i>
      <input type="text" name="search" placeholder="{{ __('Rechercher par IP...') }}" value="{{ request('search') }}">
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

<div class="table-card">
  <div class="header">
    <h3><i class="bi bi-people"></i> {{ $visitors->total() }} {{ __('sessions') }}</h3>
  </div>
  @forelse($visitors as $v)
    <a href="{{ route('admin.analytics.visitor', $v->session_id) }}" class="visitor-row">
      <span class="v-ip">
        @if($v->last_seen >= now()->subMinutes(5))
          <span class="live-dot-sm"></span>
        @endif
        {{ $v->ip }}
      </span>
      <span class="v-meta">
        <span class="v-badge {{ $v->source }}">
          @if($v->source === 'search')<i class="bi bi-search"></i>
          @elseif($v->source === 'social')<i class="bi bi-share"></i>
          @elseif($v->source === 'referral')<i class="bi bi-box-arrow-in-right"></i>
          @else<i class="bi bi-cursor"></i>
          @endif
          {{ $v->source === 'direct' ? __('Direct') : ($v->referrer_host ? \App\Models\Visit::cleanReferrerName($v->referrer_host) : __('Direct')) }}
        </span>
        <span class="v-badge"><i class="bi bi-{{ $v->device === 'mobile' ? 'phone' : ($v->device === 'tablet' ? 'tablet' : 'laptop') }}"></i> {{ ucfirst($v->device) }}</span>
        @if($v->browser)<span class="v-badge">{{ $v->browser }}</span>@endif
        @if($v->os)<span class="v-badge">{{ $v->os }}</span>@endif
      </span>
      <span class="v-pages" title="{{ __('Pages vues') }}">{{ $v->pageviews }} <i class="bi bi-file-text" style="font-size:11px;color:var(--slate)"></i></span>
      <span class="v-duration" title="{{ __('Duree totale') }}">
        @php $m = floor($v->total_duration / 60); $s = $v->total_duration % 60; @endphp
        {{ $m }}m{{ str_pad($s, 2, '0', STR_PAD_LEFT) }}s
      </span>
      <span class="v-time">{{ \Carbon\Carbon::parse($v->last_seen)->diffForHumans() }}</span>
      <span class="v-arrow"><i class="bi bi-chevron-right"></i></span>
    </a>
  @empty
    <div style="padding:40px;text-align:center;color:var(--slate)">{{ __('Aucun visiteur pour cette periode.') }}</div>
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
