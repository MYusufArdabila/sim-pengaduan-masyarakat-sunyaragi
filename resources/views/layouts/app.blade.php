<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengaduan Masyarakat Kelurahan Sunyaragi | @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: linear-gradient(180deg, #1a237e 0%, #283593 60%, #303f9f 100%);
            --sidebar-w: 260px;
            --accent: #3949ab;
            --accent-light: #5c6bc0;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f7;
            margin: 0;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: white;
            position: fixed;
            top: 0; left: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            transition: transform .3s ease;
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .sidebar-logo {
            display: flex; align-items: center; gap: .75rem;
        }

        .sidebar-logo img {
            width: 42px; height: 42px;
            border-radius: 8px;
            object-fit: cover;
            background: white;
        }

        .sidebar-logo .logo-placeholder {
            width: 42px; height: 42px;
            border-radius: 8px;
            background: rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .sidebar-logo .app-name {
            font-size: .8rem;
            font-weight: 700;
            line-height: 1.3;
            color: white;
        }

        .sidebar-logo .app-sub {
            font-size: .65rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.2;
        }

        .sidebar-menu {
            padding: 1rem .75rem;
            flex: 1;
            overflow-y: auto;
        }

        .menu-label {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            padding: .5rem .5rem .25rem;
            margin-top: .5rem;
        }

        .nav-link-sidebar {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .6rem .75rem;
            border-radius: 8px;
            color: rgba(255,255,255,0.78);
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: 2px;
            transition: all .2s;
        }

        .nav-link-sidebar:hover {
            background: rgba(255,255,255,0.12);
            color: white;
        }

        .nav-link-sidebar.active {
            background: rgba(255,255,255,0.2);
            color: white;
            font-weight: 600;
        }

        .nav-link-sidebar i {
            width: 20px;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 1rem .75rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin .3s;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: white;
            border-bottom: 1px solid #e8eaf0;
            padding: .75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .topbar-title {
            font-size: .95rem;
            font-weight: 600;
            color: #37474f;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: .5rem;
            background: #f3f4f8;
            border-radius: 30px;
            padding: .35rem .85rem .35rem .5rem;
            font-size: .82rem;
            font-weight: 500;
            color: #37474f;
            cursor: pointer;
        }

        .user-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--accent);
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem;
            font-weight: 700;
        }

        .role-chip {
            font-size: .65rem;
            padding: .15rem .5rem;
            border-radius: 20px;
            font-weight: 600;
        }

        /* ===== CONTENT ===== */
        .content-area {
            padding: 1.75rem;
            flex: 1;
        }

        /* ===== SIDEBAR TOGGLE (Mobile) ===== */
        .sidebar-toggle-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #37474f;
            cursor: pointer;
            padding: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-wrapper {
                margin-left: 0 !important;
            }
            .sidebar-overlay {
                position: fixed; inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1040;
            }
            .sidebar-toggle-btn {
                display: block;
            }
            .content-area {
                padding: 1rem;
            }
        }

        .sidebar-overlay { display: none; }

        @media (max-width: 767.98px) {
            .table-responsive { border: none !important; margin-bottom: 0; }
            .table-responsive table { display: block; width: 100%; border: none; }
            .table-responsive thead { display: none; }
            .table-responsive tbody { display: block; width: 100%; }
            .table-responsive tr {
                display: block; margin-bottom: 1rem; border: 1.5px solid #e0e3ea !important;
                border-radius: 12px; background: #fff; padding: 0.5rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            }
            .table-responsive td {
                display: flex; justify-content: space-between; align-items: center;
                text-align: right; border-bottom: 1px solid #f0f2f7 !important;
                padding: 0.75rem 0.5rem !important;
                border-top: none !important;
            }
            .table-responsive td:last-child { border-bottom: none !important; }
            .table-responsive td::before {
                content: attr(data-label); font-weight: 700; color: #90a4ae;
                font-size: 0.75rem; text-transform: uppercase; margin-right: 1rem;
                text-align: left; letter-spacing: 0.05em;
            }
            .table-responsive td > * { margin-bottom: 0; }
            .table-responsive td .text-truncate { max-width: 150px !important; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo_sunyaragi.jpeg') }}" alt="Logo Kelurahan">
            <div>
                <div class="app-name">Pengaduan Masyarakat</div>
                <div class="app-sub">{{ \App\Models\Setting::get('nama_kelurahan', 'Kelurahan Sunyaragi') }}</div>
            </div>
        </div>
    </div>

    <div class="sidebar-menu">
        <div class="menu-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="nav-link-sidebar {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        @if(Auth::user()->role === 'warga')
        <a href="{{ route('complaints.create') }}" class="nav-link-sidebar {{ request()->routeIs('complaints.create') ? 'active' : '' }}">
            <i class="bi bi-pencil-square"></i> Buat Pengaduan
        </a>
        @endif

        <a href="{{ route('complaints.index') }}" class="nav-link-sidebar {{ request()->routeIs('complaints.index','complaints.show') ? 'active' : '' }}">
            <i class="bi bi-card-list"></i>
            {{ Auth::user()->role === 'warga' ? 'Pengaduan' : 'Data Pengaduan' }}
        </a>

        @if(Auth::user()->role === 'admin')
        <a href="{{ route('statistik.index') }}" class="nav-link-sidebar {{ request()->routeIs('statistik.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Statistik Pengaduan
        </a>
        @endif

        <a href="{{ route('profil') }}" class="nav-link-sidebar {{ request()->routeIs('profil') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Profil Kelurahan
        </a>

        @if(Auth::user()->role === 'admin')
        <div class="menu-label">Manajemen</div>
        <a href="{{ route('users.index') }}" class="nav-link-sidebar {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Pengguna
        </a>
        <a href="{{ route('categories.index') }}" class="nav-link-sidebar {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori
        </a>
        <a href="{{ route('settings.index') }}" class="nav-link-sidebar {{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a>
        @endif
    </div>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link-sidebar w-100 border-0 text-danger" style="background:rgba(255,0,0,0.08);">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </form>
    </div>
</div>

<!-- MAIN WRAPPER -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <span class="topbar-title d-none d-sm-block">@yield('title', 'Dashboard')</span>
        </div>
        <div class="topbar-right">
            <div class="dropdown">
                <div class="user-badge" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        {{ Auth::user()->role === 'warga' ? 'W' : strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="d-none d-sm-inline">
                        {{ Auth::user()->role === 'warga' ? 'Warga Anonim' : Auth::user()->name }}
                    </span>
                    <span class="role-chip {{ Auth::user()->role === 'admin' ? 'bg-primary text-white' : 'bg-success text-white' }}">
                        {{ Auth::user()->role === 'admin' ? 'Admin' : 'Warga' }}
                    </span>
                    <i class="bi bi-chevron-down" style="font-size:.7rem"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-1">
                    <li><span class="dropdown-item-text text-muted small">
                        {{ Auth::user()->email }}
                    </span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a href="{{ route('password.change') }}" class="dropdown-item">
                            <i class="bi bi-key me-2"></i>Ubah Password
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').style.display =
            document.getElementById('sidebar').classList.contains('show') ? 'block' : 'none';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('sidebarOverlay').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.table-responsive table').forEach(table => {
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText.trim());
            table.querySelectorAll('tbody tr').forEach(tr => {
                Array.from(tr.children).forEach((td, index) => {
                    if (headers[index]) {
                        td.setAttribute('data-label', headers[index]);
                    }
                });
            });
        });
    });
</script>
@stack('scripts')
</body>
</html>
