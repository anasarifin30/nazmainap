<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    @vite(['resources/css/detailbooking.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <x-header></x-header>
    <div class="confirmation-container">
        <div class="confirmation-header">
            <h1>Ringkasan Pemesanan</h1>
            <p class="booking-id">ID Pesanan: #{{ $riwayat->id }}</p>
        </div>

        <div class="confirmation-card">
            

            <!-- Homestay & Gambar -->
            <div class="room-details">
                <div class="room-image">
                    <img src="{{ ($riwayat->homestay && $riwayat->homestay->coverPhoto && $riwayat->homestay->coverPhoto->photo_path)
                        ? asset('storage/images-homestay/' . $riwayat->homestay->coverPhoto->photo_path)
                        : asset('storage/images-homestay/default-homestay.jpg') }}"
                        alt="{{ $riwayat->homestay->name ?? '-' }}">
                </div>
                <div class="room-info">
                    <div class="booking-status status-{{ strtolower($riwayat->status) }}">
                        @if($riwayat->status == 'selesai')
                            <i class="fas fa-check-circle"></i> Selesai
                        @elseif($riwayat->status == 'aktif')
                            <i class="fas fa-clock"></i> Aktif
                        @elseif($riwayat->status == 'dibatalkan')
                            <i class="fas fa-times-circle"></i> Dibatalkan
                        @elseif($riwayat->status == 'menunggu')
                            <i class="fas fa-hourglass-half"></i> Menunggu
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
                    <div class="detail-value">{{ $riwayat->user->phone ?? '-' }}</div>
                </div>
            </div>

            <!-- Tanggal Check-in/out -->
            <div class="guest-details">
                <h3>Tanggal Menginap</h3>
                <div class="detail-row">
                    <div class="detail-label">Check-in</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($riwayat->check_in)->format('d M Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Check-out</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($riwayat->check_out)->format('d M Y') }}</div>
                </div>
            </div>

            <!-- Syarat & Tombol -->
            @if($riwayat->status == 'menunggu')
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
                @if($riwayat->status == 'menunggu')
                <form action="#" method="POST" id="form-bayar">
                    @csrf
                    <button type="submit" class="btn-primary" id="btn-bayar" disabled>Konfirmasi dan Bayar</button>
                </form>
                @endif
            </div>

            @if($riwayat->status == 'menunggu')
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.getElementById('terms');
                const btnBayar = document.getElementById('btn-bayar');
                const warning = document.getElementById('terms-warning');
                const form = document.getElementById('form-bayar');

                checkbox.addEventListener('change', function() {
                    btnBayar.disabled = !this.checked;
                    if(this.checked) warning.style.display = 'none';
                });

                form.addEventListener('submit', function(e) {
                    if (!checkbox.checked) {
                        e.preventDefault();
                        warning.style.display = 'block';
                    }
                });
            });
            </script>
            @endif
        </div>
    </div>
    <x-footer></x-footer>
</body>
</html>