<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Katalog Homestay - Nazmainap</title>
  @vite(['resources/css/kataloghomestay.css'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container">
      <a href="/" class="logo">NAZMAINAP</a>
      <div class="nav-links">
        <a href="/" class="active">Beranda</a>
        <a href="#about">Tentang</a>
        <a href="#contact">Bantuan</a>
      </div>
      <div class="menu-toggle" id="mobile-menu-button">
        <i class="fas fa-bars"></i>
      </div>
      <div class="login-btn">
        <a href="#">Masuk</a>
      </div>
    </div>
    <div class="mobile-menu hidden" id="mobile-menu">
      <a href="/" class="active">Beranda</a>
      <a href="#about">Tentang</a>
      <a href="#contact">Bantuan</a>
      <a href="#" class="btn">Masuk</a>
    </div>
  </nav>

  <!-- Search -->
  <section class="search-section">
    <div class="search-box">
      <i class="fas fa-search search-icon"></i>
      <input type="text" placeholder="Lokasi" />
      <button class="search-button">Cari</button>
    </div>
  </section>

  <!-- Catalog -->
  <section class="catalog">
    <div class="container">
      <h1>Katalog Homestay di Pacitan</h1>
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
        <!-- Tambahkan item lain di sini -->
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <a href="#"><i class="fas fa-chevron-left"></i></a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <span>...</span>
        <a href="#">8</a>
        <a href="#"><i class="fas fa-chevron-right"></i></a>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-section">
    <div class="container">
      <h3>Punya rumah kosong atau kamar tersedia?</h3>
      <a href="#" class="btn">Daftarkan sekarang</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>Copyright 2025 - Developed by Nazma Office</p>
      <div class="footer-contact">
        <h3>Kontak Kami</h3>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
