@extends('layouts.app')
@section('title', 'Conditions Generales d\'Utilisation — Voxa Center')

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
  <h1>Conditions Generales d'Utilisation</h1>
  <p class="updated">Derniere mise a jour : {{ date('d/m/Y') }}</p>

  <div class="legal-info">
    <p><strong>Editeur du site :</strong> D4.FR — SAS au capital de 4 000,00 &euro;</p>
    <p><strong>SIREN :</strong> 801 303 496</p>
    <p><strong>SIRET (siege) :</strong> 801 303 496 00013</p>
    <p><strong>RCS :</strong> 801 303 496 R.C.S. Paris</p>
    <p><strong>N&deg; TVA :</strong> FR46801303496</p>
    <p><strong>Site web :</strong> <a href="https://d4.fr" target="_blank">https://d4.fr</a></p>
  </div>

  <h2>Article 1 — Objet</h2>
  <p>Les presentes Conditions Generales d'Utilisation (ci-apres « CGU ») ont pour objet de definir les modalites et conditions dans lesquelles la societe D4.FR (ci-apres « l'Editeur ») met a disposition le site internet <strong>voxa.center</strong> (ci-apres « le Site ») et le logiciel Voxa Center (ci-apres « le Logiciel »), ainsi que les conditions dans lesquelles l'utilisateur (ci-apres « l'Utilisateur ») accede au Site et utilise ses services.</p>
  <p>L'acces au Site implique l'acceptation sans reserve des presentes CGU.</p>

  <h2>Article 2 — Description du service</h2>
  <p>Voxa Center est une plateforme open source de gestion de telephonie VoIP propulsee par Asterisk, avec agent IA integre. Le Site permet de :</p>
  <ul>
    <li>Presenter les fonctionnalites du Logiciel</li>
    <li>Demander un rendez-vous ou un devis</li>
    <li>Acceder a un espace client pour suivre ses demandes</li>
    <li>Souscrire a des services professionnels (hebergement, support, installation, developpement sur mesure)</li>
  </ul>

  <h2>Article 3 — Acces au site</h2>
  <p>Le Site est accessible gratuitement a tout Utilisateur disposant d'un acces internet. Tous les couts afferents a l'acces au Site, que ce soient les frais materiels, logiciels ou d'acces internet sont exclusivement a la charge de l'Utilisateur.</p>
  <p>L'Editeur met en oeuvre tous les moyens raisonnables a sa disposition pour assurer un acces de qualite au Site, mais n'est tenu a aucune obligation d'y parvenir.</p>
  <p>L'Editeur se reserve le droit de restreindre l'acces au Site ou a certaines parties, sans preavis, sans indemnite et sans que cela puisse engager sa responsabilite.</p>

  <h2>Article 4 — Logiciel open source</h2>
  <p>Le Logiciel Voxa Center est distribue sous licence <strong>GNU General Public License v3.0</strong> (GPL-3.0). L'Utilisateur est libre de :</p>
  <ul>
    <li>Utiliser, copier et distribuer le Logiciel</li>
    <li>Modifier le code source et distribuer ses modifications</li>
    <li>Utiliser le Logiciel a des fins commerciales</li>
  </ul>
  <p>Sous condition que toute distribution inclut le code source, que les travaux derives soient distribues sous la meme licence GPL-3.0, et que les mentions de copyright soient conservees.</p>

  <h2>Article 5 — Espace client</h2>
  <p>L'acces a l'Espace Client est reserve aux Utilisateurs ayant soumis une demande de contact et ayant configure leur compte via le lien recu par email. L'Utilisateur est responsable de la confidentialite de ses identifiants de connexion.</p>
  <p>Toute utilisation des identifiants est presumee etre celle de l'Utilisateur. En cas de perte ou d'utilisation non autorisee de ses identifiants, l'Utilisateur doit en informer immediatement l'Editeur.</p>

  <h2>Article 6 — Propriete intellectuelle</h2>
  <p>Le contenu du Site (textes, images, graphismes, logo, icones, design) est la propriete de D4.FR ou de ses partenaires et est protege par les lois francaises et internationales relatives a la propriete intellectuelle.</p>
  <p>Toute reproduction, representation, modification, publication, transmission ou denaturation, totale ou partielle, du Site ou de son contenu, par quelque procede que ce soit, et sur quelque support que ce soit, est interdite sans l'autorisation ecrite prealable de D4.FR.</p>

  <h2>Article 7 — Responsabilite</h2>
  <p>L'Editeur s'efforce de fournir des informations aussi precises que possible sur le Site. Toutefois, il ne pourra etre tenu responsable des omissions, inexactitudes et carences dans la mise a jour, qu'elles soient de son fait ou du fait des tiers partenaires qui lui fournissent ces informations.</p>
  <p>L'Editeur ne saurait etre tenu responsable des dommages directs ou indirects causes au materiel de l'Utilisateur lors de l'acces au Site.</p>

  <h2>Article 8 — Liens hypertextes</h2>
  <p>Le Site peut contenir des liens hypertextes vers d'autres sites internet. L'Editeur ne dispose d'aucun moyen de controle du contenu de ces sites tiers et n'assume aucune responsabilite de ce fait.</p>

  <h2>Article 9 — Cookies</h2>
  <p>Le Site utilise des cookies techniques strictement necessaires au fonctionnement du service (session, preferences de langue, jeton CSRF). Ces cookies ne collectent aucune donnee personnelle a des fins de suivi ou de publicite.</p>
  <p>Aucun cookie tiers, analytique ou publicitaire n'est utilise. L'Utilisateur peut configurer son navigateur pour refuser les cookies, mais certaines fonctionnalites du Site pourraient en etre affectees.</p>
  <p>Pour plus d'informations sur les cookies, consultez notre <a href="/politique-de-confidentialite">Politique de confidentialite</a>.</p>

  <h2>Article 10 — Droit applicable et juridiction</h2>
  <p>Les presentes CGU sont regies par le droit francais. En cas de litige, et apres tentative de resolution amiable, les tribunaux competents de Paris seront seuls competents.</p>

  <h2>Article 11 — Contact</h2>
  <p>Pour toute question relative aux presentes CGU, vous pouvez nous contacter :</p>
  <ul>
    <li>Via le formulaire de contact : <a href="/nous-contacter">voxa.center/nous-contacter</a></li>
    <li>Par le site de l'editeur : <a href="https://d4.fr" target="_blank">https://d4.fr</a></li>
  </ul>
</div>
@endsection
