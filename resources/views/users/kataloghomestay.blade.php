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
                        <a href="{{ route('homestays.show', $homestay->id) }}" class="card-link">
                            <div class="card">
                                <img src="{{ $homestay->coverPhoto && $homestay->coverPhoto->photo_path
                                    ? asset('storage/images-homestay/' . $homestay->coverPhoto->photo_path)
                                    : asset('storage/images-room/default-room.jpg') }}"
                                    alt="{{ $homestay->name }}" />
                                <div class="card-body">
                                    <h3>{{ $homestay->name }}</h3>
                                    <p class="location">{{ $homestay->kecamatan }}, {{ $homestay->kabupaten }}</p>
                                    
                                    <!-- Fasilitas -->
                                    <div class="facilities">
                                        @php
                                            // Ambil fasilitas dari semua room di homestay ini
                                            $allFacilities = collect();
                                            
                                            foreach($homestay->rooms as $room) {
                                                if($room->roomFacilities && $room->roomFacilities->count() > 0) {
                                                    foreach($room->roomFacilities as $roomFacility) {
                                                        if($roomFacility->facility) {
                                                            $allFacilities->push($roomFacility->facility);
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            // Remove duplicates berdasarkan ID fasilitas
                                            $uniqueFacilities = $allFacilities->unique('id');
                                        @endphp
                                        
                                        @if($uniqueFacilities->count() > 0)
                                            @foreach($uniqueFacilities->take(3) as $facility)
                                                <span class="facility-tag">
                                                    <i class="fas fa-check-circle"></i>
                                                    {{ $facility->name }}
                                                </span>
                                            @endforeach
                                            @if($uniqueFacilities->count() > 3)
                                                <span class="facility-more">+{{ $uniqueFacilities->count() - 3 }} lainnya</span>
                                            @endif
                                        @else
                                            <span class="facility-tag">
                                                <i class="fas fa-info-circle"></i>
                                                Fasilitas lengkap
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="price-detail">
                                        <div class="price-info">
                                            @if ($homestay->rooms->isNotEmpty())
                                                <p class="price">Rp{{ number_format($homestay->rooms->min('price'), 0, ',', '.') }}</p>
                                                <p class="stock">Sisa {{ $homestay->rooms->sum('total_rooms') }} Kamar</p>
                                            @else
                                                <p class="price">Harga tidak tersedia</p>
                                                <p class="stock">Kamar tidak tersedia</p>
                                            @endif
                                        </div>
                                        <div class="click-indicator">
                                            <i class="fas fa-arrow-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
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
                                    <a href="{{ route('homestays.show', $homestay->id) }}" class="card-link">
                                        <div class="card">
                                            <img src="{{ $homestay->coverPhoto && $homestay->coverPhoto->photo_path
                                                ? asset('storage/images-homestay/' . $homestay->coverPhoto->photo_path)
                                                : asset('storage/images-room/default-room.jpg') }}"
                                                alt="{{ $homestay->name }}" />
                                            <div class="card-body">
                                                <h3>{{ $homestay->name }}</h3>
                                                <p class="location">{{ $homestay->kecamatan }}, {{ $homestay->kabupaten }}</p>
                                                
                                                <!-- Fasilitas -->
                                                <div class="facilities">
                                                    @php
                                                        // Ambil fasilitas dari semua room di homestay ini
                                                        $allFacilities = collect();
                                                        
                                                        foreach($homestay->rooms as $room) {
                                                            if($room->roomFacilities && $room->roomFacilities->count() > 0) {
                                                                foreach($room->roomFacilities as $roomFacility) {
                                                                    if($roomFacility->facility) {
                                                                        $allFacilities->push($roomFacility->facility);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        // Remove duplicates berdasarkan ID fasilitas
                                                        $uniqueFacilities = $allFacilities->unique('id');
                                                    @endphp
                                                    
                                                    @if($uniqueFacilities->count() > 0)
                                                        @foreach($uniqueFacilities->take(3) as $facility)
                                                            <span class="facility-tag">
                                                                <i class="fas fa-check-circle"></i>
                                                                {{ $facility->name }}
                                                            </span>
                                                        @endforeach
                                                        @if($uniqueFacilities->count() > 3)
                                                            <span class="facility-more">+{{ $uniqueFacilities->count() - 3 }} lainnya</span>
                                                        @endif
                                                    @else
                                                        <span class="facility-tag">
                                                            <i class="fas fa-info-circle"></i>
                                                            Fasilitas lengkap
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="price-detail">
                                                    <div class="price-info">
                                                        @if ($homestay->rooms->isNotEmpty())
                                                            <p class="price">Rp{{ number_format($homestay->rooms->min('price'), 0, ',', '.') }}</p>
                                                            <p class="stock">Sisa {{ $homestay->rooms->sum('total_rooms') }} Kamar</p>
                                                        @else
                                                            <p class="price">Harga tidak tersedia</p>
                                                            <p class="stock">Kamar tidak tersedia</p>
                                                        @endif
                                                    </div>
                                                    <div class="click-indicator">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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