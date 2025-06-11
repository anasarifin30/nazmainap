<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - MANDHAPA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/cart.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- Header -->
   <x-header></x-header>


        <div class="container">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
             @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif


            <div class="cart-header" style="text-align:center; margin: 38px 0 18px 0;">
                <h1 style="font-size:1.2rem; font-weight:600; color:#22223b; margin-bottom:2px;">Keranjang Pemesanan</h1>
                <p style="font-size:0.98rem; color:#64748b;">Daftar kamar yang telah Anda masukkan ke dalam keranjang pemesanan.</p>
            </div>

            <div class="cart-content" style="max-width:900px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(44,47,117,0.07); padding:0; margin-bottom:40px; overflow:hidden;">
                @if($booking && $booking->bookingDetails->count() > 0) {{-- Pastikan ada bookingDetails --}}
                    <!-- Homestay Info -->
                    <div class="homestay-info">
                        <a href="{{ route('homestays.show', $booking->homestay->id) }}" class="homestay-link">
                            <div class="homestay-image">
                                <img src="{{ $booking->homestay->coverPhoto ? asset('storage/images-homestay/'.$booking->homestay->coverPhoto->photo_path) : asset('storage/images-homestay/default-homestay.jpg') }}"
                                     alt="{{ $booking->homestay->name }}">
                            </div>
                            <div class="homestay-details">
                                <h2>{{ $booking->homestay->name }}</h2>
                                <p class="homestay-location">
                                    {{ $booking->homestay->kabupaten }}, {{ $booking->homestay->provinsi }}
                                </p>

                                <div class="booking-dates">
                                    <div class="booking-dates-grid">
                                        <div class="date-info">
                                            <span class="date-label">Check-in</span>
                                            <span class="date-value">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</span>
                                        </div>
                                        <div class="date-info">
                                            <span class="date-label">Check-out</span>
                                            <span class="date-value">{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Cart Items -->
                    <div class="cart-items">
                        <div class="cart-items-header">
                            <div>Detail Kamar</div>
                            <div>Jumlah</div>
                            <div>Harga</div>
                            <div></div>
                        </div>
                        @foreach($booking->bookingDetails as $detail)
                        <div class="cart-item">
                            <a href="{{ route('rooms.show', $detail->room->id) }}" class="item-link">
                                <div class="item-image">
                                    <img src="{{ $detail->room->roomPhotos->where('is_cover',1)->first() ? asset('storage/images-room/'.$detail->room->roomPhotos->where('is_cover',1)->first()->photo_path) : asset('storage/images-room/default-room.jpg') }}"
                                         alt="{{ $detail->room->name }}">
                                </div>
                                <div class="item-details">
                                    <h4>{{ $detail->room->name }}</h4>
                                    <div class="item-price">Rp {{ number_format($detail->price_per_night,0,',','.') }}/malam</div>
                                    <div class="room-info">
                                        <div class="room-capacity">
                                            <i class="bx bx-user"></i>
                                            <span>*Maks {{ $detail->room->max_guests }} tamu/kamar</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="item-quantity">
                                <label>Jumlah Kamar:</label>
                                @if($detail->room->total_rooms == 1)
                                    <div class="quantity-value">
                                        <span class="quantity-number">1</span>
                                        <p class="room-availability-note">*Hanya tersedia 1 kamar</p>
                                    </div>
                                @else
                                    <div class="quantity-controls" data-max-rooms="{{ $detail->room->total_rooms }}">
                                        <button type="button"
                                                class="qty-btn decrease"
                                                data-detail-id="{{ $detail->id }}"
                                                title="Kurangi jumlah kamar">
                                            <i class='bx bx-minus'></i>
                                        </button>
                                        <input type="text"
                                               value="{{ $detail->quantity }}"
                                               class="quantity-input"
                                               readonly>
                                        <button type="button"
                                                class="qty-btn increase"
                                                data-detail-id="{{ $detail->id }}"
                                                title="Tambah jumlah kamar">
                                            <i class='bx bx-plus'></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="total-price">
                                Rp {{ number_format($detail->subtotal_price,0,',','.') }}
                            </div>
                            <div class="item-actions">
                                <form method="POST" action="{{ route('cart.remove', $detail->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-remove" type="submit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3,6 5,6 21,6"></polyline>
                                            <path d="m19,6v14a2,2 0 0,1-2,2H7a2,2 0 0,1-2-2V6m3,0V4a2,2 0 0,1,2-2h4a2,2 0 0,1,2,2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Checkout & Total -->
                    <div class="cart-checkout-bar">
    <div class="terms-conditions">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">
            Saya setuju dengan <a href="{{ route('users.syaratketentuan') }}" target="_blank">Syarat dan Ketentuan</a> pemesanan
        </label>
    </div>

    <div class="price-breakdown">
        <div class="price-row">
            <span>Subtotal Kamar</span>
            <span>Rp {{ number_format($booking->base_price,0,',','.') }}</span>
        </div>
        <div class="price-row">
            <span>Biaya Layanan (5%)</span>
            <span>Rp {{ number_format($booking->service_price,0,',','.') }}</span>
        </div>
        <div class="price-row total">
            <span>Total Pembayaran</span>
            <span>Rp {{ number_format($booking->total_price,0,',','.') }}</span>
        </div>
    </div>

    <form method="POST" action="{{ route('cart.checkout') }}" id="checkoutForm">
        @csrf
        <button type="submit" class="btn-checkout" id="btn-checkout" disabled>
            <span class="button-text">Checkout</span>
            <div class="loading-spinner">
                <i class='bx bx-loader-alt'></i>
            </div>
        </button>
    </form>
</div>
                @else
                    <div class="empty-cart" id="emptyCart">
                        <div class="empty-cart-icon">🏠</div>
                        <h3>Belum Ada Kamar Dipilih</h3>
                        <p>Pilih tipe kamar yang tersedia!</p>
                        <a href="{{ route('users.kataloghomestay') }}" class="btn-primary">Pilih Kamar</a>
                    </div>
                @endif
            </div>
        </div>


    <!-- Footer -->
    <x-footer></x-footer>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('terms');
    const checkoutButton = document.getElementById('btn-checkout');
    const checkoutForm = document.getElementById('checkoutForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Initialize button state
    if (checkoutButton && termsCheckbox) {
        checkoutButton.disabled = !termsCheckbox.checked;
        updateButtonStyle();

        // Add event listener to checkbox
        termsCheckbox.addEventListener('change', function() {
            checkoutButton.disabled = !this.checked;
            updateButtonStyle();
        });
    }

    function updateButtonStyle() {
        if (checkoutButton.disabled) {
            checkoutButton.style.backgroundColor = '#cbd5e1';
            checkoutButton.style.cursor = 'not-allowed';
            checkoutButton.style.transform = 'none';
        } else {
            checkoutButton.style.backgroundColor = '#e65100';
            checkoutButton.style.cursor = 'pointer';
        }
    }

    // =====================================
    // QUANTITY CONTROLS
    // =====================================
    const quantityButtons = document.querySelectorAll('.qty-btn');
    
    quantityButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const detailId = this.dataset.detailId;
            const action = this.classList.contains('increase') ? 'increment' : 'decrement';
            const cartItem = this.closest('.cart-item');
            const quantityInput = cartItem.querySelector('.quantity-input');
            const totalPriceElement = cartItem.querySelector('.total-price');
            
            // Disable button sementara
            this.disabled = true;
            this.style.opacity = '0.6';
            
            try {
                const response = await fetch(`/cart/update/${detailId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ action: action })
                });

                const data = await response.json();

                if (data.success) {
                    // Update quantity input
                    quantityInput.value = data.quantity;
                    
                    // Update total price for this item
                    totalPriceElement.textContent = `Rp ${data.subtotal_price.toLocaleString('id-ID')}`;
                    
                    // Update overall totals
                    updateCartTotals(data);
                    
                    // Update button states
                    updateQuantityButtons(cartItem, data.quantity, data.max_rooms);
                    
                    showSuccessMessage('Jumlah kamar berhasil diperbarui');
                } else {
                    showErrorMessage(data.message || 'Gagal memperbarui jumlah kamar');
                }
            } catch (error) {
                console.error('Update error:', error);
                showErrorMessage('Terjadi kesalahan saat memperbarui keranjang');
            } finally {
                // Re-enable button
                this.disabled = false;
                this.style.opacity = '1';
            }
        });
    });

    function updateCartTotals(data) {
        // Update subtotal kamar
        const subtotalElement = document.querySelector('.price-row:nth-child(1) span:last-child');
        if (subtotalElement) {
            subtotalElement.textContent = `Rp ${data.total_base_price.toLocaleString('id-ID')}`;
        }
        
        // Update biaya layanan
        const serviceElement = document.querySelector('.price-row:nth-child(2) span:last-child');
        if (serviceElement) {
            serviceElement.textContent = `Rp ${data.service_price.toLocaleString('id-ID')}`;
        }
        
        // Update total pembayaran
        const totalElement = document.querySelector('.price-row.total span:last-child');
        if (totalElement) {
            totalElement.textContent = `Rp ${data.total_price.toLocaleString('id-ID')}`;
        }
    }

    function updateQuantityButtons(cartItem, currentQuantity, maxRooms) {
        const decreaseBtn = cartItem.querySelector('.qty-btn.decrease');
        const increaseBtn = cartItem.querySelector('.qty-btn.increase');
        
        // Update button states
        if (decreaseBtn) {
            decreaseBtn.disabled = currentQuantity <= 1;
            decreaseBtn.style.opacity = currentQuantity <= 1 ? '0.5' : '1';
            decreaseBtn.style.cursor = currentQuantity <= 1 ? 'not-allowed' : 'pointer';
        }
        
        if (increaseBtn) {
            increaseBtn.disabled = currentQuantity >= maxRooms;
            increaseBtn.style.opacity = currentQuantity >= maxRooms ? '0.5' : '1';
            increaseBtn.style.cursor = currentQuantity >= maxRooms ? 'not-allowed' : 'pointer';
        }
    }

    function showSuccessMessage(message) {
        showMessage(message, 'success');
    }

    function showErrorMessage(message) {
        showMessage(message, 'error');
    }

    function showMessage(message, type) {
        // Remove existing alerts
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass}" role="alert" style="margin: 1rem 0; padding: 0.75rem 1rem; border-radius: 8px; background: ${type === 'success' ? '#d4edda' : '#f8d7da'}; color: ${type === 'success' ? '#155724' : '#721c24'}; border: 1px solid ${type === 'success' ? '#c3e6cb' : '#f5c6cb'}; font-size: 0.9rem;">
                ${message}
            </div>
        `;
        
        const container = document.querySelector('.container');
        if (container) {
            container.insertAdjacentHTML('afterbegin', alertHtml);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                const alert = container.querySelector('.alert');
                if (alert) alert.remove();
            }, 3000);
        }
    }

    // Form submit handler
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!termsCheckbox.checked) {
                showErrorMessage('Anda harus menyetujui Syarat dan Ketentuan');
                return;
            }

            const button = this.querySelector('button');
            const buttonText = button.querySelector('.button-text');
            const spinner = button.querySelector('.loading-spinner');

            try {
                // Update button state
                button.disabled = true;
                buttonText.style.display = 'none';
                spinner.style.display = 'block';

                // Submit form untuk checkout
                this.submit();

            } catch (error) {
                console.error('Checkout error:', error);
                showErrorMessage('Terjadi kesalahan saat checkout');
                
                // Reset button state
                button.disabled = false;
                buttonText.style.display = 'block';
                spinner.style.display = 'none';
            }
        });
    }

    // Initialize quantity button states on page load
    document.querySelectorAll('.cart-item').forEach(cartItem => {
        const quantityInput = cartItem.querySelector('.quantity-input');
        const maxRoomsElement = cartItem.querySelector('[data-max-rooms]');
        
        if (quantityInput && maxRoomsElement) {
            const currentQuantity = parseInt(quantityInput.value);
            const maxRooms = parseInt(maxRoomsElement.dataset.maxRooms);
            updateQuantityButtons(cartItem, currentQuantity, maxRooms);
        }
    });
});
</script>
</body>
</html>
