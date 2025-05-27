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


        <div class="container">
            <div class="cart-header" style="text-align:center; margin: 38px 0 18px 0;">
                <h1 style="font-size:1.2rem; font-weight:600; color:#22223b; margin-bottom:2px;">Keranjang Pemesanan</h1>
                <p style="font-size:0.98rem; color:#64748b;">Kelola pemesanan kamar homestay Anda</p>
            </div>

            <div class="cart-content" style="max-width:900px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(44,47,117,0.07); padding:0; margin-bottom:40px; overflow:hidden;">
                @if($booking && $booking->bookingDetails->count())
                    <!-- Homestay Info -->
                    <div class="homestay-info" style="padding:28px 32px 16px 32px;">
                        <div class="homestay-image">
                            <img src="{{ $booking->homestay->coverPhoto ? asset('storage/images-homestay/'.$booking->homestay->coverPhoto->photo_path) : asset('storage/images-homestay/default-homestay.jpg') }}" alt="{{ $booking->homestay->name }}">
                        </div>
                        <div class="homestay-details">
                            <h2>{{ $booking->homestay->name }}</h2>
                            <p class="homestay-location">{{ $booking->homestay->kabupaten }}, {{ $booking->homestay->provinsi }}</p>
                        </div>
                    </div>

                    <!-- Cart Items -->
                    <div class="cart-items">
                        @foreach($booking->bookingDetails as $detail)
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="{{ $detail->room->roomPhotos->where('is_cover',1)->first() ? asset('storage/images-room/'.$detail->room->roomPhotos->where('is_cover',1)->first()->photo_path) : asset('storage/images-room/default-room.jpg') }}" alt="{{ $detail->room->name }}">
                            </div>
                            <div class="item-details">
                                <h4>{{ $detail->room->name }}</h4>
                                <div class="item-price">Rp {{ number_format($detail->price_per_night,0,',','.') }}/malam</div>
                            </div>
                            <div class="item-quantity">
                                <label>Jumlah:</label>
                                <form method="POST" action="{{ route('cart.update', $detail->id) }}" style="display:flex;align-items:center;gap:6px;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="action" value="decrement" class="qty-btn" {{ $detail->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                    <input type="text" name="quantity" value="{{ $detail->quantity }}" readonly style="width:32px;text-align:center;font-weight:600;">
                                    <button type="submit" name="action" value="increment" class="qty-btn" {{ $detail->quantity >= $detail->room->max_guests ? 'disabled' : '' }}>+</button>
                                </form>
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
                        <span class="cart-total-label" style="font-size:1.08rem; color:#22223b;">
                            Total Keranjang:
                            <span id="cart-grand-total" style="font-weight:600; color:#e65100; margin-left:6px;">
                                Rp {{ number_format($booking->total_price,0,',','.') }}
                            </span>
                        </span>
                        <a class="btn-primary btn-checkout" style="font-size:1.1rem;padding:12px 38px;" href="#">
                            Checkout
                        </a>
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
</body>
</html>