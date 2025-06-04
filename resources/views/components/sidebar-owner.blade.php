<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - {{ config('app.name') }}</title>
    @vite(['resources/css/owner/sidebar-owner.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="{{ asset('storage/logo/mandhapaputih.png') }}" alt="Mandhapa" class="logo-img">
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item">
                    <a href="/owner" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/owner/homestayowner" class="nav-link">
                        <i class="fas fa-building"></i>
                        <span>Homestay</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/owner/pemesanan" class="nav-link">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Pemesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/owner/profilowner" class="nav-link">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar">
                </div>
                <div class="user-details">
                    <span class="user-name">Owner</span>
                    <span class="user-role">Pemilik Homestay</span>
                </div>
            </div>
            <button class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>
    </aside>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>