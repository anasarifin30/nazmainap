<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran - NAZMAINAP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    @vite(['resources/css/confirpayment.css'])
</head>
<body>
    <!-- Header -->
    <x-header></x-header>

    <!-- Main Content -->
    <div class="payment-container">
        <div class="breadcrumb">
            Beranda <span class="mx-2">></span> Pemesanan <span class="mx-2">></span> Konfirmasi Pembayaran
        </div>
        
        <div class="payment-content">
            <!-- Payment Header -->
            <div class="payment-header">
                <h1 class="payment-title">Konfirmasi Pembayaran</h1>
                <div class="payment-status status-pending">Menunggu Pembayaran</div>
            </div>
            
            <!-- Booking Details Section -->
            <div class="payment-section">
                <h2 class="section-title">Detail Pesanan</h2>
                <div class="booking-details">
                    <div class="booking-info">
                        <h3 class="booking-title">Villa Sunset Indah</h3>
                        <div class="booking-meta">
                            <div class="meta-item">
                                Check-in: <span>12 Jun 2025, 14:00</span>
                            </div>
                            <div class="meta-item">
                                Check-out: <span>15 Jun 2025, 12:00</span>
                            </div>
                            <div class="meta-item">
                                Tamu: <span>2 Dewasa, 1 Anak</span>
                            </div>
                            <div class="meta-item">
                                Total Pembayaran: <span>Rp 1.375.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Payment Button -->
            <div class="payment-section">
                <h2 class="section-title">Lanjutkan Pembayaran</h2>
                <div class="action-buttons">
                    <button id="pay-button" class="btn btn-confirm">
                        Bayar Sekarang <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer></x-footer>

    <!-- Midtrans Script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            // Replace 'YOUR_TRANSACTION_TOKEN' with the actual token from your backend
            window.snap.pay('YOUR_TRANSACTION_TOKEN', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log(result);
                    // Redirect to success page
                    window.location.href = "/payment-success";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                },
                onClose: function() {
                    alert("Anda menutup popup pembayaran!");
                }
            });
        });
    </script>
</body>
</html>