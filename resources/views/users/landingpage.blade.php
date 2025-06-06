<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazmainap - Penginapan Desa di Pacitan</title>
    @vite(['resources/css/landingpage.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body>

    <!-- Header -->
    <x-header></x-header>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title font-bold">Nikmati kemudahan mencari, memesan, dan mengelola<br class="desktop-only">penginapan desa di Pacitan.</h1>

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
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Catalog -->
        <h2>Katalog Penginapan di Pacitan</h2>
        <section class="catalog">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($homestaysslide as $homestay)
                        <div class="swiper-slide">
                            <div class="card">
                                    <img
                                        src="{{ $homestay->coverPhoto && $homestay->coverPhoto->photo_path
                                            ? asset('storage/images-homestay/' . $homestay->coverPhoto->photo_path)
                                            : asset('storage/images-room/default-room.jpg') }}"
                                        alt="{{ $homestay->name }}"
                                    />                                
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
        </section>

        <!-- About Section -->
        <section id="about" class="about-section">
            <div class="about-container">
                <div class="about-content">
                    <h2>Selamat datang di Nazmainap</h2>
                    <p>Nazmainap adalah platform pemesanan homestay milik warga desa wisata Pacitan. Temukan pengalaman menginap yang unik dan nyaman di sini.</p>
                    <a href="{{ route('users.kataloghomestay') }}" class="about-button">Pesan</a>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/pacitan-desa.jpg') }}" alt="Pacitan">
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="features-section">
            <h2>Kenapa Pilih Nazmainap?</h2>
            <p class="subtitle">Nikmati Kemudahan mencari, memesan, dan mengelola penginapan desa di Pacitan</p>
            <div class="features-grid">
                <div class="feature-item"><i class="fas fa-home feature-icon"></i><p>Penginapan milik warga</p></div>
                <div class="feature-item"><i class="fas fa-id-card feature-icon"></i><p>Dikelola BumDes</p></div>
                <div class="feature-item"><i class="fas fa-shield-alt feature-icon"></i><p>Aman & transparan</p></div>
                <div class="feature-item"><i class="fas fa-credit-card feature-icon"></i><p>Pembayaran Online</p></div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="how-it-works">
            <h2>Cara Kerja</h2>
            <div class="steps-grid">
                <div class="step-item"><span class="step-number">1</span><p>Cari Penginapan</p></div>
                <div class="step-item"><span class="step-number">2</span><p>Pesan Penginapan</p></div>
                <div class="step-item"><span class="step-number">3</span><p>Transaksi & Pembayaran</p></div>
            </div>
        </section>

        <!-- Destinations -->
        <section class="destinations-section">
            <h2>Pilih Lokasi Penginapan</h2>
            <div class="cities-grid">
                @foreach ($kabupatens->take(5) as $kabupaten)
                    <a href="{{ route('users.kataloghomestay', ['search' => $kabupaten->kabupaten]) }}" class="city-item">
                        <div class="city-content">
                            <i class="fas fa-building"></i>
                            <span>Penginapan {{ $kabupaten->kabupaten }}</span>
                        </div>
                    </a>
                @endforeach
                <a href="{{ route('users.kataloghomestay') }}" class="city-item see-all">
                    <div class="city-content">
                        <i class="fas fa-arrow-right"></i>
                        <span>Lihat Semua</span>
                    </div>
                </a>
            </div>
        </section>

        
    </div>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
            
            // Initialize Swiper
            new Swiper(".mySwiper", {
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
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
                        slidesPerView: 4, // 4 card per baris di desktop
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                },
            });
        });
    </script>
    
    <!-- Footer -->
    <x-footer></x-footer>

</body>
</html>