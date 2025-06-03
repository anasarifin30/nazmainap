<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - {{ config('app.name') }}</title>
    @vite(['resources/css/owner/dashboard.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar Component -->
    <x-sidebar-owner activeMenu="dashboard" />

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="header-left">
                <h1>Dashboard</h1>
                <p>Selamat datang kembali! Berikut adalah ringkasan bisnis Anda hari ini.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="date-info">
                        <span>{{ date('d M Y') }}</span>
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
                        <p class="stat-value">Rp 15.250.000</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +8.3%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card bookings">
                    <div class="stat-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Pemesanan</h3>
                        <p class="stat-value">48</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +12.5%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card occupancy">
                    <div class="stat-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Tingkat Okupansi</h3>
                        <p class="stat-value">85%</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +5.2%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card rooms">
                    <div class="stat-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Kamar Tersedia</h3>
                        <p class="stat-value">8/12</p>
                        <span class="stat-status available">
                            <i class="fas fa-check-circle"></i> Siap Huni
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
                        <h3>Grafik Pemesanan</h3>
                        <div class="chart-controls">
                            <select class="chart-period">
                                <option>Minggu Ini</option>
                                <option>Bulan Ini</option>
                                <option>3 Bulan Terakhir</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="bookingsChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-card">
                    <div class="card-header">
                        <h3>Tipe Kamar Popular</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="roomTypeChart"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Activity & Quick Actions -->
        <section class="dashboard-bottom">
            <div class="bottom-grid">
                <div class="activity-card">
                    <div class="card-header">
                        <h3>Aktivitas Terbaru</h3>
                        <a href="#" class="view-all">Lihat Semua</a>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon new-booking">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Pemesanan Baru</strong></p>
                                <span>Kamar Deluxe #204 - 3 Malam</span>
                                <time>5 menit yang lalu</time>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon check-in">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Check-in Hari Ini</strong></p>
                                <span>2 tamu - Kamar Standard #101</span>
                                <time>30 menit yang lalu</time>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon review">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Ulasan Baru</strong></p>
                                <span>⭐⭐⭐⭐⭐ Kamar Family #305</span>
                                <time>2 jam yang lalu</time>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon maintenance">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Pemeliharaan Kamar</strong></p>
                                <span>AC Kamar #203 perlu service</span>
                                <time>5 jam yang lalu</time>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="quick-actions-card">
                    <div class="card-header">
                        <h3>Aksi Cepat</h3>
                    </div>
                    <div class="quick-actions">
                        <button class="action-btn primary">
                            <i class="fas fa-calendar-plus"></i>
                            <span>Tambah Pemesanan</span>
                        </button>
                        <button class="action-btn success">
                            <i class="fas fa-bed"></i>
                            <span>Kelola Kamar</span>
                        </button>
                        <button class="action-btn info">
                            <i class="fas fa-users"></i>
                            <span>Data Tamu</span>
                        </button>
                        <button class="action-btn warning">
                            <i class="fas fa-chart-bar"></i>
                            <span>Laporan Keuangan</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>