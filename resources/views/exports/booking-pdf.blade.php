<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Invoice - {{ $booking->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { height: 60px; }
        .title { font-size: 18px; font-weight: bold; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">FAKTUR PENYEWAAN MOBIL</div>
        <div>Fara Trans - Rental Mobil & Paket Wisata</div>
    </div>

    <div class="section">
        <div class="section-title">Informasi Penyewa</div>
        <table>
            <tr>
                <td width="30%">Nama Penyewa</td>
                <td>{{ $booking->customer_name }}</td>
            </tr>
            <tr>
                <td>Nomor Telepon/WA</td>
                <td>{{ $booking->customer_phone }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $booking->customer_address ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Detail Penyewaan</div>
        <table class="table">
            <tr>
                <th>Mobil</th>
                <th>Tipe Sewa</th>
                <th class="text-right">Harga</th>
            </tr>
            <tr>
                <td>{{ $booking->car->brand }} {{ $booking->car->type }}</td>
                <td>{{ $booking->rent_type == 'self_drive' ? 'Lepas Kunci' : 'Dengan Driver' }}</td>
                <td class="text-right">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Jadwal Penyewaan</div>
        <table>
            <tr>
                <td width="30%">Tanggal/Jam Sewa</td>
                <td>{{ $booking->start_date->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <td>Tanggal/Jam Kembali</td>
                <td>{{ $booking->end_date->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ $booking->returned ? 'Sudah Dikembalikan' : 'Belum Dikembalikan' }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
        <p>Terima kasih telah menggunakan layanan Fara Trans</p>
    </div>
</body>
</html>