<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - Penginapan dan Akomodasi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    vite(['resources/css/detailhomestay.css'])
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="#">NAZMAINAP</a>
                </div>
                <nav class="main-nav">
                    <a href="#" class="active">Beranda</a>
                    <a href="#">Tentang</a>
                    <a href="#">Bantuan</a>
                </nav>
                <div class="user-profile">
                    <button class="profile-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Property Overview -->
        <div class="property-gallery">
            <div class="main-image">
                <img src="images/hacienda-exterior.jpg" alt="Hacienda Watukarung exterior">
            </div>
            <div class="side-images">
                <div class="side-image">
                    <img src="images/hammock.jpg" alt="Hammock">
                </div>
                <div class="side-image photo-overlay">
                    <img src="images/pool.jpg" alt="Pool area">
                    <div class="photo-overlay-content">
                        <button class="btn-primary">
                            Lihat semua foto
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Details -->
        <div class="property-details">
            <!-- Left Column - Property Info -->
            <div class="property-info">
                <div class="info-card">
                    <h1>Hacienda Watukarung</h1>
                    <p class="description">
                        Hacienda Villa Watukarung menyediakan akomodasi dengan taman di Watukarung. Properti ini menyediakan tempat parkir pribadi gratis, serta berjarak 3 menit jalan kaki dari Pantai Watu Karung dan 2,3 km dari Pantai Kasap.
                    </p>

                    <div class="info-section">
                        <h2>Alamat</h2>
                        <p>
                            Ketro, Watukarung, Kec. Pringkuku, Kabupaten Pacitan, Jawa Timur 63552, Watukarung 63552
                        </p>
                    </div>

                    <div class="info-section">
                        <h2>No HP</h2>
                        <p>081687906467</p>
                    </div>

                    <div class="info-section">
                        <h2>Fasilitas Kamar</h2>
                        <ul class="facilities-list">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                AC
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Kasur
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Meja
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Lemari Baju
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Ventilasi
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Bantal
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Guling
                            </li>
                        </ul>
                    </div>

                    <div class="info-section">
                        <h2>Peraturan</h2>
                        <ol class="rules-list">
                            <li>Seluruh fasilitas penginapan, hanya diperuntukkan bagi penyewa bukan untuk umum</li>
                            <li>Penyewa penginapan dilarang menerima tamu dan/atau membawa teman ke kamar. Sebaiknya menerima tamu atau teman di tempat terbuka atau tempat umum lainnya, seperti cafe/resto</li>
                            <li>Penyewa dilarang membawa tamu atau teman lawan jenis</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Right Column - Room Types -->
            <div class="room-types">
                <h2>Tipe Kamar</h2>
                
                <!-- Room Type 1 -->
                <div class="room-card">
                    <img src="images/room-1.jpg" alt="Room Type 1">
                    <div class="room-info">
                        <h3>Hacienda Watukarung</h3>
                        <p class="location">Pacitan</p>
                        <div class="features">
                            <span>WiFi • Kasur • Terverifikasi</span>
                        </div>
                        <div class="room-footer">
                            <div class="price-info">
                                <p class="price">Rp200.000</p>
                                <p class="availability">Sisa 1 kamar</p>
                            </div>
                            <button class="btn-detail">Detail</button>
                        </div>
                        <!-- Hidden details that will be shown on expand -->
                        <div class="room-details hidden">
                            <div class="details-content">
                                <p><span>Deskripsi:</span> Kamar nyaman dengan pemandangan taman</p>
                                <p><span>Max Pengunjung:</span> 2 orang</p>
                                <p><span>Total Kamar:</span> 3 kamar</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Room Type 2 -->
                <div class="room-card">
                    <img src="images/room-2.jpg" alt="Room Type 2">
                    <div class="room-info">
                        <h3>Hacienda Watukarung</h3>
                        <p class="location">Pacitan</p>
                        <div class="features">
                            <span>WiFi • Kasur • Terverifikasi</span>
                        </div>
                        <div class="room-footer">
                            <div class="price-info">
                                <p class="price">Rp200.000</p>
                                <p class="availability">Sisa 1 kamar</p>
                            </div>
                            <button class="btn-detail">Detail</button>
                        </div>
                        <!-- Hidden details that will be shown on expand -->
                        <div class="room-details hidden">
                            <div class="details-content">
                                <p><span>Deskripsi:</span> Kamar nyaman dengan pemandangan taman</p>
                                <p><span>Max Pengunjung:</span> 2 orang</p>
                                <p><span>Total Kamar:</span> 3 kamar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-cta">
                    <h3>Punya rumah kosong atau kamar tersedia?</h3>
                    <button class="btn-primary">
                        Daftarkan sekarang
                    </button>
                </div>
                <div class="footer-contact">
                    <h3>Kontak Kami</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-envelope"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <p>Copyright 2025 - Develop By NaZMa Office</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>