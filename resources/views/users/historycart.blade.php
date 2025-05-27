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
                        @php
                            $statuses = [
                                'semua' => 'Semua',
                                'aktif' => 'Aktif',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                                'menunggu' => 'Menunggu'
                            ];
                        @endphp
                        @foreach($statuses as $key => $label)
                            <a href="{{ route('users.historycart', ['status' => $key != 'semua' ? $key : null]) }}"
                               class="filter-button filter-{{ $key }}{{ (request('status') == $key || (!request('status') && $key == 'semua')) ? ' active' : '' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                    
                    <!-- History Cards -->
                    <div class="history-cards">
                        @forelse($riwayats as $riwayat)
                            <div class="history-card">
                                <div class="card-image">
                                    <div class="card-badge badge-{{ strtolower($riwayat->status) }}">
                                        @if($riwayat->status == 'selesai')
                                            <i class="fas fa-check-circle"></i> Selesai
                                        @elseif($riwayat->status == 'aktif')
                                            <i class="fas fa-clock"></i> Aktif
                                        @elseif($riwayat->status == 'dibatalkan')
                                            <i class="fas fa-times-circle"></i> Dibatalkan
                                        @elseif($riwayat->status == 'menunggu')
                                            <i class="fas fa-hourglass-half"></i> Menunggu
                                        @else
                                            {{ ucfirst($riwayat->status) }}
                                        @endif
                                    </div>
                                    <img src="{{ ($riwayat->homestay && $riwayat->homestay->coverPhoto && $riwayat->homestay->coverPhoto->photo_path)
                                        ? asset('storage/images-homestay/' . $riwayat->homestay->coverPhoto->photo_path)
                                        : asset('storage/images-homestay/default-homestay.jpg') }}"
                                        alt="{{ $riwayat->homestay->name ?? '-' }}">
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
                                    <div class="card-action-row">
                                        <div class="card-price">Rp {{ number_format($riwayat->total_price, 0, ',', '.') }}</div>
                                        <a href="{{ route('users.detailbooking', $riwayat->id) }}" class="btn btn-detail">Detail</a>
                                    </div>
                                </div>
                                
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">Belum ada riwayat pemesanan.</div>
                        @endforelse
                    </div>
                    
                    <!-- Pagination -->
                    @if ($riwayats->lastPage() > 1)
                        <div class="pagination">
                            {{-- Previous --}}
                            @if ($riwayats->onFirstPage())
                                <span class="pagination-item disabled"><i class="fas fa-chevron-left"></i></span>
                            @else
                                <a href="{{ $riwayats->previousPageUrl() }}{{ request('status') ? '&status='.request('status') : '' }}" class="pagination-item"><i class="fas fa-chevron-left"></i></a>
                            @endif

                            {{-- Page Numbers --}}
                            @for ($i = 1; $i <= $riwayats->lastPage(); $i++)
                                @if ($i == $riwayats->currentPage())
                                    <span class="pagination-item active">{{ $i }}</span>
                                @else
                                    <a href="{{ $riwayats->url($i) }}{{ request('status') ? '&status='.request('status') : '' }}" class="pagination-item">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Next --}}
                            @if ($riwayats->hasMorePages())
                                <a href="{{ $riwayats->nextPageUrl() }}{{ request('status') ? '&status='.request('status') : '' }}" class="pagination-item"><i class="fas fa-chevron-right"></i></a>
                            @else
                                <span class="pagination-item disabled"><i class="fas fa-chevron-right"></i></span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>