<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h4>Tambah Keluarga untuk NIP: <strong>{{ $peserta->nip }}</strong> ({{ $peserta->nama }})</h4>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <form action="{{ route('keluarga.store') }}" method="POST" class="mt-3">
        @csrf

        <input type="hidden" name="nip" value="{{ $peserta->nip }}">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Anggota Keluarga</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="hubungan" class="form-label">Hubungan</label>
            <select class="form-select" id="hubungan" name="hubungan" required>
                <option value="">-- Pilih Hubungan --</option>
                <option value="Suami">Suami</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Orang Tua">Orang Tua</option>
                <option value="Saudara">Saudara</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('operator.dashboard') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>
