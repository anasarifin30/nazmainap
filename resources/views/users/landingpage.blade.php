<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazmainap - Platform Penginapan Desa di Pacitan</title>
    @vite(['resources/css/landingpage.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="container">
            <a href="#" class="logo">NAZMAINAP</a>
            <div class="nav-links">
                <a href="#">Beranda</a>
                <a href="#about">Tentang</a>
                <a href="#contact">Bantuan</a>
            </div>
            <!-- Mobile Menu Button -->
            <div class="mobile-menu-button" id="mobile-menu-button">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </div>
            <div class="login-button-container">
                <a href="#" class="login-button">Masuk</a>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu">
            <a href="#">Beranda</a>
            <a href="#about">Tentang</a>
            <a href="#contact">Bantuan</a>
            <a href="#" class="login-button">Masuk</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Nikmati kemudahan mencari, memesan, dan mengelola<br class="desktop-only">penginapan desa di Pacitan.</h1>
            
            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Lokasi penginapan">
                    <button>Cari</button>
                </div>
            </div>

            <!-- Recommendations -->
            <h2>Rekomendasi Penginapan di Pacitan</h2>
            <div class="recommendations-grid">
                <!-- Recommendation Card 1 -->
                <div class="recommendation-card">
                    <img src="{{ asset('images/hacienda.jpg') }}" alt="Hacienda Watukarung">
                    <div class="card-content">
                        <h3>Hacienda Watukarung</h3>
                        <p class="location">Pacitan</p>
                        <p class="distance">3.9 km dari pusat kota Watukarung</p>
                        <div class="price-container">
                            <p class="price">Rp200.000</p>
                            <p class="price-note">Mulai 1 Kamar</p>
                        </div>
                        <button class="detail-button">Detail</button>
                    </div>
                </div>
                
                <!-- Recommendation Card 2 -->
                <div class="recommendation-card">
                    <img src="{{ asset('images/hacienda.jpg') }}" alt="Hacienda Watukarung">
                    <div class="card-content">
                        <h3>Hacienda Watukarung</h3>
                        <p class="location">Pacitan</p>
                        <p class="distance">3.9 km dari pusat kota Watukarung</p>
                        <div class="price-container">
                            <p class="price">Rp200.000</p>
                            <p class="price-note">Mulai 1 Kamar</p>
                        </div>
                        <button class="detail-button">Detail</button>
                    </div>
                </div>
                
                <!-- Recommendation Card 3 -->
                <div class="recommendation-card">
                    <img src="{{ asset('images/hacienda.jpg') }}" alt="Hacienda Watukarung">
                    <div class="card-content">
                        <h3>Hacienda Watukarung</h3>
                        <p class="location">Pacitan</p>
                        <p class="distance">3.9 km dari pusat kota Watukarung</p>
                        <div class="price-container">
                            <p class="price">Rp200.000</p>
                            <p class="price-note">Mulai 1 Kamar</p>
                        </div>
                        <button class="detail-button">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="{{ url('/kataloghomestay') }}">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="{{ url('/kataloghomestay') }}" class="view-all">Lihat Semua</a>
                <a href="{{ url('/kataloghomestay') }}">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-container">
                <div class="about-content">
                    <h2>Selamat datang di Nazmainap</h2>
                    <p>
                        Nazmainap adalah platform pemesanan homestay milik warga desa wisata Pacitan. Temukan pengalaman menginap yang unik dan nyaman di sini.
                    </p>
                    <a href="#contact" class="about-button">Hubungi Kami</a>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/pacitan-desa.jpg') }}" alt="Pacitan">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="features-section">
        <div class="container">
            <h2>Kenapa Pilih Nazmainap?</h2>
            <p class="subtitle">Nikmati Kemudahan mencari, memesan, dan mengelola penginapan desa di Pacitan</p>
            
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <p>Penginapan milik warga</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <p>Dikelola BumDes</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <p>Aman & transparan</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <p>Pembayaran Online</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <h2>Cara Kerja</h2>
            
            <div class="steps-grid">
                <div class="step-item">
                    <div class="step-number">
                        <span>1</span>
                    </div>
                    <p>Cari Penginapan</p>
                </div>
                <div class="step-item">
                    <div class="step-number">
                        <span>2</span>
                    </div>
                    <p>Pesan Penginapan</p>
                </div>
                <div class="step-item">
                    <div class="step-number">
                        <span>3</span>
                    </div>
                    <p>Transaksi & Pembayaran</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations -->
    <section class="destinations-section">
        <div class="container">
            <h2>Desa</h2>
            
            <div class="destinations-grid">
                <div class="destination-item">
                    <img src="{{ asset('images/pacitan.jpg') }}" alt="Pacitan">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Pacitan</h3>
                    </div>
                </div>
                <div class="destination-item">
                    <img src="{{ asset('images/wonosobo.jpg') }}" alt="Wonosobo">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Wonosobo</h3>
                    </div>
                </div>
                <div class="destination-item">
                    <img src="{{ asset('images/wonogiri.png') }}" alt="Wonogiri">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Wonogiri</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Kontak Kami</h2>
                    <p>Hubungi kami untuk informasi lebih lanjut tentang penginapan.</p>
                    <div class="contact-details">
                        <div class="contact-detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Pacitan, Jawa Timur, Indonesia</p>
                        </div>
                        <div class="contact-detail">
                            <i class="fas fa-envelope"></i>
                            <p>info@nazmainap.co.id</p>
                        </div>
                        <div class="contact-detail">
                            <i class="fas fa-phone"></i>
                            <p>+62 812 3456 7890</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="Email Anda">
                        </div>
                        <div class="form-group">
                            <label>Pesan</label>
                            <textarea rows="3" placeholder="Pesan"></textarea>
                        </div>
                        <button type="submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Pre-Footer -->
    <section class="pre-footer">
        <div class="container">
            <div class="pre-footer-container">
                <div>
                    <h3>Punya rumah kosong atau kamar tersedia?</h3>
                </div>
                <div>
                    <a href="#" class="pre-footer-button">Daftarkan sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-container">
                <p class="footer-copyright">Copyright 2025 - Developed by Nazma Office</p>
                <div class="footer-contact">
                    <h3>Kontak Kami</h3>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Smooth Scroll JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            
            // Smooth Scrolling for Anchor Links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if (this.getAttribute('href') !== '#') {
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            // Close mobile menu if open
                            if (!mobileMenu.classList.contains('hidden')) {
                                mobileMenu.classList.add('hidden');
                            }
                            
                            // Smooth scroll to target
                            target.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>