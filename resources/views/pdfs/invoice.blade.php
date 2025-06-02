<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $booking->id }}</title>
    <style>
        :root {
            --primary-color: #0B3B86;
            --text-color: #333333;
            --border-color: #E5E7EB;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            padding: 40px;
        }

        .header {
            margin-bottom: 40px;
        }

        .homestay-name {
            color: var(--primary-color);
            font-size: 32px;
            margin: 0 0 20px 0;
        }

        .homestay-contact {
            color: #666;
            margin-bottom: 5px;
        }

        .homestay-contact i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .divider {
            border-bottom: 1px solid #E5E7EB;
            margin: 20px 0;
        }

        .paid-by {
            margin: 30px 0;
        }

        .paid-by h2 {
            color: var(--primary-color);
            font-size: 18px;
            margin-bottom: 10px;
        }

        .booking-details {
            margin: 30px 0;
        }

        .booking-details h2 {
            color: var(--primary-color);
            font-size: 18px;
            margin-bottom: 15px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .detail-row {
            margin-bottom: 10px;
        }

        .detail-label {
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            text-align: left;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .receipt-number {
            float: right;
            text-align: right;
        }

        .receipt-number h1 {
            color: var(--primary-color);
            font-size: 24px;
            margin: 0;
        }

        .total-row {
            font-weight: bold;
            background-color: #F9FAFB;
        }

        .notes {
            margin-top: 30px;
            color: #666;
        }

        .tax-note {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="homestay-name">{{ $booking->homestay->name }}</div>
        <div class="homestay-contact">
            <i class="fas fa-map-marker-alt"></i> {{ $booking->homestay->address }}
        </div>
        <div class="homestay-contact">
            <i class="fas fa-phone"></i> {{ $booking->homestay->user->phone }}
        </div>
    </div>

    <div class="receipt-number">
        <h1>INVOICE</h1>
        <p>No. Invoice: #{{ $booking->id }}</p>
        <p>Tanggal: {{ now()->format('d-m-Y') }}</p>
    </div>

    <div class="divider"></div>

    <div class="paid-by">
        <h2>Data Pemesan</h2>
        <p>{{ $booking->user->name }}</p>
        <p>{{ $booking->user->email }}</p>
        <p>{{ $booking->user->phone }}</p>
    </div>

    <div class="booking-details">
        <h2>Detail Pemesanan</h2>
        <div class="details-grid">
            <div class="detail-row">
                <div class="detail-label">Check-in</div>
                <div>{{ \Carbon\Carbon::parse($booking->check_in)->format('l, d F Y') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Check-out</div>
                <div>{{ \Carbon\Carbon::parse($booking->check_out)->format('l, d F Y') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Durasi</div>
                <div>{{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }} malam</div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th style="text-align: center">Jumlah</th>
                <th style="text-align: right">Harga Unit</th>
                <th style="text-align: right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($booking->bookingDetails as $detail)
            <tr>
                <td>{{ $detail->room->name }}</td>
                <td style="text-align: center">{{ $detail->quantity }}</td>
                <td style="text-align: right">Rp {{ number_format($detail->price_per_night, 0, ',', '.') }}</td>
                <td style="text-align: right">Rp {{ number_format($detail->subtotal_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right">Subtotal</td>
                <td style="text-align: right">Rp {{ number_format($booking->base_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right">Biaya Layanan</td>
                <td style="text-align: right">Rp {{ number_format($booking->service_price, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align: right">Total</td>
                <td style="text-align: right">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="notes">
        <p>Terima kasih telah memesan di {{ $booking->homestay->name }}. Kami menantikan kedatangan Anda :)</p>
    </div>

    <div class="tax-note">
        *Sudah termasuk pajak dan biaya layanan
    </div>
</body>
</html>