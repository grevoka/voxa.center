@extends('layouts.app')
@section('title', 'Scenarios d\'appels visuels — Voxa Center')

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
.hero{padding:100px 0 80px;text-align:center;background:linear-gradient(180deg,#fff 0%,var(--gray-50) 100%);position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;top:-200px;right:-150px;width:600px;height:600px;background:radial-gradient(circle,rgba(139,92,246,.06) 0%,transparent 65%);pointer-events:none}
.hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 16px;background:var(--primary-50);color:var(--primary-light);font-size:13px;font-weight:600;border-radius:999px;margin-bottom:24px}
.hero h1{font-size:clamp(32px,5vw,52px);font-weight:800;letter-spacing:-1.5px;line-height:1.1;margin-bottom:20px}
.hero h1 span{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.hero p{font-size:18px;color:var(--gray-500);max-width:620px;margin:0 auto 40px;line-height:1.7}

/* MOCKUP */
.mockup-wrap{max-width:900px;margin:0 auto;background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-xl);overflow:hidden;box-shadow:0 25px 50px -12px rgba(0,0,0,.1)}
.mockup-bar{display:flex;align-items:center;gap:8px;padding:12px 16px;background:var(--gray-50);border-bottom:1px solid var(--gray-200)}
.mockup-dot{width:12px;height:12px;border-radius:50%}.mockup-dot.r{background:#f87171}.mockup-dot.y{background:#fbbf24}.mockup-dot.g{background:#34d399}
.mockup-url{flex:1;text-align:center;font-size:12px;color:var(--gray-400);font-family:var(--mono)}
.mockup-canvas{padding:32px;background:var(--gray-50);min-height:300px;position:relative}

/* FLOW BLOCKS */
.flow-row{display:flex;align-items:center;gap:16px;justify-content:center;margin-bottom:24px;flex-wrap:wrap}
.flow-block{padding:14px 20px;background:#fff;border:2px solid var(--gray-200);border-radius:12px;text-align:center;min-width:110px;box-shadow:0 2px 8px rgba(0,0,0,.04);transition:all .2s}
.flow-block:hover{border-color:var(--primary-light);box-shadow:0 4px 16px rgba(139,92,246,.1)}
.flow-block .icon{width:32px;height:32px;border-radius:8px;display:grid;place-items:center;margin:0 auto 8px;font-size:16px}
.flow-block .icon.blue{background:#eff6ff;color:#3b82f6}
.flow-block .icon.green{background:#ecfdf5;color:#059669}
.flow-block .icon.orange{background:#fff7ed;color:#ea580c}
.flow-block .icon.purple{background:var(--primary-50);color:var(--primary)}
.flow-block .icon.cyan{background:var(--accent-50);color:var(--accent)}
.flow-block .name{font-size:12px;font-weight:700;color:var(--gray-800)}
.flow-block .detail{font-size:10px;color:var(--gray-400);margin-top:2px}
.flow-block.active{border-color:var(--primary);background:var(--primary-50)}
.flow-arrow{color:var(--gray-300);font-size:18px;flex-shrink:0}

/* SECTIONS */
section{padding:80px 0}
section.alt{background:var(--gray-50)}
.section-label{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;background:var(--primary-50);color:var(--primary-light);font-size:13px;font-weight:600;border-radius:999px;margin-bottom:16px}
.section-title{font-size:clamp(26px,3.5vw,38px);font-weight:800;letter-spacing:-.5px;margin-bottom:16px;line-height:1.15}
.section-desc{font-size:17px;color:var(--gray-500);line-height:1.7;max-width:600px;margin-bottom:48px}

/* BLOCKS GRID */
.blocks-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.block-card{background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-lg);padding:28px 24px;transition:all .25s}
.block-card:hover{border-color:var(--primary-100);box-shadow:0 8px 24px rgba(139,92,246,.06);transform:translateY(-3px)}
.block-card .bc-icon{width:40px;height:40px;border-radius:10px;display:grid;place-items:center;font-size:18px;margin-bottom:16px}
.block-card h3{font-size:16px;font-weight:700;margin-bottom:6px}
.block-card p{font-size:14px;color:var(--gray-500);line-height:1.6}

/* STEPS */
.steps{display:grid;grid-template-columns:repeat(3,1fr);gap:32px;counter-reset:step}
.step{position:relative;padding-top:48px}
.step::before{counter-increment:step;content:counter(step);position:absolute;top:0;left:0;width:36px;height:36px;background:var(--gradient);color:#fff;border-radius:10px;display:grid;place-items:center;font-size:15px;font-weight:800}
.step h3{font-size:16px;font-weight:700;margin-bottom:6px}
.step p{font-size:14px;color:var(--gray-500);line-height:1.6}

/* CTA */
.cta-band{padding:80px 0;text-align:center;background:linear-gradient(180deg,var(--gray-50) 0%,#fff 100%);border-top:1px solid var(--gray-100)}
.cta-band h2{font-size:clamp(26px,3.5vw,40px);font-weight:800;letter-spacing:-.5px;margin-bottom:16px}
.cta-band p{font-size:17px;color:var(--gray-500);margin-bottom:32px}
.cta-actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
.btn-g{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:15px;font-weight:700;font-family:var(--font);border-radius:var(--radius);cursor:pointer;transition:all .2s;text-decoration:none;border:none}
.btn-g.primary{background:var(--gradient);color:#fff;box-shadow:0 4px 16px rgba(109,40,217,.25)}.btn-g.primary:hover{opacity:.9;transform:translateY(-1px)}
.btn-g.outline{background:#fff;color:var(--gray-700);border:1px solid var(--gray-300)}.btn-g.outline:hover{border-color:var(--gray-400)}

@media(max-width:900px){.blocks-grid,.steps{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.blocks-grid,.steps{grid-template-columns:1fr}.flow-row{flex-direction:column}.flow-arrow{transform:rotate(90deg)}.nav-links .hide-m{display:none}}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-badge"><i class="bi bi-pencil-square"></i> Editeur visuel drag & drop</div>
    <h1>Dessinez vos scenarios d'appels,<br><span>sans ecrire une ligne de config</span></h1>
    <p>Voxa Center remplace la complexite d'Asterisk par un editeur visuel. Glissez des blocs, connectez-les, et votre parcours d'appel est en production — immediatement.</p>

    <!-- MOCKUP -->
    <div class="mockup-wrap">
      <div class="mockup-bar">
        <span class="mockup-dot r"></span><span class="mockup-dot y"></span><span class="mockup-dot g"></span>
        <span class="mockup-url">voxa.example.com/callflows/edit/1</span>
      </div>
      <div class="mockup-canvas">
        <div class="flow-row">
          <div class="flow-block active">
            <div class="icon blue"><i class="bi bi-telephone-inbound-fill"></i></div>
            <div class="name">Appel entrant</div>
            <div class="detail">DID +33 1 23 45 67</div>
          </div>
          <div class="flow-arrow"><i class="bi bi-arrow-right"></i></div>
          <div class="flow-block">
            <div class="icon green"><i class="bi bi-clock-fill"></i></div>
            <div class="name">Horaires</div>
            <div class="detail">Lun-Ven 9h-18h</div>
          </div>
          <div class="flow-arrow"><i class="bi bi-arrow-right"></i></div>
          <div class="flow-block">
            <div class="icon orange"><i class="bi bi-grid-3x2-gap-fill"></i></div>
            <div class="name">Menu IVR</div>
            <div class="detail">1 → Ventes · 2 → Support</div>
          </div>
        </div>
        <div class="flow-row">
          <div class="flow-block">
            <div class="icon green"><i class="bi bi-people-fill"></i></div>
            <div class="name">File d'attente</div>
            <div class="detail">Equipe Ventes</div>
          </div>
          <div style="width:80px"></div>
          <div class="flow-block">
            <div class="icon purple"><i class="bi bi-robot"></i></div>
            <div class="name">Agent IA</div>
            <div class="detail">Support · Coral</div>
          </div>
          <div style="width:80px"></div>
          <div class="flow-block">
            <div class="icon cyan"><i class="bi bi-voicemail"></i></div>
            <div class="name">Messagerie</div>
            <div class="detail">Boite vocale</div>
          </div>
        </div>
        <div style="text-align:right;font-size:11px;color:var(--gray-400);margin-top:8px"><i class="bi bi-arrows-move"></i> Glissez-deposez vos blocs</div>
      </div>
    </div>
  </div>
</section>

<!-- BLOCS DISPONIBLES -->
<section class="alt">
  <div class="container">
    <div class="section-label"><i class="bi bi-boxes"></i> Blocs disponibles</div>
    <h2 class="section-title">12 blocs pour composer<br>n'importe quel parcours</h2>
    <p class="section-desc">Chaque bloc correspond a une action telephonique. Combinez-les pour creer des scenarios aussi simples ou complexes que vous le souhaitez.</p>

    <div class="blocks-grid">
      <div class="block-card">
        <div class="bc-icon" style="background:#eff6ff;color:#3b82f6"><i class="bi bi-telephone-inbound-fill"></i></div>
        <h3>Appel entrant</h3>
        <p>Point d'entree du scenario. Declenchement automatique par numero DID ou contexte Asterisk.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#ecfdf5;color:#059669"><i class="bi bi-clock-fill"></i></div>
        <h3>Horaires</h3>
        <p>Branche ouvert/ferme avec ports visuels vert/rouge. Gerez les jours feries et les exceptions.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#fff7ed;color:#ea580c"><i class="bi bi-grid-3x2-gap-fill"></i></div>
        <h3>Menu IVR</h3>
        <p>Menu vocal interactif avec branches par touche DTMF. Boucle configurable et timeout.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#ecfdf5;color:#059669"><i class="bi bi-telephone-fill"></i></div>
        <h3>Sonnerie</h3>
        <p>Fait sonner un ou plusieurs postes simultanement ou sequentiellement. Timeout configurable.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#ecfdf5;color:#059669"><i class="bi bi-people-fill"></i></div>
        <h3>File d'attente</h3>
        <p>Queue Asterisk avec strategies (ring all, round robin, random), musique d'attente et timeout.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:var(--primary-50);color:var(--primary)"><i class="bi bi-robot"></i></div>
        <h3>Agent IA</h3>
        <p>Agent conversationnel OpenAI Realtime. Full-duplex, 8 voix, base de connaissances RAG.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:var(--accent-50);color:var(--accent)"><i class="bi bi-soundwave"></i></div>
        <h3>Synthese vocale (TTS)</h3>
        <p>Piper TTS local avec 3 voix francaises. Preview audio directement dans l'editeur.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#fef2f2;color:#dc2626"><i class="bi bi-voicemail"></i></div>
        <h3>Messagerie vocale</h3>
        <p>Boite vocale avec notification email SMTP. Ecoute et suppression depuis l'interface.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#eff6ff;color:#3b82f6"><i class="bi bi-arrow-return-right"></i></div>
        <h3>Renvoi</h3>
        <p>Redirige l'appel vers un numero externe, un autre poste, ou un autre scenario.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#fefce8;color:#ca8a04"><i class="bi bi-music-note-beamed"></i></div>
        <h3>Musique d'attente</h3>
        <p>Fichiers locaux, playlists personnalisees, ou flux streaming HTTP via ffmpeg.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#faf5ff;color:#9333ea"><i class="bi bi-camera-video-fill"></i></div>
        <h3>Conference</h3>
        <p>Salle de conference ConfBridge. Acces par code PIN, moderateur, enregistrement.</p>
      </div>
      <div class="block-card">
        <div class="bc-icon" style="background:#f0fdf4;color:#16a34a"><i class="bi bi-check-circle-fill"></i></div>
        <h3>Raccrocher</h3>
        <p>Termine l'appel proprement. Optionnel — par defaut, le dernier bloc raccroche.</p>
      </div>
    </div>
  </div>
</section>

<!-- COMMENT CA MARCHE -->
<section>
  <div class="container">
    <div class="section-label"><i class="bi bi-lightning-charge"></i> Simple comme 1-2-3</div>
    <h2 class="section-title">Creez un scenario en 3 etapes</h2>
    <p class="section-desc">Pas de fichier extensions.conf a editer, pas de dialplan a debugger. Tout se fait dans l'interface.</p>

    <div class="steps">
      <div class="step">
        <h3>Glissez vos blocs</h3>
        <p>Choisissez les blocs dont vous avez besoin dans la palette : horaires, IVR, file d'attente, agent IA, sonnerie... Deposez-les sur le canevas.</p>
      </div>
      <div class="step">
        <h3>Connectez-les</h3>
        <p>Reliez les blocs entre eux en tirant des liens. Chaque connexion represente un chemin d'appel. Les branches IVR et horaires creent automatiquement les ports.</p>
      </div>
      <div class="step">
        <h3>C'est en production</h3>
        <p>Voxa Center genere automatiquement le dialplan Asterisk, le pousse dans la base Realtime, et recharge la configuration — sans redemarrage.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="container">
    <h2>Pret a dessiner votre telephonie ?</h2>
    <p>Installez Voxa Center gratuitement ou contactez-nous pour un accompagnement.</p>
    <div class="cta-actions">
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn-g primary"><i class="bi bi-download"></i> Commencer gratuitement</a>
      <a href="/nous-contacter" class="btn-g outline"><i class="bi bi-send"></i> Nous contacter</a>
    </div>
  </div>
</section>
@endsection
