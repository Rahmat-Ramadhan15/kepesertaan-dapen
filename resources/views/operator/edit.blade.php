<div class="modal-header">
    <h5 class="modal-title">Edit Peserta: {{ $peserta->nama }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formEditPeserta" action="{{ route('operator.update', $peserta->nip) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $peserta->nip }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $peserta->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="no_sk" class="form-label">No SK</label>
                    <input type="text" class="form-control" id="no_sk" name="no_sk" value="{{ $peserta->no_sk }}">
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki" {{ $peserta->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $peserta->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $peserta->tempat_lahir }}">
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $peserta->tanggal_lahir ? $peserta->tanggal_lahir->format('Y-m-d') : '' }}">
                </div>

                <div class="mb-3">
                    <label for="tmk" class="form-label">TMK</label>
                    <input type="date" class="form-control" id="tmk" name="tmk" value="{{ $peserta->tmk ? $peserta->tmk->format('Y-m-d') : '' }}">
                </div>

                <div class="mb-3">
                    <label for="tpst" class="form-label">TPST</label>
                    <input type="date" class="form-control" id="tpst" name="tpst" value="{{ $peserta->tpst ? $peserta->tpst->format('Y-m-d') : '' }}">
                </div>
                <div class="mb-3">
                    <label for="kode_peserta" class="form-label">Kode Peserta</label>
                    <input type="text" class="form-control" id="kode_peserta" name="kode_peserta" value="{{ $peserta->kode_peserta }}">
                </div>
                <div class="mb-3">
                    <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                    <select class="form-control" id="status_pernikahan" name="status_pernikahan">
                        <option value="Menikah" {{ $peserta->status_pernikahan == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Belum Menikah" {{ $peserta->status_pernikahan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $peserta->alamat }}">
                </div>
                <div class="mb-3">
                    <label for="kabupaten" class="form-label">Kabupaten</label>
                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ $peserta->kabupaten }}">
                </div>
                <div class="mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota" value="{{ $peserta->kota }}">
                </div>
                <div class="mb-3">
                    <label for="kode_pos" class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $peserta->kode_pos }}">
                </div>
                <div class="mb-3">
                    <label for="telpon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="telpon" name="telpon" value="{{ $peserta->telpon }}">
                </div>
                <div class="mb-3">
                    <label for="cabang" class="form-label">Cabang</label>
                    <select class="form-control" id="cabang" name="cabang_id">
                        @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" 
                                {{ $peserta->cabang_id == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->nama_cabang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pendidikan" class="form-label">Pendidikan</label>
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ $peserta->pendidikan }}">
                </div>
                <div class="mb-3">
                    <label for="golongan" class="form-label">Golongan</label>
                    <input type="text" class="form-control" id="golongan" name="golongan" value="{{ $peserta->golongan }}">
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $peserta->jabatan }}">
                </div>
                <div class="mb-3">
                    <label for="phdp" class="form-label">PHDp</label>
                    <input type="number" step="0.01" class="form-control" id="phdp" name="phdp" value="{{ $peserta->phdp }}">
                </div>
                <div class="mb-3">
                    <label for="akumulasi_ibhp" class="form-label">Akumulasi IBHP</label>
                    <input type="number" step="0.01" class="form-control" id="akumulasi_ibhp" name="akumulasi_ibhp" value="{{ $peserta->akumulasi_ibhp }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
