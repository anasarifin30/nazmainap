<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazmainap - Penginapan Desa di Pacitan</title>
    @vite(['resources/css/landingpage.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <x-header></x-header>

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

<!-- Main Content -->
<div class="container">
    <!-- Recommendations -->
    <h2>Katalog Penginapan di Pacitan</h2>
        
    <!-- Catalog -->
    <section class="catalog">
        <div class="catalog-grid">
            <div class="card">
                <img src="images/hacienda.jpg" alt="Hacienda Watukarung" />
                <div class="card-body">
                    <h3>Hacienda Watukarung</h3>
                    <p>Pacitan</p>
                    <div class="tags">WiFi &bull; Kamar &bull; Terverifikasi</div>
                    <div class="price-detail">
                        <div>
                            <p class="price">Rp200.000</p>
                            <p class="stock">Sisa 1 Kamar</p>
                        </div>
                        <a href="#" class="btn-detail">Detail</a>
                    </div>
                </div>
            </div>
            
            <!-- Additional cards for demonstration -->
            <div class="card">
                <img src="images/hacienda.jpg" alt="Villa Panorama" />
                <div class="card-body">
                    <h3>Villa Panorama</h3>
                    <p>Pacitan</p>
                    <div class="tags">WiFi &bull; Kamar &bull; Pool</div>
                    <div class="price-detail">
                        <div>
                            <p class="price">Rp350.000</p>
                            <p class="stock">Sisa 3 Kamar</p>
                        </div>
                        <a href="#" class="btn-detail">Detail</a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <img src="images/hacienda.jpg" alt="Pacitan Beach House" />
                <div class="card-body">
                    <h3>Pacitan Beach House</h3>
                    <p>Pacitan</p>
                    <div class="tags">WiFi &bull; Dapur &bull; AC</div>
                    <div class="price-detail">
                        <div>
                            <p class="price">Rp275.000</p>
                            <p class="stock">Sisa 2 Kamar</p>
                        </div>
                        <a href="#" class="btn-detail">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        
                            <div class="pagination">
                                <a href="{{ url('/kataloghomestay') }}"><i class="fas fa-chevron-left"></i></a>
                                <a href="{{ url('/kataloghomestay') }}" class="view-all">Lihat Semua</a>
                                <a href="{{ url('/kataloghomestay') }}"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-container">
                <div class="about-content">
                    <h2>Selamat datang di Nazmainap</h2>
                    <p>Nazmainap adalah platform pemesanan homestay milik warga desa wisata Pacitan. Temukan pengalaman menginap yang unik dan nyaman di sini.</p>
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
                <div class="feature-item"><i class="fas fa-home feature-icon"></i><p>Penginapan milik warga</p></div>
                <div class="feature-item"><i class="fas fa-id-card feature-icon"></i><p>Dikelola BumDes</p></div>
                <div class="feature-item"><i class="fas fa-shield-alt feature-icon"></i><p>Aman & transparan</p></div>
                <div class="feature-item"><i class="fas fa-credit-card feature-icon"></i><p>Pembayaran Online</p></div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <h2>Cara Kerja</h2>
            <div class="steps-grid">
                <div class="step-item"><span class="step-number">1</span><p>Cari Penginapan</p></div>
                <div class="step-item"><span class="step-number">2</span><p>Pesan Penginapan</p></div>
                <div class="step-item"><span class="step-number">3</span><p>Transaksi & Pembayaran</p></div>
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
                    <div class="destination-overlay"><h3>Pacitan</h3></div>
                </div>
                <div class="destination-item">
                    <img src="{{ asset('images/wonosobo.jpg') }}" alt="Wonosobo">
                    <div class="destination-overlay"><h3>Wonosobo</h3></div>
                </div>
                <div class="destination-item">
                    <img src="{{ asset('images/wonogiri.png') }}" alt="Wonogiri">
                    <div class="destination-overlay"><h3>Wonogiri</h3></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Kontak Kami</h2>
                    <p>Hubungi kami untuk informasi lebih lanjut tentang penginapan.</p>
                    <div class="contact-details">
                        <div class="contact-detail"><i class="fas fa-map-marker-alt"></i><p>Pacitan, Jawa Timur</p></div>
                        <div class="contact-detail"><i class="fas fa-envelope"></i><p>info@nazmainap.co.id</p></div>
                        <div class="contact-detail"><i class="fas fa-phone"></i><p>+62 812 3456 7890</p></div>
                    </div>
                </div>
                <div class="contact-form">
                    <form>
                        <div class="form-group"><label>Nama Lengkap</label><input type="text" placeholder="Nama Lengkap"></div>
                        <div class="form-group"><label>Email</label><input type="email" placeholder="Email Anda"></div>
                        <div class="form-group"><label>Pesan</label><textarea rows="3" placeholder="Pesan"></textarea></div>
                        <button type="submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-footer></x-footer>


    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

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
        });
    </script>
</body>
</html>
