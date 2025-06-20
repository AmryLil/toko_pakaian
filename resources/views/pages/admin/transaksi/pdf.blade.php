<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 24pt;
        }

        .header p {
            margin: 5px 0;
            font-size: 11pt;
            color: #555;
        }

        .summary {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 5px;
        }

        .summary h3 {
            margin-top: 0;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .summary p {
            margin: 0 0 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        thead tr {
            background-color: #f2f2f2;
        }

        tfoot tr {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        tfoot td {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Transaksi</h1>
        <p>
            Periode:
            <strong>{{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d M Y') : 'Awal' }}</strong> -
            <strong>{{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d M Y') : 'Akhir' }}</strong>
        </p>
    </div>

    <div class="summary">
        <h3>Ringkasan</h3>
        @if ($pelangganTeratas)
            <p><strong>Pelanggan Teratas:</strong> {{ $pelangganTeratas->name_222405 }}
                ({{ $pelangganTeratas->total_transaksi }} transaksi)</p>
        @else
            <p><strong>Pelanggan Teratas:</strong> Tidak ada data</p>
        @endif

        @if ($produkTerlaris)
            <p><strong>Produk Terlaris:</strong> {{ $produkTerlaris->nama_222405 }}
                ({{ $produkTerlaris->total_terjual }} unit terjual)</p>
        @else
            <p><strong>Produk Terlaris:</strong> Tidak ada data</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_transaksi_222405 }}</td>
                    <td>{{ $item->pelanggan->name_222405 ?? 'N/A' }}</td>
                    <td>{{ $item->produk->nama_222405 ?? 'N/A' }}</td>
                    <td>{{ $item->jumlah_222405 }}</td>
                    <td>{{ ucfirst($item->status_222405) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi_222405)->format('d-m-Y') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->harga_total_222405, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px;">
                        Tidak ada data transaksi pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">Total Nilai Transaksi</td>
                <td style="text-align: right;">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
