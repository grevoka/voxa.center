@extends('layouts.app')
@section('title', 'Conditions Generales de Vente — Voxa Center')

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
.legal-wrap p,.legal-wrap li{font-size:15px;line-height:1.8;color:#475569;margin-bottom:12px}
.legal-wrap ul{padding-left:20px;margin-bottom:16px}
.legal-wrap a{color:#6d28d9;text-decoration:none;font-weight:600}
.legal-wrap a:hover{text-decoration:underline}
.legal-info{background:#f1f5f9;border:1px solid #e2e8f0;border-radius:12px;padding:24px;margin-bottom:32px}
.legal-info p{margin-bottom:4px;font-size:14px}
.legal-info strong{color:#0f172a}
table.price-table{width:100%;border-collapse:collapse;margin:16px 0 24px;font-size:14px}
table.price-table th{background:#f1f5f9;padding:10px 14px;text-align:left;font-weight:700;font-size:13px;color:#334155;border:1px solid #e2e8f0}
table.price-table td{padding:10px 14px;border:1px solid #e2e8f0;color:#475569}
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
  <h1>Conditions Generales de Vente</h1>
  <p class="updated">Derniere mise a jour : {{ date('d/m/Y') }}</p>

  <div class="legal-info">
    <p><strong>Vendeur :</strong> D4.FR — SAS au capital de 4 000,00 &euro;</p>
    <p><strong>SIREN :</strong> 801 303 496</p>
    <p><strong>SIRET (siege) :</strong> 801 303 496 00013</p>
    <p><strong>RCS :</strong> 801 303 496 R.C.S. Paris</p>
    <p><strong>N&deg; TVA :</strong> FR46801303496</p>
    <p><strong>Site web :</strong> <a href="https://d4.fr" target="_blank">https://d4.fr</a></p>
  </div>

  <h2>Article 1 — Objet</h2>
  <p>Les presentes Conditions Generales de Vente (ci-apres « CGV ») regissent les relations contractuelles entre la societe D4.FR (ci-apres « le Prestataire ») et toute personne physique ou morale (ci-apres « le Client ») souscrivant aux services professionnels proposes sur le site <strong>voxa.center</strong>.</p>
  <p>Toute commande implique l'acceptation sans reserve des presentes CGV.</p>

  <h2>Article 2 — Services proposes</h2>
  <p>Le Prestataire propose les services professionnels suivants autour du logiciel open source Voxa Center :</p>

  <table class="price-table">
    <thead>
      <tr><th>Service</th><th>Tarif HT</th><th>Type</th></tr>
    </thead>
    <tbody>
      <tr><td>Hebergement cle en main</td><td>A partir de 29,90 &euro; / mois</td><td>Abonnement mensuel</td></tr>
      <tr><td>Support & Suivi</td><td>A partir de 250 &euro; / mois</td><td>Abonnement mensuel</td></tr>
      <tr><td>Aide a l'installation</td><td>A partir de 299 &euro;</td><td>Prestation unique</td></tr>
      <tr><td>Developpement sur mesure</td><td>Sur devis</td><td>Prestation ponctuelle</td></tr>
    </tbody>
  </table>

  <p>Le logiciel Voxa Center en lui-meme est gratuit et open source (licence GPL-3.0). Les services ci-dessus constituent des prestations de service complementaires.</p>

  <h2>Article 3 — Devis et commande</h2>
  <p>Toute commande est precedee d'un echange via le formulaire de contact ou par email. Le Prestataire adresse un devis detaille au Client. La commande est consideree comme ferme et definitive apres acceptation ecrite du devis par le Client (email, signature electronique ou bon de commande).</p>

  <h2>Article 4 — Tarifs</h2>
  <p>Les tarifs sont indiques en euros hors taxes (HT). La TVA applicable est celle en vigueur au jour de la facturation (20% pour les clients francais). Les tarifs peuvent etre revises a tout moment ; les services en cours restent au tarif convenu.</p>

  <h2>Article 5 — Conditions de paiement</h2>
  <ul>
    <li><strong>Prestations uniques</strong> (installation, developpement) — 50% a la commande, 50% a la livraison</li>
    <li><strong>Abonnements</strong> (hebergement, support) — paiement mensuel, d'avance, par virement ou prelevement</li>
  </ul>
  <p>En cas de retard de paiement, des penalites de retard seront appliquees au taux de 3 fois le taux d'interet legal en vigueur, ainsi qu'une indemnite forfaitaire de recouvrement de 40 euros conformement aux articles L.441-10 et D.441-5 du Code de commerce.</p>

  <h2>Article 6 — Duree et resiliation</h2>
  <ul>
    <li><strong>Abonnements</strong> — engagement minimum de 1 mois, resiliation possible a tout moment avec un preavis de 30 jours</li>
    <li><strong>Prestations uniques</strong> — le contrat prend fin a la livraison et au paiement integraldu solde</li>
  </ul>
  <p>En cas de manquement grave de l'une des parties a ses obligations, l'autre partie pourra resilier le contrat de plein droit, 15 jours apres mise en demeure restee sans effet.</p>

  <h2>Article 7 — Obligations du Prestataire</h2>
  <p>Le Prestataire s'engage a :</p>
  <ul>
    <li>Fournir les services avec diligence et professionnalisme</li>
    <li>Assurer la disponibilite des services d'hebergement a hauteur de 99,9% (hors maintenance planifiee)</li>
    <li>Effectuer les sauvegardes regulieres des donnees hebergees</li>
    <li>Informer le Client de toute maintenance planifiee avec un preavis raisonnable</li>
    <li>Assurer la confidentialite des donnees du Client</li>
  </ul>

  <h2>Article 8 — Obligations du Client</h2>
  <p>Le Client s'engage a :</p>
  <ul>
    <li>Fournir les informations et acces necessaires a la bonne realisation des prestations</li>
    <li>Regler les factures dans les delais convenus</li>
    <li>Respecter les conditions d'utilisation du logiciel et de l'infrastructure mise a disposition</li>
    <li>Ne pas utiliser les services a des fins illicites</li>
  </ul>

  <h2>Article 9 — Responsabilite</h2>
  <p>La responsabilite du Prestataire est limitee au montant des sommes effectivement percues au titre du contrat au cours des 12 derniers mois. Le Prestataire ne saurait etre tenu responsable des dommages indirects (perte de chiffre d'affaires, perte de donnees, atteinte a l'image).</p>
  <p>Le Prestataire n'est pas responsable des dysfonctionnements lies a l'infrastructure du Client, aux operateurs SIP tiers, ou a la plateforme OpenAI.</p>

  <h2>Article 10 — Force majeure</h2>
  <p>Aucune des parties ne sera tenue responsable d'un manquement a ses obligations contractuelles si ce manquement resulte d'un cas de force majeure au sens de l'article 1218 du Code civil.</p>

  <h2>Article 11 — Droit de retractation</h2>
  <p>Conformement a l'article L.221-28 du Code de la consommation, le droit de retractation ne s'applique pas aux prestations de services pleinement executees avant la fin du delai de retractation, ni aux contenus numeriques fournis sur un support immateriel dont l'execution a commence avec l'accord du consommateur.</p>
  <p>Pour les services non encore executes, le Client professionnel dispose d'un delai de retractation de 14 jours a compter de la signature du devis.</p>

  <h2>Article 12 — Protection des donnees</h2>
  <p>Le Prestataire s'engage a traiter les donnees personnelles du Client conformement au RGPD. Pour plus de details, consultez notre <a href="/politique-de-confidentialite">Politique de confidentialite</a>.</p>

  <h2>Article 13 — Droit applicable et litiges</h2>
  <p>Les presentes CGV sont soumises au droit francais. En cas de litige, les parties s'efforceront de trouver une solution amiable. A defaut, les tribunaux competents de Paris seront seuls competents.</p>

  <h2>Article 14 — Contact</h2>
  <p>Pour toute question relative aux presentes CGV :</p>
  <ul>
    <li>Formulaire de contact : <a href="/nous-contacter">voxa.center/nous-contacter</a></li>
    <li>Site de l'editeur : <a href="https://d4.fr" target="_blank">https://d4.fr</a></li>
  </ul>
</div>
@endsection
