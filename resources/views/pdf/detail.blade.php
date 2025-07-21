<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail Peserta Dana Pensiun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            margin: 10px;
            line-height: 1.2;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h3 {
            margin: 0;
            font-size: 12px;
            font-weight: bold;
            color: #0066cc; /* Blue color for title */
        }
        .header p {
            margin: 3px 0;
            font-size: 9px;
        }
        .total-info {
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 8px;
        }
        .card {
            border: 1px solid #000;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
        .card-header {
            background-color: #ADD8E6; /* Light blue background for participant names */
            color: #333; /* Dark text on light blue background */
            padding: 4px 6px;
            font-weight: bold;
            font-size: 8px;
            border-bottom: 1px solid #000;
        }
        .card-body {
            padding: 6px;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7px;
        }
        .detail-table td {
            padding: 2px 4px;
            vertical-align: top;
            border: none;
            line-height: 1.3;
        }
        .detail-table .label {
            width: 30%;
            font-weight: bold;
        }
        .detail-table .separator {
            width: 5%;
            text-align: center;
        }
        .detail-table .value {
            width: 65%;
        }
        .two-column {
            display: table;
            width: 100%;
        }
        .column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 10px;
        }
        .column:last-child {
            padding-right: 0;
            padding-left: 10px;
        }
        .filter-info {
            margin-top: 10px;
            font-size: 7px;
            page-break-inside: avoid;
        }
        .filter-info h4 {
            margin: 0 0 5px 0;
            font-size: 8px;
        }
        .filter-info ul {
            margin: 0;
            padding-left: 10px;
        }
        .filter-info li {
            margin-bottom: 1px;
        }
        .status-badge {
            background-color: #28a745;
            color: white;
            padding: 1px 4px;
            font-size: 6px;
            border-radius: 2px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 8px;
        }
        @media print {
            .card {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>LAPORAN DETAIL PESERTA DANA PENSIUN</h3>
        <p>Per Tanggal: {{ $date ?? date('d F Y') }}</p>
    </div>

    <div class="total-info">
        Total Data: {{ $total ?? 0 }} peserta
    </div>

    @forelse($peserta as $key => $p)
    <div class="card">
        <div class="card-header">
            {{ $key + 1 }}. {{ $p->nama ?? '-' }} ({{ $p->nip ?? '-' }})
        </div>
        <div class="card-body">
            <div class="two-column">
                <div class="column">
                    <table class="detail-table">
                        <tr>
                            <td class="label">Jenis Kelamin</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->jenis_kelamin ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Tempat Lahir</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->tempat_lahir ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Tanggal Lahir</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->tanggal_lahir ? date('d-m-Y', strtotime($p->tanggal_lahir)) : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Umur</td>
                            <td class="separator">:</td>
                            <td class="value">{{ ($p->umur ?? 0) }} tahun</td>
                        </tr>
                        <tr>
                            <td class="label">Status Pernikahan</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->status_kawin ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Pendidikan</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->pendidikan ?? '-' }}{{ $p->jurusan ? ' - '.$p->jurusan : '' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Alamat</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="column">
                    <table class="detail-table">
                        <tr>
                            <td class="label">Cabang</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->cabang->nama_cabang ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Golongan</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->golongan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Tanggal Masuk</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->tmk ? date('d-m-Y', strtotime($p->tmk)) : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Masa Kerja</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $p->masa_kerja ?? '-' }} tahun</td>
                        </tr>
                        <tr>
                            <td class="label">PHDP</td>
                            <td class="separator">:</td>
                            <td class="value">Rp {{ number_format($p->phdp ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Status</td>
                            <td class="separator">:</td>
                            <td class="value">
                                <span class="status-badge">
                                    {{ $p->kodePeserta->ket_kd_pst ?? '-' }}
                                </span>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div style="text-align: center; padding: 20px; font-size: 9px; border: 1px solid #ccc; background-color: #f8f9fa;">
        <strong>Tidak ada data yang sesuai dengan filter</strong>
    </div>
    @endforelse

    <div class="filter-info">
        <h4>Filter yang diterapkan:</h4>
        <ul>
            <li>Umur: {{ $filters['umur_min'] ?? '18' }} - {{ $filters['umur_max'] ?? '65' }} tahun</li>
            @if(!empty($filters['jenis_kelamin']))
                <li>Jenis Kelamin: {{ $filters['jenis_kelamin'] }}</li>
            @endif
            @if(!empty($filters['cabang']))
                @php
                    $cabangName = '';
                    if(class_exists('App\Models\Cabang')) {
                        $cabang = App\Models\Cabang::find($filters['cabang']);
                        $cabangName = $cabang ? $cabang->nama_cabang : 'Semua Cabang';
                    }
                @endphp
                <li>Cabang: {{ $cabangName }}</li>
            @endif
            @if(!empty($filters['status_kawin']))
                <li>Status Pernikahan: {{ $filters['status_kawin'] }}</li>
            @endif
            @if(!empty($filters['pendidikan']))
                <li>Pendidikan: {{ $filters['pendidikan'] }}</li>
            @endif
            @if(!empty($filters['golongan']))
                <li>Golongan: {{ $filters['golongan'] }}</li>
            @endif
        </ul>
    </div>

    <div class="footer">
        <p>Dokumen ini dicetak otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>© 2025 Dapen Bank Sulselbar - Semua hak cipta dilindungi</p>
    </div>
</body>
</html>