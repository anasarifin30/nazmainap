@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - Katalog Penginapan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/kataloghomestay.css']) 
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>

    <!-- Header -->
    <x-header></x-header>

    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-container">
            <form action="{{ route('users.kataloghomestay') }}" method="GET" class="search-form">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="search-input" placeholder="Lokasi penginapan" value="{{ request('search') }}">
                <button type="submit" class="search-button">Cari</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2>Temukan Penginapan Terbaik</h2>
        <p class="subjudul-desc">Jelajahi berbagai pilihan homestay dan penginapan nyaman sesuai kebutuhan Anda.</p>
    
    @if(request('search'))
            {{-- Mode search tetap pakai grid --}}
            @php $results = $homestays->flatten(1); @endphp
            @if($results->count() > 0)
                <div class="catalog-grid">
                    @foreach($results as $homestay)
                        <div class="card">
                            <img src="{{ $homestay->coverPhoto && $homestay->coverPhoto->photo_path
                                ? asset('storage/images-homestay/' . $homestay->coverPhoto->photo_path)
                                : asset('storage/images-room/default-room.jpg') }}"
                                alt="{{ $homestay->name }}" />
                            <div class="card-body">
                                <h3>{{ $homestay->name }}</h3>
                                <p>{{ $homestay->kecamatan }}, {{ $homestay->kabupaten }}</p>
                                <div class="tags">{{ $homestay->kodebumdes }}</div>
                                <div class="price-detail">
                                    <div>
                                        @if ($homestay->rooms->isNotEmpty())
                                            <p class="price">Rp{{ number_format($homestay->rooms->min('price'), 0, ',', '.') }}</p>
                                            <p class="stock">Sisa {{ $homestay->rooms->sum('total_rooms') }} Kamar</p>
                                        @else
                                            <p class="price">Harga tidak tersedia</p>
                                            <p class="stock">Kamar tidak tersedia</p>
                                        @endif
                                    </div>
                                    <a href="{{ route('homestays.show', $homestay->kodebumdes) }}" class="btn-detail">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div style="text-align:center; margin:40px 0 0 0;">
                    <a href="{{ route('users.kataloghomestay') }}" class="btn-kembali">
                        &larr; Kembali ke Semua Wilayah
                    </a>
                </div>
            @else
                <div style="text-align:center; color:#888; margin:40px 0 20px 0; font-size:1.1rem;">
                    Data homestay tidak ditemukan untuk pencarian "<b>{{ request('search') }}</b>".
                </div>
                <div style="text-align:center; margin-bottom:40px;">
                    <a href="{{ route('users.kataloghomestay') }}" class="btn-kembali">
                        &larr; Kembali ke Semua Wilayah
                    </a>
                </div>
            @endif
        @else
            @foreach($homestays as $kabupaten => $list)
                <div class="wilayah-section" style="margin-bottom: 32px;">
                    <div class="wilayah-header" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <h3 style="margin:0;">{{ $kabupaten ?: 'Lainnya' }}</h3>
                        <a href="{{ route('users.kataloghomestay', ['search' => $kabupaten]) }}" class="lihat-semua-btn">Lihat Semua</a>
                    </div>
                    <div class="swiper wilayah-swiper-{{ Str::slug($kabupaten) }}">
                        <div class="swiper-wrapper">
                            @php
                                $showAll = request('search') == $kabupaten;
                                $homestayList = $showAll ? $list : $list;
                            @endphp
                            @foreach($homestayList as $homestay)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <img src="{{ $homestay->coverPhoto && $homestay->coverPhoto->photo_path
                                            ? asset('storage/images-homestay/' . $homestay->coverPhoto->photo_path)
                                            : asset('storage/images-room/default-room.jpg') }}"
                                            alt="{{ $homestay->name }}" />
                                        <div class="card-body">
                                            <h3>{{ $homestay->name }}</h3>
                                            <p>{{ $homestay->kecamatan }}, {{ $homestay->kabupaten }}</p>
                                            <div class="tags">{{ $homestay->kodebumdes }}</div>
                                            <div class="price-detail">
                                                <div>
                                                    @if ($homestay->rooms->isNotEmpty())
                                                        <p class="price">Rp{{ number_format($homestay->rooms->min('price'), 0, ',', '.') }}</p>
                                                        <p class="stock">Sisa {{ $homestay->rooms->sum('total_rooms') }} Kamar</p>
                                                    @else
                                                        <p class="price">Harga tidak tersedia</p>
                                                        <p class="stock">Kamar tidak tersedia</p>
                                                    @endif
                                                </div>
                                                <a href="{{ route('homestays.show', $homestay->id) }}" class="btn-detail">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    <x-footer></x-footer>

    <style>
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }
        @media (max-width: 1024px) {
            .catalog-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .catalog-grid { grid-template-columns: 1fr; }
        }
        .lihat-semua-btn {
            color: #ff8000;
            font-weight: 500;
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1px solid #ff8000;
            transition: background 0.2s, color 0.2s;
        }
        .lihat-semua-btn:hover {
            background: #ff8000;
            color: #fff;
        }
    </style>

    <!-- SwiperJS JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($homestays as $kabupaten => $list)
                new Swiper('.wilayah-swiper-{{ \Illuminate\Support\Str::slug($kabupaten) }}', {
                    loop: false,
                    pagination: {
                        el: '.wilayah-swiper-{{ \Illuminate\Support\Str::slug($kabupaten) }} .swiper-pagination',
                        clickable: true,
                    },
                    slidesPerView: 1,
                    spaceBetween: 10,
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 30,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            @endforeach
        });
        </script>
</body>
</html>