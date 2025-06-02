<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - MANDHAPA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/cart.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

            <div class="cart-header" style="text-align:center; margin: 38px 0 18px 0;">
                <h1 style="font-size:1.2rem; font-weight:600; color:#22223b; margin-bottom:2px;">Keranjang Pemesanan</h1>
                <p style="font-size:0.98rem; color:#64748b;">Daftar kamar yang telah Anda masukkan ke dalam keranjang pemesanan.</p>
            </div>

            <div class="cart-content" style="max-width:900px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(44,47,117,0.07); padding:0; margin-bottom:40px; overflow:hidden;">
                @if($booking && $booking->bookingDetails->count())
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
                                    <i class="bx bx-map"></i>
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
                                        <span>1</span>
                                        <p class="text-xs text-gray-500 mt-1">*Hanya tersedia 1 kamar</p>
                                    </div>
                                @else
                                    <div class="quantity-controls">
                                        <button type="button" 
                                                class="qty-btn decrease" 
                                                data-detail-id="{{ $detail->id }}"
                                                {{ $detail->quantity <= 1 ? 'disabled' : '' }}>
                                            -
                                        </button>
                                        <input type="text" 
                                               value="{{ $detail->quantity }}" 
                                               class="quantity-input"
                                               readonly>
                                        <button type="button" 
                                                class="qty-btn increase" 
                                                data-detail-id="{{ $detail->id }}"
                                                {{ $detail->quantity >= $detail->room->total_rooms ? 'disabled' : '' }}>
                                            +
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
                    <div class="cart-checkout-bar" style="padding: 24px 32px 32px 32px; background: #fff; border-top: 1.5px solid #e2e8f0; display: flex; justify-content: flex-end; align-items: center; gap: 18px; flex-wrap: wrap;">
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
                        <form method="POST" action="{{ route('cart.checkout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-primary btn-checkout" style="font-size:1.1rem;padding:12px 38px;">
                                Checkout
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
    const qtyButtons = document.querySelectorAll('.qty-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    qtyButtons.forEach(button => {
        button.addEventListener('click', async function() {
            if (this.disabled) return;
            
            const detailId = this.dataset.detailId;
            const action = this.classList.contains('increase') ? 'increment' : 'decrement';
            const quantityInput = this.parentElement.querySelector('.quantity-input');
            const currentQty = parseInt(quantityInput.value);
            
            // Disable button during process
            this.disabled = true;
            
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
                    // Update quantity
                    quantityInput.value = data.quantity;
                    
                    // Update prices
                    updatePrices(this, data);
                    
                    // Update button states
                    updateButtonStates(this.parentElement, data);
                } else {
                    // Show error message
                    showErrorMessage(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                showErrorMessage('Terjadi kesalahan saat memperbarui keranjang');
            } finally {
                // Re-enable button
                this.disabled = false;
            }
        });
    });

    function updatePrices(button, data) {
        const cartItem = button.closest('.cart-item');
        const priceCell = cartItem.querySelector('.total-price');
        
        // Update item subtotal
        priceCell.textContent = `Rp ${numberFormat(data.subtotal_price)}`;
        
        // Update summary prices
        document.querySelector('.price-row:nth-child(1) span:last-child').textContent = 
            `Rp ${numberFormat(data.total_base_price)}`;
        document.querySelector('.price-row:nth-child(2) span:last-child').textContent = 
            `Rp ${numberFormat(data.service_price)}`;
        document.querySelector('.price-row.total span:last-child').textContent = 
            `Rp ${numberFormat(data.total_price)}`;
    }

    function updateButtonStates(container, data) {
        const decreaseBtn = container.querySelector('.decrease');
        const increaseBtn = container.querySelector('.increase');
        
        decreaseBtn.disabled = data.quantity <= 1;
        increaseBtn.disabled = data.quantity >= data.max_rooms;
    }

    function showErrorMessage(message) {
        // Create error alert
        const alert = document.createElement('div');
        alert.className = 'alert alert-error';
        alert.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #fee2e2;
            border: 1px solid #ef4444;
            color: #dc2626;
            padding: 12px 20px;
            border-radius: 6px;
            z-index: 1000;
        `;
        alert.textContent = message;

        document.body.appendChild(alert);

        // Remove after 3 seconds
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }
});

function numberFormat(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}
</script>
</body>
</html>