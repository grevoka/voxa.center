@extends('layouts.app')
@section('title', __('meta.c2c_usecases_title'))

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--primary:#6d28d9;--primary-light:#8b5cf6;--primary-50:#f5f3ff;--primary-100:#ede9fe;--accent:#06b6d4;--accent-50:#ecfeff;--gradient:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;--gray-900:#0f172a;--font:'Plus Jakarta Sans',sans-serif;--mono:'Fira Code',monospace;--radius:10px;--radius-lg:14px;--radius-xl:20px}
*{margin:0;padding:0;box-sizing:border-box}body{font-family:var(--font);color:var(--gray-800);background:#fff;-webkit-font-smoothing:antialiased}a{color:inherit;text-decoration:none}
.container{max-width:1100px;margin:0 auto;padding:0 24px}

/* HERO */
.hero{padding:100px 0 80px;text-align:center;background:linear-gradient(180deg,#fff 0%,var(--gray-50) 100%);position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;top:-200px;right:-150px;width:600px;height:600px;background:radial-gradient(circle,rgba(139,92,246,.06) 0%,transparent 65%);pointer-events:none}
.hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 16px;background:var(--primary-50);color:var(--primary-light);font-size:13px;font-weight:600;border-radius:999px;margin-bottom:24px}
.hero h1{font-size:clamp(30px,4.5vw,48px);font-weight:800;letter-spacing:-1.5px;line-height:1.1;margin-bottom:20px}
.hero h1 span{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.hero p{font-size:18px;color:var(--gray-500);max-width:640px;margin:0 auto 40px;line-height:1.7}

/* SECTIONS */
section{padding:80px 0}
section.alt{background:var(--gray-50)}
.section-label{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;background:var(--primary-50);color:var(--primary-light);font-size:13px;font-weight:600;border-radius:999px;margin-bottom:16px}
.section-title{font-size:clamp(26px,3.5vw,38px);font-weight:800;letter-spacing:-.5px;margin-bottom:16px;line-height:1.15}
.section-desc{font-size:17px;color:var(--gray-500);line-height:1.7;max-width:600px;margin-bottom:48px}

/* USE CASE CARDS */
.usecase{display:grid;grid-template-columns:1fr 1fr;gap:0;background:#fff;border:1.5px solid var(--gray-200);border-radius:var(--radius-xl);overflow:hidden;margin-bottom:32px;transition:box-shadow .3s}
.usecase:hover{box-shadow:0 12px 40px rgba(109,40,217,.08)}
.usecase.reverse .uc-visual{order:2}
.usecase.reverse .uc-content{order:1}

.uc-visual{position:relative;min-height:360px;overflow:hidden;display:flex;align-items:center;justify-content:center}
.uc-content{padding:48px 44px;display:flex;flex-direction:column;justify-content:center}

.uc-icon{width:48px;height:48px;border-radius:14px;display:grid;place-items:center;font-size:22px;margin-bottom:20px}
.uc-sector{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:8px}
.uc-content h2{font-size:24px;font-weight:800;letter-spacing:-.5px;margin-bottom:12px;line-height:1.2}
.uc-content p{font-size:15px;color:var(--gray-500);line-height:1.7;margin-bottom:20px}

.uc-benefits{list-style:none;padding:0;display:flex;flex-direction:column;gap:10px;margin-bottom:24px}
.uc-benefits li{display:flex;align-items:flex-start;gap:10px;font-size:14px;color:var(--gray-600);line-height:1.5}
.uc-benefits li i{color:var(--primary-light);font-size:16px;margin-top:1px;flex-shrink:0}

.uc-quote{padding:16px 20px;background:var(--gray-50);border-left:3px solid var(--primary-light);border-radius:0 10px 10px 0;font-size:13px;font-style:italic;color:var(--gray-600);line-height:1.6}
.uc-quote strong{color:var(--gray-800);font-style:normal}

/* MOCKUP SCENES */
.scene{width:100%;height:100%;position:relative;padding:24px}
.scene-card{background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.08);padding:16px;position:relative}
.scene-header{display:flex;align-items:center;gap:8px;margin-bottom:12px;font-size:11px;font-weight:600;color:var(--gray-400)}
.scene-header i{font-size:14px}
.scene-line{height:8px;background:var(--gray-100);border-radius:4px;margin-bottom:6px}
.scene-line.w60{width:60%}.scene-line.w80{width:80%}.scene-line.w40{width:40%}.scene-line.w70{width:70%}
.scene-price{font-size:28px;font-weight:800;color:var(--gray-900);margin:12px 0 4px}
.scene-sub{font-size:12px;color:var(--gray-400);margin-bottom:12px}
.scene-tags{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px}
.scene-tag{padding:3px 8px;background:var(--gray-100);border-radius:6px;font-size:10px;font-weight:600;color:var(--gray-500)}

/* Widget FAB in scenes */
.scene-fab{position:absolute;bottom:16px;right:16px;width:52px;height:52px;border-radius:50%;background:var(--gradient);display:grid;place-items:center;color:#fff;font-size:22px;box-shadow:0 4px 16px rgba(109,40,217,.3);cursor:default;animation:fabPulse 3s infinite}
@keyframes fabPulse{0%,100%{box-shadow:0 4px 16px rgba(109,40,217,.3)}50%{box-shadow:0 4px 24px rgba(109,40,217,.5)}}
.scene-fab-label{position:absolute;bottom:74px;right:8px;background:var(--gray-900);color:#fff;font-size:11px;font-weight:600;padding:6px 12px;border-radius:8px;white-space:nowrap}
.scene-fab-label::after{content:'';position:absolute;bottom:-5px;right:20px;width:10px;height:10px;background:var(--gray-900);transform:rotate(45deg)}

/* Image placeholder for scenes */
.scene-img{width:100%;height:140px;background:var(--gray-100);border-radius:10px;margin-bottom:12px;display:flex;align-items:center;justify-content:center;color:var(--gray-300);font-size:32px}

/* STATS BAND */
.stats-band{padding:64px 0;background:var(--gray-900);color:#fff}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:32px;text-align:center}
.stat-num{font-family:var(--mono);font-size:42px;font-weight:700;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1;margin-bottom:8px}
.stat-label{font-size:14px;color:var(--gray-400);font-weight:500}

/* MORE SECTORS */
.sectors-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.sector-card{background:#fff;border:1.5px solid var(--gray-200);border-radius:var(--radius-lg);padding:28px 24px;transition:all .25s}
.sector-card:hover{border-color:var(--primary-100);box-shadow:0 8px 24px rgba(139,92,246,.06);transform:translateY(-3px)}
.sector-card .sc-icon{width:44px;height:44px;border-radius:12px;display:grid;place-items:center;font-size:20px;margin-bottom:16px}
.sector-card h3{font-size:16px;font-weight:700;margin-bottom:6px}
.sector-card p{font-size:14px;color:var(--gray-500);line-height:1.6}

/* CTA */
.cta-band{padding:80px 0;text-align:center;background:linear-gradient(180deg,var(--gray-50) 0%,#fff 100%);border-top:1px solid var(--gray-100)}
.cta-band h2{font-size:clamp(26px,3.5vw,40px);font-weight:800;letter-spacing:-.5px;margin-bottom:16px}
.cta-band p{font-size:17px;color:var(--gray-500);margin-bottom:32px}
.cta-actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
.btn-g{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:15px;font-weight:700;font-family:var(--font);border-radius:var(--radius);cursor:pointer;transition:all .2s;text-decoration:none;border:none}
.btn-g.primary{background:var(--gradient);color:#fff;box-shadow:0 4px 16px rgba(109,40,217,.25)}.btn-g.primary:hover{opacity:.9;transform:translateY(-1px)}
.btn-g.outline{background:#fff;color:var(--gray-700);border:1px solid var(--gray-300)}.btn-g.outline:hover{border-color:var(--gray-400)}

@media(max-width:900px){.usecase{grid-template-columns:1fr}.usecase.reverse .uc-visual{order:0}.usecase.reverse .uc-content{order:0}.uc-visual{min-height:280px}.uc-content{padding:32px 28px}.stats-grid{grid-template-columns:repeat(2,1fr);gap:24px}.sectors-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.sectors-grid{grid-template-columns:1fr}.stats-grid{grid-template-columns:1fr 1fr}.uc-content{padding:24px 20px}}
</style>
@endpush

@section('content')

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-badge"><i class="bi bi-lightbulb"></i> {{ __('c2c_uc.badge') }}</div>
    <h1>{{ __('c2c_uc.title') }}<br><span>{{ __('c2c_uc.title.highlight') }}</span></h1>
    <p>{{ __('c2c_uc.sub') }}</p>
  </div>
</section>

<!-- ═══════ USE CASE 1: AUTOMOBILE ═══════ -->
<section>
  <div class="container">
    <div class="usecase">
      <div class="uc-visual" style="background:linear-gradient(135deg,#eff6ff,#dbeafe)">
        <div class="scene">
          <div class="scene-card">
            <div class="scene-img"><i class="bi bi-car-front-fill"></i></div>
            <div class="scene-tags">
              <span class="scene-tag">Peugeot 3008</span>
              <span class="scene-tag">2023</span>
              <span class="scene-tag">45 000 km</span>
              <span class="scene-tag">Diesel</span>
            </div>
            <div class="scene-price">24 990 &euro;</div>
            <div class="scene-sub">{{ __('c2c_uc.auto.scene_sub') }}</div>
            <div class="scene-line w80"></div>
            <div class="scene-line w60"></div>
            <div class="scene-fab"><i class="bi bi-telephone-fill"></i></div>
            <div class="scene-fab-label">{{ __('c2c_uc.auto.fab_label') }}</div>
          </div>
        </div>
      </div>
      <div class="uc-content">
        <div class="uc-icon" style="background:#eff6ff;color:#3b82f6"><i class="bi bi-car-front-fill"></i></div>
        <div class="uc-sector" style="color:#3b82f6">{{ __('c2c_uc.auto.sector') }}</div>
        <h2>{{ __('c2c_uc.auto.title') }}</h2>
        <p>{{ __('c2c_uc.auto.desc') }}</p>
        <ul class="uc-benefits">
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.auto.b1') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.auto.b2') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.auto.b3') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.auto.b4') }}</li>
        </ul>
        <div class="uc-quote">{{ __('c2c_uc.auto.quote') }} — <strong>{{ __('c2c_uc.auto.quote_author') }}</strong></div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ USE CASE 2: IMMOBILIER ═══════ -->
<section class="alt">
  <div class="container">
    <div class="usecase reverse">
      <div class="uc-content">
        <div class="uc-icon" style="background:#ecfdf5;color:#059669"><i class="bi bi-house-door-fill"></i></div>
        <div class="uc-sector" style="color:#059669">{{ __('c2c_uc.immo.sector') }}</div>
        <h2>{{ __('c2c_uc.immo.title') }}</h2>
        <p>{{ __('c2c_uc.immo.desc') }}</p>
        <ul class="uc-benefits">
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.immo.b1') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.immo.b2') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.immo.b3') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.immo.b4') }}</li>
        </ul>
        <div class="uc-quote">{{ __('c2c_uc.immo.quote') }} — <strong>{{ __('c2c_uc.immo.quote_author') }}</strong></div>
      </div>
      <div class="uc-visual" style="background:linear-gradient(135deg,#ecfdf5,#d1fae5)">
        <div class="scene">
          <div class="scene-card">
            <div class="scene-img"><i class="bi bi-building"></i></div>
            <div class="scene-tags">
              <span class="scene-tag">T4</span>
              <span class="scene-tag">85 m&sup2;</span>
              <span class="scene-tag">3e etage</span>
              <span class="scene-tag">Balcon</span>
            </div>
            <div class="scene-price">285 000 &euro;</div>
            <div class="scene-sub">{{ __('c2c_uc.immo.scene_sub') }}</div>
            <div class="scene-line w70"></div>
            <div class="scene-line w40"></div>
            <div class="scene-fab" style="background:linear-gradient(135deg,#059669,#10b981)"><i class="bi bi-telephone-fill"></i></div>
            <div class="scene-fab-label">{{ __('c2c_uc.immo.fab_label') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ USE CASE 3: URGENCES MEDICALES ═══════ -->
<section>
  <div class="container">
    <div class="usecase">
      <div class="uc-visual" style="background:linear-gradient(135deg,#fef2f2,#fecaca)">
        <div class="scene">
          <div class="scene-card">
            <div class="scene-header"><i class="bi bi-plus-circle-fill" style="color:#dc2626"></i> {{ __('c2c_uc.medical.scene_header') }}</div>
            <div class="scene-img" style="background:#fef2f2;color:#fca5a5"><i class="bi bi-heart-pulse-fill"></i></div>
            <div class="scene-line w80"></div>
            <div class="scene-line w60"></div>
            <div class="scene-line w70"></div>
            <div class="scene-fab" style="background:linear-gradient(135deg,#dc2626,#ef4444)"><i class="bi bi-telephone-fill"></i></div>
            <div class="scene-fab-label">{{ __('c2c_uc.medical.fab_label') }}</div>
          </div>
        </div>
      </div>
      <div class="uc-content">
        <div class="uc-icon" style="background:#fef2f2;color:#dc2626"><i class="bi bi-heart-pulse-fill"></i></div>
        <div class="uc-sector" style="color:#dc2626">{{ __('c2c_uc.medical.sector') }}</div>
        <h2>{{ __('c2c_uc.medical.title') }}</h2>
        <p>{{ __('c2c_uc.medical.desc') }}</p>
        <ul class="uc-benefits">
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.medical.b1') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.medical.b2') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.medical.b3') }}</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ USE CASE 4: E-COMMERCE ═══════ -->
<section class="alt">
  <div class="container">
    <div class="usecase reverse">
      <div class="uc-content">
        <div class="uc-icon" style="background:#fff7ed;color:#ea580c"><i class="bi bi-cart-fill"></i></div>
        <div class="uc-sector" style="color:#ea580c">{{ __('c2c_uc.ecom.sector') }}</div>
        <h2>{{ __('c2c_uc.ecom.title') }}</h2>
        <p>{{ __('c2c_uc.ecom.desc') }}</p>
        <ul class="uc-benefits">
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.ecom.b1') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.ecom.b2') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.ecom.b3') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.ecom.b4') }}</li>
        </ul>
        <div class="uc-quote">{{ __('c2c_uc.ecom.quote') }} — <strong>{{ __('c2c_uc.ecom.quote_author') }}</strong></div>
      </div>
      <div class="uc-visual" style="background:linear-gradient(135deg,#fff7ed,#fed7aa)">
        <div class="scene">
          <div class="scene-card">
            <div class="scene-header"><i class="bi bi-bag-fill" style="color:#ea580c"></i> {{ __('c2c_uc.ecom.scene_header') }}</div>
            <div class="scene-img" style="background:#fff7ed;color:#fdba74"><i class="bi bi-box-seam-fill"></i></div>
            <div class="scene-price" style="font-size:22px">149,90 &euro;</div>
            <div class="scene-tags">
              <span class="scene-tag" style="background:#dcfce7;color:#16a34a">{{ __('c2c_uc.ecom.in_stock') }}</span>
              <span class="scene-tag">{{ __('c2c_uc.ecom.free_shipping') }}</span>
            </div>
            <div class="scene-line w60"></div>
            <div class="scene-fab"><i class="bi bi-telephone-fill"></i></div>
            <div class="scene-fab-label">{{ __('c2c_uc.ecom.fab_label') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ USE CASE 5: SERVICES D'URGENCE / DEPANNAGE ═══════ -->
<section>
  <div class="container">
    <div class="usecase">
      <div class="uc-visual" style="background:linear-gradient(135deg,#fefce8,#fef08a)">
        <div class="scene">
          <div class="scene-card">
            <div class="scene-header"><i class="bi bi-tools" style="color:#ca8a04"></i> {{ __('c2c_uc.emergency.scene_header') }}</div>
            <div class="scene-img" style="background:#fefce8;color:#facc15"><i class="bi bi-wrench-adjustable"></i></div>
            <div style="font-size:18px;font-weight:800;color:var(--gray-900);margin-bottom:8px">{{ __('c2c_uc.emergency.scene_title') }}</div>
            <div class="scene-line w80"></div>
            <div class="scene-line w60"></div>
            <div class="scene-fab" style="background:linear-gradient(135deg,#ca8a04,#eab308)"><i class="bi bi-telephone-fill"></i></div>
            <div class="scene-fab-label">{{ __('c2c_uc.emergency.fab_label') }}</div>
          </div>
        </div>
      </div>
      <div class="uc-content">
        <div class="uc-icon" style="background:#fefce8;color:#ca8a04"><i class="bi bi-wrench-adjustable"></i></div>
        <div class="uc-sector" style="color:#ca8a04">{{ __('c2c_uc.emergency.sector') }}</div>
        <h2>{{ __('c2c_uc.emergency.title') }}</h2>
        <p>{{ __('c2c_uc.emergency.desc') }}</p>
        <ul class="uc-benefits">
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.emergency.b1') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.emergency.b2') }}</li>
          <li><i class="bi bi-check-circle-fill"></i> {{ __('c2c_uc.emergency.b3') }}</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ STATS BAND ═══════ -->
