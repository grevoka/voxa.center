@extends('layouts.app')
@section('title', 'Softphone WebRTC — Voxa Center')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--primary:#6d28d9;--primary-light:#8b5cf6;--primary-50:#f5f3ff;--primary-100:#ede9fe;--accent:#06b6d4;--accent-50:#ecfeff;--gradient:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;--gray-900:#0f172a;--font:'Plus Jakarta Sans',sans-serif;--mono:'Fira Code',monospace;--radius:10px;--radius-lg:14px;--radius-xl:20px}
*{margin:0;padding:0;box-sizing:border-box}body{font-family:var(--font);color:var(--gray-800);background:#fff;-webkit-font-smoothing:antialiased}a{color:inherit;text-decoration:none}
.container{max-width:1100px;margin:0 auto;padding:0 24px}

/* NAV */
.nav-top{position:sticky;top:0;z-index:100;padding:14px 0;background:rgba(255,255,255,.92);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:19px;color:var(--gray-900);letter-spacing:-.5px}
.nav-brand img{width:36px;height:36px;border-radius:var(--radius)}
.nav-links{display:flex;gap:10px}
.nav-links a{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:8px;border:1px solid var(--gray-200);color:var(--gray-600);transition:all .2s}
.nav-links a:hover{border-color:var(--gray-400);color:var(--gray-900)}
.nav-links a.cta{background:var(--gradient);color:#fff;border:none}

/* HERO */
.hero{padding:100px 0 80px;background:linear-gradient(180deg,#fff 0%,var(--gray-50) 100%);position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;top:-200px;left:-150px;width:600px;height:600px;background:radial-gradient(circle,rgba(6,182,212,.06) 0%,transparent 65%);pointer-events:none}
.hero-grid{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center}
.hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 16px;background:var(--accent-50);color:var(--accent);font-size:13px;font-weight:600;border-radius:999px;margin-bottom:24px}
.hero h1{font-size:clamp(30px,4.5vw,46px);font-weight:800;letter-spacing:-1.5px;line-height:1.1;margin-bottom:20px}
.hero h1 span{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.hero p{font-size:17px;color:var(--gray-500);line-height:1.7;margin-bottom:32px}
.hero-actions{display:flex;gap:12px;flex-wrap:wrap}

/* PHONE MOCKUP */
.phone-mockup{background:var(--gray-900);border-radius:24px;padding:32px 24px;max-width:320px;margin:0 auto;box-shadow:0 25px 50px rgba(0,0,0,.15);position:relative;overflow:hidden}
.phone-mockup::before{content:'';position:absolute;top:-80px;right:-80px;width:200px;height:200px;background:radial-gradient(circle,rgba(139,92,246,.15) 0%,transparent 70%);pointer-events:none}
.phone-status{display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:24px;font-size:13px;font-weight:600;color:#22c55e}
.phone-status .dot{width:8px;height:8px;background:#22c55e;border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}
.phone-caller{text-align:center;margin-bottom:28px}
.phone-caller .avatar{width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#06b6d4,#8b5cf6);display:grid;place-items:center;margin:0 auto 12px;font-size:24px;color:#fff}
.phone-caller .name{font-size:18px;font-weight:700;color:#fff;margin-bottom:4px}
.phone-caller .number{font-size:14px;color:var(--gray-400);font-family:var(--mono)}
.phone-timer{text-align:center;font-family:var(--mono);font-size:28px;font-weight:500;color:#fff;margin-bottom:28px;letter-spacing:2px}
.phone-actions{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.phone-btn{display:flex;flex-direction:column;align-items:center;gap:6px;padding:14px;border-radius:14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.1);color:var(--gray-400);font-size:11px;font-weight:600;transition:all .2s;cursor:default}
.phone-btn i{font-size:20px}
.phone-btn.hangup{background:rgba(239,68,68,.15);border-color:rgba(239,68,68,.3);color:#ef4444}
.phone-btn.mute{background:rgba(59,130,246,.1);border-color:rgba(59,130,246,.2);color:#3b82f6}

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

/* TECH */
.tech-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}
.tech-item{text-align:center;padding:20px 12px;background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius);transition:all .2s}
.tech-item:hover{border-color:var(--primary-100);box-shadow:0 4px 12px rgba(139,92,246,.06)}
.tech-item .t-name{font-size:14px;font-weight:700;color:var(--gray-800)}
.tech-item .t-detail{font-size:12px;color:var(--gray-400);font-family:var(--mono);margin-top:2px}

/* CTA */
.cta-band{padding:80px 0;text-align:center;background:linear-gradient(180deg,var(--gray-50) 0%,#fff 100%);border-top:1px solid var(--gray-100)}
.cta-band h2{font-size:clamp(26px,3.5vw,40px);font-weight:800;letter-spacing:-.5px;margin-bottom:16px}
.cta-band p{font-size:17px;color:var(--gray-500);margin-bottom:32px}
.cta-actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
.btn-g{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:15px;font-weight:700;font-family:var(--font);border-radius:var(--radius);cursor:pointer;transition:all .2s;text-decoration:none;border:none}
.btn-g.primary{background:var(--gradient);color:#fff;box-shadow:0 4px 16px rgba(109,40,217,.25)}.btn-g.primary:hover{opacity:.9;transform:translateY(-1px)}
.btn-g.outline{background:#fff;color:var(--gray-700);border:1px solid var(--gray-300)}.btn-g.outline:hover{border-color:var(--gray-400)}

@media(max-width:900px){.hero-grid{grid-template-columns:1fr;text-align:center}.hero-actions{justify-content:center}.phone-mockup{margin-top:40px}.feat-grid{grid-template-columns:1fr}.tech-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.tech-grid{grid-template-columns:1fr 1fr}.nav-links .hide-m{display:none}}
</style>
@endpush

@section('content')
<nav class="nav-top">
  <div class="container nav-inner">
    <a href="/" class="nav-brand"><img src="/images/logo.png" alt="Voxa Center"> Voxa Center</a>
    <div class="nav-links">
      <a href="/" class="hide-m"><i class="bi bi-arrow-left"></i> Accueil</a>
      <a href="/scenarios" class="hide-m"><i class="bi bi-diagram-3"></i> Scenarios</a>
      <a href="/nous-contacter" class="cta"><i class="bi bi-send"></i> Nous contacter</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-grid">
      <div>
        <div class="hero-badge"><i class="bi bi-headset"></i> WebRTC integre</div>
        <h1>Un softphone<br><span>dans votre navigateur</span></h1>
        <p>Passez et recevez vos appels directement depuis l'interface Voxa Center. Aucune installation, aucun plugin — juste votre navigateur et un casque.</p>
        <div class="hero-actions">
          <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn-g primary"><i class="bi bi-download"></i> Commencer gratuitement</a>
          <a href="/nous-contacter" class="btn-g outline"><i class="bi bi-send"></i> Nous contacter</a>
        </div>
      </div>
      <div>
        <!-- PHONE MOCKUP -->
        <div class="phone-mockup">
          <div class="phone-status"><span class="dot"></span> Appel en cours — Chiffre SRTP</div>
          <div class="phone-caller">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Marie Dupont</div>
            <div class="number">+33 1 23 45 67 89</div>
          </div>
          <div class="phone-timer">02:34</div>
          <div class="phone-actions">
            <div class="phone-btn mute"><i class="bi bi-mic-mute-fill"></i> Muet</div>
            <div class="phone-btn"><i class="bi bi-pause-fill"></i> Pause</div>
            <div class="phone-btn"><i class="bi bi-arrow-left-right"></i> Transfert</div>
            <div class="phone-btn"><i class="bi bi-grid-3x3-gap-fill"></i> Clavier</div>
            <div class="phone-btn hangup"><i class="bi bi-telephone-x-fill"></i> Raccrocher</div>
            <div class="phone-btn"><i class="bi bi-record-circle"></i> Enregistrer</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FONCTIONNALITES -->
<section class="alt">
  <div class="container">
    <div class="section-label"><i class="bi bi-lightning-charge"></i> Fonctionnalites</div>
    <h2 class="section-title">Tout ce qu'un softphone<br>professionnel doit faire</h2>
    <p class="section-desc">Le softphone WebRTC de Voxa Center est integre dans l'espace operateur. Chaque operateur a son telephone directement dans son navigateur.</p>

    <div class="feat-grid">
      <div class="feat-card">
        <div class="fc-icon" style="background:#eff6ff;color:#3b82f6"><i class="bi bi-telephone-inbound-fill"></i></div>
        <h3>Appels entrants & sortants</h3>
        <p>Passez et recevez des appels VoIP depuis n'importe quel navigateur moderne. Compatible Chrome, Firefox, Edge, Safari.</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:#ecfdf5;color:#059669"><i class="bi bi-shield-lock-fill"></i></div>
        <h3>Chiffrement DTLS-SRTP</h3>
        <p>Tous les flux audio sont chiffres de bout en bout via DTLS-SRTP. Negociation ICE automatique pour le NAT traversal.</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:var(--primary-50);color:var(--primary)"><i class="bi bi-arrow-left-right"></i></div>
        <h3>Transfert d'appel</h3>
        <p>Transferez un appel en cours vers un autre poste, un numero externe, ou une file d'attente — en un clic.</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:#fff7ed;color:#ea580c"><i class="bi bi-record-circle-fill"></i></div>
        <h3>Enregistrement a la volee</h3>
        <p>Lancez l'enregistrement pendant un appel (MixMonitor). Les fichiers sont accessibles depuis l'interface admin.</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:var(--accent-50);color:var(--accent)"><i class="bi bi-person-badge-fill"></i></div>
        <h3>Caller ID dynamique</h3>
        <p>Chaque operateur peut selectionner son numero sortant parmi les numeros autorises par son groupe d'acces.</p>
      </div>
      <div class="feat-card">
        <div class="fc-icon" style="background:#fef2f2;color:#dc2626"><i class="bi bi-bell-fill"></i></div>
        <h3>Notifications navigateur</h3>
        <p>Recevez une notification sonore et visuelle a chaque appel entrant, meme si l'onglet est en arriere-plan.</p>
      </div>
    </div>
  </div>
</section>

<!-- STACK TECHNIQUE -->
<section>
  <div class="container">
    <div class="section-label"><i class="bi bi-cpu"></i> Stack technique</div>
    <h2 class="section-title">WebRTC natif,<br>sans plugin ni extension</h2>
    <p class="section-desc">Le softphone repose sur JsSIP et les API WebRTC standards du navigateur. Asterisk gere le signaling SIP via WebSocket.</p>

    <div class="tech-grid">
      <div class="tech-item"><div class="t-name">JsSIP</div><div class="t-detail">Client SIP</div></div>
      <div class="tech-item"><div class="t-name">WebRTC</div><div class="t-detail">API navigateur</div></div>
      <div class="tech-item"><div class="t-name">DTLS-SRTP</div><div class="t-detail">Chiffrement</div></div>
      <div class="tech-item"><div class="t-name">ICE / STUN</div><div class="t-detail">NAT traversal</div></div>
      <div class="tech-item"><div class="t-name">WebSocket</div><div class="t-detail">:8088 (WSS)</div></div>
      <div class="tech-item"><div class="t-name">Asterisk 20</div><div class="t-detail">PJSIP</div></div>
      <div class="tech-item"><div class="t-name">Opus / G.722</div><div class="t-detail">Codecs HD</div></div>
      <div class="tech-item"><div class="t-name">MixMonitor</div><div class="t-detail">Enregistrement</div></div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="container">
    <h2>Pret a telephoner depuis votre navigateur ?</h2>
    <p>Installez Voxa Center et activez le softphone WebRTC en quelques clics.</p>
    <div class="cta-actions">
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn-g primary"><i class="bi bi-download"></i> Commencer gratuitement</a>
      <a href="/nous-contacter" class="btn-g outline"><i class="bi bi-send"></i> Nous contacter</a>
    </div>
  </div>
</section>
@endsection
