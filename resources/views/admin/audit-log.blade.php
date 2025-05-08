
<body class="p-4 bg-light">
<div class="container">
    <h3 class="mb-4">Audit Log</h3>

    {{-- FORM FILTER --}}
    <form method="GET" id="filter-form" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="tanggal" class="form-control"
                    value="{{ $tanggal ?? \Carbon\Carbon::today()->format('Y-m-d') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" id="reset-btn" class="btn btn-secondary">Reset</button>
            </div>
        </div>
    </form>

    {{-- TABEL AUDIT LOG --}}
    <div id="audit-log-table">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Aksi</th>
                    <th>Deskripsi</th>
                    <th>Perubahan</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                    <td class="text-uppercase">{{ $log->action }}</td>
                    <td>{{ $log->description }}</td>
                    <td>
                    @if (!empty($log->old_values) || !empty($log->new_values))
                        <ul class="mb-0 small">
                            @php
                                $fields = array_unique(array_merge(
                                    array_keys($log->old_values ?? []),
                                    array_keys($log->new_values ?? [])
                                ));
                            @endphp

                            @foreach ($fields as $field)
                                <li>
                                    <strong>{{ $field }}:</strong>
                                    {{ $log->old_values[$field] ?? '-' }} → {{ $log->new_values[$field] ?? '-' }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <em class="text-muted">-</em>
                    @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada log ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- SCRIPT AJAX --}}
<script>
    $(document).ready(function () {
        $('#filter-form').on('submit', function (e) {
            e.preventDefault();
            let tanggal = $('input[name="tanggal"]').val();

            $.ajax({
                url: "{{ route('admin.audit-log') }}",
                type: "GET",
                data: { tanggal: tanggal },
                success: function (data) {
                    let newTable = $(data).find('#audit-log-table').html();
                    $('#audit-log-table').html(newTable);
                }
            });
        });

        $('#reset-btn').on('click', function () {
            $('input[name="tanggal"]').val('');
            $('#filter-form').submit();
        });
    });
</script>
</body>