<section class="stats-band">
  <div class="container">
    <div class="stats-grid">
      <div>
        <div class="stat-num">+35%</div>
        <div class="stat-label">{{ __('c2c_uc.stat1') }}</div>
      </div>
      <div>
        <div class="stat-num">-50%</div>
        <div class="stat-label">{{ __('c2c_uc.stat2') }}</div>
      </div>
      <div>
        <div class="stat-num">8s</div>
        <div class="stat-label">{{ __('c2c_uc.stat3') }}</div>
      </div>
      <div>
        <div class="stat-num">24/7</div>
        <div class="stat-label">{{ __('c2c_uc.stat4') }}</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ MORE SECTORS ═══════ -->
<section>
  <div class="container">
    <div class="section-label"><i class="bi bi-grid-3x3-gap"></i> {{ __('c2c_uc.more.label') }}</div>
    <h2 class="section-title">{{ __('c2c_uc.more.title') }}</h2>
    <p class="section-desc">{{ __('c2c_uc.more.desc') }}</p>

    <div class="sectors-grid">
      <div class="sector-card">
        <div class="sc-icon" style="background:#faf5ff;color:#9333ea"><i class="bi bi-mortarboard-fill"></i></div>
        <h3>{{ __('c2c_uc.sector.education.title') }}</h3>
        <p>{{ __('c2c_uc.sector.education.desc') }}</p>
      </div>
      <div class="sector-card">
        <div class="sc-icon" style="background:#ecfeff;color:#0891b2"><i class="bi bi-airplane-fill"></i></div>
        <h3>{{ __('c2c_uc.sector.travel.title') }}</h3>
        <p>{{ __('c2c_uc.sector.travel.desc') }}</p>
      </div>
      <div class="sector-card">
        <div class="sc-icon" style="background:#f0fdf4;color:#16a34a"><i class="bi bi-bank2"></i></div>
        <h3>{{ __('c2c_uc.sector.finance.title') }}</h3>
        <p>{{ __('c2c_uc.sector.finance.desc') }}</p>
      </div>
      <div class="sector-card">
        <div class="sc-icon" style="background:#eff6ff;color:#2563eb"><i class="bi bi-headset"></i></div>
        <h3>{{ __('c2c_uc.sector.support.title') }}</h3>
        <p>{{ __('c2c_uc.sector.support.desc') }}</p>
      </div>
      <div class="sector-card">
        <div class="sc-icon" style="background:#fef2f2;color:#dc2626"><i class="bi bi-shield-fill-check"></i></div>
        <h3>{{ __('c2c_uc.sector.insurance.title') }}</h3>
        <p>{{ __('c2c_uc.sector.insurance.desc') }}</p>
      </div>
      <div class="sector-card">
        <div class="sc-icon" style="background:#fefce8;color:#ca8a04"><i class="bi bi-briefcase-fill"></i></div>
        <h3>{{ __('c2c_uc.sector.legal.title') }}</h3>
        <p>{{ __('c2c_uc.sector.legal.desc') }}</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="container">
    <h2>{{ __('c2c_uc.cta.title') }}</h2>
    <p>{{ __('c2c_uc.cta.desc') }}</p>
    <div class="cta-actions">
      <a href="{{ lroute('click-to-call') }}" class="btn-g primary"><i class="bi bi-cursor-fill"></i> {{ __('c2c_uc.cta.btn1') }}</a>
      <a href="{{ lroute('contact') }}" class="btn-g outline"><i class="bi bi-send"></i> {{ __('Nous contacter') }}</a>
    </div>
  </div>
</section>
@endsection
