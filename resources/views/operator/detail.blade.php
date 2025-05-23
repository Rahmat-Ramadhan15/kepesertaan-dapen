<div class="modal-header" style="background-color: #f5f7ff; border-bottom: 1px solid #eee;">
    <h5 class="modal-title" style="color: #303f9f; font-weight: 600;">
        <i class="fas fa-user-circle me-2"></i>Detail Peserta: {{ $peserta->nama }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body" style="padding: 1.5rem; max-height: 70vh; overflow-y: auto;">
    <!-- Data Pribadi -->
    <div class="card" style="border: none; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 1.5rem; background-color: #fff;">
        <div class="card-header" style="background-color: #f5f7ff; border-bottom: 1px solid #eee; padding: 1rem 1.2rem; font-weight: 600;">
            <i class="fas fa-id-card me-2" style="color: #3f51b5;"></i>Data Pribadi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">NIP</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->nip }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Nama Lengkap</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->nama }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Jenis Kelamin</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->jenis_kelamin }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Tempat, Tanggal Lahir</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->tempat_lahir }}, 
                            @if($peserta->tanggal_lahir)
                                @if(is_string($peserta->tanggal_lahir))
                                    {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d M Y') }}
                                @else
                                    {{ $peserta->tanggal_lahir->format('d M Y') }}
                                @endif
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Usia</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->usia ?? '-' }} tahun
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Status Pernikahan</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->status_kawin ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Kepegawaian -->
    <div class="card" style="border: none; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 1.5rem; background-color: #fff;">
        <div class="card-header" style="background-color: #f5f7ff; border-bottom: 1px solid #eee; padding: 1rem 1.2rem; font-weight: 600;">
            <i class="fas fa-briefcase me-2" style="color: #3f51b5;"></i>Data Kepegawaian
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Nomor SK</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->no_sk ?? '-' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">TMK</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            @if($peserta->tmk)
                                @if(is_string($peserta->tmk))
                                    {{ \Carbon\Carbon::parse($peserta->tmk)->format('d M Y') }}
                                @else
                                    {{ $peserta->tmk->format('d M Y') }}
                                @endif
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">TPST</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            @if($peserta->tpst)
                                @if(is_string($peserta->tpst))
                                    {{ \Carbon\Carbon::parse($peserta->tpst)->format('d M Y') }}
                                @else
                                    {{ $peserta->tpst->format('d M Y') }}
                                @endif
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Golongan</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->golongan ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Cabang</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->cabang->nama_cabang ?? 'Tidak ada cabang' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">MKMK</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            @if($peserta->mkmk)
                                @if(is_string($peserta->mkmk))
                                    {{ \Carbon\Carbon::parse($peserta->mkmk)->format('d M Y') }}
                                @else
                                    {{ $peserta->mkmk->format('d M Y') }}
                                @endif
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">MKMP</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            @if($peserta->mkmp)
                                @if(is_string($peserta->mkmp))
                                    {{ \Carbon\Carbon::parse($peserta->mkmp)->format('d M Y') }}
                                @else
                                    {{ $peserta->mkmp->format('d M Y') }}
                                @endif
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Jabatan</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->jabatan ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Kode Direktorat</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->kode_dir ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Tahun Menjabat</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            @if($peserta->tahun_jabat)
                                @if(is_string($peserta->tahun_jabat))
                                    {{ \Carbon\Carbon::parse($peserta->tahun_jabat)->format('Y') }}
                                @else
                                    {{ $peserta->tahun_jabat->format('Y') }}
                                @endif
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Pendidikan -->
    <div class="card" style="border: none; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 1.5rem; background-color: #fff;">
        <div class="card-header" style="background-color: #f5f7ff; border-bottom: 1px solid #eee; padding: 1rem 1.2rem; font-weight: 600;">
            <i class="fas fa-graduation-cap me-2" style="color: #3f51b5;"></i>Data Pendidikan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Pendidikan Terakhir</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->pendidikan ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Jurusan</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->jurusan ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Keuangan -->
    <div class="card" style="border: none; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 1.5rem; background-color: #fff;">
        <div class="card-header" style="background-color: #f5f7ff; border-bottom: 1px solid #eee; padding: 1rem 1.2rem; font-weight: 600;">
            <i class="fas fa-money-bill-wave me-2" style="color: #3f51b5;"></i>Data Keuangan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">PHDP</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            Rp {{ number_format($peserta->phdp ?? 0, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Kode PTKP</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->kode_ptkp ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Akumulasi IBHP</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            Rp {{ number_format($peserta->akumulasi_ibhp ?? 0, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Kode Peserta</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->kode_peserta ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Alamat -->
    <div class="card" style="border: none; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 1.5rem; background-color: #fff;">
        <div class="card-header" style="background-color: #f5f7ff; border-bottom: 1px solid #eee; padding: 1rem 1.2rem; font-weight: 600;">
            <i class="fas fa-map-marker-alt me-2" style="color: #3f51b5;"></i>Data Alamat
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Alamat Lengkap</label>
                <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem; min-height: 60px;">
                    {{ $peserta->alamat ?? '-' }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Kelurahan</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->kelurahan ?? '-' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Kabupaten/Kota</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->kabupaten_kota ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Kecamatan</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->kecamatan ?? '-' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Kode Pos</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            {{ $peserta->kode_pos ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #495057; margin-bottom: 0.3rem;">Telepon</label>
                        <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">
                            <i class="fas fa-phone me-2"></i>{{ $peserta->telpon ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Keluarga -->
    <div class="card" style="border: none; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 1.5rem; background-color: #fff;">
        <div class="card-header" style="background-color: #f5f7ff; border-bottom: 1px solid #eee; padding: 1rem 1.2rem; font-weight: 600;">
            <i class="fas fa-users me-2" style="color: #3f51b5;"></i>Data Keluarga
        </div>
        <div class="card-body">
            @if($peserta->keluargas->isEmpty())
                <div class="text-center py-4">
                    <i class="fas fa-users" style="font-size: 3rem; color: #dee2e6; margin-bottom: 1rem;"></i>
                    <p class="text-muted">Tidak ada data keluarga.</p>
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table class="table table-striped">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th style="border: 1px solid #dee2e6; font-weight: 600;">Nama</th>
                                <th style="border: 1px solid #dee2e6; font-weight: 600;">Hubungan</th>
                                <th style="border: 1px solid #dee2e6; font-weight: 600;">Pekerjaan</th>
                                <th style="border: 1px solid #dee2e6; font-weight: 600;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peserta->keluargas as $keluarga)
                                <tr>
                                    <td style="border: 1px solid #dee2e6;">{{ $keluarga->nama }}</td>
                                    <td style="border: 1px solid #dee2e6;">{{ $keluarga->hubungan }}</td>
                                    <td style="border: 1px solid #dee2e6;">{{ $keluarga->pekerjaan ?? '-' }}</td>
                                    <td style="border: 1px solid #dee2e6;">
                                        <form action="{{ route('keluarga.destroy', $keluarga->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" style="padding: 0.3rem 0.6rem; border-radius: 0.3rem;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal-footer" style="border-top: 1px solid #eee; padding: 1rem 1.5rem; background-color: #f8f9fa;">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding: 0.6rem 1.2rem; border-radius: 0.5rem; font-weight: 500;">
        <i class="fas fa-times me-2"></i>Tutup
    </button>

    <button class="btn btn-warning btn-edit" data-nip="{{ $peserta->nip }}" style="padding: 0.6rem 1.2rem; border-radius: 0.5rem; font-weight: 500; background-color: #ffc107; border-color: #ffc107;">
        <i class="fas fa-edit me-2"></i>Edit
    </button>

    <form action="{{ route('operator.destroy', $peserta->nip) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="padding: 0.6rem 1.2rem; border-radius: 0.5rem; font-weight: 500;">
            <i class="fas fa-trash me-2"></i>Hapus
        </button>
    </form>

    <a href="{{ route('keluarga.create', $peserta->nip) }}" class="btn btn-success" style="padding: 0.6rem 1.2rem; border-radius: 0.5rem; font-weight: 500; background-color: #28a745; border-color: #28a745;">
        <i class="fas fa-plus me-2"></i>Tambah Keluarga
    </a>
</div>

<script>
    $(document).ready(function() {
        // Klik baris peserta untuk lihat detail
        $('.row-clickable').on('click', function(e) {
            // Cegah klik jika menekan tombol atau form
            if ($(e.target).is('button') || $(e.target).closest('form').length) return;

            let nip = $(this).data('nip');
            let url = "{{ route('operator.detail', ':nip') }}".replace(':nip', nip);

            $('#modalPeserta .modal-body').html('<div class="text-center py-4"><i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #3f51b5;"></i><p class="mt-2">Loading...</p></div>');

            $.get(url, function(data) {
                $('#modalContent').html(data);
            });

            $('#modalPeserta').modal('show');
        });

        // Klik tombol edit di dalam modal
        $(document).on('click', '.btn-edit', function() {
            let nip = $(this).data('nip');
            let url = "{{ route('operator.edit', ':nip') }}".replace(':nip', nip);

            $('#modalPeserta .modal-body').html('<div class="text-center py-4"><i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #3f51b5;"></i><p class="mt-2">Loading...</p></div>');

            $.get(url, function(data) {
                $('#modalContent').html(data);
            });
        });

        // Form update peserta
        $(document).on('submit', '#formEditPeserta', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');

            $.post(url, form.serialize(), function(response) {
                alert(response.message);
                $('#modalPeserta').modal('hide');
                location.reload();
            }).fail(function() {
                alert("Gagal menyimpan data!");
            });
        });
    });
</script>