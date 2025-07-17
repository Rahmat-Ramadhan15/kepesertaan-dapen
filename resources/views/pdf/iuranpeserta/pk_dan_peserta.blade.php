<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan PK dan Peserta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .currency {
            text-align: right;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 9px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .total-row {
            background-color: #f1f2f6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN IURAN PK & PESERTA</h1>
        <p>Dapen Bank Sulselbar</p>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Cabang</th>
                <th>PHDP</th>
                <th>Iuran Peserta</th>
                <th>Iuran Pemberi Kerja</th>
                <th>Total Iuran</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalPeserta = 0;
                $totalPK = 0;
            @endphp
            @forelse ($data as $item)
                @php
                    $peserta = $item->peserta;
                    $total = $item->iuran_peserta + $item->iuran_pemberi_kerja;
                    $totalPeserta += $item->iuran_peserta;
                    $totalPK += $item->iuran_pemberi_kerja;
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $peserta->nama ?? '-' }}</td>
                    <td>{{ $peserta->cabang->nama_cabang ?? '-' }}</td>
                    <td class="currency">{{ number_format($item->phdp_bulan_ini, 0, ',', '.') }}</td>
                    <td class="currency">{{ number_format($item->iuran_peserta, 0, ',', '.') }}</td>
                    <td class="currency">{{ number_format($item->iuran_pemberi_kerja, 0, ',', '.') }}</td>
                    <td class="currency">{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; font-style: italic;">Tidak ada data.</td>
                </tr>
            @endforelse

            @if ($data->count() > 0)
                <tr class="total-row">
                    <td colspan="5">TOTAL</td>
                    <td class="currency">{{ number_format($totalPeserta, 0, ',', '.') }}</td>
                    <td class="currency">{{ number_format($totalPK, 0, ',', '.') }}</td>
                    <td class="currency">{{ number_format($totalPeserta + $totalPK, 0, ',', '.') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>© 2025 Dapen Bank Sulselbar - Semua hak cipta dilindungi</p>
    </div>
</body>
</html>
