@php $loc = app()->getLocale(); @endphp
<nav class="site-nav" id="siteNav">
  <div class="nav-container">
    <a href="{{ lroute('home') }}" class="nav-brand">
      <img src="/images/logo.png" alt="Voxa Center">
      Voxa Center
    </a>
    <div class="nav-mid">
      <a href="{{ lroute('scenarios') }}">{{ __('Scenarios') }}</a>
      <a href="{{ lroute('softphone') }}">Softphone</a>
      <a href="{{ lroute('click-to-call') }}">Click to Call</a>
      <a href="{{ lroute('home') }}#ai">{{ __('Agent IA') }}</a>
      <a href="{{ lroute('home') }}#pricing">{{ __('Tarifs') }}</a>
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank">GitHub</a>
    </div>
    <div class="nav-right">
      {{-- Language switcher --}}
      <div class="lang-switch" onclick="this.classList.toggle('open')">
        <button class="lang-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
          {{ strtoupper($loc) }}
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="lang-dropdown">
          <a href="{{ route('home') }}" class="{{ $loc === 'fr' ? 'active' : '' }}"><span class="lang-code">FR</span> Fran&ccedil;ais</a>
          <a href="/en" class="{{ $loc === 'en' ? 'active' : '' }}"><span class="lang-code">EN</span> English</a>
        </div>
      </div>
      <a href="{{ lroute('home') }}#pricing" class="nav-btn-outline hide-mobile">{{ __('Voir les tarifs') }}</a>
      <a href="{{ lroute('contact') }}" class="nav-btn-primary hide-mobile">{{ __('Nous contacter') }}</a>
      {{-- Hamburger --}}
      <button class="hamburger" id="hamburgerBtn" onclick="toggleMobileMenu()" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

{{-- Mobile drawer --}}
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-inner">
    <div class="mobile-links">
      <a href="{{ lroute('scenarios') }}" onclick="closeMobileMenu()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3v12"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 01-9 9"/></svg>
        {{ __('Scenarios') }}
      </a>
      <a href="{{ lroute('softphone') }}" onclick="closeMobileMenu()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0118 0v6"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/></svg>
        Softphone
      </a>
      <a href="{{ lroute('click-to-call') }}" onclick="closeMobileMenu()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.05 5A5 5 0 0119 8.95M15.05 1A9 9 0 0123 8.94M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        Click to Call
      </a>
      <a href="{{ lroute('home') }}#ai" onclick="closeMobileMenu()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8V4H8"/><rect x="2" y="8" width="20" height="14" rx="2"/><path d="M6 18h.01M18 18h.01M9 13a3 3 0 106 0"/></svg>
        {{ __('Agent IA') }}
      </a>
      <a href="{{ lroute('home') }}#pricing" onclick="closeMobileMenu()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        {{ __('Tarifs') }}
      </a>
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" onclick="closeMobileMenu()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
        GitHub
      </a>
    </div>
    <div class="mobile-lang">
      <a href="{{ route('home') }}" class="{{ $loc === 'fr' ? 'active' : '' }}"><span class="lang-code">FR</span> Fran&ccedil;ais</a>
      <a href="/en" class="{{ $loc === 'en' ? 'active' : '' }}"><span class="lang-code">EN</span> English</a>
    </div>
    <div class="mobile-cta">
      <a href="{{ lroute('home') }}#pricing" class="mobile-btn outline" onclick="closeMobileMenu()">{{ __('Voir les tarifs') }}</a>
      <a href="{{ lroute('contact') }}" class="mobile-btn primary" onclick="closeMobileMenu()">{{ __('Nous contacter') }}</a>
    </div>
  </div>
</div>

