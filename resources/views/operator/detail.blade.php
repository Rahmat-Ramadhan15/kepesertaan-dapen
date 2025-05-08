<div class="modal-header">
    <h5 class="modal-title">Detail Peserta: {{ $peserta->nama }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <h4>Informasi Pribadi</h4>
            <p><strong>NIP:</strong> {{ $peserta->nip }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $peserta->jenis_kelamin }}</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $peserta->tempat_lahir }}, {{ $peserta->tanggal_lahir->format('d M Y') }}</p>
            <p><strong>Status Pernikahan:</strong> {{ $peserta->status_pernikahan }}</p>
        </div>
        <div class="col-md-6">
            <h4>Informasi Pekerjaan</h4>
            <p><strong>Nomor SK:</strong> {{ $peserta->no_sk }}</p>
            <p><strong>TMK:</strong> {{ $peserta->tmk->format('d M Y') }}</p>
            <p><strong>TPST:</strong> {{ $peserta->tpst->format('d M Y') }}</p>
            <p><strong>Golongan:</strong> {{ $peserta->golongan }}</p>
            <p><strong>Jabatan:</strong> {{ $peserta->jabatan }}</p>
            <p><strong>Cabang:</strong> {{ $peserta->cabang->nama_cabang ?? 'Tidak ada cabang' }}</p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <h4>Pendidikan</h4>
            <p><strong>Pendidikan:</strong> {{ $peserta->pendidikan }}</p>
            <p><strong>Jurusan:</strong> {{ $peserta->jurusan }}</p>
        </div>
        <div class="col-md-6">
            <h4>Keuangan</h4>
            <p><strong>PHDP:</strong> Rp. {{ number_format($peserta->phdp, 2) }}</p>
            <p><strong>Akumulasi IBHP:</strong> Rp. {{ number_format($peserta->akumulasi_ibhp, 2) }}</p>
        </div>
    </div>

    <div class="row mt-4">
    <div class="col-12">
        <h4>Data Keluarga</h4>
        @if($peserta->keluargas->isEmpty())
            <p>Tidak ada data keluarga.</p>
        @else
        <div style="overflow-x:auto;">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Hubungan</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Status Hidup</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keluarga->keluargas as $keluarga)
                        <tr>
                            <td>{{ $keluarga->nama }}</td>
                            <td>{{ $keluarga->hubungan }}</td>
                            <td>{{ $keluarga->jenis_kelamin }}</td>
                            <td>{{ \Carbon\Carbon::parse($keluarga->tanggal_lahir)->format('d M Y') }}</td>
                            <td>{{ $keluarga->status_hidup }}</td>
                            <td>{{ $keluarga->pekerjaan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('keluarga.destroy', $keluarga->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
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


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

    <button class="btn btn-warning btn-sm btn-edit" data-nip="{{ $peserta->nip }}">
        Edit
    </button>

    <form action="{{ route('operator.destroy', $peserta->nip) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
    </form>

    <a href="{{ route('keluarga.create', $peserta->nip) }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus me-1"></i> Tambah Keluarga
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

            $('#modalPeserta .modal-body').html('<p>Loading...</p>');

            $.get(url, function(data) {
                $('#modalContent').html(data);
            });

            $('#modalPeserta').modal('show');
        });

        // Klik tombol edit di dalam modal
        $(document).on('click', '.btn-edit', function() {
            let nip = $(this).data('nip');
            let url = "{{ route('operator.edit', ':nip') }}".replace(':nip', nip);

            $('#modalPeserta .modal-body').html('<p>Loading...</p>');

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
