<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandhapa - Penginapan Desa di Pacitan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600" rel="stylesheet" />
    @vite(['resources/css/header.css','resources/css/components/alert.css'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                            @if(Auth::user()->foto)
                                @php
                                    // Cek apakah foto adalah URL (Google) atau file di storage lokal
                                    $foto = filter_var(Auth::user()->foto, FILTER_VALIDATE_URL)
                                        ? Auth::user()->foto
                                        : asset('storage/' . Auth::user()->foto);
                                @endphp
                                <img src="{{ $foto }}" 
                                     alt="User Avatar" 
                                     class="user-avatar" 
                                     onclick="toggleDropdown()">
                            @else
                                <div class="default-avatar" onclick="toggleDropdown()">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
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
        @if(Auth::user()->foto)
            @php
                $foto = filter_var(Auth::user()->foto, FILTER_VALIDATE_URL)
                    ? Auth::user()->foto
                    : asset('storage/' . Auth::user()->foto);
            @endphp
            <img src="{{ $foto }}"
                 alt="User Avatar"
                 style="width:60px;height:60px;border-radius:50%;object-fit:cover;margin:0 auto 10px;display:block;border:2px solid #ff8000;">
        @else
            <div class="default-avatar-large">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
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