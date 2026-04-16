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
        <button class="lang-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
          {{ strtoupper($loc) }}
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="lang-dropdown">
          <a href="{{ route('home') }}" class="{{ $loc === 'fr' ? 'active' : '' }}">
            <span class="lang-code">FR</span> Fran&ccedil;ais
          </a>
          <a href="/en" class="{{ $loc === 'en' ? 'active' : '' }}">
            <span class="lang-code">EN</span> English
          </a>
        </div>
      </div>
      <a href="{{ lroute('home') }}#pricing" class="nav-btn-outline hide-m2" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:8px;border:1px solid #cbd5e1;background:#fff;color:#334155;text-decoration:none;transition:all .2s;">{{ __('Voir les tarifs') }}</a>
      <a href="{{ lroute('contact') }}" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:8px;border:none;background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);color:#fff;text-decoration:none;transition:all .2s;">{{ __('Nous contacter') }}</a>
    </div>
  </div>
</nav>
<style>
.lang-btn{display:flex;align-items:center;gap:6px;padding:6px 12px;font-size:13px;font-weight:700;border-radius:8px;border:1px solid #e2e8f0;background:#fff;color:#475569;cursor:pointer;font-family:inherit;transition:all .15s}
.lang-btn:hover{border-color:#cbd5e1;background:#f8fafc}
.lang-btn svg:first-child{color:#8b5cf6}
.lang-dropdown{display:none;position:absolute;top:calc(100% + 6px);right:0;background:#fff;border:1px solid #e2e8f0;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.1);overflow:hidden;min-width:150px;z-index:200}
.lang-switch.open .lang-dropdown{display:block}
.lang-dropdown a{display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13px;font-weight:500;color:#475569;text-decoration:none;transition:all .15s}
.lang-dropdown a:hover{background:#f8fafc}
.lang-dropdown a.active{font-weight:700;color:#6d28d9;background:#f5f3ff}
.lang-code{display:inline-flex;align-items:center;justify-content:center;width:26px;height:18px;border-radius:4px;font-size:10px;font-weight:800;letter-spacing:.5px;background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0}
.lang-dropdown a.active .lang-code{background:#ede9fe;color:#6d28d9;border-color:#c4b5fd}
@media(max-width:900px){.nav-mid{display:none!important}.hide-m2{display:none!important}}
</style>
