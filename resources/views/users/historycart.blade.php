<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - NAZMAINAP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    @vite(['resources/css/historycart.css'])
</head>
<body>
    <!-- Header -->
    <x-header></x-header>

    <!-- Main Content -->
    <div class="history-container">
        <div class="breadcrumb">
            Beranda <span class="mx-2">></span> Riwayat
        </div>
        
        <div class="history-content">
            <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-menu">
            <a href="#" class="menu-item">
                <i class="fas fa-user"></i> Profil
            </a>
            <a href="/historycart" class="menu-item active">
                <i class="fas fa-history"></i> Riwayat
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </div>
            
            <!-- Main History Content -->
            <div class="main-content">
                <h1 class="history-heading">Riwayat Pemesanan</h1>
                
                <!-- Filter Buttons -->
                <div class="history-filter">
                    <button class="filter-button active">Semua</button>
                    <button class="filter-button">Aktif</button>
                    <button class="filter-button">Selesai</button>
                    <button class="filter-button">Dibatalkan</button>
                </div>
                
                <!-- History Cards -->
                <div class="history-cards">
                    <!-- Card 1 -->
                    <div class="history-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Villa Sunset">
                            <div class="card-badge badge-success">Selesai</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Villa Sunset Indah</h3>
                            <div class="card-location">
                                <i class="fas fa-map-marker-alt"></i> Bantul, Yogyakarta
                            </div>
                            <div class="card-dates">
                                <div>Check-in: <b>12 Apr 2025</b></div>
                                <div>Check-out: <b>15 Apr 2025</b></div>
                            </div>
                            <div class="card-price">Rp 1.200.000</div>
                        </div>
                        <div class="card-footer">
                            <div class="card-status status-completed">
                                <i class="fas fa-check-circle"></i> Selesai
                            </div>
                            <a href="#" class="btn btn-detail">Detail</a>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="history-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1540518614846-7eded433c457?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Homestay Cozy">
                            <div class="card-badge badge-warning">Aktif</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Homestay Cozy Garden</h3>
                            <div class="card-location">
                                <i class="fas fa-map-marker-alt"></i> Sleman, Yogyakarta
                            </div>
                            <div class="card-dates">
                                <div>Check-in: <b>20 Mei 2025</b></div>
                                <div>Check-out: <b>22 Mei 2025</b></div>
                            </div>
                            <div class="card-price">Rp 850.000</div>
                        </div>
                        <div class="card-footer">
                            <div class="card-status status-active">
                                <i class="fas fa-clock"></i> Aktif
                            </div>
                            <a href="#" class="btn btn-detail">Detail</a>
                        </div>
                    </div>
                    
                    <!-- Card 3 -->
                    <div class="history-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Guesthouse Modern">
                            <div class="card-badge badge-danger">Dibatalkan</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Guesthouse Modern Minimalis</h3>
                            <div class="card-location">
                                <i class="fas fa-map-marker-alt"></i> Kota Yogyakarta
                            </div>
                            <div class="card-dates">
                                <div>Check-in: <b>5 Mar 2025</b></div>
                                <div>Check-out: <b>7 Mar 2025</b></div>
                            </div>
                            <div class="card-price">Rp 750.000</div>
                        </div>
                        <div class="card-footer">
                            <div class="card-status status-cancelled">
                                <i class="fas fa-times-circle"></i> Dibatalkan
                            </div>
                            <a href="#" class="btn btn-detail">Detail</a>
                        </div>
                    </div>
                    
                    <!-- Card 4 -->
                    <div class="history-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Cottage Mountain">
                            <div class="card-badge badge-success">Selesai</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Cottage Mountain View</h3>
                            <div class="card-location">
                                <i class="fas fa-map-marker-alt"></i> Kaliurang, Yogyakarta
                            </div>
                            <div class="card-dates">
                                <div>Check-in: <b>15 Feb 2025</b></div>
                                <div>Check-out: <b>17 Feb 2025</b></div>
                            </div>
                            <div class="card-price">Rp 1.500.000</div>
                        </div>
                        <div class="card-footer">
                            <div class="card-status status-completed">
                                <i class="fas fa-check-circle"></i> Selesai
                            </div>
                            <a href="#" class="btn btn-detail">Detail</a>
                        </div>
                    </div>
                    
                    <!-- Card 5 -->
                    <div class="history-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1564078516393-cf04bd966897?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kamar Resort">
                            <div class="card-badge badge-success">Selesai</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Kamar Resort Premium</h3>
                            <div class="card-location">
                                <i class="fas fa-map-marker-alt"></i> Parangtritis, Bantul
                            </div>
                            <div class="card-dates">
                                <div>Check-in: <b>5 Jan 2025</b></div>
                                <div>Check-out: <b>8 Jan 2025</b></div>
                            </div>
                            <div class="card-price">Rp 2.100.000</div>
                        </div>
                        <div class="card-footer">
                            <div class="card-status status-completed">
                                <i class="fas fa-check-circle"></i> Selesai
                            </div>
                            <a href="#" class="btn btn-detail">Detail</a>
                        </div>
                    </div>
                    
                    <!-- Card 6 -->
                    <div class="history-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Villa Family">
                            <div class="card-badge badge-warning">Aktif</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Villa Family Paradise</h3>
                            <div class="card-location">
                                <i class="fas fa-map-marker-alt"></i> Prambanan, Sleman
                            </div>
                            <div class="card-dates">
                                <div>Check-in: <b>1 Jun 2025</b></div>
                                <div>Check-out: <b>5 Jun 2025</b></div>
                            </div>
                            <div class="card-price">Rp 3.500.000</div>
                        </div>
                        <div class="card-footer">
                            <div class="card-status status-active">
                                <i class="fas fa-clock"></i> Aktif
                            </div>
                            <a href="#" class="btn btn-detail">Detail</a>
                        </div>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-item">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="pagination-item active">1</div>
                    <div class="pagination-item">2</div>
                    <div class="pagination-item">3</div>
                    <div class="pagination-item">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>