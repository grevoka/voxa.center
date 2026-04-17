@extends('layouts.app')
@section('title', __('meta.c2c_title'))

@push('styles')
<style>
:root{--primary:#6d28d9;--primary-light:#8b5cf6;--primary-50:#f5f3ff;--primary-100:#ede9fe;--accent:#06b6d4;--accent-50:#ecfeff;--gradient:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;--gray-900:#0f172a;--font:'Plus Jakarta Sans',sans-serif;--mono:'Fira Code',monospace;--radius:10px;--radius-lg:14px;--radius-xl:20px}
*{margin:0;padding:0;box-sizing:border-box}body{font-family:var(--font);color:var(--gray-800);background:#fff;-webkit-font-smoothing:antialiased}a{color:inherit;text-decoration:none}
.container{max-width:1100px;margin:0 auto;padding:0 24px}

/* HERO */
.hero{padding:100px 0 80px;background:linear-gradient(180deg,#fff 0%,var(--gray-50) 100%);position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;top:-200px;left:-150px;width:600px;height:600px;background:radial-gradient(circle,rgba(6,182,212,.06) 0%,transparent 65%);pointer-events:none}
.hero-grid{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center}
.hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 16px;background:var(--accent-50);color:var(--accent);font-size:13px;font-weight:600;border-radius:999px;margin-bottom:24px}
.hero h1{font-size:clamp(30px,4.5vw,46px);font-weight:800;letter-spacing:-1.5px;line-height:1.1;margin-bottom:20px}
.hero h1 span{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.hero p{font-size:17px;color:var(--gray-500);line-height:1.7;margin-bottom:32px}
.hero-actions{display:flex;gap:12px;flex-wrap:wrap}

/* WIDGET MOCKUP */
.widget-mockup{position:relative;max-width:420px;margin:0 auto}
.widget-site{background:var(--gray-100);border-radius:var(--radius-lg);overflow:hidden;min-height:340px;position:relative;border:1px solid var(--gray-200)}
.widget-site-bar{height:32px;background:var(--gray-200);display:flex;align-items:center;padding:0 12px;gap:6px}
.widget-site-bar span{width:8px;height:8px;border-radius:50%}
.widget-site-bar span:nth-child(1){background:#ef4444}
.widget-site-bar span:nth-child(2){background:#eab308}
.widget-site-bar span:nth-child(3){background:#22c55e}
.widget-site-content{padding:24px 20px}
.widget-site-line{height:10px;background:var(--gray-200);border-radius:4px;margin-bottom:10px}
.widget-site-line.short{width:60%}
.widget-site-line.med{width:80%}
.widget-site-line.title{height:14px;width:40%;margin-bottom:18px;background:var(--gray-300,#cbd5e1)}
.widget-fab{position:absolute;bottom:16px;right:16px;width:56px;height:56px;border-radius:50%;background:var(--gradient);display:grid;place-items:center;color:#fff;font-size:22px;box-shadow:0 6px 20px rgba(109,40,217,.35);cursor:default;z-index:2}
.widget-panel{position:absolute;bottom:82px;right:16px;width:280px;background:var(--gray-900);border-radius:var(--radius-lg);overflow:hidden;box-shadow:0 12px 40px rgba(0,0,0,.2);z-index:2}
.widget-panel-header{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid rgba(255,255,255,.1)}
.widget-panel-header span{color:#fff;font-size:15px;font-weight:700}
.widget-panel-header i{color:var(--gray-400);font-size:14px;cursor:default}
.widget-panel-body{padding:20px 16px;text-align:center}
.widget-call-btn{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:#22c55e;color:#fff;font-size:14px;font-weight:700;border-radius:999px;margin-bottom:16px}
.widget-call-btn i{font-size:16px}
.widget-status{font-size:12px;color:var(--gray-400);margin-bottom:12px;display:flex;align-items:center;justify-content:center;gap:6px}
.widget-status .dots::after{content:'...';animation:dots 1.5s steps(4,end) infinite}
@keyframes dots{0%{content:''}25%{content:'.'}50%{content:'..'}75%{content:'...'}}
.widget-timer{font-family:var(--mono);font-size:22px;font-weight:500;color:#fff;display:flex;align-items:center;justify-content:center;gap:8px}
.widget-timer .dot{width:8px;height:8px;background:#22c55e;border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}

/* SECTIONS */
section{padding:80px 0}
section.alt{background:var(--gray-50)}
.section-label{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;background:var(--primary-50);color:var(--primary-light);font-size:13px;font-weight:600;border-radius:999px;margin-bottom:16px}
.section-title{font-size:clamp(26px,3.5vw,38px);font-weight:800;letter-spacing:-.5px;margin-bottom:16px;line-height:1.15}
.section-desc{font-size:17px;color:var(--gray-500);line-height:1.7;max-width:600px;margin-bottom:48px}

/* FEATURES */
.feat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
.feat-card{background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-lg);padding:28px 24px;transition:all .25s}
.feat-card:hover{border-color:var(--primary-100);box-shadow:0 8px 24px rgba(139,92,246,.06);transform:translateY(-3px)}
.feat-card .fc-icon{width:40px;height:40px;border-radius:10px;display:grid;place-items:center;font-size:18px;margin-bottom:16px}
.feat-card h3{font-size:16px;font-weight:700;margin-bottom:6px}
.feat-card p{font-size:14px;color:var(--gray-500);line-height:1.6}

/* STEPS */
.steps{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;counter-reset:step}
.step{position:relative;padding:28px 24px;background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-lg);counter-increment:step;transition:all .25s}
.step:hover{border-color:var(--primary-100);box-shadow:0 8px 24px rgba(139,92,246,.06);transform:translateY(-3px)}
.step::before{content:counter(step);display:grid;place-items:center;width:36px;height:36px;background:var(--gradient);color:#fff;font-size:15px;font-weight:800;border-radius:10px;margin-bottom:16px}
.step h3{font-size:16px;font-weight:700;margin-bottom:6px}
.step p{font-size:14px;color:var(--gray-500);line-height:1.6}

/* VARIANT GRID */
.variant-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
.variant-card{background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-lg);overflow:hidden;transition:all .25s}
.variant-card:hover{border-color:var(--primary-100);box-shadow:0 8px 24px rgba(139,92,246,.06);transform:translateY(-3px)}
.variant-card .variant-preview{position:relative;background:var(--gray-100);min-height:180px;border-bottom:1px solid var(--gray-200)}
.variant-card .variant-preview .vp-bar{height:24px;background:var(--gray-200);display:flex;align-items:center;padding:0 10px;gap:4px}
.variant-card .variant-preview .vp-bar span{width:6px;height:6px;border-radius:50%}
.variant-card .variant-preview .vp-bar span:nth-child(1){background:#ef4444}
.variant-card .variant-preview .vp-bar span:nth-child(2){background:#eab308}
.variant-card .variant-preview .vp-bar span:nth-child(3){background:#22c55e}
.variant-card .variant-preview .vp-lines{padding:14px 12px}
.variant-card .variant-preview .vp-line{height:6px;background:var(--gray-200);border-radius:3px;margin-bottom:6px}
.variant-card .variant-preview .vp-line.s{width:50%}.variant-card .variant-preview .vp-line.m{width:75%}
.variant-card .variant-label{padding:14px 18px;font-size:14px;font-weight:700;text-align:center}

/* Variant: classic */
.v-classic-fab{position:absolute;bottom:12px;right:12px;width:48px;height:48px;border-radius:50%;background:var(--gradient);display:grid;place-items:center;color:#fff;font-size:18px;box-shadow:0 4px 14px rgba(109,40,217,.3)}
.v-classic-label{position:absolute;bottom:16px;right:70px;background:var(--gray-900);color:#fff;font-size:10px;font-weight:600;padding:6px 10px;border-radius:6px;white-space:nowrap}

/* Variant: minimal */
.v-minimal-fab{position:absolute;bottom:12px;left:12px;width:40px;height:40px;border-radius:50%;background:var(--gray-800);display:grid;place-items:center;color:#fff;font-size:16px;box-shadow:0 3px 10px rgba(0,0,0,.2)}

/* Variant: branded */
.v-branded-fab{position:absolute;bottom:12px;right:12px;width:48px;height:48px;border-radius:50%;background:#059669;display:grid;place-items:center;color:#fff;font-size:18px;box-shadow:0 4px 14px rgba(5,150,105,.3)}
.v-branded-name{position:absolute;bottom:16px;right:70px;background:#059669;color:#fff;font-size:10px;font-weight:600;padding:6px 10px;border-radius:6px;white-space:nowrap}

/* Variant: bar */
.v-bar{position:absolute;bottom:0;left:0;right:0;background:var(--gray-900);display:flex;align-items:center;justify-content:center;gap:10px;padding:10px 16px}
.v-bar i{color:#fff;font-size:14px}
.v-bar span{color:#fff;font-size:11px;font-weight:600}
.v-bar .v-bar-cta{background:var(--gradient);color:#fff;font-size:10px;font-weight:700;padding:5px 12px;border-radius:6px}

/* CODE BLOCK */
.code-wrap{max-width:700px;margin:0 auto 40px;background:var(--gray-900);border-radius:var(--radius-lg);overflow:hidden;box-shadow:0 12px 40px rgba(0,0,0,.12)}
.code-wrap .mockup-bar{height:36px;background:var(--gray-800);display:flex;align-items:center;padding:0 14px;gap:6px}
.code-wrap .mockup-bar span{width:10px;height:10px;border-radius:50%}
.code-wrap .mockup-bar span:nth-child(1){background:#ef4444}
.code-wrap .mockup-bar span:nth-child(2){background:#eab308}
.code-wrap .mockup-bar span:nth-child(3){background:#22c55e}
.code-block{padding:24px;font-family:var(--mono);font-size:13px;line-height:1.8;color:#e2e8f0;overflow-x:auto;white-space:pre}
.code-block .tag{color:#06b6d4}.code-block .attr{color:#a78bfa}.code-block .val{color:#34d399}.code-block .comment{color:var(--gray-500)}

.param-list{max-width:700px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:16px}
.param-list .param{padding:16px;background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius)}
.param-list .param code{font-family:var(--mono);font-size:13px;font-weight:600;color:var(--primary)}
.param-list .param p{font-size:13px;color:var(--gray-500);margin-top:4px;line-height:1.5}

/* CTA */
.cta-band{padding:80px 0;text-align:center;background:linear-gradient(180deg,var(--gray-50) 0%,#fff 100%);border-top:1px solid var(--gray-100)}
.cta-band h2{font-size:clamp(26px,3.5vw,40px);font-weight:800;letter-spacing:-.5px;margin-bottom:16px}
.cta-band p{font-size:17px;color:var(--gray-500);margin-bottom:32px}
.cta-actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
.btn-g{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:15px;font-weight:700;font-family:var(--font);border-radius:var(--radius);cursor:pointer;transition:all .2s;text-decoration:none;border:none}
.btn-g.primary{background:var(--gradient);color:#fff;box-shadow:0 4px 16px rgba(109,40,217,.25)}.btn-g.primary:hover{opacity:.9;transform:translateY(-1px)}
.btn-g.outline{background:#fff;color:var(--gray-700);border:1px solid var(--gray-300)}.btn-g.outline:hover{border-color:var(--gray-400)}

@media(max-width:900px){.hero-grid{grid-template-columns:1fr;text-align:center}.hero-actions{justify-content:center}.widget-mockup{margin-top:40px}.feat-grid{grid-template-columns:1fr}.steps{grid-template-columns:1fr}.variant-grid{grid-template-columns:1fr}.param-list{grid-template-columns:1fr}}
@media(max-width:600px){.widget-panel{width:240px}}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-grid">
      <div>
        <div class="hero-badge"><i class="bi bi-cursor-fill"></i> {{ __('c2c.badge') }}</div>
        <h1>{{ __('c2c.title') }}<br><span>{{ __('c2c.title.highlight') }}</span></h1>
        <p>{{ __('c2c.sub') }}</p>
        <div class="hero-actions">
          <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn-g primary"><i class="bi bi-download"></i> {{ __('Commencer gratuitement') }}</a>
          <a href="{{ lroute('click-to-call.usecases') }}" class="btn-g outline"><i class="bi bi-lightbulb"></i> {{ __('Voir les cas d\'usage') }}</a>
        </div>
      </div>
      <div>
        <!-- WIDGET MOCKUP -->
        <div class="widget-mockup">
          <div class="widget-site">
            <div class="widget-site-bar"><span></span><span></span><span></span></div>
            <div class="widget-site-content">
              <div class="widget-site-line title"></div>
              <div class="widget-site-line"></div>
              <div class="widget-site-line med"></div>
              <div class="widget-site-line short"></div>
              <div class="widget-site-line"></div>
              <div class="widget-site-line med"></div>
              <div class="widget-site-line short"></div>
            </div>
            <div class="widget-panel">
              <div class="widget-panel-header">
                <span>Appelez-nous</span>
                <i class="bi bi-x-lg"></i>
              </div>
              <div class="widget-panel-body">
                <div class="widget-call-btn"><i class="bi bi-telephone-fill"></i> Lancer l'appel</div>
                <div class="widget-status">Connexion en cours<span class="dots"></span></div>
                <div class="widget-timer"><span class="dot"></span> 01:24</div>
              </div>
            </div>
            <div class="widget-fab"><i class="bi bi-telephone-fill"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FONCTIONNALITES -->
<section class="alt">
  <div class="container">
    <div class="section-label"><i class="bi bi-lightning-charge"></i> {{ __('c2c.features.label') }}</div>
    <h2 class="section-title">{{ __('c2c.features.title') }}<br>{{ __('c2c.features.title2') }}</h2>
    <p class="section-desc">{{ __('c2c.features.desc') }}</p>

    <div class="feat-grid">
      <div class="feat-card">
        <div class="fc-icon" style="background:#eff6ff;color:#3b82f6"><i class="bi bi-cursor-fill"></i></div>
        <h3>{{ __('c2c.feat.oneclick.title') }}</h3>
        <p>{{ __('c2c.feat.oneclick.desc') }}</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:#ecfdf5;color:#059669"><i class="bi bi-globe2"></i></div>
        <h3>{{ __('c2c.feat.webrtc.title') }}</h3>
        <p>{{ __('c2c.feat.webrtc.desc') }}</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:var(--primary-50);color:var(--primary)"><i class="bi bi-palette-fill"></i></div>
        <h3>{{ __('c2c.feat.custom.title') }}</h3>
        <p>{{ __('c2c.feat.custom.desc') }}</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:#fff7ed;color:#ea580c"><i class="bi bi-graph-up"></i></div>
        <h3>{{ __('c2c.feat.analytics.title') }}</h3>
        <p>{{ __('c2c.feat.analytics.desc') }}</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:var(--accent-50);color:var(--accent)"><i class="bi bi-diagram-3-fill"></i></div>
        <h3>{{ __('c2c.feat.pbx.title') }}</h3>
        <p>{{ __('c2c.feat.pbx.desc') }}</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:#fef2f2;color:#dc2626"><i class="bi bi-shield-lock-fill"></i></div>
        <h3>{{ __('c2c.feat.secure.title') }}</h3>
        <p>{{ __('c2c.feat.secure.desc') }}</p>
      </div>
    </div>
  </div>
</section>

<!-- COMMENT CA MARCHE -->
<section>
  <div class="container">
    <div class="section-label"><i class="bi bi-signpost-split"></i> {{ __('c2c.steps.label') }}</div>
    <h2 class="section-title">{{ __('c2c.steps.title') }}</h2>
    <p class="section-desc">{{ __('c2c.steps.desc') }}</p>

    <div class="steps">
      <div class="step">
        <h3>{{ __('c2c.step1.title') }}</h3>
        <p>{{ __('c2c.step1.desc') }}</p>
      </div>
      <div class="step">
        <h3>{{ __('c2c.step2.title') }}</h3>
        <p>{{ __('c2c.step2.desc') }}</p>
      </div>
      <div class="step">
        <h3>{{ __('c2c.step3.title') }}</h3>
        <p>{{ __('c2c.step3.desc') }}</p>
      </div>
    </div>
  </div>
</section>

<!-- PERSONNALISATION -->
<section class="alt">
  <div class="container">
    <div class="section-label"><i class="bi bi-palette"></i> {{ __('c2c.customization.label') }}</div>
    <h2 class="section-title">{{ __('c2c.customization.title') }}<br>{{ __('c2c.customization.title2') }}</h2>
    <p class="section-desc">{{ __('c2c.customization.desc') }}</p>

    <div class="variant-grid">
      {{-- Classic --}}
      <div class="variant-card">
        <div class="variant-preview">
          <div class="vp-bar"><span></span><span></span><span></span></div>
          <div class="vp-lines">
            <div class="vp-line"></div><div class="vp-line m"></div><div class="vp-line s"></div>
            <div class="vp-line"></div><div class="vp-line m"></div>
          </div>
          <div class="v-classic-label">Appelez-nous</div>
          <div class="v-classic-fab"><i class="bi bi-telephone-fill"></i></div>
        </div>
        <div class="variant-label">{{ __('c2c.variant.classic') }}</div>
      </div>

      {{-- Minimal --}}
      <div class="variant-card">
        <div class="variant-preview">
          <div class="vp-bar"><span></span><span></span><span></span></div>
          <div class="vp-lines">
            <div class="vp-line"></div><div class="vp-line m"></div><div class="vp-line s"></div>
            <div class="vp-line"></div><div class="vp-line m"></div>
          </div>
          <div class="v-minimal-fab"><i class="bi bi-telephone-fill"></i></div>
        </div>
        <div class="variant-label">{{ __('c2c.variant.minimal') }}</div>
      </div>

      {{-- Branded --}}
      <div class="variant-card">
        <div class="variant-preview">
          <div class="vp-bar"><span></span><span></span><span></span></div>
          <div class="vp-lines">
            <div class="vp-line"></div><div class="vp-line m"></div><div class="vp-line s"></div>
            <div class="vp-line"></div><div class="vp-line m"></div>
          </div>
          <div class="v-branded-name">Acme Corp.</div>
          <div class="v-branded-fab"><i class="bi bi-telephone-fill"></i></div>
        </div>
        <div class="variant-label">{{ __('c2c.variant.branded') }}</div>
      </div>

      {{-- Floating bar --}}
      <div class="variant-card">
        <div class="variant-preview">
          <div class="vp-bar"><span></span><span></span><span></span></div>
          <div class="vp-lines">
            <div class="vp-line"></div><div class="vp-line m"></div><div class="vp-line s"></div>
            <div class="vp-line"></div><div class="vp-line m"></div>
          </div>
          <div class="v-bar">
            <i class="bi bi-telephone-fill"></i>
            <span>Besoin d'aide ?</span>
            <div class="v-bar-cta">Appeler</div>
          </div>
        </div>
        <div class="variant-label">{{ __('c2c.variant.bar') }}</div>
      </div>
    </div>
  </div>
</section>

<!-- INTEGRATION -->
<section>
  <div class="container" style="text-align:center">
    <div class="section-label"><i class="bi bi-code-slash"></i> {{ __('c2c.integration.label') }}</div>
    <h2 class="section-title" style="max-width:600px;margin-left:auto;margin-right:auto">{{ __('c2c.integration.title') }}</h2>
    <p class="section-desc" style="margin-left:auto;margin-right:auto">{{ __('c2c.integration.desc') }}</p>

    <div class="code-wrap">
      <div class="mockup-bar"><span></span><span></span><span></span></div>
      <div class="code-block"><span class="tag">&lt;script</span> <span class="attr">src</span>=<span class="val">"https://cdn.voxa.center/widget.js"</span>
        <span class="attr">data-key</span>=<span class="val">"YOUR_API_KEY"</span>
        <span class="attr">data-color</span>=<span class="val">"#6d28d9"</span>
        <span class="attr">data-position</span>=<span class="val">"bottom-right"</span>
        <span class="attr">data-text</span>=<span class="val">"Appelez-nous"</span><span class="tag">&gt;</span>
<span class="tag">&lt;/script&gt;</span></div>
    </div>

    <div class="param-list">
      <div class="param">
        <code>data-key</code>
        <p>{{ __('c2c.integration.param.key') }}</p>
      </div>
      <div class="param">
        <code>data-color</code>
        <p>{{ __('c2c.integration.param.color') }}</p>
      </div>
      <div class="param">
        <code>data-position</code>
        <p>{{ __('c2c.integration.param.position') }}</p>
      </div>
      <div class="param">
        <code>data-text</code>
        <p>{{ __('c2c.integration.param.text') }}</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="container">
    <h2>{{ __('c2c.cta.title') }}</h2>
    <p>{{ __('c2c.cta.desc') }}</p>
    <div class="cta-actions">
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn-g primary"><i class="bi bi-download"></i> {{ __('Commencer gratuitement') }}</a>
      <a href="{{ lroute('click-to-call.usecases') }}" class="btn-g outline"><i class="bi bi-lightbulb"></i> {{ __('Voir les cas d\'usage') }}</a>
      <a href="{{ lroute('contact') }}" class="btn-g outline"><i class="bi bi-send"></i> {{ __('Nous contacter') }}</a>
    </div>
  </div>
</section>
@endsection
