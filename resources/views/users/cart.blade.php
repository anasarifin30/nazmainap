<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - MANDHAPA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/cart.css'])
</head>
<body>
    <!-- Header -->
   <x-header></x-header>

    <!-- Main Content -->
    <div class="container">
        <div class="cart-header" style="text-align:center; margin: 38px 0 18px 0;">
            <h1 style="font-size:1.2rem; font-weight:600; color:#22223b; margin-bottom:2px;">Keranjang Pemesanan</h1>
            <p style="font-size:0.98rem; color:#64748b;">Kelola pemesanan kamar homestay Anda</p>
        </div>

        <div class="cart-content" style="max-width:900px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(44,47,117,0.07); padding:0; margin-bottom:40px; overflow:hidden;">
            <!-- Homestay Info -->
            <div class="homestay-info" style="padding:28px 32px 16px 32px;">
                <div class="homestay-image">
                    <img src="assets('storage/images-room/default-room.jpg')" alt="Villa Puncak Sejuk">
                </div>
                <div class="homestay-details">
                    <h2>Villa Puncak Sejuk</h2>
                    <p class="homestay-location">Jl. Pantai Klayar No. 15, Pacitan, Jawa Timur</p>
                </div>
            </div>

            <!-- Cart Items (tanpa header tabel) -->
            <div class="cart-items">
                <!-- Room Type 1 (hanya satu kamar) -->
                <div class="cart-item" style="display:flex;align-items:flex-start;gap:32px;padding:18px 32px;border-bottom:1px solid #e2e8f0;">
                    <div class="item-image">
                        <img src="https://via.placeholder.com/120x80" alt="Deluxe Room">
                    </div>
                    <div class="item-details" style="min-width:140px;">
                        <h4 style="font-size:1rem;font-weight:600;margin-bottom:2px;">Deluxe Room</h4>
                        <div class="item-price" style="font-size:0.98rem;color:#22223b;">Rp 350.000/malam</div>
                    </div>
                    <div class="item-quantity" style="margin-left:32px;">
                        <label style="font-size:0.95rem;color:#64748b;">Jumlah:</label>
                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="changeQuantity(1, -1)">-</button>
                            <span class="qty-value" id="qty-1">1</span>
                            <button class="qty-btn" onclick="changeQuantity(1, 1)">+</button>
                        </div>
                    </div>
                    <div class="total-price" id="total-1" style="font-weight:600;color:#e65100;margin-left:32px;">Rp 700.000</div>
                    <div class="item-actions" style="margin-left:32px;">
                        <button class="btn-remove" onclick="removeItem(1)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3,6 5,6 21,6"></polyline>
                                <path d="m19,6v14a2,2 0 0,1-2,2H7a2,2 0 0,1-2-2V6m3,0V4a2,2 0 0,1,2-2h4a2,2 0 0,1,2,2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>

                <!-- Empty Cart Message (hidden by default) -->
                <div class="empty-cart" id="emptyCart" style="display: none;">
                    <div class="empty-cart-icon">🏠</div>
                    <h3>Belum Ada Kamar Dipilih</h3>
                    <p>Pilih tipe kamar yang tersedia di Villa Puncak Sejuk!</p>
                    <a href="#" class="btn-primary">Pilih Kamar</a>
                </div>
            </div>

            <!-- Checkout & Total -->
            <div class="cart-checkout-bar" style="padding: 24px 32px 32px 32px; background: #fff; border-top: 1.5px solid #e2e8f0; display: flex; justify-content: flex-end; align-items: center; gap: 18px; flex-wrap: wrap;">
                <span class="cart-total-label" style="font-size:1.08rem; color:#22223b;">
                    Total Keranjang:
                    <span id="cart-grand-total" style="font-weight:600; color:#e65100; margin-left:6px;">
                        Rp 700.000
                    </span>
                </span>
                <button class="btn-primary btn-checkout" style="font-size:1.1rem;padding:12px 38px;" onclick="window.location.href='#'">
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <script>
        function changeQuantity(roomId, change) {
            const qtyElement = document.getElementById(`qty-${roomId}`);
            const totalElement = document.getElementById(`total-${roomId}`);
            let currentQty = parseInt(qtyElement.textContent);

            currentQty += change;
            if (currentQty < 1) currentQty = 1;
            if (currentQty > 5) currentQty = 5; // Maximum 5 rooms

            qtyElement.textContent = currentQty;

            // Update price based on room type
            let pricePerNight = 350000; // hanya satu kamar: Deluxe Room
            const totalPrice = pricePerNight * currentQty * 2; // 2 nights
            totalElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;

            updateCartTotal();
        }

        function updateCartTotal() {
            // Hanya satu kamar
            const totalText = document.getElementById('total-1').textContent.replace(/[^\d]/g, '');
            const total = parseInt(totalText) || 0;
            document.getElementById('cart-grand-total').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        // Inisialisasi total saat load
        document.addEventListener('DOMContentLoaded', updateCartTotal);
    </script>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>