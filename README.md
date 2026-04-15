# Voxa Center

**Site vitrine & plateforme de gestion pour Voxa Center — Telephonie VoIP & Agent IA**

Voxa Center est le site web commercial et la plateforme d'administration pour le projet open source [SIP.ctrl](https://github.com/grevoka/SIP.ctrl), un PBX Asterisk avec agent IA integre.

## Fonctionnalites

### Site public
- **Landing page** — presentation du produit, fonctionnalites, agent IA, architecture, tarifs, stack technique
- **Animation interactive** — reseau de noeuds Canvas avec effets de pulse et attraction souris
- **Multi-langue** — FR (defaut), EN, ES, DE, PL avec prefixes d'URL automatiques
- **SEO** — balises hreflang, meta tags, URLs localisees
- **Formulaire de contact** — avec protection anti-bot (honeypot, timing, challenge math)
- **Prise de RDV** — selection de creneau horaire via API (jours ouvres, pauses dejeuner)

### Panel d'administration (`/admin`)
- **Dashboard** — statistiques (total, non lues, aujourd'hui), dernieres demandes
- **Demandes de contact** — liste, recherche, filtres, archivage, thread de conversation chiffre (AES-256)
- **Calendrier RDV** — FullCalendar avec vues semaine/jour/mois, replanification
- **Gestion utilisateurs** — creation, suppression, roles (Admin, Partenaire, Editeur)
- **Permissions RBAC** — matrice de permissions par role et section
- **Fichiers partages** — upload, partage entre utilisateurs, streaming video, tracking d'acces
- **Configuration SMTP** — serveur email dynamique avec test integre
- **Horaires** — jours ouvres, heures, duree des creneaux, pause dejeuner
- **Mot de passe** — changement securise
- **Multi-langue admin** — FR/EN avec switch dans la sidebar

### Espace client (`/espace-client`)
- **Setup par token** — lien email pour creer son compte (login genere automatiquement)
- **Dashboard client** — suivi de toutes les demandes avec apercu du dernier message
- **Thread de conversation** — echanges chiffres entre admin et client
- **Replanification** — modification de RDV avec notification email

### Emails transactionnels
- Confirmation de demande de contact (avec lien de setup)
- Notification de replanification de rendez-vous

## Stack technique

| Composant | Version |
|-----------|---------|
| PHP | 8.3+ |
| Laravel | 13 |
| SQLite | 3 |
| Bootstrap | 5.3.3 (admin) |
| FullCalendar | 6.x (calendrier) |
| Bootstrap Icons | 1.11.3 |

## Installation

```bash
git clone <repo-url> voxa.center
cd voxa.center
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### Compte admin par defaut

| Email | Mot de passe |
|-------|-------------|
| `admin@voxa.center` | `admin2024` |

## Developpement

```bash
composer dev
```

Lance en parallele : serveur Laravel, queue worker, logs (pail), et Vite.

## Structure du projet

```
voxa.center/
├── app/
│   ├── Helpers/helpers.php              # lroute() — URLs localisees
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminController.php  # Dashboard, contacts, users, SMTP, calendrier
│   │   │   │   ├── AuthController.php   # Login/logout admin
│   │   │   │   └── FileController.php   # Upload, partage, streaming
│   │   │   ├── ClientAuthController.php # Espace client (setup, login, conversation)
│   │   │   └── PageController.php       # Pages publiques, formulaire contact
│   │   └── Middleware/
│   │       ├── CheckSection.php         # Verification RBAC par section
│   │       ├── SetAdminLocale.php       # Langue admin (preference utilisateur)
│   │       ├── SetClientLocale.php      # Langue client (preference client)
│   │       └── SetLocale.php            # Langue frontend (prefixe URL)
│   ├── Mail/
│   │   ├── AppointmentRescheduled.php
│   │   └── ContactConfirmation.php
│   ├── Models/
│   │   ├── Appointment.php              # RDV avec scope confirmed()
│   │   ├── Client.php                   # Auth client, generateLogin()
│   │   ├── Contact.php                  # Demandes avec scopes active/archived
│   │   ├── ContactMessage.php           # Messages chiffres AES-256
│   │   ├── File.php                     # Fichiers avec humanSize(), iconClass()
│   │   ├── FileActivity.php             # Tracking download/stream/preview
│   │   ├── RolePermission.php           # RBAC par section
│   │   ├── Setting.php                  # Key-value avec cache
│   │   └── User.php                     # Roles admin/partner/editor
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── MailConfigProvider.php       # SMTP dynamique depuis la BDD
├── database/
│   ├── migrations/                      # 13 migrations
│   └── seeders/
│       ├── AdminSeeder.php              # Compte admin@voxa.center
│       └── DatabaseSeeder.php
├── lang/
│   ├── fr.json                          # Traductions francais
│   └── en.json                          # Traductions anglais
├── resources/views/
│   ├── admin/                           # 13 vues admin
│   ├── client/                          # 4 vues espace client
│   ├── emails/                          # 2 templates email
│   ├── layouts/
│   │   ├── admin.blade.php              # Layout admin (sidebar RBAC)
│   │   └── app.blade.php               # Layout public (hreflang)
│   └── pages/
│       ├── home.blade.php               # Landing page (depuis index-6.html)
│       ├── fonctionnalites.blade.php
│       ├── tarifs.blade.php
│       ├── contact.blade.php
│       └── legal/                       # CGU, CGV, Confidentialite
├── routes/web.php                       # 66 routes (admin, client, public, i18n)
├── config/auth.php                      # Double guard (web + client)
└── index-6.html                         # Template original de la landing page
```

## Routes principales

| URL | Description |
|-----|-------------|
| `/` | Landing page |
| `/fonctionnalites` | Page fonctionnalites |
| `/tarifs` | Page tarifs |
| `/nous-contacter` | Page contact |
| `/admin/login` | Connexion admin |
| `/admin` | Dashboard admin |
| `/admin/contacts` | Gestion des demandes |
| `/admin/users` | Gestion utilisateurs |
| `/admin/files` | Fichiers partages |
| `/admin/calendar` | Calendrier RDV |
| `/admin/smtp` | Configuration SMTP |
| `/espace-client/login` | Connexion client |
| `/espace-client` | Dashboard client |
| `/en/`, `/es/`, `/de/`, `/pl/` | Versions localisees |

## Securite

- Messages de conversation chiffres (AES-256 via Laravel Crypt)
- Protection anti-bot (honeypot + timing + challenge math)
- RBAC granulaire par section
- Double systeme d'authentification (admin / client)
- Tokens de setup avec expiration (72h)

## Licence

Ce projet est distribue sous licence **GPL-3.0**.
