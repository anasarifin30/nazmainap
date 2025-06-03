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
                <div class="countdown-timer" style="display: none;">
                    <div class="timer-wrapper">
                        <div class="timer-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="timer-content">
                            <div class="timer-label">Selesaikan pembayaran dalam</div>
                            <div class="timer-countdown" id="countdown">10:00</div>
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

            <!-- Syarat & Tombol -->
            @if($riwayat->status == 'belum dibayar')
                <div class="terms-conditions">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">Saya setuju dengan <a href="{{ route('users.syaratketentuan') }}">Syarat dan Ketentuan</a> pemesanan</label>
                    <div id="terms-warning" style="display:none;color:#e53935;font-size:0.97rem;margin-top:6px;">
                        Silakan centang persetujuan syarat dan ketentuan terlebih dahulu.
                    </div>
                </div>
            @endif

            <div class="action-buttons">
                <a href="{{ route('users.historycart') }}" class="btn-secondary">Kembali</a>
                @if($riwayat->status == 'belum dibayar')
                    <form action="{{ route('bookings.pay', $riwayat->id) }}" method="POST" id="form-bayar">
                        @csrf
                        <button type="submit" class="btn-primary" id="btn-bayar">
                            Konfirmasi dan Bayar
                        </button>
                    </form>
                @elseif(in_array($riwayat->status, ['menunggu', 'aktif', 'selesai', 'dibatalkan']))
                    <a href="{{ route('bookings.invoice', $riwayat->id) }}" class="btn-primary" target="_blank">
                        <i class="fas fa-download"></i> Unduh Invoice
                    </a>
                @endif
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const btnBayar = document.getElementById("btn-bayar");
    const checkbox = document.getElementById("terms");
    const warning = document.getElementById("terms-warning");
    const form = document.getElementById("form-bayar");

    // Initial checkbox state
    if (btnBayar) {
        btnBayar.disabled = !checkbox?.checked;
    }

    // Checkbox event listener
    checkbox?.addEventListener('change', function() {
        if (btnBayar) {
            btnBayar.disabled = !this.checked;
            warning.style.display = 'none';
        }
    });

    // Form submit handler
    form?.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!checkbox.checked) {
            warning.style.display = 'block';
            return false;
        }

        try {
            btnBayar.disabled = true;
            btnBayar.textContent = 'Memproses...';

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');

            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            const data = await response.json();
            console.log('Payment response:', data);

            if (data.status === 'success' && data.snap_token) {
                const countdownDiv = document.querySelector('.countdown-timer');
                const countdownDisplay = document.getElementById('countdown');
                
                if (data.remaining_seconds) {
                    countdownDiv.style.display = 'block';
                    startCountdown(data.remaining_seconds, countdownDisplay);
                }

                window.snap.pay(data.snap_token, {
                    onSuccess: async function(result) {
                        localStorage.removeItem('paymentEndTime');
                        if (window.countdownInterval) {
                            clearInterval(window.countdownInterval);
                        }
                        console.log('Payment success:', result);
                        try {
                            const updateResponse = await fetch("{{ route('bookings.update-status', $riwayat->id) }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    status: 'menunggu',
                                    payment_result: result
                                })
                            });

                            if (updateResponse.ok) {
                                await Swal.fire({
                                    icon: 'success',
                                    title: 'Pembayaran Berhasil',
                                    text: 'Terima kasih atas pembayaran Anda.',
                                    confirmButtonColor: '#0B3B86'
                                });
                                window.location.href = "{{ route('users.historycart') }}";
                            } else {
                                await Swal.fire({
                                    icon: 'warning',
                                    title: 'Perhatian',
                                    text: 'Pembayaran berhasil tetapi status gagal diperbarui',
                                    confirmButtonColor: '#0B3B86'
                                });
                            }
                        } catch (error) {
                            console.error('Status update error:', error);
                            alert('Pembayaran berhasil tetapi status gagal diperbarui');
                        }
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);
                        window.location.href = "{{ route('users.historycart') }}";
                    },
                    onError: async function(result) {
                        if (result.status_code === "407") {
                            await Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: 'Waktu pembayaran telah habis.',
                                confirmButtonColor: '#0B3B86'
                            });
                            window.location.href = "{{ route('users.historycart') }}";
                        } else {
                            await Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: result.status_message || 'Terjadi kesalahan saat memproses pembayaran',
                                confirmButtonColor: '#0B3B86'
                            });
                            btnBayar.disabled = false;
                            btnBayar.textContent = 'Konfirmasi dan Bayar';
                        }
                    },
                    onClose: function() {
                        btnBayar.disabled = false;
                        btnBayar.textContent = 'Konfirmasi dan Bayar';
                    }
                });
            } else {
                console.error('Payment setup error:', data);
                alert(data.message || 'Terjadi kesalahan saat memproses pembayaran');
                btnBayar.disabled = false;
                btnBayar.textContent = 'Konfirmasi dan Bayar';
            }
        } catch (error) {
            console.error('Fetch error:', error);
            alert('Terjadi kesalahan pada sistem pembayaran');
            btnBayar.disabled = false;
            btnBayar.textContent = 'Konfirmasi dan Bayar';
        }
    });

    let globalCountdown = null;

    function startCountdown(initialSeconds, display) {
        if (globalCountdown) {
            clearInterval(globalCountdown);
        }

        let endTime = Date.now() + (initialSeconds * 1000);
        localStorage.setItem('paymentEndTime', endTime);

        function updateDisplay() {
            let now = Date.now();
            let timeLeft = Math.max(0, Math.ceil((endTime - now) / 1000));

            if (timeLeft <= 0) {
                clearInterval(globalCountdown);
                localStorage.removeItem('paymentEndTime');
                
                // Automatically cancel booking when timer expires
                cancelExpiredBooking();
                return;
            }

            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            display.textContent = formattedTime;

            if (timeLeft <= 120) {
                display.classList.add('timer-warning');
            }
        }

        updateDisplay();
        globalCountdown = setInterval(updateDisplay, 1000);
        return globalCountdown;
    }

    async function cancelExpiredBooking() {
        try {
            // Show loading state using SweetAlert2
            Swal.fire({
                title: 'Memproses Pembatalan',
                html: 'Mohon tunggu sebentar...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const response = await fetch("{{ route('bookings.cancel', $riwayat->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (data.success) {
                // Clear timer data
                localStorage.removeItem('paymentEndTime');
                
                // Update UI elements
                const paymentForm = document.getElementById('form-bayar');
                const countdownTimer = document.querySelector('.countdown-timer');
                const termsConditions = document.querySelector('.terms-conditions');
                
                if (paymentForm) paymentForm.style.display = 'none';
                if (countdownTimer) countdownTimer.style.display = 'none';
                if (termsConditions) termsConditions.style.display = 'none';

                // Update status display
                const statusElement = document.querySelector('.booking-status');
                if (statusElement) {
                    statusElement.className = 'booking-status status-dibatalkan';
                    statusElement.innerHTML = '<i class="fas fa-times-circle"></i> Dibatalkan';
                }

                // Show success message and redirect
                await Swal.fire({
                    icon: 'info',
                    title: 'Pemesanan Dibatalkan',
                    text: 'Waktu pembayaran telah habis. Pemesanan otomatis dibatalkan.',
                    confirmButtonColor: '#0B3B86',
                    allowOutsideClick: false
                });

                window.location.href = data.redirect;
            } else {
                throw new Error(data.message || 'Gagal membatalkan pemesanan');
            }
        } catch (error) {
            console.error('Error:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal membatalkan pemesanan. Sistem akan memuat ulang halaman.',
                confirmButtonColor: '#0B3B86'
            });
            window.location.reload();
        }
    }

    function updateDisplay() {
        let now = Date.now();
        let timeLeft = Math.max(0, Math.ceil((endTime - now) / 1000));

        if (timeLeft <= 0) {
            clearInterval(globalCountdown);
            localStorage.removeItem('paymentEndTime');
            cancelExpiredBooking();
            return;
        }

        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        display.textContent = formattedTime;

        if (timeLeft <= 120) {
            display.classList.add('timer-warning');
        }
    }

    // Add check on page load
    window.addEventListener('load', function() {
        const savedEndTime = localStorage.getItem('paymentEndTime');
        if (savedEndTime && Date.now() >= parseInt(savedEndTime)) {
            cancelExpiredBooking();
        }
    });

    // --- TIMER LOGIC AGAR TIDAK RESET SAAT REFRESH ---

    const countdownDiv = document.querySelector('.countdown-timer');
    const countdownDisplay = document.getElementById('countdown');

    @if($riwayat->status == 'belum dibayar')
        // Ambil waktu kadaluarsa dari backend (waktu kadaluarsa invoice midtrans)
        // Pastikan backend mengirimkan $riwayat->midtrans_expiry (timestamp detik)
        @php
            $expiryTimestamp = isset($riwayat->midtrans_expiry) ? $riwayat->midtrans_expiry : null;
        @endphp

        @if($expiryTimestamp)
            // Jika ada expiry dari backend, gunakan itu
            const expiryTimestamp = {{ $expiryTimestamp }};
            const nowTimestamp = Math.floor(Date.now() / 1000);
            let remainingSeconds = expiryTimestamp - nowTimestamp;

            // Cek localStorage, jika ada dan lebih kecil dari expiry, gunakan yang lebih kecil
            const savedEndTime = localStorage.getItem('paymentEndTime');
            if (savedEndTime) {
                const savedRemaining = Math.ceil((savedEndTime - Date.now()) / 1000);
                if (savedRemaining > 0 && savedRemaining < remainingSeconds) {
                    remainingSeconds = savedRemaining;
                }
            }

            if (remainingSeconds > 0 && countdownDiv && countdownDisplay) {
                countdownDiv.style.display = 'flex';
                startCountdown(remainingSeconds, countdownDisplay);
            } else {
                localStorage.removeItem('paymentEndTime');
                if (countdownDiv) countdownDiv.style.display = 'none';
            }
        @else
            // Fallback: jika tidak ada expiry dari backend, pakai default 10 menit
            const totalTime = 10 * 60;
            const savedEndTime = localStorage.getItem('paymentEndTime');
            let remainingSeconds = totalTime;
            if (savedEndTime) {
                const savedRemaining = Math.ceil((savedEndTime - Date.now()) / 1000);
                if (savedRemaining > 0) {
                    remainingSeconds = savedRemaining;
                }
            }
            if (remainingSeconds > 0 && countdownDiv && countdownDisplay) {
                countdownDiv.style.display = 'flex';
                startCountdown(remainingSeconds, countdownDisplay);
            } else {
                localStorage.removeItem('paymentEndTime');
                if (countdownDiv) countdownDiv.style.display = 'none';
            }
        @endif
    @endif
});

</script>
</body>
</html>
