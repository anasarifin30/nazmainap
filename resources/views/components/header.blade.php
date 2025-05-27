<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandhapa - Penginapan Desa di Pacitan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }

        .header {
            width: 100%;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            position: relative;
            justify-content: space-between;
        }
        .logo {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #2a3990;
        }
        .logo-img {
            height: 32px;
            width: auto;
            display: inline-block;
            vertical-align: middle;
            margin-right: 8px;
        }
        .logo-text {
            font-size: 24px;
            font-weight: 600;
            color: #2a3990;
            vertical-align: middle;
        }
        .spacer {
            flex: 1 1 0;
        }
        .nav-container {
            display: flex;
            align-items: center;
            gap: 40px;
            position: relative;
            flex: 0 1 700px;
            justify-content: center;
        }
        .nav {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
            flex: 1 1 auto;
        }
        .nav a {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            padding: 8px 0;
            transition: color 0.3s;
            position: relative;
        }
        .nav a:hover, .nav a.active { color: #ff8000; }
        /* Hapus garis oranye di bawah menu */
        .nav a.active::after {
            display: none;
        }
        .auth-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: 24px;
            flex: 0 0 auto;
        }
        .login-btn, .sidebar-login-btn {
    background: #292f7b;
    color: #fff;
    border: none;
    border-radius: 16px;
    padding: 6px 18px;
    font-weight: 400;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: none;
    transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
    cursor: pointer;
    outline: none;
    text-decoration: none;
    min-width: 80px;
    text-align: center;
    letter-spacing: 0.5px;
}
        .login-btn:hover, .sidebar-login-btn:hover,
        .login-btn:focus, .sidebar-login-btn:focus {
            background: #1d225a;
            color: #fff;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 16px rgba(41,47,123,0.12);
        }
        .user-menu { position: relative; display: flex; align-items: center; }
        .user-name { font-weight: 500; color: #2a3990; font-size: 15px; margin-right: 8px; }
        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%; cursor: pointer;
            border: 2px solid #e5e7eb; transition: border-color 0.3s;
        }
        .user-avatar:hover { border-color: #ff8000; }
        .dropdown {
            position: absolute; top: 110%; right: 0; margin-top: 10px;
            background: #fff; border: 1px solid #e5e7eb; border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); min-width: 200px;
            display: none; z-index: 50;
            padding: 0;
        }
        .dropdown.show { display: block; }
        .dropdown-header { padding: 12px 16px; border-bottom: 1px solid #e5e7eb; }
        .dropdown-name { font-weight: 500; color: #111827; font-size: 14px; }
        .dropdown-email { color: #6b7280; font-size: 12px; margin-top: 2px; }
        .dropdown-menu { list-style: none; padding: 8px 0; }
        .dropdown-item {
            display: block; padding: 8px 16px; color: #374151;
            text-decoration: none; font-size: 14px; transition: background 0.2s;
        }
        .dropdown-item:hover, .logout-btn:hover { background: #f3f4f6 !important; }
        .logout-form { display: inline; }
        .logout-btn {
            background: none; border: none; color: #374151; cursor: pointer;
            font-size: 14px; font-family: inherit;
        }
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            margin-left: 16px;
        }
        .mobile-menu-btn:hover { background: #f3f4f6; }
        .hamburger { width: 24px; height: 24px; stroke: #6b7280; }

        @media (max-width: 900px) {
            .navbar { flex-wrap: wrap; }
            .nav-container { gap: 16px; }
            .logo-text { font-size: 20px; }
            .spacer { width: 24px; }
        }
        @media (max-width: 768px) {
            .navbar { flex-wrap: wrap; }
            .nav-container {
                display: none;
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: #fff;
                border-top: 1px solid #e5e7eb;
                flex-direction: column;
                gap: 0;
                padding: 20px;
                z-index: 99;
                justify-content: flex-start;
                align-items: stretch;
            }
            .nav-container.show { display: flex; }
            .nav {
                flex-direction: column;
                gap: 0;
                width: 100%;
                justify-content: flex-start;
                align-items: stretch;
            }
            .nav a {
                padding: 12px 0;
                border-bottom: 1px solid #f3f4f6;
                width: 100%;
                text-align: center;
            }
            .auth-section {
                margin-left: 0;
                justify-content: center;
            }
            .user-menu {
                width: 100%;
                justify-content: center;
            }
            .mobile-menu-btn { display: block; }
            .dropdown {
                position: static;
                min-width: 0;
                width: 100%;
                margin-top: 12px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                padding: 0 8px 8px 8px;
            }
            .dropdown-header {
                padding-left: 12px;
                padding-right: 12px;
            }
            .spacer { display: none; }
        }
        /* Sidebar styles: RIGHT SIDEBAR */
        .sidebar {
            display: none;
            position: fixed;
            top: 0; right: 0; /* Ubah dari left:0 ke right:0 */
            width: 260px;
            height: 100vh;
            background: #fff;
            box-shadow: -2px 0 16px rgba(44,48,114,0.08); /* Ubah arah shadow */
            z-index: 9999;
            flex-direction: column;
            padding: 32px 24px 24px 24px;
            transition: transform 0.3s;
            transform: translateX(100%); /* Ubah dari -100% ke 100% */
        }
        .sidebar.show {
            display: flex;
            transform: translateX(0);
        }
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 48px 0 24px 0; /* Tambahkan margin-top agar menu di bawah tanda silang */
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .sidebar-nav a {
            color: #374151;
            font-weight: 500;
            font-size: 1.1rem;
            text-decoration: none;
            padding: 8px 0;
            border-radius: 6px;
            transition: background 0.18s, color 0.18s;
        }
        .sidebar-nav a.active,
        .sidebar-nav a:hover {
            color: #ff8000;
            background: #fff7ed;
        }
        .sidebar-auth {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .sidebar-login-btn {
            width: 100%;
            justify-content: center;
            margin-top: 12px;
            font-size: 1rem;
        }
        .close-sidebar {
            background: none;
            border: none;
            font-size: 2rem;
            color: #2a3990;
            position: absolute;
            top: 12px;
            left: 18px;
            cursor: pointer;
            z-index: 2;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.18);
            z-index: 9998;
        }
        .sidebar.show ~ .sidebar-overlay {
            display: block;
        }
        @media (max-width: 900px) {
            .nav-container { display: none !important; }
            .mobile-menu-btn { display: block; }
        }
        @media (min-width: 901px) {
            .sidebar, .sidebar-overlay { display: none !important; }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <!-- Logo -->
            <a href="/" class="logo">
                <img src="{{ asset('storage/logo/mandhapa.png') }}" alt="Mandhapa Logo" class="logo-img" style="height:32px;width:auto;display:inline-block;vertical-align:middle;">
                <span class="logo-text" style="vertical-align:middle;"></span>
            </a>
            <div class="spacer"></div>
            <!-- Mobile menu button SEBELAH KANAN -->
            <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Menu">
                <svg class="hamburger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <!-- Navigation -->
            <div class="nav-container" id="navMenu">
                <ul class="nav">
                    <li><a href="/" class="active">Beranda</a></li>
                    <li><a href="/kataloghomestay">Penginapan</a></li>
                    <li><a href="/pemesanan">Pemesanan</a></li>
                </ul>
                <div class="auth-section">
                    @if (!Auth::check())
                        <a href="/login" class="login-btn">Masuk</a>
                    @else
                        <div class="user-menu">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '/api/placeholder/36/36' }}" alt="User Avatar" class="user-avatar" onclick="toggleDropdown()">
                            <div class="dropdown" id="userDropdown">
                                <div class="dropdown-header">
                                    <div class="dropdown-name">{{ Auth::user()->name }}</div>
                                    <div class="dropdown-email">{{ Auth::user()->email }}</div>
                                </div>
                                <ul class="dropdown-menu">
    <li>
        <a href="{{ route('users.profile') }}" class="dropdown-item" style="display:flex;align-items:center;gap:8px;transition:background 0.18s;">
            <span style="display:inline-block;">
                <svg width="18" height="18" fill="none" stroke="#2a3990" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-4 8-4 8-4s8 0 8 4"/>
                </svg>
            </span>
            Profil
        </a>
    </li>
    <li>
        <a href="{{ route('users.historycart') }}" class="dropdown-item" style="display:flex;align-items:center;gap:8px;transition:background 0.18s;">
            <span style="display:inline-block;">
                <svg width="18" height="18" fill="none" stroke="#ff8000" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="6" width="18" height="13" rx="2"/>
                    <path d="M16 3v3M8 3v3"/>
                </svg>
            </span>
            Riwayat
        </a>
    </li>
    <li>
        <form class="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item logout-btn" style="display:flex;align-items:center;gap:8px;transition:background 0.18s;">
                <span style="display:inline-block;">
                    <svg width="18" height="18" fill="none" stroke="#e53e3e" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                        <path d="M9 20H5a2 2 0 01-2-2V6a2 2 0 012-2h4"/>
                    </svg>
                </span>
                Keluar
            </button>
        </form>
    </li>
</ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Sidebar for mobile (kanan) -->
            <div class="sidebar" id="sidebarMenu">
                <button class="close-sidebar" onclick="toggleSidebar()">&times;</button>
                <ul class="sidebar-nav">
                    <li><a href="/" class="active">Beranda</a></li>
                    <li><a href="/kataloghomestay">Penginapan</a></li>
                    <li><a href="/pemesanan">Pemesanan</a></li>
                </ul>
                <div class="sidebar-auth">
                    @if (!Auth::check())
                        <a href="/login" class="login-btn sidebar-login-btn">Masuk</a>
                    @else
                        <div class="user-menu w-full">
            <div class="user-menu w-full">
    <div class="dropdown-header" style="padding-left:0;padding-right:0; text-align:center;">
        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '/api/placeholder/60/60' }}"
             alt="User Avatar"
             style="width:60px;height:60px;border-radius:50%;object-fit:cover;margin:0 auto 10px;display:block;border:2px solid #ff8000;">
        <div class="dropdown-name" style="font-weight:600;font-size:1.1rem;color:#2a3990;">{{ Auth::user()->name }}</div>
        <div class="dropdown-email" style="color:#6b7280;font-size:0.95rem;margin-bottom:8px;">{{ Auth::user()->email }}</div>
        <div class="guest-badge" style="display:inline-block;background:#ff8000;color:#fff;padding:2px 14px;border-radius:12px;font-size:0.85rem;font-weight:500;margin-bottom:18px;">
            Guest
        </div>
        <div style="display:flex;flex-direction:column;gap:10px;align-items:center;">
            <a href="{{ route('users.profile') }}" class="dropdown-item"
               style="width:100%;max-width:180px;display:flex;align-items:center;justify-content:center;gap:8px;padding:10px 0;border-radius:8px;text-align:center;transition:background 0.18s;">
                <span style="display:inline-block;">
                    <svg width="18" height="18" fill="none" stroke="#2a3990" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 8-4 8-4s8 0 8 4"/></svg>
                </span>
                Profil
            </a>
            <a href="{{ route('users.historycart') }}" class="dropdown-item"
               style="width:100%;max-width:180px;display:flex;align-items:center;justify-content:center;gap:8px;padding:10px 0;border-radius:8px;text-align:center;transition:background 0.18s;">
                <span style="display:inline-block;">
                    <svg width="18" height="18" fill="none" stroke="#ff8000" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="6" width="18" height="13" rx="2"/>
                        <path d="M16 3v3M8 3v3"/>
                    </svg>
                </span>
                Riwayat
            </a>
            <form class="logout-form" method="POST" action="{{ route('logout') }}" style="width:100%;max-width:180px;">
                @csrf
                <button type="submit" class="dropdown-item logout-btn"
                        style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:10px 0;border-radius:8px;text-align:center;transition:background 0.18s;">
                    <span style="display:inline-block;">
                        <svg width="18" height="18" fill="none" stroke="#e53e3e" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7"/><path d="M9 20H5a2 2 0 01-2-2V6a2 2 0 012-2h4"/></svg>
                    </span>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
                    @endif
                </div>
            </div>
            <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
        </nav>
    </header>
    <script>
        // Toggle sidebar kanan
        function toggleSidebar() {
            const sidebarMenu = document.getElementById('sidebarMenu');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            sidebarMenu.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        }
        // Toggle user dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');
            if (userMenu && dropdown && !userMenu.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebarMenu = document.getElementById('sidebarMenu');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            if (
                sidebarMenu.classList.contains('show') &&
                !sidebarMenu.contains(event.target) &&
                !mobileBtn.contains(event.target)
            ) {
                sidebarMenu.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            }
        });
        // Set active navigation based on current page
        function setActiveNav() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav a, .sidebar-nav a');
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        }
        document.addEventListener('DOMContentLoaded', setActiveNav);
    </script>
</body>
</html>