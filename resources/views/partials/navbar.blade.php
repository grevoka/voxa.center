@php $loc = app()->getLocale(); @endphp
<nav style="position:sticky;top:0;z-index:100;padding:14px 0;background:rgba(255,255,255,.92);backdrop-filter:blur(16px) saturate(1.5);border-bottom:1px solid #e2e8f0;">
  <div style="max-width:1200px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between;">
    <a href="{{ lroute('home') }}" style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:19px;color:#0f172a;text-decoration:none;letter-spacing:-.5px;">
      <img src="/images/logo.png" alt="Voxa Center" style="width:36px;height:36px;border-radius:10px;">
      Voxa Center
    </a>
    <div style="display:flex;align-items:center;gap:32px;" class="nav-mid">
      <a href="{{ lroute('scenarios') }}" style="font-size:14px;font-weight:500;color:#475569;text-decoration:none;transition:color .2s;">{{ __('Scenarios') }}</a>
      <a href="{{ lroute('softphone') }}" style="font-size:14px;font-weight:500;color:#475569;text-decoration:none;transition:color .2s;">Softphone</a>
      <a href="{{ lroute('home') }}#ai" style="font-size:14px;font-weight:500;color:#475569;text-decoration:none;transition:color .2s;">{{ __('Agent IA') }}</a>
      <a href="{{ lroute('home') }}#pricing" style="font-size:14px;font-weight:500;color:#475569;text-decoration:none;transition:color .2s;">{{ __('Tarifs') }}</a>
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" style="font-size:14px;font-weight:500;color:#475569;text-decoration:none;transition:color .2s;">GitHub</a>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
      {{-- Language switcher --}}
      <div style="position:relative;" class="lang-switch" onclick="this.classList.toggle('open')">
        <button style="display:flex;align-items:center;gap:6px;padding:6px 10px;font-size:13px;font-weight:600;border-radius:8px;border:1px solid #e2e8f0;background:#fff;color:#475569;cursor:pointer;font-family:inherit;">
          @if($loc === 'fr')&#127467;&#127479;@else&#127468;&#127463;@endif
          <span style="font-size:11px;color:#94a3b8;">&#9662;</span>
        </button>
        <div class="lang-dropdown" style="display:none;position:absolute;top:calc(100% + 6px);right:0;background:#fff;border:1px solid #e2e8f0;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.1);overflow:hidden;min-width:140px;z-index:200;">
          <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:8px;padding:10px 14px;font-size:13px;font-weight:{{ $loc === 'fr' ? '700' : '500' }};color:{{ $loc === 'fr' ? '#6d28d9' : '#475569' }};text-decoration:none;transition:background .15s;{{ $loc === 'fr' ? 'background:#f5f3ff;' : '' }}">
            &#127467;&#127479; Fran&ccedil;ais
          </a>
          <a href="/en" style="display:flex;align-items:center;gap:8px;padding:10px 14px;font-size:13px;font-weight:{{ $loc === 'en' ? '700' : '500' }};color:{{ $loc === 'en' ? '#6d28d9' : '#475569' }};text-decoration:none;transition:background .15s;{{ $loc === 'en' ? 'background:#f5f3ff;' : '' }}">
            &#127468;&#127463; English
          </a>
        </div>
      </div>
      <a href="{{ lroute('home') }}#pricing" class="nav-btn-outline hide-m2" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:8px;border:1px solid #cbd5e1;background:#fff;color:#334155;text-decoration:none;transition:all .2s;">{{ __('Voir les tarifs') }}</a>
      <a href="{{ lroute('contact') }}" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:8px;border:none;background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);color:#fff;text-decoration:none;transition:all .2s;">{{ __('Nous contacter') }}</a>
    </div>
  </div>
</nav>
<style>
.lang-switch.open .lang-dropdown{display:block!important}
.lang-dropdown a:hover{background:#f8fafc!important}
@media(max-width:900px){.nav-mid{display:none!important}.hide-m2{display:none!important}}
</style>
