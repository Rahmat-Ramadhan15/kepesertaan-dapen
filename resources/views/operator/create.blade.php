<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peserta Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3f51b5;
            --primary-light: #f5f7ff;
            --primary-dark: #303f9f;
            --light-gray: #f8f9fa;
            --border-radius: 0.5rem;
        }
        
        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding-bottom: 2rem;
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .dashboard-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin: 0;
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 2rem;
            background-color: #fff;
        }
        
        .card-header {
            background-color: var(--primary-light);
            border-bottom: 1px solid #eee;
            padding: 1.2rem 1.5rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .action-button {
            padding: 0.6rem 1.2rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            background-color: #f8f9fa;
            color: #333;
            border-color: #ddd;
        }
        
        .btn-secondary:hover {
            background-color: #e9ecef;
            border-color: #ccc;
            color: #333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: var(--border-radius);
            border: 1px solid #dee2e6;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(63, 81, 181, 0.1);
        }
        
        .form-field-group {
            margin-bottom: 1.5rem;
        }
        
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        
        .alert-danger {
            background-color: #fff5f5;
            color: #dc3545;
            border-color: #ffe0e0;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
        }
        
        .alert-danger ul {
            margin-bottom: 0;
            padding-left: 1.2rem;
        }
        
        .section-divider {
            margin: 1.5rem 0;
            height: 1px;
            background-color: #eee;
        }
        
        .form-section-title {
            color: var(--primary-dark);
            font-weight: 600;
            margin: 1.5rem 0 1rem 0;
            font-size: 1.1rem;
        }
        
        /* Animation for form inputs on focus */
        .form-control:focus, .form-select:focus {
            transform: translateY(-2px);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #aaa;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">
                <i class="fas fa-user-plus me-2"></i> Tambah Peserta Baru
            </h1>
            <a href="{{ route('operator.index') }}" class="btn btn-secondary action-button">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Terdapat kesalahan pada form:</strong>
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <i class="fas fa-clipboard-list me-2"></i> Data Informasi Peserta
            </div>
            <div class="card-body">
                <form action="{{ route('operator.store') }}" method="POST">
                    @csrf
                    
                    <!-- Data Pribadi -->
                    <div class="form-section-title">
                        <i class="fas fa-id-card me-2"></i> Data Pribadi
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="nip" class="form-label required-field">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" required placeholder="Masukkan NIP">
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="nama" class="form-label required-field">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="jenis_kelamin" class="form-label required-field">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                            <select class="form-select" id="status_pernikahan" name="status_pernikahan">
                                <option value="">Pilih Status</option>
                                <option value="Lajang" {{ old('status_pernikahan') == 'Lajang' ? 'selected' : '' }}>Lajang</option>
                                <option value="Menikah" {{ old('status_pernikahan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Duda" {{ old('status_pernikahan') == 'Duda' ? 'selected' : '' }}>Duda</option>
                                <option value="Janda" {{ old('status_pernikahan') == 'Janda' ? 'selected' : '' }}>Janda</option>
                            </select>
                        </div>
                    </div>

                    <!-- Data Kepegawaian -->
                    <div class="section-divider"></div>
                    <div class="form-section-title">
                        <i class="fas fa-briefcase me-2"></i> Data Kepegawaian
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="no_sk" class="form-label">Nomor SK</label>
                            <input type="text" class="form-control" id="no_sk" name="no_sk" value="{{ old('no_sk') }}" placeholder="Masukkan nomor SK">
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="cabang_id" class="form-label">Cabang</label>
                            <select class="form-select" id="cabang_id" name="cabang_id">
                                <option value="">Pilih Cabang</option>
                                @foreach($listCabang as $cabang)
                                    <option value="{{ $cabang->id }}" {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>
                                        {{ $cabang->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="tmk" class="form-label">TMK (Tanggal Mulai Kerja)</label>
                            <input type="date" class="form-control" id="tmk" name="tmk" value="{{ old('tmk') }}">
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="tpst" class="form-label">TPST</label>
                            <input type="date" class="form-control" id="tpst" name="tpst" value="{{ old('tpst') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="golongan" class="form-label">Golongan</label>
                            <input type="text" class="form-control" id="golongan" name="golongan" value="{{ old('golongan') }}" placeholder="Masukkan golongan">
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Masukkan jabatan">
                        </div>
                    </div>

                    <!-- Data Pendidikan -->
                    <div class="section-divider"></div>
                    <div class="form-section-title">
                        <i class="fas fa-graduation-cap me-2"></i> Data Pendidikan
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                            <select class="form-select" id="pendidikan" name="pendidikan">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/SMK" {{ old('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Masukkan jurusan">
                        </div>
                    </div>

                    <!-- Data Keuangan -->
                    <div class="section-divider"></div>
                    <div class="form-section-title">
                        <i class="fas fa-money-bill-wave me-2"></i> Data Keuangan
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="phdp" class="form-label">PHDP</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" step="0.01" class="form-control" id="phdp" name="phdp" value="{{ old('phdp') }}" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="akumulasi_ibhp" class="form-label">Akumulasi IBHP</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" step="0.01" class="form-control" id="akumulasi_ibhp" name="akumulasi_ibhp" value="{{ old('akumulasi_ibhp') }}" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="kode_ptkp" class="form-label">Kode PTKP</label>
                            <input type="text" class="form-control" id="kode_ptkp" name="kode_ptkp" value="{{ old('kode_ptkp') }}" placeholder="Masukkan kode PTKP">
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="kode_peserta" class="form-label">Kode Peserta</label>
                            <input type="text" class="form-control" id="kode_peserta" name="kode_peserta" value="{{ old('kode_peserta') }}" placeholder="Masukkan kode peserta">
                        </div>
                    </div>

                    <!-- Data Alamat -->
                    <div class="section-divider"></div>
                    <div class="form-section-title">
                        <i class="fas fa-map-marker-alt me-2"></i> Data Alamat
                    </div>
                    
                    <div class="form-field-group">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}" placeholder="Masukkan kelurahan">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="kota" class="form-label">Kabupaten/Kota</label>
                            <input type="text" class="form-control" id="kabupaten/kota" name="kabupaten/kota" value="{{ old('kabupaten/kota') }}" placeholder="Masukkan kota">
                        </div>
                        <div class="col-md-6 form-field-group">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" placeholder="Masukkan kode pos">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-field-group">
                            <label for="telpon" class="form-label">Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" id="telpon" name="telpon" value="{{ old('telpon') }}" placeholder="Masukkan nomor telepon">
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('operator.index') }}" class="btn btn-secondary action-button">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary action-button">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>