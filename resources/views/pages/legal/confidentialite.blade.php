@extends('layouts.app')
@section('title', 'Politique de confidentialite — Voxa Center')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
body{font-family:'Plus Jakarta Sans',sans-serif;color:#1e293b;background:#f8fafc}
.legal-nav{position:sticky;top:0;z-index:100;padding:14px 0;background:rgba(255,255,255,.9);backdrop-filter:blur(16px);border-bottom:1px solid #e2e8f0}
.legal-nav-inner{max-width:800px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between}
.legal-nav a.brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:18px;color:#0f172a;text-decoration:none}
.legal-nav a.brand img{width:32px;height:32px;border-radius:8px}
.legal-nav a.back{font-size:13px;font-weight:600;color:#64748b;text-decoration:none;display:flex;align-items:center;gap:4px}
.legal-wrap{max-width:800px;margin:0 auto;padding:60px 24px 80px}
.legal-wrap h1{font-size:32px;font-weight:800;letter-spacing:-.5px;margin-bottom:8px}
.legal-wrap .updated{font-size:13px;color:#64748b;margin-bottom:40px}
.legal-wrap h2{font-size:20px;font-weight:700;margin:40px 0 12px;color:#0f172a}
.legal-wrap h3{font-size:16px;font-weight:700;margin:24px 0 8px;color:#334155}
.legal-wrap p,.legal-wrap li{font-size:15px;line-height:1.8;color:#475569;margin-bottom:12px}
.legal-wrap ul{padding-left:20px;margin-bottom:16px}
.legal-wrap a{color:#6d28d9;text-decoration:none;font-weight:600}
.legal-wrap a:hover{text-decoration:underline}
.legal-info{background:#f1f5f9;border:1px solid #e2e8f0;border-radius:12px;padding:24px;margin-bottom:32px}
.legal-info p{margin-bottom:4px;font-size:14px}
.legal-info strong{color:#0f172a}
table.cookie-table{width:100%;border-collapse:collapse;margin:16px 0 24px;font-size:14px}
table.cookie-table th{background:#f1f5f9;padding:10px 14px;text-align:left;font-weight:700;font-size:13px;color:#334155;border:1px solid #e2e8f0}
table.cookie-table td{padding:10px 14px;border:1px solid #e2e8f0;color:#475569}
</style>
@endpush

@section('content')
<nav class="legal-nav">
  <div class="legal-nav-inner">
    <a href="/" class="brand"><img src="/images/logo.png" alt="Voxa Center"> Voxa Center</a>
    <a href="/" class="back">&larr; Retour au site</a>
  </div>
</nav>

<div class="legal-wrap">
  <h1>Politique de confidentialite</h1>
  <p class="updated">Derniere mise a jour : {{ date('d/m/Y') }}</p>

  <div class="legal-info">
    <p><strong>Responsable du traitement :</strong> D4.FR — SAS au capital de 4 000,00 &euro;</p>
    <p><strong>SIREN :</strong> 801 303 496</p>
    <p><strong>SIRET (siege) :</strong> 801 303 496 00013</p>
    <p><strong>RCS :</strong> 801 303 496 R.C.S. Paris</p>
    <p><strong>N&deg; TVA :</strong> FR46801303496</p>
    <p><strong>Site web :</strong> <a href="https://d4.fr" target="_blank">https://d4.fr</a></p>
  </div>

  <h2>1. Introduction</h2>
  <p>La societe D4.FR (ci-apres « nous ») s'engage a proteger la vie privee des utilisateurs du site <strong>voxa.center</strong> (ci-apres « le Site »). La presente politique de confidentialite decrit les types de donnees personnelles que nous collectons, comment nous les utilisons, les conservons et les protegeons, conformement au Reglement General sur la Protection des Donnees (RGPD) et a la loi Informatique et Libertes.</p>

  <h2>2. Donnees collectees</h2>
  <h3>2.1 Formulaire de contact</h3>
  <p>Lorsque vous soumettez le formulaire de contact ou de prise de rendez-vous, nous collectons :</p>
  <ul>
    <li>Nom et prenom</li>
    <li>Adresse email</li>
    <li>Numero de telephone (facultatif)</li>
    <li>Nom de la societe (facultatif)</li>
    <li>Profil professionnel (facultatif)</li>
    <li>Centres d'interet selectionnes</li>
    <li>Message libre (facultatif)</li>
    <li>Date et creneau horaire souhaites (facultatif)</li>
  </ul>

  <h3>2.2 Espace client</h3>
  <p>Si vous creez un compte client, nous conservons egalement :</p>
  <ul>
    <li>Identifiant de connexion (genere automatiquement)</li>
    <li>Mot de passe (stocke sous forme de hash irreversible)</li>
    <li>Messages echanges avec notre equipe (chiffres AES-256)</li>
  </ul>

  <h3>2.3 Donnees techniques</h3>
  <p>Nous ne collectons aucune donnee de navigation, adresse IP, ou traceur analytique. Aucun outil de tracking tiers (Google Analytics, Facebook Pixel, etc.) n'est utilise sur le Site.</p>

  <h2>3. Finalites du traitement</h2>
  <p>Vos donnees personnelles sont collectees pour les finalites suivantes :</p>
  <ul>
    <li><strong>Gestion des demandes de contact</strong> — repondre a votre demande, planifier un rendez-vous</li>
    <li><strong>Espace client</strong> — vous permettre de suivre vos demandes et echanger avec notre equipe</li>
    <li><strong>Communication</strong> — vous envoyer un email de confirmation et des notifications relatives a vos rendez-vous</li>
  </ul>
  <p>Vos donnees ne sont <strong>jamais</strong> utilisees a des fins de prospection commerciale non sollicitee, de profilage, ou revendues a des tiers.</p>

  <h2>4. Base legale du traitement</h2>
  <ul>
    <li><strong>Consentement</strong> (article 6.1.a du RGPD) — lorsque vous soumettez le formulaire de contact</li>
    <li><strong>Execution d'un contrat</strong> (article 6.1.b) — lorsque vous utilisez l'espace client dans le cadre d'une prestation</li>
    <li><strong>Interet legitime</strong> (article 6.1.f) — pour assurer la securite du Site (protection anti-spam)</li>
  </ul>

  <h2>5. Duree de conservation</h2>
  <ul>
    <li><strong>Demandes de contact</strong> — conservees 24 mois apres le dernier echange, puis archivees ou supprimees</li>
    <li><strong>Comptes clients</strong> — conserves pendant la duree de la relation commerciale, puis 3 ans apres le dernier contact</li>
    <li><strong>Messages chiffres</strong> — conserves pendant la duree de la relation, puis supprimes avec le compte</li>
  </ul>

  <h2>6. Destinataires des donnees</h2>
  <p>Vos donnees sont accessibles uniquement :</p>
  <ul>
    <li>A l'equipe D4.FR habilitee a traiter les demandes (administrateurs, partenaires autorises)</li>
    <li>A notre hebergeur (pour le stockage technique)</li>
  </ul>
  <p>Aucune donnee n'est transferee en dehors de l'Union europeenne.</p>

  <h2>7. Securite des donnees</h2>
  <p>Nous mettons en oeuvre les mesures techniques et organisationnelles suivantes :</p>
  <ul>
    <li>Chiffrement des messages (AES-256 via Laravel Crypt)</li>
    <li>Mots de passe hashes (bcrypt)</li>
    <li>Connexions HTTPS (TLS)</li>
    <li>Protection anti-spam (honeypot, timing, challenge mathematique)</li>
    <li>Controle d'acces par roles (RBAC)</li>
    <li>Tokens de session securises</li>
  </ul>

  <h2>8. Cookies</h2>
  <p>Le Site utilise exclusivement des <strong>cookies techniques</strong> strictement necessaires au fonctionnement du service :</p>

  <table class="cookie-table">
    <thead>
      <tr><th>Cookie</th><th>Finalite</th><th>Duree</th></tr>
    </thead>
    <tbody>
      <tr><td><code>laravel_session</code></td><td>Session utilisateur (authentification, jeton CSRF)</td><td>2 heures</td></tr>
      <tr><td><code>XSRF-TOKEN</code></td><td>Protection contre les attaques CSRF</td><td>2 heures</td></tr>
      <tr><td><code>remember_web_*</code></td><td>Connexion persistante (si « Se souvenir de moi »)</td><td>30 jours</td></tr>
      <tr><td><code>voxa_cookie_consent</code></td><td>Enregistre votre choix d'acceptation des cookies</td><td>12 mois</td></tr>
    </tbody>
  </table>

  <p><strong>Aucun cookie tiers, analytique ou publicitaire n'est utilise.</strong> Les cookies techniques sont exempts de consentement selon les recommandations de la CNIL (deliberation n&deg; 2020-091).</p>
  <p>Vous pouvez a tout moment configurer votre navigateur pour refuser les cookies. Cependant, le refus des cookies techniques peut empecher l'utilisation de certaines fonctionnalites (connexion, formulaire).</p>

  <h2>9. Vos droits</h2>
  <p>Conformement au RGPD, vous disposez des droits suivants :</p>
  <ul>
    <li><strong>Droit d'acces</strong> — obtenir la confirmation que vos donnees sont traitees et en obtenir une copie</li>
    <li><strong>Droit de rectification</strong> — faire corriger vos donnees inexactes ou incompletes</li>
    <li><strong>Droit a l'effacement</strong> — demander la suppression de vos donnees</li>
    <li><strong>Droit a la limitation</strong> — demander la limitation du traitement dans certains cas</li>
    <li><strong>Droit a la portabilite</strong> — recevoir vos donnees dans un format structure et lisible</li>
    <li><strong>Droit d'opposition</strong> — vous opposer au traitement de vos donnees</li>
  </ul>
  <p>Pour exercer vos droits, contactez-nous via le <a href="/nous-contacter">formulaire de contact</a> ou par le site <a href="https://d4.fr" target="_blank">https://d4.fr</a>.</p>
  <p>Vous disposez egalement du droit d'introduire une reclamation aupres de la <strong>CNIL</strong> (Commission Nationale de l'Informatique et des Libertes) — <a href="https://www.cnil.fr" target="_blank">www.cnil.fr</a>.</p>

  <h2>10. Modifications</h2>
  <p>Nous nous reservons le droit de modifier la presente politique de confidentialite a tout moment. Les modifications prennent effet des leur publication sur le Site. Nous vous invitons a consulter regulierement cette page.</p>

  <h2>11. Contact</h2>
  <p>Pour toute question relative a la protection de vos donnees :</p>
  <ul>
    <li>Formulaire de contact : <a href="/nous-contacter">voxa.center/nous-contacter</a></li>
    <li>Site de l'editeur : <a href="https://d4.fr" target="_blank">https://d4.fr</a></li>
  </ul>
</div>
@endsection
