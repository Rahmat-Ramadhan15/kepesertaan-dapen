<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cetak Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        
        /* Sidebar styles */
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
        
        /* Specific styles for print menu */
        .form-label {
            font-weight: 500;
            color: #555;
        }
        
        .print-options {
            background-color: var(--primary-light);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .preview-area {
            max-height: 600px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            padding: 1rem;
        }
        
        .preview-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .preview-table th, .preview-table td {
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
        }
        
        .preview-table th {
            background-color: var(--primary-light);
            text-align: left;
            font-weight: 600;
        }
        
        .preview-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        /* Badges */
        .badge-print {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
            border-radius: 20px;
        }
        
        .badge-age {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .badge-gender {
            background-color: #fce4ec;
            color: #c2185b;
        }
        
        .badge-status {
            background-color: #f1f8e9;
            color: #558b2f;
        }
        
        /* Range slider */
        .range-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 6px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
        }
        
        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary-color);
            cursor: pointer;
        }
        
        .range-slider::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary-color);
            cursor: pointer;
        }
        
        .range-values {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            color: #666;
            font-size: 0.85rem;
        }
        
        /* Print styles */
        @media print {
            body {
                background-color: #fff;
            }
            
            .sidebar, .btn-print-controls, .no-print {
                display: none !important;
            }
            
            #mainContent {
                margin-left: 0;
                padding: 0;
            }
            
            .preview-area {
                border: none;
                max-height: none;
                overflow: visible;
                padding: 0;
            }
            
            .preview-table {
                page-break-inside: auto;
            }
            
            .preview-table tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            
            .card {
                box-shadow: none;
                border: none;
            }
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
                <a href="{{ route('operator.index') }}">
                    <i class="fas fa-users"></i>
                    Data Peserta
                </a>
            </li>
            <li>
                <a href="{{ route('cetak.index') }}"  class="active">
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
                    <i class="fas fa-print me-2"></i> Menu Cetak Laporan Peserta
                </h1>
                <div class="btn-print-controls">
                    <button type="button" id="btnPreview" class="btn btn-primary action-button">
                        <i class="fas fa-eye me-2"></i> Preview
                    </button>
                    <button type="button" id="btnPrint" class="btn btn-success action-button">
                        <i class="fas fa-print me-2"></i> Cetak
                    </button>
                    <button type="button" id="btnExport" class="btn btn-secondary action-button">
                        <i class="fas fa-file-export me-2"></i> Export
                    </button>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-filter me-2"></i> Filter Laporan
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="filterForm">
                                <!-- Jenis Laporan -->
                                <div class="mb-3">
                                    <label class="form-label">Jenis Laporan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_laporan" id="laporanUmum" value="umum" checked>
                                        <label class="form-check-label" for="laporanUmum">
                                            Laporan Umum Peserta
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_laporan" id="laporanDetail" value="detail">
                                        <label class="form-check-label" for="laporanDetail">
                                            Laporan Detail Peserta
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_laporan" id="laporanKeluarga" value="keluarga">
                                        <label class="form-check-label" for="laporanKeluarga">
                                            Laporan Keluarga Peserta
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                
                                <!-- Filter Range Umur -->
                                <div class="mb-3">
                                    <label class="form-label">Range Umur</label>
                                    <div class="d-flex gap-2 align-items-center mb-2">
                                        <input type="number" class="form-control form-control-sm" id="umurMin" min="18" max="65" value="18">
                                        <span>s/d</span>
                                        <input type="number" class="form-control form-control-sm" id="umurMax" min="18" max="65" value="65">
                                        <span>tahun</span>
                                    </div>
                                    <input type="range" class="range-slider" id="umurSlider" min="18" max="65" value="40">
                                    <div class="range-values">
                                        <span>18 th</span>
                                        <span>40 th</span>
                                        <span>65 th</span>
                                    </div>
                                </div>
                                
                                <!-- Cabang -->
                                <div class="mb-3">
                                    <label for="filter_cabang" class="form-label">Cabang</label>
                                    <select id="filter_cabang" class="form-select" name="cabang">
                                        <option value="">Semua Cabang</option>
                                        @foreach($cabang as $c)
                                            <option value="{{ $c->id }}">{{ $c->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Jenis Kelamin -->
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelaminSemua" value="" checked>
                                        <label class="form-check-label" for="jenisKelaminSemua">
                                            Semua
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelaminLaki" value="Laki-laki">
                                        <label class="form-check-label" for="jenisKelaminLaki">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelaminPerempuan" value="Perempuan">
                                        <label class="form-check-label" for="jenisKelaminPerempuan">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Status Pernikahan -->
                                <div class="mb-3">
                                    <label class="form-label">Status Pernikahan</label>
                                    <select id="filter_status_pernikahan" class="form-select" name="status_kawin">
                                        <option value="">Semua Status</option>
                                        @foreach($statusPernikahan as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Pendidikan -->
                                <div class="mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <select id="filter_pendidikan" class="form-select" name="pendidikan">
                                        <option value="">Semua Pendidikan</option>
                                        @foreach($pendidikanTerakhir as $pendidikan)
                                            <option value="{{ $pendidikan }}">{{ $pendidikan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Range PHDP -->
                                <div class="mb-3">
                                    <label class="form-label">Range PHDP</label>
                                    <div class="d-flex gap-2 align-items-center mb-2">
                                        <input type="number" class="form-control form-control-sm" id="phdpMin" min="0" value="0">
                                        <span>s/d</span>
                                        <input type="number" class="form-control form-control-sm" id="phdpMax" min="0" value="50000000">
                                    </div>
                                </div>
                                
                                <!-- Golongan -->
                                <div class="mb-3">
                                    <label class="form-label">Golongan</label>
                                    <select id="filter_golongan" class="form-select" name="golongan">
                                        <option value="">Semua Golongan</option>
                                        @foreach($golonganList as $golongan)
                                            <option value="{{ $golongan }}">Golongan {{ $golongan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Tombol Reset & Filter -->
                                <div class="d-flex gap-2 mt-4">
                                    <button type="reset" class="btn btn-secondary flex-fill">
                                        <i class="fas fa-undo me-1"></i> Reset
                                    </button>
                                    <button type="button" id="btnFilter" class="btn btn-primary flex-fill">
                                        <i class="fas fa-filter me-1"></i> Terapkan Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-table me-2"></i> Preview Laporan
                            </h5>
                            <div class="print-info">
                                <span class="badge bg-info">
                                    <i class="fas fa-users me-1"></i> <span id="totalPeserta">0</span> Peserta
                                </span>
                            </div>
                        </div>
                        <div class="card-body preview-area">
                            <div id="previewContent">
                                <div class="text-center py-5">
                                    <i class="fas fa-print fa-4x mb-3 text-muted"></i>
                                    <h5>Preview Laporan</h5>
                                    <p class="text-muted">Silahkan pilih filter dan klik tombol "Preview" untuk melihat hasil laporan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
   $(document).ready(function() {
    // Toggle sidebar
    $('#toggleSidebar').on('click', function() {
        $('#sidebar').toggleClass('collapsed');
        $('body').toggleClass('sidebar-hidden');
    });
    
    // Handle range slider for age
    const umurSlider = document.getElementById('umurSlider');
    const umurMin = document.getElementById('umurMin');
    const umurMax = document.getElementById('umurMax');
    
    // Update range value when slider changes
    umurSlider.addEventListener('input', function() {
        const value = this.value;
        umurMin.value = Math.max(18, value - 10);
        umurMax.value = Math.min(65, parseInt(value) + 10);
    });
    
    // Update slider when min/max inputs change
    umurMin.addEventListener('change', function() {
        const minVal = parseInt(this.value);
        const maxVal = parseInt(umurMax.value);
        if (minVal > maxVal) {
            this.value = maxVal;
        }
        if (minVal < 18) {
            this.value = 18;
        }
        umurSlider.value = Math.floor((minVal + maxVal) / 2);
    });
    
    umurMax.addEventListener('change', function() {
        const minVal = parseInt(umurMin.value);
        const maxVal = parseInt(this.value);
        if (maxVal < minVal) {
            this.value = minVal;
        }
        if (maxVal > 65) {
            this.value = 65;
        }
        umurSlider.value = Math.floor((minVal + maxVal) / 2);
    });
    
    // Preview Button Handler
    $('#btnPreview').on('click', function() {
        // Get all filter values
        const filters = collectFilterValues();
        fetchPreviewData(filters);
    });
    
    // Print Button Handler
    $('#btnPrint').on('click', function() {
        if ($('#totalPeserta').text() === '0') {
            alert('Silahkan preview data terlebih dahulu sebelum mencetak');
            return;
        }
        window.print();
    });
    
    // Export Button Handler
    $('#btnExport').on('click', function() {
        if ($('#totalPeserta').text() === '0') {
            alert('Silahkan preview data terlebih dahulu sebelum export');
            return;
        }
        
        // Get all filter values
        const filters = collectFilterValues();
        
        // Create form for export
        const form = $('<form>', {
            action: '/cetak/export',
            method: 'POST',
            style: 'display: none;'
        });
        
        // Add CSRF token
        form.append($('<input>', {
            type: 'hidden',
            name: '_token',
            value: $('meta[name="csrf-token"]').attr('content')
        }));
        
        // Add all filters as hidden inputs
        Object.keys(filters).forEach(key => {
            form.append($('<input>', {
                type: 'hidden',
                name: key,
                value: filters[key]
            }));
        });
        
        // Submit form
        $('body').append(form);
        form.submit();
        form.remove();
    });
    
    // Filter Button Handler
    $('#btnFilter').on('click', function() {
        $('#btnPreview').click();
    });
    
    // Helper Functions
    function collectFilterValues() {
        return {
            jenis_laporan: $('input[name="jenis_laporan"]:checked').val(),
            umur_min: $('#umurMin').val(),
            umur_max: $('#umurMax').val(),
            cabang: $('#filter_cabang').val(),
            jenis_kelamin: $('input[name="jenis_kelamin"]:checked').val(),
            status_kawin: $('#filter_status_pernikahan').val(),
            pendidikan: $('#filter_pendidikan').val(),
            phdp_min: $('#phdpMin').val(),
            phdp_max: $('#phdpMax').val(),
            golongan: $('#filter_golongan').val()
        };
    }
    
    function fetchPreviewData(filters) {
        // Show loading indicator
        $('#previewContent').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Memuat data laporan...</p>
            </div>
        `);
        
        // Make AJAX request to server
        $.ajax({
            url: '/preview',
            type: 'POST',
            data: filters,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Replace preview content with server response
                $('#previewContent').html(response);
                
                // Update total peserta count
                const count = $('#previewContent').find('.peserta-count').data('count');
                $('#totalPeserta').text(count || 0);
            },
            error: function(xhr, status, error) {
                // Show error message
                $('#previewContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Terjadi kesalahan: ${error}
                    </div>
                `);
                $('#totalPeserta').text('0');
            }
        });
    }
});
</script>
</body>
</html>