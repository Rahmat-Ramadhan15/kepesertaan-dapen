<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta - {{ $peserta->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            margin: 15px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 3px 0 0 0;
            color: #666;
            font-size: 10px;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            background-color: #007bff;
            color: white;
            padding: 6px 10px;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 12px;
        }
        .field-row {
            display: flex;
            margin-bottom: 4px;
            align-items: baseline;
        }
        .field-label {
            font-weight: bold;
            color: #555;
            width: 150px;
            flex-shrink: 0;
        }
        .field-colon {
            margin: 0 8px;
            font-weight: bold;
        }
        .field-value {
            flex: 1;
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 10px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 4px 6px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 10px;
            font-size: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 8px;
        }
        @page {
            margin: 15mm;
            size: A4;
        }
        .two-column {
            display: flex;
            gap: 30px;
        }
        .column {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DETAIL PESERTA</h1>
        <p>Dapen Bank Sulselbar</p>
        <p>Tanggal Cetak: {{ now()->format('d F Y') }}</p>
    </div>

    <!-- Data Pribadi -->
    <div class="section">
        <div class="section-title">📋 Data Pribadi</div>
        <div class="two-column">
            <div class="column">
                <div class="field-row">
                    <span class="field-label">NIP</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->nip }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Nama Lengkap</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->nama }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Jenis Kelamin</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->jenis_kelamin }}</span>
                </div>
            </div>
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Tempat, Tanggal Lahir</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">
                        {{ $peserta->tempat_lahir }},
                        @if($peserta->tanggal_lahir)
                            {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field-row">
                    <span class="field-label">Usia</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->usia ?? '-' }} tahun</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Status Pernikahan</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->status_kawin ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Kepegawaian -->
    <div class="section">
        <div class="section-title">💼 Data Kepegawaian</div>
        <div class="two-column">
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Nomor SK</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->no_sk ?? '-' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">TMK</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">
                        @if($peserta->tmk)
                            {{ \Carbon\Carbon::parse($peserta->tmk)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field-row">
                    <span class="field-label">TPST</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">
                        @if($peserta->tpst)
                            {{ \Carbon\Carbon::parse($peserta->tpst)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field-row">
                    <span class="field-label">Golongan</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->golongan ?? '-' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Kode Direktorat</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->kode_dir ?? '-' }}</span>
                </div>
            </div>
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Cabang</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->cabang->nama_cabang ?? 'Tidak ada cabang' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">MKMK</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">
                        @if($peserta->mkmk)
                            {{ \Carbon\Carbon::parse($peserta->mkmk)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field-row">
                    <span class="field-label">MKMP</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">
                        @if($peserta->mkmp)
                            {{ \Carbon\Carbon::parse($peserta->mkmp)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field-row">
                    <span class="field-label">Jabatan</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->jabatan ?? '-' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Tahun Menjabat</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">
                        @if($peserta->tahun_jabat)
                            {{ \Carbon\Carbon::parse($peserta->tahun_jabat)->format('Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Pendidikan -->
    <div class="section">
        <div class="section-title">🎓 Data Pendidikan</div>
        <div class="two-column">
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Pendidikan Terakhir</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->pendidikan ?? '-' }}</span>
                </div>
            </div>
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Jurusan</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->jurusan ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Keuangan -->
    <div class="section">
        <div class="section-title">💰 Data Keuangan</div>
        <div class="two-column">
            <div class="column">
                <div class="field-row">
                    <span class="field-label">PHDP</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">Rp {{ number_format($peserta->phdp ?? 0, 2, ',', '.') }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Kode PTKP</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->kode_ptkp ?? '-' }}</span>
                </div>
            </div>
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Akumulasi IBHP</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">Rp {{ number_format($peserta->akumulasi_ibhp ?? 0, 2, ',', '.') }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Kode Peserta</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->kode_peserta ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Alamat -->
    <div class="section">
        <div class="section-title">📍 Data Alamat</div>
        <div class="field-row">
            <span class="field-label">Alamat Lengkap</span>
            <span class="field-colon">:</span>
            <span class="field-value">{{ $peserta->alamat ?? '-' }}</span>
        </div>
        <div class="two-column">
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Kelurahan</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->kelurahan ?? '-' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Kecamatan</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->kecamatan ?? '-' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Kabupaten/Kota</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->kabupaten_kota ?? '-' }}</span>
                </div>
            </div>
            <div class="column">
                <div class="field-row">
                    <span class="field-label">Kode Pos</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->kode_pos ?? '-' }}</span>
                </div>
                <div class="field-row">
                    <span class="field-label">Telepon</span>
                    <span class="field-colon">:</span>
                    <span class="field-value">{{ $peserta->telpon ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Keluarga -->
    <div class="section">
        <div class="section-title">👨‍👩‍👧‍👦 Data Keluarga</div>
        @if($peserta->keluargas->isEmpty())
            <div class="no-data">Tidak ada data keluarga.</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Tanggal Lahir</th>
                        <th>Usia</th>
                        <th>Hubungan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peserta->keluargas as $index => $keluarga)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $keluarga->nama }}</td>
                            <td>{{ $keluarga->jenis_kelamin }}</td>
                            <td>{{ $keluarga->tanggal_lahir }}</td>
                            <td>{{ $keluarga->usia ?? '-' }}</td>
                            <td>{{ $keluarga->hubungan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>© 2025 Dapen Bank Sulselbar - Semua hak cipta dilindungi</p>
    </div>
</body>
</html>