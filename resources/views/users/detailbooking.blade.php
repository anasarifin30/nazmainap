<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Booking</title>
    @vite(['resources/css/detailbooking.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <x-header></x-header>
    <div class="confirmation-container">
        <div class="confirmation-header">
            <h1>Ringkasan Pemesanan</h1>
            <p class="booking-id">ID Pesanan: #{{ $riwayat->id }}</p>
        </div>

        <div class="confirmation-card">
            <!-- Add Timer at the top -->
            @if($riwayat->status == 'belum dibayar')
                <div class="countdown-wrapper">
                    <div class="countdown-timer">
                        <i class="fas fa-clock"></i>
                        <span>Selesaikan pembayaran dalam:</span>
                        <div id="countdown">
                            {{ gmdate('i:s', isset($remaining_seconds) && $remaining_seconds > 0 ? $remaining_seconds : 600) }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Homestay & Gambar -->
            <div class="room-details">
                <div class="room-image">
                    <img src="{{ ($riwayat->homestay && $riwayat->homestay->coverPhoto && $riwayat->homestay->coverPhoto->photo_path)
                        ? asset('storage/images-homestay/' . $riwayat->homestay->coverPhoto->photo_path)
                        : asset('storage/images-homestay/default-homestay.jpg') }}"
                        alt="{{ $riwayat->homestay->name ?? '-' }}">
                </div>
                <div class="room-info">
                    <div class="booking-status status-{{ strtolower(str_replace(' ', '-', $riwayat->status)) }}">
                        @if($riwayat->status == 'selesai')
                            <i class="fas fa-check-circle"></i> Selesai
                        @elseif($riwayat->status == 'aktif')
                            <i class="fas fa-clock"></i> Aktif
                        @elseif($riwayat->status == 'dibatalkan')
                            <i class="fas fa-times-circle"></i> Dibatalkan
                        @elseif($riwayat->status == 'menunggu')
                            <i class="fas fa-hourglass-half"></i> Menunggu
                        @elseif($riwayat->status == 'belum dibayar')
                            <i class="fas fa-exclamation-circle"></i> Belum Dibayar
                        @else
                            {{ ucfirst($riwayat->status) }}
                        @endif
                    </div>
                    <div class="homestay-title-row">
                        <h2 class="homestay-title">{{ $riwayat->homestay->name ?? '-' }}</h2>
                    </div>
                    <p class="hotel-name">{{ $riwayat->homestay->kabupaten ?? '-' }}, {{ $riwayat->homestay->provinsi ?? '-' }}</p>
                    <div class="amenities">
                        @if($riwayat->homestay && $riwayat->homestay->facilities)
                            @foreach($riwayat->homestay->facilities as $facility)
                                <span><i class="fas fa-check"></i> {{ $facility->name }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Daftar Kamar Dipesan -->
            <div class="booking-details">
                <h3>Daftar Kamar Dipesan</h3>
                <table style="width:100%;margin-bottom:10px;">
                    <thead>
                        <tr style="background:#f7f7f7;">
                            <th style="text-align:left;padding:6px 8px;">Kamar</th>
                            <th style="text-align:center;padding:6px 8px;">Jumlah</th>
                            <th style="text-align:center;padding:6px 8px;">Harga/Malam</th>
                            <th style="text-align:center;padding:6px 8px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat->bookingDetails as $detail)
                            <tr>
                                <td style="padding:6px 8px;">{{ $detail->room->name ?? '-' }}</td>
                                <td style="text-align:center;padding:6px 8px;">{{ $detail->quantity }}</td>
                                <td style="text-align:center;padding:6px 8px;">Rp {{ number_format($detail->price_per_night, 0, ',', '.') }}</td>
                                <td style="text-align:center;padding:6px 8px;">
                                    Rp {{ number_format($detail->subtotal_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="font-size:13px;color:#888;">
                    Durasi: {{ \Carbon\Carbon::parse($riwayat->check_in)->diffInDays(\Carbon\Carbon::parse($riwayat->check_out)) }} malam
                </div>
            </div>

            <!-- Rincian Harga -->
            <div class="price-details">
                <h3>Rincian Harga</h3>
                <div class="price-row">
                    <div class="price-label">Subtotal</div>
                    <div class="price-value">Rp {{ number_format($riwayat->base_price, 0, ',', '.') }}</div>
                </div>
                <div class="price-row">
                    <div class="price-label">Biaya Layanan</div>
                    <div class="price-value">Rp {{ number_format($riwayat->service_price, 0, ',', '.') }}</div>
                </div>
                <div class="price-row total">
                    <div class="price-label">Total Pembayaran</div>
                    <div class="price-value">Rp {{ number_format($riwayat->total_price, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Data Pemesan -->
            <div class="guest-details">
                <h3>Detail Pemesan</h3>
                <div class="detail-row">
                    <div class="detail-label">Nama Lengkap</div>
                    <div class="detail-value">{{ $riwayat->user->name ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ $riwayat->user->email ?? '-' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Nomor Telepon</div>
                    <div class="detail-value">{{ $riwayat->user->nomorhp ?? '-' }}</div>
                </div>
            </div>

            <!-- Tanggal Check-in/out -->
            <div class="guest-details">
                <h3>Tanggal Menginap</h3>
                <div class="detail-row">
                    <div class="detail-label">Check-in</div>
                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($riwayat->check_in)->format('d M Y') }} <span style="color:#888;font-size:13px;">(14:00 WIB)</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Check-out</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($riwayat->check_out)->format('d M Y') }} <span style="color:#888;font-size:13px;">(12:00 WIB)</span></div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            @if($riwayat->status == 'belum dibayar')
                <div class="action-buttons">
                    <a href="{{ route('users.historycart') }}" class="btn-secondary">Kembali</a>
                    <button type="button" class="btn-primary" id="btn-bayar"
                        data-url="{{ route('bookings.pay', $riwayat->id) }}">
                        Bayar
                    </button>
                </div>
            @elseif(in_array($riwayat->status, ['menunggu', 'aktif', 'selesai', 'dibatalkan']))
                <div class="action-buttons">
                    <a href="{{ route('users.historycart') }}" class="btn-secondary">Kembali</a>
                    <a href="{{ route('bookings.invoice', $riwayat->id) }}" class="btn-primary" target="_blank">
                        <i class="fas fa-download"></i> Unduh Invoice
                    </a>
                </div>
            @endif
        </div>
    </div>



    <script>
document.addEventListener('DOMContentLoaded', function() {
    const btnBayar = document.getElementById('btn-bayar');
    if (btnBayar) {
        btnBayar.disabled = false;
        btnBayar.addEventListener('click', async function() {
            btnBayar.disabled = true;
            btnBayar.textContent = 'Memproses...';
            try {
                const response = await fetch(btnBayar.dataset.url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();
                if (data.status === 'success' && data.snap_token) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: async function(result) {
                            await updatePaymentStatus('settlement', result.payment_type);
                        },
                        onPending: function(result) {},
                        onError: async function(result) {
                            if (result.status_code === "407") {
                                await Swal.fire({
                                    icon: 'error',
                                    title: 'Pembayaran Gagal',
                                    text: 'Waktu pembayaran telah habis.',
                                    confirmButtonColor: '#0B3B86'
                                });
                                window.location.href = "{{ route('users.historycart') }}";
                            }
                        },
                        onClose: function() {
                            window.location.reload();
                        }
                    });
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                    btnBayar.disabled = false;
                    btnBayar.textContent = 'Bayar';
                }
            } catch (err) {
                alert('Terjadi kesalahan saat memproses pembayaran');
                btnBayar.disabled = false;
                btnBayar.textContent = 'Bayar';
            }
        });
    }

    async function updatePaymentStatus(status, paymentMethod = null) {
        try {
            const response = await fetch("{{ route('bookings.update-status', $riwayat->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ payment_status: status, payment_method: paymentMethod })
            });
            const data = await response.json();
            if (data.success) {
                window.location.reload();
            } else {
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    confirmButtonColor: '#0B3B86'
                });
            }
        } catch (error) {
            console.error('There was a problem with your fetch operation:', error);
        }
    }

    // Timer
    const countdownDisplay = document.getElementById('countdown');
    let remainingSeconds = {{ isset($remaining_seconds) && $remaining_seconds > 0 ? (int)$remaining_seconds : 600 }};
    if (countdownDisplay && "{{ $riwayat->status }}" === "belum dibayar") {
        startCountdown(remainingSeconds, countdownDisplay);
    }

    function startCountdown(seconds, display) {
        let timer = seconds;
        updateDisplay(timer, display);
        const interval = setInterval(function() {
            timer--;
            updateDisplay(timer, display);
            if (timer <= 0) {
                clearInterval(interval);
                autoCancelBooking();
            }
        }, 1000);
    }

    function updateDisplay(timer, display) {
        const minutes = Math.floor(timer / 60);
        const seconds = timer % 60;
        display.textContent = (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
    }

    async function autoCancelBooking() {
        try {
            await fetch("{{ route('bookings.update-status', $riwayat->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ payment_status: 'expire' })
            });
        } catch (e) {}
        window.location.reload();
    }
});
</script>
</body>
</html>
