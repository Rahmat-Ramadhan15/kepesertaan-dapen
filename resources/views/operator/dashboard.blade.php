<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta</title>
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
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            padding: 1rem 1.5rem;
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
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            font-weight: 600;
            color: #555;
            border-top: none;
            background-color: var(--primary-light);
            padding: 1rem 1.5rem;
        }
        
        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }
        
        .row-clickable {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        
        .row-clickable:hover {
            background-color: var(--primary-light);
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 0;
            padding: 1rem 1.5rem;
        }
        
        .modal-content {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .modal-title {
            font-weight: 600;
            font-size: 1.3rem;
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #777;
        }
        
        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        /* Custom gender badges */
        .gender-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            pointer-events: none; /* Prevent badge click events */
        }
        
        .male {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .female {
            background-color: #fce4ec;
            color: #c2185b;
        }
        
        /* Cabang badge */
        .cabang-badge {
            background-color: #f1f8e9;
            color: #558b2f;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            pointer-events: none; /* Prevent badge click events */
        }
        
        /* Add animation for modal */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translateY(-50px);
        }
        
        .modal.show .modal-dialog {
            transform: translateY(0);
        }

        /* Detail button for explicit action */
        .btn-view-detail {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
            background-color: var(--primary-light);
            color: var(--primary-dark);
            border: 1px solid var(--primary-color);
            border-radius: 4px;
        }
        
        .btn-view-detail:hover {
            background-color: var(--primary-color);
            color: white;
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
        .sidebar {
        width: 250px;
        height: calc(100vh - 40px);
        margin: 20px 0 20px 20px;
        background: linear-gradient(to bottom, #4a5bcc, #3f51b5);
        border-radius: 16px;
        position: fixed;
        left: 0;
        top: 0;
        overflow-y: auto;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease;
        z-index: 1000;
        padding: 0;
        color: #fff;
    }

    .sidebar.collapsed {
        margin-left: -250px;
    }

    .sidebar-header {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        font-weight: bold;
        font-size: 18px;
        padding: 1.2rem 1.25rem;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar ul {
        padding-top: 0.5rem;
    }

    .sidebar ul li {
        margin: 0.5rem 0;
    }

    .sidebar ul li a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin: 0 0.75rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }

    .sidebar ul li a:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        transform: translateX(3px);
    }

    .sidebar ul li a.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        font-weight: 500;
    }

    .sidebar ul li a i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    /* Divider styling */
    .sidebar ul li.border-top {
        border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        margin-top: 1rem;
        padding-top: 1rem;
    }

    /* Logout button styling */
    .sidebar ul li a.text-danger {
        color: #fff !important;
    }

    .sidebar ul li a.text-danger:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    /* Custom scrollbar for sidebar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    #mainContent {
        margin-left: 250px;
        transition: all 0.3s ease;
        padding: 20px;
        width: 100%;
    }

    body.sidebar-hidden #mainContent {
        margin-left: 0;
    }
</style>
</head>
<body class="sidebar-hidden">

<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar shadow-sm collapsed">
        <div class="sidebar-header px-3 py-3 d-flex justify-content-between align-items-center">
            <span>Dana Pensiun</span>
        </div>
        <ul class="list-unstyled px-3 mt-3">
            <li>
                <a href="{{ route('operator.index') }}" class="active">
                    <i class="fas fa-users"></i>
                    Data Peserta
                </a>
            </li>
            <li>
                <a href="{{ route('cetak.index') }}">
                    <i class="fas fa-print"></i>
                    <span>Menu Cetak</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manfaat.index') }}">
                    <i class="fas fa-book"></i>
                    <span>Manfaat Pensiun</span>
                </a>
            </li>
            <li>
                <a href="{{ route('hitung.index') }}">
                    <i class="fas fa-calculator"></i>
                    <span>Hitung Iuran</span>
                </a>
            </li>
            <!-- Tambahkan menu lainnya di sini -->
            
            <!-- Spacer to push logout to bottom -->
            <div class="mt-auto"></div>
            
            <!-- Divider before logout -->
            <li class="mt-5 pt-2 border-top">
                <a href="{{ route('logout') }}" class="text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1" id="mainContent">
        <!-- Toggle Button -->
        <button id="toggleSidebar" class="btn btn-primary m-3">
            <i class="fas fa-bars"></i>
        </button>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">
                <i class="fas fa-users me-2"></i> Data Peserta
            </h1>
        </div>

        <form action="{{ route('operator.index') }}" method="GET" class="mb-4 row g-2 align-items-end">
            <div class="col-md-3">
                <label for="filter_cabang" class="form-label">Cabang</label>
                <select name="cabang" id="filter_cabang" class="form-select">
                    <option value="">Semua Cabang</option>
                    @foreach($listCabang as $cabang)
                        <option value="{{ $cabang->id }}" {{ request('cabang') == $cabang->id ? 'selected' : '' }}>
                            {{ $cabang->nama_cabang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="filter_gender" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="filter_gender" class="form-select">
                    <option value="">Semua</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="filter_nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="filter_nama" class="form-control" placeholder="Cari nama..." value="{{ request('nama') }}">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <a href="{{ route('operator.index') }}" class="btn btn-primary me-2">
                    <i class="fas fa-sync-alt me-1"></i> Reset
                </a>
                <a href="{{ route('operator.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Tambah 
                </a>
            </div>
        </form>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>Daftar Seluruh Peserta</strong>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="20%">NIP</th>
                            <th width="30%">Nama</th>
                            <th width="15%">Jenis Kelamin</th>
                            <th width="20%" class="text-center
                            ">Cabang</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $p)
                            <tr>
                                <td>{{ $p->nip }}</td>
                                <td class="fw-semibold">{{ $p->nama }}</td>
                                <td>
                                    @if($p->jenis_kelamin == 'Laki-laki')
                                        <span class="gender-badge male">
                                            <i class="fas fa-mars me-1"></i> {{ $p->jenis_kelamin }}
                                        </span>
                                    @else
                                        <span class="gender-badge female">
                                            <i class="fas fa-venus me-1"></i> {{ $p->jenis_kelamin }}
                                        </span>
                                    @endif
                                </td>
                                <td style="padding-left: 50px;">
                                    <span class="cabang-badge">
                                        <i class="fas fa-building me-1"></i> {{ $p->cabang->nama_cabang ?? 'Tidak ada cabang' }}
                                    </span>
                                </td>
                                <td style="padding-left: 50px;">
                                    <button class="btn btn-view-detail" data-nip="{{ $p->nip }}">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPeserta" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-circle me-2"></i> Detail Peserta
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cache for loaded data
            const dataCache = {};
            
            // Function to fetch and display peserta detail
            function loadPesertaDetail(nip) {
                if (!nip) {
                    console.error("NIP tidak valid");
                    return;
                }
                
                const url = "{{ route('operator.detail', ':nip') }}".replace(':nip', nip);
                
                // Set loading state in modal
                $('#modalPeserta .modal-body').html(`
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Loading data untuk NIP: ${nip}...</span>
                    </div>
                `);
                
                // Show modal immediately with loading state
                $('#modalPeserta').modal('show');
                
                // Check if data is in cache
                if (dataCache[nip]) {
                    console.log("Loading from cache for NIP:", nip);
                    $('#modalContent').html(dataCache[nip]);
                    return;
                }
                
                // Fetch data via AJAX with a slight delay to ensure modal is visible first
                setTimeout(function() {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        cache: false,
                        success: function(data) {
                            // Store in cache
                            dataCache[nip] = data;
                            // Update modal content
                            $('#modalContent').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error loading data:", error);
                            $('#modalPeserta .modal-body').html(`
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Gagal memuat data untuk NIP: ${nip}. 
                                    <hr>
                                    Error: ${error}
                                </div>
                                <div class="text-center mt-3">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button class="btn btn-primary ms-2" onclick="loadPesertaDetail('${nip}')">
                                        <i class="fas fa-sync-alt me-1"></i> Coba Lagi
                                    </button>
                                </div>
                            `);
                        }
                    });
                }, 300);
            }
            
            // Handler for detail button
            $(document).on('click', '.btn-view-detail', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const nip = $(this).data('nip');
                loadPesertaDetail(nip);
            });
            
            // AJAX untuk menampilkan form edit peserta
            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const nip = $(this).data('nip');
                const url = "{{ route('operator.edit', ':nip') }}".replace(':nip', nip);
                
                $('#modalPeserta .modal-body').html(`
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Loading form edit...</span>
                    </div>
                `);
                
                $('#modalPeserta').modal('show');
                
                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    success: function(data) {
                        $('#modalContent').html(data);
                    },
                    error: function(xhr, status, error) {
                        $('#modalPeserta .modal-body').html(`
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Gagal memuat form edit. 
                                <hr>
                                Error: ${error}
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        `);
                    }
                });
            });
            
            // Handle form submission for edit form
            $(document).on('submit', '#formEditPeserta', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const form = $(this);
                const url = form.attr('action');
                const formData = form.serialize();
                
                // Show loading state
                const submitBtn = form.find('button[type="submit"]');
                const originalBtnText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...');
                submitBtn.prop('disabled', true);
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    success: function(response) {
                        // Clear cache on successful update
                        dataCache = {};
                        
                        alert(response.message || 'Data berhasil disimpan');
                        $('#modalPeserta').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        submitBtn.html(originalBtnText);
                        submitBtn.prop('disabled', false);
                        
                        let errorMsg = 'Gagal menyimpan data!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        
                        alert(errorMsg);
                    }
                });
            });
            
            // Ensure modal closes properly
            $(document).on('click', '[data-bs-dismiss="modal"]', function() {
                $('#modalPeserta').modal('hide');
            });
            
            // Clean up when modal is hidden
            $('#modalPeserta').on('hidden.bs.modal', function() {
                // Optional: clear modal content when closed
                // $('#modalContent').html('');
            });
        });
    </script>
 <script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.body.classList.toggle('sidebar-hidden');
    });
</script>

</body>
</html>