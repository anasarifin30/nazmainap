<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - {{ config('app.name') }}</title>
    @vite(['resources/css/owner/dashboard.css'])
    @vite(['resources/css/owner/sidebar-owner.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Sidebar Component dengan active menu dashboard -->
    <x-sidebar-owner active-menu="dashboard" />

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Include Notification -->
        <x-notif />

        <!-- Header -->
        <header class="main-header">
            <div class="header-left">
                <h1>Dashboard</h1>
                <p>Selamat datang kembali, {{ Auth::user()->name }}! Berikut adalah ringkasan bisnis Anda hari ini.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <button class="notification-btn" onclick="toggleNotifications()">
                        <i class="fas fa-bell"></i>
                        @if(isset($pendingPayments) && $pendingPayments > 0)
                            <span class="notification-badge">{{ $pendingPayments }}</span>
                        @endif
                    </button>
                    <div class="date-info">
                        <span>{{ Carbon\Carbon::now()->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Stats Cards -->
        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-card revenue">
                    <div class="stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Pendapatan Bulan Ini</h3>
                        <p class="stat-value">Rp 0</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 
                            0%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card bookings">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Pemesanan Bulan Ini</h3>
                        <p class="stat-value">0</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 
                            0%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card occupancy">
                    <div class="stat-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Tingkat Okupansi</h3>
                        <p class="stat-value">0%</p>
                        <span class="stat-status low">
                            <i class="fas fa-times-circle"></i>
                            Rendah
                        </span>
                    </div>
                </div>
                
                <div class="stat-card rooms">
                    <div class="stat-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Kamar Tersedia</h3>
                        <p class="stat-value">0/0</p>
                        <span class="stat-status available">
                            <i class="fas fa-check-circle"></i>
                            Tersedia
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Charts Section -->
        <section class="charts-section">
            <div class="charts-grid">
                <div class="chart-card main-chart">
                    <div class="card-header">
                        <h3>Tren Pemesanan & Pendapatan</h3>
                        <div class="chart-legend">
                            <span class="legend-item">
                                <span class="legend-color booking"></span> Pemesanan
                            </span>
                            <span class="legend-item">
                                <span class="legend-color revenue"></span> Pendapatan (Juta)
                            </span>
                        </div>
                    </div>
                    <div class="chart-container">
                        <p>Grafik akan muncul setelah ada data pemesanan</p>
                    </div>
                </div>
                
                <div class="chart-card">
                    <div class="card-header">
                        <h3>Tipe Kamar Populer</h3>
                    </div>
                    <div class="room-stats">
                        <div class="empty-state">
                            <i class="fas fa-bed"></i>
                            <p>Belum ada data kamar</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dashboard Bottom -->
        <section class="dashboard-bottom">
            <div class="bottom-grid">
                <div class="activity-card">
                    <div class="card-header">
                        <h3>Aktivitas Terbaru</h3>
                        <a href="#" class="view-all">Lihat Semua</a>
                    </div>
                    <div class="activity-list">
                        <div class="empty-state">
                            <i class="fas fa-calendar"></i>
                            <p>Belum ada aktivitas</p>
                        </div>
                    </div>
                </div>
                
                <div class="quick-actions-card">
                    <div class="card-header">
                        <h3>Aksi Cepat</h3>
                    </div>
                    <div class="quick-actions">
                        <a href="{{ route('owner.homestay') }}" class="action-btn primary">
                            <i class="fas fa-home"></i>
                            <span>Kelola Homestay</span>
                        </a>
                        <a href="{{ route('owner.homestay.create.step1') }}" class="action-btn success">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Homestay</span>
                        </a>
                        <button class="action-btn info" onclick="showBookings()">
                            <i class="fas fa-calendar-check"></i>
                            <span>Lihat Pemesanan</span>
                        </button>
                        <a href="#" class="action-btn warning">
                            <i class="fas fa-user-cog"></i>
                            <span>Pengaturan Profil</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function showBookings() {
            alert('Fitur lihat pemesanan akan segera tersedia');
        }

        // Mobile sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            let sidebarOpen = false;
            
            function isMobile() {
                return window.innerWidth <= 768;
            }
            
            function toggleSidebar() {
                if (isMobile()) {
                    sidebarOpen = !sidebarOpen;
                    sidebar.classList.toggle('mobile-open', sidebarOpen);
                    sidebarOverlay.classList.toggle('active', sidebarOpen);
                    document.body.classList.toggle('mobile-sidebar-open', sidebarOpen);
                    
                    const icon = mobileMenuBtn.querySelector('i');
                    if (sidebarOpen) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            }
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleSidebar);
            }
            
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }
        });
    </script>
</body>
</html>