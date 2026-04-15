<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Nous contacter — Voxa Center</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root {
  --white:#fff;--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-300:#cbd5e1;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;--gray-900:#0f172a;
  --primary:#6d28d9;--primary-dark:#5b21b6;--primary-light:#8b5cf6;--primary-50:#f5f3ff;--primary-100:#ede9fe;
  --accent:#06b6d4;--accent-light:#22d3ee;--accent-50:#ecfeff;
  --gradient:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);
  --success:#059669;--success-light:#d1fae5;
  --font:'Plus Jakarta Sans',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  --mono:'Fira Code','Consolas',monospace;
  --radius:10px;--radius-lg:14px;--radius-xl:20px;--radius-full:9999px;
  --shadow-lg:0 10px 15px -3px rgba(0,0,0,.08),0 4px 6px -4px rgba(0,0,0,.04);
  --shadow-xl:0 20px 25px -5px rgba(0,0,0,.08),0 8px 10px -6px rgba(0,0,0,.04);
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--font);color:var(--gray-800);background:var(--gray-50);-webkit-font-smoothing:antialiased}

/* NAVBAR */
.navbar-top{position:sticky;top:0;z-index:100;padding:14px 0;background:rgba(255,255,255,.9);backdrop-filter:blur(16px) saturate(1.5);border-bottom:1px solid var(--gray-200)}
.navbar-inner{max-width:1100px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between}
.navbar-brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:19px;color:var(--gray-900);text-decoration:none;letter-spacing:-.5px}
.navbar-logo{width:36px;height:36px;border-radius:var(--radius);overflow:hidden;flex-shrink:0}
.navbar-logo img{width:100%;height:100%;object-fit:contain}
.btn-nav{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-family:var(--font);font-size:13px;font-weight:600;border-radius:8px;cursor:pointer;transition:all .2s;text-decoration:none;border:1px solid var(--gray-300);background:var(--white);color:var(--gray-700)}
.btn-nav:hover{background:var(--gray-50);border-color:var(--gray-400)}

/* DEMO SECTION */
.demo-section{padding:80px 0 96px}
.demo-hero{text-align:center;margin-bottom:48px}
.demo-badge-pill{display:inline-flex;align-items:center;gap:8px;background:var(--primary-50);color:var(--primary);border:1px solid var(--primary-100);border-radius:var(--radius-full);padding:6px 16px;font-size:12px;font-weight:700;margin-bottom:20px}
.demo-hero h2{font-size:clamp(28px,4vw,46px);font-weight:800;letter-spacing:-1.5px;color:var(--gray-900);margin-bottom:16px}
.demo-hero p{font-size:17px;color:var(--gray-500);line-height:1.75;max-width:560px;margin:0 auto}

/* CARD */
.demo-card{background:var(--white);border-radius:24px;overflow:hidden;box-shadow:0 8px 56px rgba(37,99,235,.08);border:1px solid var(--gray-200);max-width:1100px;margin:0 auto}
.demo-card.glow{animation:glowPulse 1.5s ease}
@keyframes glowPulse{
  0%{box-shadow:0 8px 56px rgba(37,99,235,.08)}
  40%{box-shadow:0 8px 56px rgba(59,130,246,.3),0 0 0 4px rgba(59,130,246,.12)}
  100%{box-shadow:0 8px 56px rgba(37,99,235,.08)}
}

