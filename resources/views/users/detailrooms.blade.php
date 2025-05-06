<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - Hacienda Watukarung</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/detailrooms.css'])
</head>
<body>
    <!-- Header -->
    <x-header></x-header>
    <!-- Main Content -->
    <main>
        <!-- Rooms Images -->
        <div class="image-grid">
            <div class="main-image-container">
                <img src="room-main.jpg" alt="Hacienda Watukarung Villa" class="main-image">
            </div>
            <div class="thumbnail-grid">
                <div class="thumbnail-container">
                    <img src="hammock.jpg" alt="Villa Hammock" class="thumbnail">
                </div>
                <div class="thumbnail-overlay">
                    <img src="pool.jpg" alt="Villa Pool" class="thumbnail">
                    <div class="overlay-content">
                        <button class="view-all-btn">Lihat semua foto</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <!-- Room Details -->
            <div class="room-details">
                <h1 class="room-title">Hacienda Watukarung</h1>
                <p class="room-description">
                    Kamar nyaman dengan pemandangan taman, cocok untuk pasangan
                </p>

            <!-- Booking Section -->
            <div class="booking-section">
                <div class="price">Rp 200.000</div>

                <div class="form-group">
                    <label class="form-label">Tanggal Masuk</label>
                    <div class="form-input-container">
                        <input type="text" placeholder="dd-mm-yy" class="form-input">
                        <i class="far fa-calendar form-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Keluar</label>
                    <div class="form-input-container">
                        <input type="text" placeholder="dd-mm-yy" class="form-input">
                        <i class="far fa-calendar form-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Jumlah Tamu</label>
                    <input type="number" placeholder="2" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Periode</label>
                    <input type="number" placeholder="2" class="form-input">
                </div>

                <button class="btn btn-primary">Pesan Sekarang</button>
                <button class="btn btn-secondary">Hubungi Pemilik</button>
            </div>
        </div>

       
            </div>
        </section>
    </main>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>