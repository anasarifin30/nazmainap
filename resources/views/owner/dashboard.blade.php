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
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Pendapatan</h3>
                        <p class="stat-value">Rp 25.450.000</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +12.5%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card orders">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Pesanan</h3>
                        <p class="stat-value">1,247</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +8.2%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card customers">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Pelanggan Aktif</h3>
                        <p class="stat-value">892</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +15.3%
                        </span>
                    </div>
                </div>
                
                <div class="stat-card products">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Produk Terjual</h3>
                        <p class="stat-value">3,456</p>
                        <span class="stat-change negative">
                            <i class="fas fa-arrow-down"></i> -2.1%
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
                        <h3>Grafik Penjualan</h3>
                        <div class="chart-controls">
                            <select class="chart-period">
                                <option>7 Hari Terakhir</option>
                                <option>30 Hari Terakhir</option>
                                <option>3 Bulan Terakhir</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-card">
                    <div class="card-header">
                        <h3>Kategori Produk</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
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
                            <div class="activity-icon new-order">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Pesanan baru #1234</strong></p>
                                <span>Dari Budi Santoso - Rp 150.000</span>
                                <time>2 menit yang lalu</time>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon payment">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Pembayaran diterima</strong></p>
                                <span>Pesanan #1230 - Rp 275.000</span>
                                <time>15 menit yang lalu</time>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon new-customer">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Pelanggan baru terdaftar</strong></p>
                                <span>Sari Dewi bergabung</span>
                                <time>1 jam yang lalu</time>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon stock-alert">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Stok menipis</strong></p>
                                <span>Produk A tinggal 5 unit</span>
                                <time>3 jam yang lalu</time>
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
                            <i class="fas fa-plus"></i>
                            <span>Tambah Produk</span>
                        </button>
                        <button class="action-btn secondary">
                            <i class="fas fa-file-alt"></i>
                            <span>Buat Laporan</span>
                        </button>
                        <button class="action-btn success">
                            <i class="fas fa-bullhorn"></i>
                            <span>Buat Promosi</span>
                        </button>
                        <button class="action-btn warning">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan Toko</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>