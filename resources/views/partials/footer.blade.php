@php $loc = app()->getLocale(); @endphp
<footer style="background:#0f172a;color:#94a3b8;padding:64px 0 40px;">
  <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
    <div style="display:flex;justify-content:space-between;gap:40px;flex-wrap:wrap;margin-bottom:48px;">
      <div>
        <a href="{{ lroute('home') }}" style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:19px;color:#fff;text-decoration:none;letter-spacing:-.5px;">
          <img src="/images/logo.png" alt="Voxa Center" style="width:36px;height:36px;border-radius:10px;">
          Voxa Center
        </a>
        <p style="max-width:280px;font-size:13px;line-height:1.7;color:#64748b;margin-top:16px;">{{ __('footer.description') }}</p>
      </div>
      <div style="display:flex;gap:64px;flex-wrap:wrap;">
        <div>
          <h5 style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#64748b;margin-bottom:16px;">{{ __('Produit') }}</h5>
          <a href="{{ lroute('scenarios') }}" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('Scenarios d\'appels') }}</a>
          <a href="{{ lroute('softphone') }}" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">Softphone WebRTC</a>
          <a href="{{ lroute('home') }}#ai" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('Agent IA') }}</a>
          <a href="{{ lroute('home') }}#pricing" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('Tarifs') }}</a>
        </div>
        <div>
          <h5 style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#64748b;margin-bottom:16px;">{{ __('Ressources') }}</h5>
          <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('Documentation') }}</a>
          <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">GitHub</a>
          <a href="https://github.com/grevoka/Voxa.center.app/releases" target="_blank" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">Changelog</a>
          <a href="https://github.com/grevoka/Voxa.center.app/wiki" target="_blank" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">Wiki</a>
        </div>
        <div>
          <h5 style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#64748b;margin-bottom:16px;">{{ __('Entreprise') }}</h5>
          <a href="{{ lroute('contact') }}" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('Contact') }}</a>
          <a href="{{ lroute('contact') }}" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('Demander une demo') }}</a>
          <a href="{{ lroute('legal.cgu') }}" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('CGU') }}</a>
          <a href="{{ lroute('legal.confidentialite') }}" style="display:block;font-size:14px;color:#94a3b8;margin-bottom:10px;text-decoration:none;transition:color .2s;">{{ __('Confidentialite') }}</a>
        </div>
      </div>
    </div>
    {{-- Language + copyright --}}
    <div style="padding-top:24px;border-top:1px solid rgba(255,255,255,.08);display:flex;justify-content:space-between;align-items:center;font-size:13px;color:#475569;flex-wrap:wrap;gap:12px;">
      <div style="display:flex;align-items:center;gap:16px;">
        <span>&copy; {{ date('Y') }} Voxa Center.</span>
        <div style="display:flex;gap:6px;align-items:center;">
          <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:4px;text-decoration:none;font-size:12px;font-weight:{{ $loc === 'fr' ? '800' : '600' }};padding:4px 10px;border-radius:6px;border:1px solid {{ $loc === 'fr' ? '#c4b5fd' : '#334155' }};background:{{ $loc === 'fr' ? '#ede9fe' : 'transparent' }};color:{{ $loc === 'fr' ? '#8b5cf6' : '#64748b' }};">FR</a>
          <a href="/en" style="display:inline-flex;align-items:center;gap:4px;text-decoration:none;font-size:12px;font-weight:{{ $loc === 'en' ? '800' : '600' }};padding:4px 10px;border-radius:6px;border:1px solid {{ $loc === 'en' ? '#c4b5fd' : '#334155' }};background:{{ $loc === 'en' ? '#ede9fe' : 'transparent' }};color:{{ $loc === 'en' ? '#8b5cf6' : '#64748b' }};">EN</a>
        </div>
      </div>
      <span>{{ __('Un produit') }} <a href="https://d4.fr" target="_blank" style="color:#8b5cf6;text-decoration:none;font-weight:600;">D4.FR</a> &middot; Open source &middot; {{ __('Propulse par') }} Asterisk</span>
    </div>
  </div>
</footer>
