<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', __('Administration')) &mdash; Voxa Center</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--navy:#1e293b;--navy-dk:#0f172a;--cyan:#3b82f6;--mid:#2563eb;--lav:#94a3b8;--lav-sub:#eff6ff;--lav-bdr:#bfdbfe;--border:#e2e8f0;--bg:#f8fafc;--slate:#64748b;--ink:#0f172a;--ink3:#334155;--font:'Plus Jakarta Sans',sans-serif;--mono:'Fira Code',monospace}
*{box-sizing:border-box}
body{font-family:var(--font);color:var(--ink);background:var(--bg);-webkit-font-smoothing:antialiased;margin:0}
.admin-sidebar{width:240px;background:var(--navy-dk);min-height:100vh;position:fixed;top:0;left:0;display:flex;flex-direction:column;z-index:50}
.admin-sidebar .brand{padding:20px 20px 16px;border-bottom:1px solid rgba(59,130,246,.1)}
.admin-sidebar .brand a{font-family:var(--font);font-weight:800;font-size:20px;color:#fff;text-decoration:none;letter-spacing:-.04em;display:flex;align-items:center;gap:10px}
.admin-sidebar .brand a .brand-icon{width:32px;height:32px;background:var(--cyan);border-radius:8px;display:grid;place-items:center}
.admin-sidebar .brand small{display:block;font-size:11px;color:var(--lav);margin-top:4px;font-weight:500}
.admin-nav{padding:16px 10px;flex:1}
.admin-nav a{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:8px;color:var(--lav);text-decoration:none;font-size:14px;font-weight:500;transition:all .15s;margin-bottom:2px}
.admin-nav a:hover{background:rgba(59,130,246,.1);color:#fff}
.admin-nav a.active{background:rgba(59,130,246,.15);color:#fff;font-weight:600}
.admin-nav a i{font-size:16px;width:20px;text-align:center}
.admin-nav .badge-count{margin-left:auto;background:var(--cyan);color:#fff;font-size:11px;font-weight:700;padding:1px 8px;border-radius:100px}
.admin-footer{padding:16px 20px;border-top:1px solid rgba(59,130,246,.1)}
.admin-footer .user-info{font-size:13px;color:var(--lav);font-weight:500}
.admin-main{margin-left:240px;padding:32px 40px;min-height:100vh}
.admin-header{margin-bottom:32px}
.admin-header h1{font-family:var(--font);font-size:28px;font-weight:800;color:var(--navy);letter-spacing:-.02em;margin:0}
.admin-header p{font-size:14px;color:var(--slate);margin:4px 0 0}
.card-stat{background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:24px;transition:all .15s}
.card-stat:hover{border-color:var(--lav-bdr);box-shadow:0 4px 16px rgba(37,99,235,.06)}
.card-stat .num{font-family:var(--mono);font-size:36px;font-weight:700;line-height:1;margin-bottom:4px}
.card-stat .label{font-size:13px;color:var(--slate);font-weight:500}
.table-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;overflow:hidden}
.table-card .header{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border)}
.table-card .header h3{font-size:16px;font-weight:700;color:var(--navy);margin:0}
.table-card table{width:100%;border-collapse:collapse}
.table-card table th{padding:10px 20px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--slate);background:var(--bg);border-bottom:1px solid var(--border);text-align:left}
.table-card table td{padding:12px 20px;border-bottom:1px solid #F1F5F9;font-size:14px;vertical-align:middle}
.table-card table tr:last-child td{border-bottom:none}
.table-card table tr:hover td{background:#FAFBFE}
.badge-unread{background:#FEF2F2;color:#DC2626;font-size:11px;font-weight:700;padding:2px 8px;border-radius:100px}
.badge-read{background:#F0FDF4;color:#16A34A;font-size:11px;font-weight:700;padding:2px 8px;border-radius:100px}
.btn-admin{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:all .15s;text-decoration:none}
.btn-admin.primary{background:var(--mid);color:#fff}.btn-admin.primary:hover{background:#1d4ed8}
.btn-admin.danger{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA}.btn-admin.danger:hover{background:#FEE2E2}
.btn-admin.outline{background:#fff;color:var(--navy);border:1.5px solid var(--border)}.btn-admin.outline:hover{border-color:var(--lav-bdr)}
.search-box{display:flex;align-items:center;gap:8px;background:#fff;border:1.5px solid var(--border);border-radius:10px;padding:8px 14px;width:300px}
.search-box input{border:none;outline:none;font-family:var(--font);font-size:14px;color:var(--ink);width:100%;background:transparent}
.search-box i{color:var(--slate);font-size:14px}
.detail-card{background:#fff;border:1.5px solid var(--border);border-radius:16px;padding:32px}
.detail-row{display:flex;gap:8px;padding:12px 0;border-bottom:1px solid #F1F5F9}
.detail-row:last-child{border-bottom:none}
.detail-label{font-size:13px;font-weight:600;color:var(--slate);min-width:180px;flex-shrink:0}
.detail-value{font-size:14px;color:var(--ink)}
.interest-tag{display:inline-flex;align-items:center;gap:4px;background:var(--lav-sub);border:1px solid var(--lav-bdr);border-radius:6px;padding:3px 10px;font-size:12px;font-weight:600;color:var(--mid);margin-right:4px;margin-bottom:4px}
.alert-success{background:#ECFDF5;border:1.5px solid #A7F3D0;border-radius:10px;padding:12px 20px;color:#059669;font-weight:600;font-size:14px;margin-bottom:20px}
@stack('styles')
</style>
</head>
<body>
<aside class="admin-sidebar">
  <div class="brand">
    <a href="{{ route('admin.dashboard') }}">
      <img src="/images/logo.png" alt="Voxa Center" style="width:32px;height:32px;border-radius:8px;">
      Voxa Center
    </a>
    <small>{{ __('Administration') }}</small>
  </div>
  @php $userRole = Auth::user()->role; @endphp
  <nav class="admin-nav">
    @if(\App\Models\RolePermission::hasAccess($userRole, 'dashboard'))
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-grid-1x2-fill"></i> {{ __('Dashboard') }}
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'analytics'))
    <a href="{{ route('admin.analytics') }}" class="{{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
      <i class="bi bi-graph-up"></i> {{ __('Analytics') }}
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'contacts'))
    <a href="{{ route('admin.contacts') }}" class="{{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
      <i class="bi bi-envelope-fill"></i> {{ __('Contact requests') }}
      @php $unreadCount = \App\Models\Contact::active()->where('read', false)->count(); @endphp
      @if($unreadCount > 0)
        <span class="badge-count">{{ $unreadCount }}</span>
      @endif
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'users'))
    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
      <i class="bi bi-people-fill"></i> {{ __('Users') }}
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'files'))
    <a href="{{ route('admin.files') }}" class="{{ request()->routeIs('admin.files*') ? 'active' : '' }}">
      <i class="bi bi-folder2-open"></i> {{ __('Shared files') }}
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'calendar'))
    <a href="{{ route('admin.calendar') }}" class="{{ request()->routeIs('admin.calendar*') ? 'active' : '' }}">
      <i class="bi bi-calendar3"></i> {{ __('Appointment calendar') }}
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'schedule'))
    <a href="{{ route('admin.schedule') }}" class="{{ request()->routeIs('admin.schedule*') ? 'active' : '' }}">
      <i class="bi bi-clock-history"></i> {{ __('Schedule') }}
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'smtp'))
    <a href="{{ route('admin.smtp') }}" class="{{ request()->routeIs('admin.smtp*') ? 'active' : '' }}">
      <i class="bi bi-envelope-at-fill"></i> {{ __('SMTP Server') }}
    </a>
    @endif
    @if(\App\Models\RolePermission::hasAccess($userRole, 'password'))
    <a href="{{ route('admin.password') }}" class="{{ request()->routeIs('admin.password*') ? 'active' : '' }}">
      <i class="bi bi-key-fill"></i> {{ __('My password') }}
    </a>
    @endif
  </nav>
  <div class="admin-footer">
    <div class="user-info">
      <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
    </div>
    <form action="{{ route('admin.locale.update') }}" method="POST" class="mt-2">
      @csrf
      @method('PUT')
      <select name="locale" onchange="this.form.submit()" style="width:100%;background:rgba(59,130,246,.08);border:1px solid rgba(59,130,246,.15);border-radius:8px;padding:6px 10px;font-size:12px;font-family:var(--font);color:var(--lav);cursor:pointer;outline:none">
        <option value="fr" {{ Auth::user()->locale === 'fr' ? 'selected' : '' }}>&#127467;&#127479; Fran&ccedil;ais</option>
        <option value="en" {{ Auth::user()->locale === 'en' ? 'selected' : '' }}>&#127468;&#127463; English</option>
      </select>
    </form>
    <form action="{{ route('admin.logout') }}" method="POST" class="mt-2">
      @csrf
      <button type="submit" class="btn-admin outline" style="width:100%;justify-content:center;font-size:12px;padding:6px 12px">
        <i class="bi bi-box-arrow-left"></i> {{ __('Deconnexion') }}
      </button>
    </form>
  </div>
</aside>

<main class="admin-main">
  @if(session('success'))
    <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
  @endif
  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
