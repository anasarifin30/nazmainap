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
        }
        .logo {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #2a3990;
        }
        .logo-icon {
            width: 24px; height: 24px; fill: #2a3990;
        }
        .logo-text {
            font-size: 24px; font-weight: 600; color: #2a3990;
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
        .login-btn {
            background: linear-gradient(90deg, #ff8000 0%, #ffb347 100%);
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 8px 28px 8px 18px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(255,128,0,0.08);
            transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
            cursor: pointer;
            outline: none;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        .login-btn:hover, .login-btn:focus {
            background: linear-gradient(90deg, #ff9900 0%, #ff8000 100%);
            box-shadow: 0 4px 16px rgba(255,128,0,0.18);
            transform: translateY(-2px) scale(1.03);
            color: #fff;
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
        .dropdown-item:hover { background: #f3f4f6; }
        .logout-form { display: inline; }
        .logout-btn {
            background: none; border: none; color: #374151; cursor: pointer;
            font-size: 14px; font-family: inherit;
        }
        .mobile-menu-btn {
            display: none; background: none; border: none; cursor: pointer;
            padding: 8px; border-radius: 4px;
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
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <!-- Logo -->
            <a href="/" class="logo">
                <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                <span class="logo-text">Mandhapa</span>
            </a>
            <div class="spacer"></div>
            <!-- Mobile menu button -->
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Menu">
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
                <!-- Login button or User menu -->
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
                                    <li><a href="#" class="dropdown-item">Profil</a></li>
                                    <li>
                                        <form class="logout-form" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item logout-btn">Sign out</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <script>
        // Toggle mobile menu
        function toggleMobileMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('show');
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
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar');
            const navMenu = document.getElementById('navMenu');
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            if (!navbar.contains(event.target) && !mobileBtn.contains(event.target)) {
                navMenu.classList.remove('show');
            }
        });
        // Set active navigation based on current page
        function setActiveNav() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav a');
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