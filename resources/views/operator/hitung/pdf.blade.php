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
            padding: 15px;
            font-size: 11px;
            line-height: 1.3;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .header h2 {
            margin: 8px 0;
            font-size: 14px;
            color: #34495e;
        }
        
        .header h3 {
            margin: 5px 0;
            font-size: 12px;
            color: #34495e;
        }
        
        .info-peserta {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 12px;
            border-radius: 3px;
        }
        
        .info-peserta table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        
        .info-peserta td {
            padding: 4px;
            vertical-align: top;
        }
        
        .info-peserta td:first-child {
            font-weight: bold;
            width: 120px;
        }
        
        .table-container {
            margin-top: 20px;
            overflow: visible;
        }
        
        /* Tabel utama dengan ukuran yang lebih besar */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 9px; /* Dinaikkan dari 7px */
        }
        
        .main-table th, 
        .main-table td {
            border: 1px solid #ddd;
            padding: 6px 4px; /* Dinaikkan dari 3px 2px */
            text-align: center;
            vertical-align: middle;
        }
        
        .main-table th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 9px; /* Dinaikkan dari 7px */
            height: 40px; /* Tinggi header lebih besar */
        }
        
        /* Kolom width yang dioptimalkan untuk portrait */
        .col-bulan { width: 8%; }
        .col-phdp { width: 10%; }
        .col-ir { width: 6%; }
        .col-saldo { width: 9%; }
        .col-iuran { width: 8%; }
        .col-hasil { width: 8%; }
        
        .main-table tbody tr {
            height: 25px; /* Tinggi baris data lebih besar */
        }
        
        .currency {
            text-align: right;
            font-size: 8px; /* Dinaikkan dari 6px */
        }
        
        .month-name {
            font-weight: bold;
            background-color: #ecf0f1;
            font-size: 9px; /* Dinaikkan dari 7px */
        }
        
        .total-row {
            background-color: #e8f4f8;
            font-weight: bold;
            font-size: 9px; /* Dinaikkan dari 7px */
            height: 30px; /* Tinggi baris total lebih besar */
        }
        
        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 9px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        .summary {
            margin-top: 20px;
            background-color: #f1f2f6;
            padding: 12px;
            border-radius: 3px;
        }
        
        .summary h3 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 12px;
        }
        
        .summary table {
            width: 80%;
            margin: 10px 0;
            font-size: 10px;
        }
        
        .summary td {
            padding: 6px;
            border: 1px solid #bdc3c7;
        }
        
        .summary .label {
            background-color: #ecf0f1;
            font-weight: bold;
            width: 65%;
        }
        
        /* Responsive adjustments untuk portrait */
        @media print {
            body {
                margin: 0;
                padding: 10px;
                font-size: 10px;
            }
            
            .main-table {
                font-size: 8px; /* Tetap besar untuk print */
            }
            
            .main-table th, 
            .main-table td {
                padding: 4px 3px; /* Tetap dengan padding yang cukup */
            }
            
            .main-table th {
                height: 35px;
            }
            
            .main-table tbody tr {
                height: 22px;
            }
            
            .currency {
                font-size: 7px;
            }
            
            .header {
                page-break-inside: avoid;
            }
            
            .main-table {
                page-break-inside: auto;
            }
            
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
        
        /* Alternative: Tabel dengan scroll horizontal untuk mobile/preview */
        .table-scroll {
            overflow-x: auto;
            margin: 15px 0;
        }
        
        /* Styling untuk header yang lebih kompak */
        .compact-header {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            height: 60px;
            padding: 4px 2px;
        }
        
        /* Menambahkan spacing yang lebih baik */
        .main-table thead th {
            line-height: 1.2;
            white-space: nowrap;
        }
        
        .main-table tbody td {
            line-height: 1.3;
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
        <table class="main-table">
            <thead>
                <tr>
                    <th rowspan="2" class="col-bulan">Bulan</th>
                    <th rowspan="2" class="col-phdp">PHDP</th>
                    <th rowspan="2" class="col-ir">IR<br>(%)</th>
                    <th colspan="4">PESERTA</th>
                    <th colspan="4">PEMBERI KERJA</th>
                </tr>
                <tr>
                    <th class="col-saldo">Saldo<br>Awal</th>
                    <th class="col-iuran">Iuran</th>
                    <th class="col-hasil">Hsl.<br>Peng.</th>
                    <th class="col-saldo">Saldo<br>Akhir</th>
                    <th class="col-saldo">Saldo<br>Awal</th>
                    <th class="col-iuran">Iuran</th>
                    <th class="col-hasil">Hsl.<br>Peng.</th>
                    <th class="col-saldo">Saldo<br>Akhir</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $bulan_names = [
                        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
                        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
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
                        <td class="currency">{{ number_format($histori->phdp_bulan_ini, 0, ',', '.') }}</td>
                        <td>{{ number_format($histori->ir_bulan_ini, 1, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_awal_peserta, 0, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->iuran_peserta, 0, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->hasil_pengembangan_peserta, 0, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_akhir_peserta, 0, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_awal_pemberi_kerja, 0, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->iuran_pemberi_kerja, 0, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->hasil_pengembangan_pemberi_kerja, 0, ',', '.') }}</td>
                        <td class="currency">{{ number_format($histori->saldo_akhir_pemberi_kerja, 0, ',', '.') }}</td>
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
                        <td class="currency"><strong>{{ number_format($total_iuran_peserta, 0, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($total_hasil_peng_peserta, 0, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($historiIuran->last()->saldo_akhir_peserta ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="currency">-</td>
                        <td class="currency"><strong>{{ number_format($total_iuran_pk, 0, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($total_hasil_peng_pk, 0, ',', '.') }}</strong></td>
                        <td class="currency"><strong>{{ number_format($historiIuran->last()->saldo_akhir_pemberi_kerja ?? 0, 0, ',', '.') }}</strong></td>
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
                    <td class="currency">{{ number_format($total_iuran_peserta, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Iuran Pemberi Kerja</td>
                    <td class="currency">{{ number_format($total_iuran_pk, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Hasil Pengembangan Peserta</td>
                    <td class="currency">{{ number_format($total_hasil_peng_peserta, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Hasil Pengembangan PK</td>
                    <td class="currency">{{ number_format($total_hasil_peng_pk, 0, ',', '.') }}</td>
                </tr>
                <tr style="background-color: #3498db; color: black; font-weight: bold;">
                    <td class="label">TOTAL AKUMULASI</td>
                    <td class="currency">{{ number_format(($historiIuran->last()->saldo_akhir_peserta ?? 0) + ($historiIuran->last()->saldo_akhir_pemberi_kerja ?? 0), 0, ',', '.') }}</td>
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