<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Iuran Peserta - {{ $peserta->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 11px;
            line-height: 1.3;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .header h2 {
            margin: 5px 0;
            font-size: 14px;
            color: #34495e;
        }
        
        .info-peserta {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        
        .info-peserta table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-peserta td {
            padding: 5px;
            vertical-align: top;
        }
        
        .info-peserta td:first-child {
            font-weight: bold;
            width: 150px;
        }
        
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
            font-size: 10px;
        }
        
        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        
        .currency {
            text-align: right;
        }
        
        .month-name {
            font-weight: bold;
            background-color: #ecf0f1;
        }
        
        .total-row {
            background-color: #e8f4f8;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        .summary {
            margin-top: 20px;
            background-color: #f1f2f6;
            padding: 15px;
            border-radius: 5px;
        }
        
        .summary h3 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 12px;
        }
        
        .summary table {
            width: 60%;
            margin: 10px 0;
        }
        
        .summary td {
            padding: 8px;
            border: 1px solid #bdc3c7;
        }
        
        .summary .label {
            background-color: #ecf0f1;
            font-weight: bold;
            width: 60%;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            
            .header {
                page-break-inside: avoid;
            }
            
            table {
                page-break-inside: auto;
            }
            
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HISTORI IURAN PESERTA DANA PENSIUN</h1>
        <h2>BANK SULSELBAR</h2>
        <h3>TAHUN {{ $tahun }}</h3>
    </div>

    <div class="info-peserta">
        <table>
            <tr>
                <td><strong>NIP</strong></td>
                <td>: {{ $peserta->nip }}</td>
                <td><strong>Nama</strong></td>
                <td>: {{ $peserta->nama }}</td>
            </tr>
            <tr>
                <td><strong>Cabang</strong></td>
                <td>: {{ $peserta->cabang->nama_cabang ?? 'N/A' }}</td>
                <td><strong>Status</strong></td>
                <td>: {{ $peserta->status_kepesertaan ?? 'Aktif' }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Lahir</strong></td>
                <td>: {{ $peserta->tanggal_lahir ? \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d/m/Y') : 'N/A' }}</td>
                <td><strong>Tanggal Pensiun</strong></td>
                <td>: {{ $peserta->tanggal_pensiun ? \Carbon\Carbon::parse($peserta->tanggal_pensiun)->format('d/m/Y') : 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Bulan</th>
                    <th rowspan="2">PHDP</th>
                    <th rowspan="2">IR (%)</th>
                    <th colspan="4">PESERTA</th>
                    <th colspan="4">PEMBERI KERJA</th>
                </tr>
                <tr>
                    <th>Saldo Awal</th>
                    <th>Iuran</th>
                    <th>Hsl. Peng.</th>
                    <th>Saldo Akhir</th>
                    <th>Saldo Awal</th>
                    <th>Iuran</th>
                    <th>Hsl. Peng.</th>
                    <th>Saldo Akhir</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $bulan_names = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                    
                    $total_iuran_peserta = 0;
                    $total_iuran_pk = 0;
                    $total_hasil_peng_peserta = 0;
                    $total_hasil_peng_pk = 0;
                @endphp
                
                @forelse($historiIuran as $histori)
                    @php
                        $total_iuran_peserta += $histori->iuran_peserta;
                        $total_iuran_pk += $histori->iuran_pemberi_kerja;
                        $total_hasil_peng_peserta += $histori->hasil_pengembangan_peserta;
                        $total_hasil_peng_pk += $histori->hasil_pengembangan_pemberi_kerja;
                    @endphp
                    <tr>
                        <td class="month-name">{{ $bulan_names[$histori->bulan] ?? $histori->bulan }}</td>
                        <td class="currency">{{ number_format($histori->phdp_bulan_ini, 2, ',', '.') }}</td>
                        <td>{{ number_format($histori->ir_bulan_ini, 3, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_awal_peserta, 2, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->iuran_peserta, 2, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->hasil_pengembangan_peserta, 2, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_akhir_peserta, 2, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_awal_pemberi_kerja, 2, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->iuran_pemberi_kerja, 2, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->hasil_pengembangan_pemberi_kerja, 2, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_akhir_pemberi_kerja, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" style="text-align: center; font-style: italic; color: #7f8c8d;">
                            Tidak ada data histori iuran untuk tahun {{ $tahun }}
                        </td>
                    </tr>
                @endforelse
                
                @if($historiIuran->count() > 0)
                    <tr class="total-row">
                        <td colspan="4"><strong>TOTAL</strong></td>
                        <td class="currency"><strong>{{ number_format($total_iuran_peserta, 2, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($total_hasil_peng_peserta, 2, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($historiIuran->last()->saldo_akhir_peserta ?? 0, 2, ',', '.') }}</strong></td>
                        <td class="currency">-</td>
                        <td class="currency"><strong>{{ number_format($total_iuran_pk, 2, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($total_hasil_peng_pk, 2, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($historiIuran->last()->saldo_akhir_pemberi_kerja ?? 0, 2, ',', '.') }}</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    @if($historiIuran->count() > 0)
        <div class="summary">
            <h3>RINGKASAN AKUMULASI</h3>
            <table>
                <tr>
                    <td class="label">Total Iuran Peserta</td>
                    <td class="currency">{{ number_format($total_iuran_peserta, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Iuran Pemberi Kerja</td>
                    <td class="currency">{{ number_format($total_iuran_pk, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Hasil Pengembangan Peserta</td>
                    <td class="currency">{{ number_format($total_hasil_peng_peserta, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Hasil Pengembangan PK</td>
                    <td class="currency">{{ number_format($total_hasil_peng_pk, 2, ',', '.') }}</td>
                </tr>
                <tr style="background-color: #3498db; color: black; font-weight: bold;">
                    <td class="label">TOTAL AKUMULASI</td>
                    <td class="currency">{{ number_format(($historiIuran->last()->saldo_akhir_peserta ?? 0) + ($historiIuran->last()->saldo_akhir_pemberi_kerja ?? 0), 2, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ $tanggal_cetak }}</p>
        <p>Sistem Informasi Kepesertaan DAPEN</p>
    </div>
</body>
</html>