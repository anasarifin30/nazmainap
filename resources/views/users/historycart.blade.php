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
    <div class="page-wrapper">
        <div class="history-container">
            <div class="breadcrumb">
                Beranda <span class="mx-2">></span> Riwayat
            </div>
            
            <div class="history-content">
                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="sidebar-menu">
                        <a href="{{ route('users.profile') }}" class="menu-item">
                            <i class="fas fa-user"></i> Profil
                        </a>
                        <a href="{{ route('users.historycart') }}" class="menu-item active">
                            <i class="fas fa-history"></i> Riwayat
                        </a>
                        <a href="{{ route('logout') }}" class="menu-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
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
                        @forelse($riwayats as $riwayat)
                            <div class="history-card">
                                <div class="card-image">
                                    <img src="{{ $riwayat->homestay->thumbnail_url ?? asset('images/default-homestay.jpg') }}" alt="{{ $riwayat->homestay->name }}">
                                    <div class="card-badge badge-{{ strtolower($riwayat->status) }}">
                                        @php
                                            $statusText = [
                                                'pending' => 'Menunggu',
                                                'confirmed' => 'Aktif',
                                                'completed' => 'Selesai',
                                                'cancelled' => 'Dibatalkan'
                                            ][$riwayat->status] ?? ucfirst($riwayat->status);
                                        @endphp
                                        {{ $statusText }}
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">{{ $riwayat->homestay->name ?? '-' }}</h3>
                                    <div class="card-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $riwayat->homestay->kabupaten ?? '-' }}, {{ $riwayat->homestay->provinsi ?? '-' }}
                                    </div>
                                    <div class="card-dates">
                                        <div>Check-in: <b>{{ \Carbon\Carbon::parse($riwayat->check_in)->format('d M Y') }}</b></div>
                                        <div>Check-out: <b>{{ \Carbon\Carbon::parse($riwayat->check_out)->format('d M Y') }}</b></div>
                                    </div>
                                    <div class="card-price">Rp {{ number_format($riwayat->total_price, 0, ',', '.') }}</div>
                                </div>
                                <div class="card-footer">
                                    <div class="card-status status-{{ strtolower($riwayat->status) }}">
                                        @if($riwayat->status == 'completed')
                                            <i class="fas fa-check-circle"></i> Selesai
                                        @elseif($riwayat->status == 'confirmed')
                                            <i class="fas fa-clock"></i> Aktif
                                        @elseif($riwayat->status == 'cancelled')
                                            <i class="fas fa-times-circle"></i> Dibatalkan
                                        @elseif($riwayat->status == 'pending')
                                            <i class="fas fa-hourglass-half"></i> Menunggu
                                        @endif
                                    </div>
                                    <a href="{{ route('riwayat.detail', $riwayat->id) }}" class="btn btn-detail">Detail</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">Belum ada riwayat pemesanan.</div>
                        @endforelse
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
    </div>
    
    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>