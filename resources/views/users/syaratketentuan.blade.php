<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan</title>
    @vite(['resources/css/syaratketentuan.css'])
</head>
<body>
    <x-header></x-header>
    <div class="terms-container">
        <h1>Syarat &amp; Ketentuan Pemesanan</h1>
        <ol>
            <li>
                <b>Pemesanan</b><br>
                Pemesanan hanya dapat dilakukan oleh pengguna terdaftar dan wajib mengisi data dengan benar.
            </li>
            <li>
                <b>Pembayaran</b><br>
                Pembayaran harus dilakukan sesuai nominal dan metode yang tersedia. Bukti pembayaran wajib diunggah jika diminta.
            </li>
            <li>
                <b>Pembatalan</b><br>
                Pembatalan pesanan dapat dilakukan sebelum tanggal check-in. Dana akan dikembalikan sesuai kebijakan refund.
            </li>
            <li>
                <b>Check-in &amp; Check-out</b><br>
                Tamu wajib check-in dan check-out sesuai waktu yang tertera pada pesanan.
            </li>
            <li>
                <b>Peraturan Homestay</b><br>
                Tamu wajib mematuhi peraturan homestay yang berlaku. Kerusakan atau kehilangan menjadi tanggung jawab tamu.
            </li>
            <li>
                <b>Lain-lain</b><br>
                Syarat &amp; ketentuan dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya.
            </li>
        </ol>
        <a href="{{ url()->previous() }}" class="btn-back">Kembali</a>
    </div>
    <x-footer></x-footer>
</body>
</html>