<style>
.site-nav{position:sticky;top:0;z-index:100;padding:14px 0;background:rgba(255,255,255,.92);backdrop-filter:blur(16px) saturate(1.5);border-bottom:1px solid #e2e8f0}
.nav-container{max-width:1200px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between}
.nav-brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:19px;color:#0f172a;text-decoration:none;letter-spacing:-.5px}
.nav-brand img{width:36px;height:36px;border-radius:10px}
.nav-mid{display:flex;align-items:center;gap:32px}
.nav-mid a{font-size:14px;font-weight:500;color:#475569;text-decoration:none;transition:color .2s}
.nav-mid a:hover{color:#0f172a}
.nav-right{display:flex;align-items:center;gap:10px}
.nav-btn-outline{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:8px;border:1px solid #cbd5e1;background:#fff;color:#334155;text-decoration:none;transition:all .2s}
.nav-btn-outline:hover{border-color:#94a3b8;background:#f8fafc}
.nav-btn-primary{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:8px;border:none;background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);color:#fff;text-decoration:none;transition:all .2s}
.nav-btn-primary:hover{opacity:.9}

/* Lang */
.lang-switch{position:relative}
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

/* Hamburger */
.hamburger{display:none;flex-direction:column;gap:5px;padding:8px;background:none;border:1px solid #e2e8f0;border-radius:8px;cursor:pointer;transition:all .15s}
.hamburger:hover{background:#f8fafc;border-color:#cbd5e1}
.hamburger span{display:block;width:20px;height:2px;background:#334155;border-radius:2px;transition:all .25s}
.hamburger.open span:nth-child(1){transform:rotate(45deg) translate(5px,5px)}
.hamburger.open span:nth-child(2){opacity:0}
.hamburger.open span:nth-child(3){transform:rotate(-45deg) translate(5px,-5px)}

/* Mobile menu */
.mobile-menu{display:none;position:fixed;top:0;left:0;right:0;bottom:0;z-index:99;background:rgba(15,23,42,.5);backdrop-filter:blur(4px);opacity:0;transition:opacity .25s}
.mobile-menu.open{display:block;opacity:1}
.mobile-menu-inner{position:absolute;top:65px;left:0;right:0;background:#fff;border-bottom:1px solid #e2e8f0;box-shadow:0 16px 48px rgba(0,0,0,.12);padding:8px 16px 24px;max-height:calc(100vh - 65px);overflow-y:auto;animation:slideDown .25s ease}
@keyframes slideDown{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}
.mobile-links{display:flex;flex-direction:column;gap:2px;padding:8px 0;border-bottom:1px solid #f1f5f9;margin-bottom:12px}
.mobile-links a{display:flex;align-items:center;gap:12px;padding:14px 16px;border-radius:10px;font-size:15px;font-weight:600;color:#334155;text-decoration:none;transition:all .15s}
.mobile-links a:hover,.mobile-links a:active{background:#f8fafc;color:#0f172a}
.mobile-links a svg{color:#8b5cf6;flex-shrink:0}
.mobile-lang{display:flex;gap:8px;padding:8px 0 16px;border-bottom:1px solid #f1f5f9;margin-bottom:16px}
.mobile-lang a{display:flex;align-items:center;gap:8px;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:500;color:#475569;text-decoration:none;border:1px solid #e2e8f0;transition:all .15s}
.mobile-lang a.active{font-weight:700;color:#6d28d9;background:#f5f3ff;border-color:#c4b5fd}
.mobile-cta{display:flex;flex-direction:column;gap:8px}
.mobile-btn{display:flex;align-items:center;justify-content:center;padding:14px;border-radius:10px;font-size:15px;font-weight:700;text-decoration:none;transition:all .15s}
.mobile-btn.outline{background:#fff;color:#334155;border:1.5px solid #e2e8f0}
.mobile-btn.primary{background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);color:#fff;border:none}

/* Responsive */
@media(max-width:900px){
  .nav-mid{display:none}
  .hide-mobile{display:none}
  .hamburger{display:flex}
}
@media(min-width:901px){
  .mobile-menu{display:none!important}
}
</style>

<script>
function toggleMobileMenu(){
  const menu = document.getElementById('mobileMenu');
  const btn = document.getElementById('hamburgerBtn');
  const isOpen = menu.classList.contains('open');
  if(isOpen){closeMobileMenu();}
  else{menu.classList.add('open');btn.classList.add('open');document.body.style.overflow='hidden';}
}
function closeMobileMenu(){
  document.getElementById('mobileMenu').classList.remove('open');
  document.getElementById('hamburgerBtn').classList.remove('open');
  document.body.style.overflow='';
}
document.getElementById('mobileMenu').addEventListener('click',function(e){if(e.target===this)closeMobileMenu();});
</script>
