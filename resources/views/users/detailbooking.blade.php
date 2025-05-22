<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    @vite(['resources/css/confirpayment.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <x-header></x-header>
<div class="confirmation-container">
    <div class="confirmation-header">
        <h1>Ringkasan Pemesanan</h1>
        <p class="booking-id">ID Pesanan: #123456789</p>
    </div>

    <div class="confirmation-card">
        <div class="room-details">
            <div class="room-image">
                <img src="images/homestay.jpg" alt="Kamar Hotel">
            </div>
            <div class="room-info">
                <h2>Deluxe Room</h2>
                <p class="hotel-name">Hotel Nyaman</p>
                <div class="amenities">
                    <span><i class="fas fa-wifi"></i> WiFi</span>
                    <span><i class="fas fa-coffee"></i> Sarapan</span>
                    <span><i class="fas fa-snowflake"></i> AC</span>
                </div>
            </div>
        </div>

        <div class="booking-details">
            <div class="detail-row">
                <div class="detail-label">Check-in</div>
                <div class="detail-value">21 Mei 2025</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Check-out</div>
                <div class="detail-value">22 Mei 2025</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Jumlah Tamu</div>
                <div class="detail-value">1 Tamu</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Durasi</div>
                <div class="detail-value">1 Malam</div>
            </div>
        </div>

        <div class="price-details">
            <h3>Rincian Harga</h3>
            <div class="price-row">
                <div class="price-label">Harga kamar (1 malam)</div>
                <div class="price-value">Rp 259.663</div>
            </div>
            <div class="price-row">
                <div class="price-label">Pajak dan biaya layanan</div>
                <div class="price-value">Rp 25.966</div>
            </div>
            <div class="price-row total">
                <div class="price-label">Total Pembayaran</div>
                <div class="price-value">Rp 285.629</div>
            </div>
        </div>

        <div class="guest-details">
            <h3>Detail Pemesan</h3>
            <div class="detail-row">
                <div class="detail-label">Nama Lengkap</div>
                <div class="detail-value">Budi Santoso</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Email</div>
                <div class="detail-value">budi.santoso@email.com</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Nomor Telepon</div>
                <div class="detail-value">+62 812-3456-7890</div>
            </div>
        </div>

        <div class="terms-conditions">
            <input type="checkbox" id="terms" required>
            <label for="terms">Saya setuju dengan <a href="#">Syarat dan Ketentuan</a> pemesanan</label>
        </div>

        <div class="action-buttons">
            <a href="#" class="btn-secondary">Kembali</a>
            <form action="#" method="POST">
                <input type="hidden" name="booking_id" value="123456789">
                <button type="submit" class="btn-primary">Konfirmasi dan Bayar</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<x-footer></x-footer>
</body>
</html>