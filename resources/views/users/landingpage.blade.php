<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandhapa - Penginapan Desa di Pacitan</title>
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
            <h1 class="hero-title font-bold">Nikmati kemudahan mencari, memesan, dan mengelola penginapan desa di <br class="desktop-only">berbagai daerah dengan lebih mudah.</h1>

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
        <h2>Katalog Penginapan</h2>
        <section class="catalog">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($homestaysslide as $homestay)
                        <div class="swiper-slide">
                            <a href="{{ route('homestays.show', $homestay->id) }}" class="card-link">
                                <div class="card">
                                    <img
                                        src="{{ $homestay->coverPhoto && $homestay->coverPhoto->photo_path
                                            ? asset('storage/images-homestay/' . $homestay->coverPhoto->photo_path)
                                            : asset('storage/images-room/default-room.jpg') }}"
                                        alt="{{ $homestay->name }}"
                                    />                                
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
        </section>

        <!-- About Section -->
        <section id="about" class="about-section">
            <div class="about-container">
                <div class="about-content">
                    <h2>Selamat datang di Mandhapa</h2>
                    <p>Mandhapa adalah platform pemesanan homestay yang dikelola langsung oleh warga desa wisata dari berbagai daerah. Temukan pengalaman menginap yang autentik, nyaman, dan penuh kehangatan lokal bersama Mandhapa.</p>
                    <a href="{{ route('users.kataloghomestay') }}" class="about-button">Pesan</a>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/pacitan-desa.jpg') }}" alt="Pacitan">
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="features-section">
            <h2>Kenapa Pilih Mandhapa?</h2>
            <p class="subtitle">Nikmati Kemudahan mencari, memesan, dan mengelola penginapan desa di berbagai daerah</p>
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

        <!-- FAQ Section -->
        @if($faqs->count() > 0)
        <section class="faq-section" id="faq">
            <div class="faq-container">
                <h2>Pertanyaan yang Sering Diajukan</h2>
                <p class="subtitle">Temukan jawaban atas pertanyaan umum tentang Mandhapa</p>
                
                <div class="faq-list">
                    @foreach($faqs as $index => $faq)
                        <div class="faq-item" data-faq="{{ $index }}">
                            <div class="faq-question">
                                <h3>{{ $faq->question }}</h3>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </div>
                            <div class="faq-answer">
                                <p>{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="faq-contact">
                    <p>Tidak menemukan jawaban yang Anda cari?</p>
                    <a href="mailto:info@mandhapa.com" class="contact-button">
                        <i class="fas fa-envelope"></i>
                        Kirim Email
                    </a>
                </div>
            </div>
        </section>
        @endif
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
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                },
            });

            // Card click analytics (opsional)
            document.querySelectorAll('.card-link').forEach(card => {
                card.addEventListener('click', function() {
                    // Optional: Add analytics tracking
                    console.log('Homestay card clicked:', this.href);
                });
            });

            // FAQ Accordion
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach((item, index) => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-icon');
                
                question.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');
                    
                    // Close all FAQ items
                    faqItems.forEach(faqItem => {
                        faqItem.classList.remove('active');
                        faqItem.querySelector('.faq-answer').style.maxHeight = '0';
                        faqItem.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                    });
                    
                    // If not currently active, open this item
                    if (!isActive) {
                        item.classList.add('active');
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        });
    </script>
    
    <!-- Footer -->
    <x-footer></x-footer>

</body>
</html>