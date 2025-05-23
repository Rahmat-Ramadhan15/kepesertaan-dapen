<div class="modal-header">
    <h5 class="modal-title">
        <i class="fas fa-user-edit me-2"></i>Edit Peserta: {{ $peserta->nama }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formEditPeserta" action="{{ route('operator.update', $peserta->nip) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Data Pribadi -->
        <div class="form-section-title">
            <i class="fas fa-id-card me-2"></i> Data Pribadi
        </div>
        
        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="nip" class="form-label required-field">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ $peserta->nip }}" readonly>
            </div>
            <div class="col-md-6 form-field-group">
                <label for="nama" class="form-label required-field">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $peserta->nama }}" required placeholder="Masukkan nama lengkap">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="jenis_kelamin" class="form-label required-field">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ $peserta->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $peserta->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-6 form-field-group">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $peserta->tempat_lahir }}" placeholder="Masukkan tempat lahir">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $peserta->tanggal_lahir ? (is_string($peserta->tanggal_lahir) ? $peserta->tanggal_lahir : $peserta->tanggal_lahir->format('Y-m-d')) : '' }}">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="usia" class="form-label">Usia</label>
                <input type="number" class="form-control" id="usia" name="usia" value="{{ $peserta->usia }}" placeholder="Masukkan usia">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="status_kawin" class="form-label">Status Pernikahan</label>
                <select class="form-select" id="status_kawin" name="status_kawin">
                    <option value="">Pilih Status</option>
                    <option value="Lajang" {{ $peserta->status_kawin == 'Lajang' ? 'selected' : '' }}>Lajang</option>
                    <option value="Menikah" {{ $peserta->status_kawin == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="Duda" {{ $peserta->status_kawin == 'Duda' ? 'selected' : '' }}>Duda</option>
                    <option value="Janda" {{ $peserta->status_kawin == 'Janda' ? 'selected' : '' }}>Janda</option>
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
                <input type="text" class="form-control" id="no_sk" name="no_sk" value="{{ $peserta->no_sk }}" placeholder="Masukkan nomor SK">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="cabang_id" class="form-label">Cabang</label>
                <select class="form-select" id="cabang_id" name="cabang_id">
                    <option value="">Pilih Cabang</option>
                    @foreach($cabangs as $cabang)
                        <option value="{{ $cabang->id }}" {{ $peserta->cabang_id == $cabang->id ? 'selected' : '' }}>
                            {{ $cabang->nama_cabang }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="tmk" class="form-label">TMK (Tanggal Mulai Kerja)</label>
                <input type="date" class="form-control" id="tmk" name="tmk" value="{{ $peserta->tmk ? (is_string($peserta->tmk) ? $peserta->tmk : $peserta->tmk->format('Y-m-d')) : '' }}">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="mkmk" class="form-label">MKMK</label>
                <input type="date" class="form-control" id="mkmk" name="mkmk" value="{{ $peserta->mkmk ? (is_string($peserta->mkmk) ? $peserta->mkmk : $peserta->mkmk->format('Y-m-d')) : '' }}" placeholder="Masukkan MKMK">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="tpst" class="form-label">TPST</label>
                <input type="date" class="form-control" id="tpst" name="tpst" value="{{ $peserta->tpst ? (is_string($peserta->tpst) ? $peserta->tpst : $peserta->tpst->format('Y-m-d')) : '' }}">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="mkmp" class="form-label">MKMP</label>
                <input type="date" class="form-control" id="mkmp" name="mkmp" value="{{ $peserta->mkmp ? (is_string($peserta->mkmp) ? $peserta->mkmp : $peserta->mkmp->format('Y-m-d')) : '' }}" placeholder="Masukkan MKMP">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="golongan" class="form-label">Golongan</label>
                <select class="form-select" id="golongan" name="golongan">
                    <option value="">Pilih Golongan</option>
                    <option value="Karyawan" {{ $peserta->golongan == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                    <option value="Direktur" {{ $peserta->golongan == 'Direktur' ? 'selected' : '' }}>Direktur</option>
                </select>
            </div>
            <div class="col-md-6 form-field-group">
                <label for="kode_dir" class="form-label">Kode Direktorat</label>
                <input type="text" class="form-control" id="kode_dir" name="kode_dir" value="{{ $peserta->kode_dir }}" placeholder="Masukkan kode direktorat">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $peserta->jabatan }}" placeholder="Masukkan jabatan">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="tahun_jabat" class="form-label">Tahun Menjabat</label>
                <input type="date" class="form-control" id="tahun_jabat" name="tahun_jabat" value="{{ $peserta->tahun_jabat ? (is_string($peserta->tahun_jabat) ? $peserta->tahun_jabat : $peserta->tahun_jabat->format('Y-m-d')) : '' }}" placeholder="Masukkan tahun menjabat">
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
                    <option value="SD" {{ $peserta->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ $peserta->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA/SMK" {{ $peserta->pendidikan == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                    <option value="D3" {{ $peserta->pendidikan == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="S1" {{ $peserta->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ $peserta->pendidikan == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ $peserta->pendidikan == 'S3' ? 'selected' : '' }}>S3</option>
                </select>
            </div>
            <div class="col-md-6 form-field-group">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ $peserta->jurusan }}" placeholder="Masukkan jurusan">
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
                    <input type="number" step="0.01" class="form-control" id="phdp" name="phdp" value="{{ $peserta->phdp }}" placeholder="0.00">
                </div>
            </div>
            <div class="col-md-6 form-field-group">
                <label for="akumulasi_ibhp" class="form-label">Akumulasi IBHP</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" step="0.01" class="form-control" id="akumulasi_ibhp" name="akumulasi_ibhp" value="{{ $peserta->akumulasi_ibhp }}" placeholder="0.00">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="kode_ptkp" class="form-label">Kode PTKP</label>
                <input type="text" class="form-control" id="kode_ptkp" name="kode_ptkp" value="{{ $peserta->kode_ptkp }}" placeholder="Masukkan kode PTKP">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="kode_peserta" class="form-label">Kode Peserta</label>
                <input type="text" class="form-control" id="kode_peserta" name="kode_peserta" value="{{ $peserta->kode_peserta }}" placeholder="Masukkan kode peserta">
            </div>
        </div>

        <!-- Data Alamat -->
        <div class="section-divider"></div>
        <div class="form-section-title">
            <i class="fas fa-map-marker-alt me-2"></i> Data Alamat
        </div>
        
        <div class="form-field-group">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ $peserta->alamat }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="kelurahan" class="form-label">Kelurahan</label>
                <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ $peserta->kelurahan }}" placeholder="Masukkan kelurahan">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ $peserta->kecamatan }}" placeholder="Masukkan kecamatan">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="kabupaten_kota" class="form-label">Kabupaten/Kota</label>
                <input type="text" class="form-control" id="kabupaten_kota" name="kabupaten_kota" value="{{ $peserta->kabupaten_kota }}" placeholder="Masukkan kabupaten/kota">
            </div>
            <div class="col-md-6 form-field-group">
                <label for="kode_pos" class="form-label">Kode Pos</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $peserta->kode_pos }}" placeholder="Masukkan kode pos">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-field-group">
                <label for="telpon" class="form-label">Telepon</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" class="form-control" id="telpon" name="telpon" value="{{ $peserta->telpon }}" placeholder="Masukkan nomor telepon">
                </div>
            </div>
        </div>

        <div class="section-divider"></div>
        
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-secondary action-button" data-bs-dismiss="modal">
                <i class="fas fa-times me-2"></i> Batal
            </button>
            <button type="submit" class="btn btn-primary action-button">
                <i class="fas fa-save me-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<style>
    .form-section-title {
        color: var(--primary-dark, #303f9f);
        font-weight: 600;
        margin: 1.5rem 0 1rem 0;
        font-size: 1.1rem;
    }
    
    .section-divider {
        margin: 1.5rem 0;
        height: 1px;
        background-color: #eee;
    }
    
    .form-field-group {
        margin-bottom: 1.5rem;
    }
    
    .required-field::after {
        content: " *";
        color: #dc3545;
    }
    
    .action-button {
        padding: 0.6rem 1.2rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .action-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .form-control, .form-select {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color, #3f51b5);
        box-shadow: 0 0 0 0.25rem rgba(63, 81, 181, 0.1);
        transform: translateY(-2px);
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
</style>