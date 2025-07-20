<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Keluarga Peserta Dana Pensiun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 15px;
            line-height: 1.3;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2196F3;
            padding-bottom: 10px;
        }
        .header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #2196F3;
        }
        .header p {
            margin: 5px 0;
            font-size: 11px;
            color: #666;
        }
        
        .peserta-card {
            margin-bottom: 25px;
            page-break-inside: avoid;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .peserta-header {
            background-color: #2196F3;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 12px;
            border-radius: 5px 5px 0 0;
        }
        
        .section {
            margin-bottom: 15px;
            background-color: #f8f9fa;
            border-radius: 3px;
        }
        
        .section-header {
            background-color: #2196F3;
            color: white;
            padding: 6px 10px;
            font-weight: bold;
            font-size: 10px;
            margin: 0;
        }
        
        .section-content {
            padding: 10px;
        }
        
        .data-row {
            display: table;
            width: 100%;
            margin-bottom: 3px;
        }
        
        .data-label {
            display: table-cell;
            width: 35%;
            font-weight: bold;
            vertical-align: top;
            padding-right: 10px;
        }
        
        .data-value {
            display: table-cell;
            vertical-align: top;
        }
        
        .two-column {
            display: table;
            width: 100%;
        }
        
        .column-left, .column-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 15px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 9px;
        }
        
        table, th, td {
            border: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
            padding: 6px 4px;
            text-align: center;
            font-weight: bold;
            font-size: 9px;
        }
        
        td {
            padding: 5px 4px;
            vertical-align: top;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .filter-info {
            margin-top: 20px;
            font-size: 9px;
            page-break-inside: avoid;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
        
        .filter-info h4 {
            margin: 0 0 8px 0;
            font-size: 10px;
            color: #2196F3;
        }
        
        .filter-info ul {
            margin: 0;
            padding-left: 15px;
        }
        
        .filter-info li {
            margin-bottom: 2px;
        }
        
        .total-info {
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 11px;
            background-color: #e3f2fd;
            padding: 8px;
            border-radius: 3px;
        }
        
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>LAPORAN KELUARGA PESERTA DANA PENSIUN</h3>
        <p>Per Tanggal: {{ $date ?? date('d F Y') }}</p>
    </div>

    <div class="total-info">
        Total Data: {{ $total ?? ($peserta ? $peserta->count() : 0) }} peserta
    </div>

    @forelse($peserta as $key => $p)
    <div class="peserta-card">
        <div class="peserta-header">
            DETAIL PESERTA
        </div>
        
        <!-- Data Pribadi -->
        <div class="section">
            <div class="section-header">Data Pribadi</div>
            <div class="section-content">
                <div class="two-column">
                    <div class="column-left">
                        <div class="data-row">
                            <div class="data-label">NIP</div>
                            <div class="data-value">: {{ $p->nip ?? '-' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">Nama Lengkap</div>
                            <div class="data-value">: {{ $p->nama ?? '-' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">Jenis Kelamin</div>
                            <div class="data-value">: {{ $p->jenis_kelamin ?? '-' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">Tempat, Tanggal Lahir</div>
                            <div class="data-value">: {{ $p->tempat_lahir ?? '-' }}, {{ $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') : '-' }}</div>
                        </div>
                    </div>
                    <div class="column-right">
                        <div class="data-row">
                            <div class="data-label">Usia</div>
                            <div class="data-value">: {{ $p->umur ?? '-' }} tahun</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">Status Pernikahan</div>
                            <div class="data-value">: {{ $p->status_kawin ?? '-' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">Golongan</div>
                            <div class="data-value">: {{ $p->golongan ?? '-' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">Cabang</div>
                            <div class="data-value">: {{ $p->cabang->nama_cabang ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Kepegawaian -->
        @if(isset($p->nomor_sk) || isset($p->tmt) || isset($p->tpt1) || isset($p->golongan))
        <div class="section">
            <div class="section-header">Data Kepegawaian</div>
            <div class="section-content">
                <div class="two-column">
                    <div class="column-left">
                        <div class="data-row">
                            <div class="data-label">Nomor SK</div>
                            <div class="data-value">: {{ $p->no_sk ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="column-right">
                        <div class="data-row">
                            <div class="data-label">Golongan</div>
                            <div class="data-value">: {{ $p->golongan ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Data Pendidikan -->
        @if(isset($p->pendidikan_terakhir) || isset($p->jurusan))
        <div class="section">
            <div class="section-header">Data Pendidikan</div>
            <div class="section-content">
                <div class="data-row">
                    <div class="data-label">Pendidikan Terakhir</div>
                    <div class="data-value">: {{ $p->pendidikan ?? '-' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Jurusan</div>
                    <div class="data-value">: {{ $p->jurusan ?? '-' }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Data Keuangan -->
        @if(isset($p->phdp) || isset($p->gaji_pokok))
        <div class="section">
            <div class="section-header">Data Keuangan</div>
            <div class="section-content">
                <div class="data-row">
                    <div class="data-label">PHDP</div>
                    <div class="data-value">: Rp {{ isset($p->phdp) ? number_format($p->phdp, 0, ',', '.') : '-' }}</div>
                </div>
                @if(isset($p->gaji_pokok))
                <div class="data-row">
                    <div class="data-label">Gaji Pokok</div>
                    <div class="data-value">: Rp {{ number_format($p->gaji_pokok, 0, ',', '.') }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Data Alamat -->
        @if(isset($p->alamat) || isset($p->kelurahan) || isset($p->kode_pos))
        <div class="section">
            <div class="section-header">Data Alamat</div>
            <div class="section-content">
                <div class="data-row">
                    <div class="data-label">Alamat Lengkap</div>
                    <div class="data-value">: {{ $p->alamat ?? '-' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Kelurahan</div>
                    <div class="data-value">: {{ $p->kelurahan ?? '-' }}</div>
                </div>
                <div class="data-row">
                    <div class="data-label">Kode Pos</div>
                    <div class="data-value">: {{ $p->kode_pos ?? '-' }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Data Keluarga -->
        <div class="section">
            <div class="section-header">Data Keluarga</div>
            <div class="section-content">
                @php
                    $keluargaData = $p->keluarga ?? $p->keluargas ?? collect();
                @endphp
                
                @if($keluargaData && $keluargaData->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 8%;">No</th>
                                <th style="width: 25%;">Nama</th>
                                <th style="width: 12%;">JK</th>
                                <th style="width: 20%;">Tanggal Lahir</th>
                                <th style="width: 10%;">Umur</th>
                                <th style="width: 25%;">Hubungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keluargaData as $index => $keluarga)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $keluarga->nama ?? '-' }}</td>
                                <td class="text-center">{{ $keluarga->jenis_kelamin ?? '-' }}</td>
                                <td class="text-center">{{ $keluarga->tanggal_lahir ? \Carbon\Carbon::parse($keluarga->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                                <td class="text-center">{{ $keluarga->umur ?? '0' }}</td>
                                <td>{{ $keluarga->hubungan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">Tidak ada data keluarga</div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="no-data">
        Tidak ada data yang sesuai dengan filter
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
                    } else {
                        $cabangName = 'Semua Cabang';
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
</body>
</html>