/* LEFT */
.demo-left{padding:52px 48px;background:linear-gradient(140deg,var(--gray-900) 0%,var(--gray-800) 60%,#334155 100%);color:#fff;height:100%;position:relative;overflow:hidden}
.demo-left::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(139,92,246,.12) 0%,transparent 70%);top:-150px;right:-100px;pointer-events:none}
.demo-left h3{font-size:26px;font-weight:800;letter-spacing:-.02em;margin-bottom:14px;position:relative;color:#fff}
.demo-left>p{font-size:15px;color:var(--gray-400);line-height:1.75;margin-bottom:32px;position:relative}
.demo-feat{display:flex;align-items:flex-start;gap:12px;margin-bottom:18px;position:relative}
.demo-feat-ic{width:34px;height:34px;border-radius:9px;background:rgba(139,92,246,.18);display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;color:#a78bfa}
.demo-feat h5{font-size:14px;font-weight:700;color:#fff;margin-bottom:3px}
.demo-feat p{font-size:13px;color:var(--gray-400);margin:0;line-height:1.55}
.demo-badges{display:flex;flex-wrap:wrap;gap:8px;margin-top:28px;position:relative}
.demo-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(139,92,246,.15);border:1px solid rgba(139,92,246,.3);border-radius:var(--radius-full);padding:6px 14px;font-size:12px;font-weight:600;color:#a78bfa}
.demo-badge i{font-size:11px}

/* RIGHT */
.demo-right{padding:52px 48px}
.demo-right h4{font-size:24px;font-weight:800;margin-bottom:6px;color:var(--gray-900)}
.demo-right .sub{font-size:14px;color:var(--gray-500);margin-bottom:32px}

/* FORM COMPONENTS */
.fg{margin-bottom:16px}
.fg label{display:block;font-size:13px;font-weight:600;color:var(--gray-700);margin-bottom:6px}
.fg label .req{color:var(--primary);margin-left:2px}
.fc{width:100%;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:11px 14px;font-size:14px;font-family:var(--font);color:var(--gray-900);transition:all .15s;outline:none}
.fc:focus{border-color:var(--primary);background:var(--white);box-shadow:0 0 0 3px rgba(37,99,235,.12)}
.fc::placeholder{color:var(--gray-400)}
textarea.fc{resize:vertical;min-height:90px}

/* RADIO/CHECKBOX GRID */
.sol-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:4px}
.sol-cb{position:relative}
.sol-cb input{position:absolute;opacity:0;width:0;height:0}
.sol-cb label{display:flex;align-items:center;gap:8px;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:10px 12px;cursor:pointer;font-size:13px;font-weight:600;color:var(--gray-700);transition:all .15s;user-select:none}
.sol-cb label:hover{border-color:var(--primary-100);color:var(--gray-900);background:var(--primary-50)}
.sol-cb input:checked+label{border-color:var(--primary);color:var(--primary-dark);background:var(--primary-50)}
.sol-ico{width:24px;height:24px;border-radius:6px;background:var(--gray-200);display:flex;align-items:center;justify-content:center;font-size:12px;transition:all .15s;flex-shrink:0}
.sol-cb input:checked+label .sol-ico{background:var(--primary);color:#fff}

/* INTEREST CHECKBOXES */
.int-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:4px}
.int-cb{position:relative}
.int-cb input{position:absolute;opacity:0;width:0;height:0}
.int-cb label{display:flex;align-items:center;gap:8px;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:10px 12px;cursor:pointer;font-size:13px;font-weight:600;color:var(--gray-700);transition:all .15s;user-select:none}
.int-cb label:hover{border-color:var(--primary-100);color:var(--gray-900);background:var(--primary-50)}
.int-cb input:checked+label{border-color:var(--primary);color:var(--primary-dark);background:var(--primary-50)}
.int-cb input:checked+label .sol-ico{background:var(--primary);color:#fff}

/* SUBMIT */
.btn-submit{width:100%;background:var(--gradient);color:#fff;border:none;border-radius:var(--radius);padding:16px;font-size:15px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s;display:flex;align-items:center;justify-content:center;gap:9px;margin-top:6px;box-shadow:0 4px 16px rgba(109,40,217,.25)}
.btn-submit:hover{opacity:.9;transform:translateY(-1px);box-shadow:0 8px 24px rgba(109,40,217,.35)}
.form-note{font-size:12px;color:var(--gray-500);text-align:center;margin-top:10px;line-height:1.6}

/* SUCCESS MODAL */
.success-overlay{position:fixed;inset:0;background:rgba(15,23,42,.7);backdrop-filter:blur(8px);z-index:9999;display:flex;align-items:center;justify-content:center;animation:fadeOverlay .3s ease}
@keyframes fadeOverlay{from{opacity:0}to{opacity:1}}
.success-modal{background:#fff;border-radius:24px;padding:56px 48px;max-width:520px;width:90%;text-align:center;position:relative;box-shadow:0 32px 80px rgba(37,99,235,.2);animation:popModal .4s cubic-bezier(.16,1,.3,1)}
@keyframes popModal{from{opacity:0;transform:scale(.85) translateY(30px)}to{opacity:1;transform:scale(1) translateY(0)}}
.success-modal .icon-wrap{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#ECFDF5,#D1FAE5);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;box-shadow:0 8px 32px rgba(22,163,74,.2)}
.success-modal .icon-wrap i{font-size:36px;color:#16A34A}
.success-modal h2{font-size:28px;font-weight:800;color:var(--gray-900);letter-spacing:-.02em;margin:0 0 12px}
.success-modal p{font-size:16px;color:var(--gray-500);line-height:1.7;margin:0 0 8px}
.success-modal .highlight{font-size:14px;font-weight:600;color:var(--primary-dark);background:var(--primary-50);border:1px solid var(--primary-100);border-radius:var(--radius);padding:12px 20px;margin-top:20px;display:inline-flex;align-items:center;gap:8px}
.success-modal .close-btn{margin-top:28px;background:var(--primary);color:#fff;border:none;border-radius:12px;padding:14px 40px;font-size:15px;font-weight:700;font-family:var(--font);cursor:pointer;transition:all .15s;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 16px rgba(37,99,235,.25)}
.success-modal .close-btn:hover{background:var(--primary-dark);transform:translateY(-2px);box-shadow:0 8px 24px rgba(37,99,235,.35)}

/* RESPONSIVE */
@media(max-width:991px){
  .demo-left,.demo-right{padding:36px 28px}
}
@media(max-width:767px){
  .sol-grid,.int-grid{grid-template-columns:1fr}
  .demo-left,.demo-right{padding:28px 20px}
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar-top">
  <div class="navbar-inner">
    <a href="/" class="navbar-brand">
      <div class="navbar-logo"><img src="/images/logo.png" alt="Voxa Center"></div>
      Voxa Center
    </a>
    <div style="display:flex;gap:10px;align-items:center">
      <a href="/" class="btn-nav"><i class="bi bi-arrow-left"></i> Retour au site</a>
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn-nav"><i class="bi bi-github"></i> GitHub</a>
    </div>
  </div>
</nav>

<!-- DEMO SECTION -->
<section class="demo-section" id="demo">
  <div class="container" style="max-width:1100px">
    <div class="demo-hero">
      <div class="demo-badge-pill">
        <i class="bi bi-calendar-check"></i> {{ __('Rendez-vous gratuit') }} &middot; {{ __('Sans engagement') }}
      </div>
      <h2>{{ __('Parlons de votre projet') }}<br>{{ __('telephonie') }}</h2>
      <p>{{ __('Nos equipes vous accompagnent dans la mise en place de Voxa Center. Hebergement, installation, support — nous revenons vers vous sous 24h.') }}</p>
    </div>

    @if(session('success'))
    <div class="success-overlay" id="successOverlay" onclick="if(event.target===this)closeSuccessModal()">
      <div class="success-modal">
        <div class="icon-wrap"><i class="bi bi-check-lg"></i></div>
        <h2>{{ __('Demande envoyee !') }}</h2>
        <p>{!! __('Merci ! Votre demande a bien ete enregistree.<br>Nous revenons vers vous sous <strong>24h ouvrees</strong>.') !!}</p>
        <div class="highlight"><i class="bi bi-clock-fill" style="color:var(--primary)"></i> {{ __('Reponse garantie sous 24h — sans engagement') }}</div>
        <br>
        <button class="close-btn" onclick="closeSuccessModal()"><i class="bi bi-check-circle-fill"></i> {{ __('Compris, merci !') }}</button>
      </div>
    </div>
    @endif

    <div class="demo-card" id="demo-form">
      <div class="row g-0">
        <div class="col-lg-5">
          <div class="demo-left h-100">
            <h3>{{ __('Pourquoi nous contacter ?') }}</h3>
            <p>{{ __('Que vous souhaitiez un hebergement cle en main, une aide a l\'installation, ou un developpement sur mesure — nous adaptons notre offre a votre infrastructure.') }}</p>

            <div class="demo-feat">
              <div class="demo-feat-ic"><i class="bi bi-cloud-fill"></i></div>
              <div><h5>{{ __('Hebergement cle en main') }}</h5><p>{{ __('Voxa Center preinstalle, maintenu et surveille sur un serveur dedie. Vous n\'avez rien a gerer.') }}</p></div>
            </div>
            <div class="demo-feat">
              <div class="demo-feat-ic"><i class="bi bi-tools"></i></div>
              <div><h5>{{ __('Installation assistee') }}</h5><p>{{ __('Nous installons et configurons Voxa Center sur votre serveur Debian/Ubuntu avec vos trunks SIP.') }}</p></div>
            </div>
            <div class="demo-feat">
              <div class="demo-feat-ic"><i class="bi bi-headset"></i></div>
              <div><h5>{{ __('Support technique') }}</h5><p>{{ __('Suivi mensuel, monitoring, mises a jour de securite, assistance configuration et debug.') }}</p></div>
            </div>
            <div class="demo-feat">
              <div class="demo-feat-ic"><i class="bi bi-cpu-fill"></i></div>
              <div><h5>{{ __('Developpement sur mesure') }}</h5><p>{{ __('Fonctionnalites personnalisees, integrations CRM/ERP, agents IA specifiques a votre metier.') }}</p></div>
            </div>

            <div class="demo-badges">
              <span class="demo-badge"><i class="bi bi-check-circle-fill" style="color:#34d399"></i> {{ __('Sans engagement') }}</span>
              <span class="demo-badge"><i class="bi bi-clock"></i> {{ __('Reponse sous 24h') }}</span>
              <span class="demo-badge"><i class="bi bi-telephone-fill"></i> {{ __('Asterisk 20') }}</span>
              <span class="demo-badge"><i class="bi bi-globe2"></i> voxa.center</span>
            </div>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="demo-right">
            <h4>{{ __('Demander un rendez-vous') }}</h4>
            <p class="sub">{{ __('Remplissez ce formulaire — nous revenons vers vous sous 24h pour planifier votre session.') }}</p>

            <form action="{{ lroute('contact.submit') }}" method="POST" id="contactForm">
              @csrf
              {{-- Honeypot --}}
              <div style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden" aria-hidden="true">
                <input type="text" name="website_url" value="" tabindex="-1" autocomplete="off">
                <input type="text" name="fax_number" value="" tabindex="-1" autocomplete="off">
              </div>
              {{-- Timing --}}
              <input type="hidden" name="_form_token" value="{{ encrypt(time()) }}">

              <div class="row g-3">
                <!-- Nom / Email -->
                <div class="col-sm-6">
                  <div class="fg"><label>{{ __('Prenom & Nom') }} <span class="req">*</span></label>
                  <input type="text" name="name" class="fc" placeholder="{{ __('Jean Dupont') }}" value="{{ old('name') }}" required></div>
                </div>
                <div class="col-sm-6">
                  <div class="fg"><label>{{ __('Email professionnel') }} <span class="req">*</span></label>
                  <input type="email" name="email" class="fc" placeholder="{{ __('jean@societe.fr') }}" value="{{ old('email') }}" required></div>
                </div>

                <!-- Societe / Telephone -->
                <div class="col-sm-6">
                  <div class="fg"><label>{{ __('Societe / Structure') }}</label>
                  <input type="text" name="company" class="fc" placeholder="{{ __('Mon Entreprise SAS') }}" value="{{ old('company') }}"></div>
                </div>
                <div class="col-sm-6">
                  <div class="fg"><label>{{ __('Telephone') }}</label>
                  <input type="tel" name="phone" class="fc" placeholder="+33 6 00 00 00 00" value="{{ old('phone') }}"></div>
                </div>

                <!-- Profil -->
                <div class="col-12">
                  <div class="fg">
                    <label><i class="bi bi-person-badge" style="color:var(--primary)"></i> {{ __('Votre profil') }}</label>
                    <div class="sol-grid">
                      <div class="sol-cb"><input type="radio" name="profile" value="Entreprise / PME" id="p1" @checked(old('profile')=='Entreprise / PME')><label for="p1"><div class="sol-ico"><i class="bi bi-building"></i></div>{{ __('Entreprise / PME') }}</label></div>
                      <div class="sol-cb"><input type="radio" name="profile" value="Call center" id="p2" @checked(old('profile')=='Call center')><label for="p2"><div class="sol-ico"><i class="bi bi-headset"></i></div>{{ __('Call center') }}</label></div>
                      <div class="sol-cb"><input type="radio" name="profile" value="Freelance / Consultant" id="p3" @checked(old('profile')=='Freelance / Consultant')><label for="p3"><div class="sol-ico"><i class="bi bi-person-workspace"></i></div>{{ __('Freelance / Consultant') }}</label></div>
                      <div class="sol-cb"><input type="radio" name="profile" value="Hebergeur / Operateur" id="p4" @checked(old('profile')=='Hebergeur / Operateur')><label for="p4"><div class="sol-ico"><i class="bi bi-hdd-rack"></i></div>{{ __('Hebergeur / Operateur') }}</label></div>
                    </div>
                  </div>
                </div>

                <!-- Interets -->
                <div class="col-12">
                  <div class="fg">
                    <label><i class="bi bi-lightning-charge" style="color:var(--primary)"></i> {{ __('Vous etes interesse par') }}</label>
                    <div class="int-grid">
                      <div class="int-cb"><input type="checkbox" name="interests[]" value="Hebergement cle en main" id="i1" @checked(is_array(old('interests')) && in_array('Hebergement cle en main', old('interests')))><label for="i1"><div class="sol-ico"><i class="bi bi-cloud"></i></div>{{ __('Hebergement') }}</label></div>
                      <div class="int-cb"><input type="checkbox" name="interests[]" value="Installation assistee" id="i2" @checked(is_array(old('interests')) && in_array('Installation assistee', old('interests')))><label for="i2"><div class="sol-ico"><i class="bi bi-tools"></i></div>{{ __('Installation') }}</label></div>
                      <div class="int-cb"><input type="checkbox" name="interests[]" value="Support & Suivi" id="i3" @checked(is_array(old('interests')) && in_array('Support & Suivi', old('interests')))><label for="i3"><div class="sol-ico"><i class="bi bi-headset"></i></div>{{ __('Support') }}</label></div>
                      <div class="int-cb"><input type="checkbox" name="interests[]" value="Developpement sur mesure" id="i4" @checked(is_array(old('interests')) && in_array('Developpement sur mesure', old('interests')))><label for="i4"><div class="sol-ico"><i class="bi bi-cpu"></i></div>{{ __('Dev sur mesure') }}</label></div>
                      <div class="int-cb"><input type="checkbox" name="interests[]" value="Agent IA vocal" id="i5" @checked(is_array(old('interests')) && in_array('Agent IA vocal', old('interests')))><label for="i5"><div class="sol-ico"><i class="bi bi-robot"></i></div>{{ __('Agent IA') }}</label></div>
                      <div class="int-cb"><input type="checkbox" name="interests[]" value="Essai gratuit / Demo" id="i6" @checked(is_array(old('interests')) && in_array('Essai gratuit / Demo', old('interests')))><label for="i6"><div class="sol-ico"><i class="bi bi-play-circle"></i></div>{{ __('Demo / Essai') }}</label></div>
                    </div>
                  </div>
                </div>

                <!-- Date / Creneaux -->
                <div class="col-sm-6">
                  <div class="fg"><label><i class="bi bi-calendar-event" style="color:var(--primary)"></i> {{ __('Date souhaitee') }}</label>
                  <input type="date" name="preferred_date" class="fc" id="slot-date-input" value="{{ old('preferred_date') }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+60 days')) }}"></div>
                </div>
                <div class="col-sm-6">
                  <div class="fg">
                    <label><i class="bi bi-clock" style="color:var(--primary)"></i> {{ __('Creneau horaire') }}</label>
                    <div id="slot-container" class="sol-grid" style="grid-template-columns:1fr 1fr 1fr">
                      <div id="slot-placeholder" style="grid-column:1/-1;text-align:center;color:var(--gray-500);font-size:13px;padding:12px">
                        <i class="bi bi-calendar-event"></i> {{ __('Selectionnez une date pour voir les creneaux') }}
                      </div>
                    </div>
                    <div id="slot-closed" style="display:none;grid-column:1/-1;text-align:center;color:#DC2626;font-size:13px;padding:12px;background:#FEF2F2;border-radius:8px">
                      <i class="bi bi-x-circle"></i> {{ __('Aucun creneau disponible ce jour (ferme)') }}
                    </div>
                    <div id="slot-full" style="display:none;grid-column:1/-1;text-align:center;color:#92400E;font-size:13px;padding:12px;background:#FEF3C7;border-radius:8px">
                      <i class="bi bi-exclamation-circle"></i> {{ __('Tous les creneaux sont pris, choisissez une autre date') }}
                    </div>
                    <div id="slot-loading" style="display:none;grid-column:1/-1;text-align:center;color:var(--gray-500);font-size:13px;padding:12px">
                      <i class="bi bi-hourglass-split"></i> {{ __('Chargement...') }}
                    </div>
                    <div style="font-size:11px;color:var(--gray-500);margin-top:6px"><i class="bi bi-info-circle"></i> {{ __('Fuseau horaire : Paris (CET/CEST) — Lundi au vendredi') }}</div>
                  </div>
                </div>

                <!-- Message -->
                <div class="col-12">
                  <div class="fg"><label>{{ __('Votre besoin en quelques mots') }}</label>
                  <textarea name="message" class="fc" rows="3" placeholder="{{ __('Decrivez brievement votre projet, votre infrastructure actuelle et vos attentes...') }}">{{ old('message') }}</textarea></div>
                </div>

                <!-- Anti-spam -->
                @php $a = rand(2, 9); $b = rand(1, 9); $answer = $a + $b; @endphp
                <div class="col-sm-6">
                  <div class="fg">
                    <label><i class="bi bi-shield-check" style="color:var(--primary)"></i> {{ __('Verification anti-spam') }} <span class="req">*</span></label>
                    <div style="display:flex;align-items:center;gap:10px">
                      <span style="font-weight:700;font-size:16px;color:var(--gray-900);white-space:nowrap">{{ $a }} + {{ $b }} =</span>
                      <input type="number" name="_challenge" class="fc" placeholder="?" required style="max-width:100px" autocomplete="off">
                      <input type="hidden" name="_challenge_hash" value="{{ hash_hmac('sha256', (string) $answer, config('app.key')) }}">
                    </div>
                    @error('_challenge')
                      <div style="color:#DC2626;font-size:12px;margin-top:4px"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <!-- Submit -->
                <div class="col-12">
                  <button type="submit" class="btn-submit">
                    <i class="bi bi-send-fill"></i> {{ __('Envoyer ma demande') }}
                  </button>
                  <p class="form-note">
                    <i class="bi bi-lock-fill"></i>&nbsp; {{ __('Sans engagement · Reponse sous 24h · Vos donnees ne sont jamais partagees') }}
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Success modal
function closeSuccessModal(){
  const o = document.getElementById('successOverlay');
  if(o) o.style.display='none';
}

// Slot loading
(function(){
  const dateInput = document.getElementById('slot-date-input');
  const container = document.getElementById('slot-container');
  const placeholder = document.getElementById('slot-placeholder');
  const closedMsg = document.getElementById('slot-closed');
  const fullMsg = document.getElementById('slot-full');
  const loadingMsg = document.getElementById('slot-loading');
  let counter = 0;

  if (!dateInput) return;

  dateInput.addEventListener('change', async function(){
    const date = this.value;
    if (!date) return;

    const myId = ++counter;
    placeholder.style.display = 'none';
    closedMsg.style.display = 'none';
    fullMsg.style.display = 'none';
    loadingMsg.style.display = 'block';
    container.querySelectorAll('.sol-cb').forEach(el => el.remove());

    try {
      const res = await fetch('/api/available-slots?date=' + encodeURIComponent(date));
      const data = await res.json();
      if (myId !== counter) return;

      loadingMsg.style.display = 'none';

      if (data.closed) {
        closedMsg.style.display = 'block';
        return;
      }

      if (data.slots.length === 0) {
        fullMsg.style.display = 'block';
        return;
      }

      data.slots.forEach(function(slot, i){
        const parts = slot.split('-');
        const label = parts[0].replace(':','h') + ' \u2013 ' + parts[1].replace(':','h');
        const id = 'slot_' + i;
        const div = document.createElement('div');
        div.className = 'sol-cb';
        div.innerHTML = '<input type="radio" name="preferred_time" value="' + slot + '" id="' + id + '"><label for="' + id + '">' + label + '</label>';
        container.appendChild(div);
      });
    } catch(e) {
      if (myId !== counter) return;
      loadingMsg.style.display = 'none';
      placeholder.style.display = 'block';
      placeholder.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Erreur de chargement';
    }
  });

  if (dateInput.value) dateInput.dispatchEvent(new Event('change'));
})();

// Glow effect on load
document.addEventListener('DOMContentLoaded', function(){
  const card = document.getElementById('demo-form');
  if (card && window.location.hash === '#demo') {
    card.classList.add('glow');
    setTimeout(() => card.classList.remove('glow'), 1500);
  }
});
</script>
</body>
</html>
