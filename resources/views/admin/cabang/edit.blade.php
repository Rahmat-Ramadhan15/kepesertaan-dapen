<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Cabang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* SALIN SEMUA KODE CSS DARI FILE index.blade.php DATA BANK ANDA DI SINI */
        :root {
            --primary-color: #3f51b5;
            --primary-light: #f5f7ff;
            --primary-dark: #303f9f;
            --light-gray: #f8f9fa;
            --border-radius: 0.5rem;
            --sidebar-width: 250px;
            --sidebar-width-collapsed: 70px;
            --header-height: 60px;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--primary-dark);
            color: white;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
            background-color: transparent;
            box-shadow: none;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            height: var(--header-height);
        }

        .sidebar.collapsed .sidebar-header {
            border-bottom: none;
            justify-content: center;
            padding: 1.5rem 0;
        }

        .sidebar-title {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-title {
            display: none;
        }

        .sidebar-toggle {
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.25rem;
            font-size: 1.2rem;
            line-height: 1;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-toggle {
            color: var(--primary-dark);
            padding: 0.5rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            margin: 0;
        }

        .sidebar-menu {
            margin-top: 1rem;
            padding: 0;
            list-style: none;
        }

        .sidebar-menu-item {
            padding: 0;
            display: block;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .sidebar-menu-item a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            width: 100%;
        }

        .sidebar.collapsed .sidebar-menu-item a {
            justify-content: center;
            padding: 0.75rem 0;
        }

        .sidebar-menu-item a:hover {
            background-color: rgba(255, 254, 254, 0.1);
            color: white;
            cursor: pointer;
        }

        .sidebar.collapsed .sidebar-menu-item a:hover {
            background-color: transparent;
        }

        .sidebar.collapsed .sidebar-menu-item a i {
            color: var(--primary-dark);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem;
            border-radius: 50%;
            margin: 0.5rem 0;
        }

        .sidebar-menu-item a i {
            margin-right: 1rem;
            width: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-menu-item a i {
            margin-right: 0;
        }

        .sidebar.collapsed .sidebar-menu-item a span {
            display: none;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-width-collapsed);
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
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

        /* Logout button in sidebar */
        .sidebar-logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 1rem;
        }

        .sidebar-logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            background-color: #dc3545;
            border: none;
            border-radius: var(--border-radius);
            text-align: left;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar-logout-btn:hover {
            background-color: #bb2d3b;
            color: white;
        }

        .sidebar-logout-btn i {
            margin-right: 1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar.collapsed .sidebar-logout-btn span {
            display: none;
        }

        .sidebar.collapsed .sidebar-logout-btn {
            justify-content: center;
            padding: 0.75rem 0;
        }

        .sidebar.collapsed .sidebar-logout-btn i {
            margin-right: 0;
            color: white;
            background-color: transparent;
            padding: 0;
            margin: 0;
        }

        @media (max-width: 992px) {
            .sidebar-logout {
                display: block;
            }

            .sidebar.collapsed .sidebar-logout-btn span {
                display: inline;
            }

            .sidebar.collapsed .sidebar-logout-btn {
                justify-content: flex-start;
                padding: 0.75rem 1rem;
            }

            .sidebar.collapsed .sidebar-logout-btn i {
                margin-right: 1rem;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: var(--sidebar-width-collapsed);
                transform: translateX(-100%);
            }

            .sidebar.collapsed {
                transform: translateX(0);
                width: var(--sidebar-width);
                background-color: var(--primary-dark);
            }

            .sidebar.collapsed .sidebar-header {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                justify-content: space-between;
                padding: 1.5rem 1rem;
            }

            .sidebar.collapsed .sidebar-toggle {
                color: white;
                background-color: transparent;
                border-radius: 0;
            }

            .sidebar.collapsed .sidebar-title {
                display: block;
            }

            .sidebar.collapsed .sidebar-menu-item a {
                justify-content: flex-start;
                padding: 0.75rem 1rem;
            }

            .sidebar.collapsed .sidebar-menu-item a i {
                color: rgba(255, 255, 255, 0.8);
                background-color: transparent;
                padding: 0;
                border-radius: 0;
                margin-right: 1rem;
                margin: 0 1rem 0 0;
            }

            .sidebar.collapsed .sidebar-menu-item a:hover {
                background-color: rgba(255, 255, 255, 0.1);
            }

            .sidebar.collapsed .sidebar-menu-item a span {
                display: inline;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1001;
                background-color: var(--primary-color);
                color: white;
                border: none;
                border-radius: var(--border-radius);
                padding: 0.5rem;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }
        }
    </style>
</head>
<body>
    @include('admin.layouts.sidebar')

    <div class="modal fade" id="auditLogModal" tabindex="-1" aria-labelledby="auditLogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="auditLogModalLabel">
                        <i class="fas fa-clipboard-list me-2"></i> Log Aktivitas Pengguna
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" id="auditLogContent">
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-spinner fa-spin fa-2x"></i><br>
                        Memuat data log...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="mobile-toggle d-lg-none" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="main-content" id="mainContent">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1 class="dashboard-title">
                    <i class="fas fa-sitemap me-2"></i> Edit Data Cabang
                </h1>
                <div>
                    <a href="{{ route('cabang.index') }}" class="btn btn-secondary action-button">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('cabang.update', $cabang->kode_cabang) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Gunakan PUT method untuk update --}}

                        <div class="mb-3">
                            <label for="kode_cabang" class="form-label">Kode Cabang</label>
                            <input type="text" class="form-control" id="kode_cabang" name="kode_cabang" value="{{ old('kode_cabang', $cabang->kode_cabang) }}" required readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nama_cabang" class="form-label">Nama Cabang</label>
                            <input type="text" class="form-control @error('nama_cabang') is-invalid @enderror" id="nama_cabang" name="nama_cabang" value="{{ old('nama_cabang', $cabang->nama_cabang) }}" required>
                            @error('nama_cabang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kode_alias" class="form-label">Kode Alias</label>
                            <input type="text" class="form-control @error('kode_alias') is-invalid @enderror" id="kode_alias" name="kode_alias" value="{{ old('kode_alias', $cabang->kode_alias) }}">
                            @error('kode_alias')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $cabang->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota" value="{{ old('kota', $cabang->kota) }}">
                            @error('kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $cabang->kode_pos) }}">
                            @error('kode_pos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $cabang->telepon) }}">
                            @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fax" class="form-label">Fax</label>
                            <input type="text" class="form-control @error('fax') is-invalid @enderror" id="fax" name="fax" value="{{ old('fax', $cabang->fax) }}">
                            @error('fax')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $cabang->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary action-button">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set initial state for mobile (sidebar should be closed initially)
            if ($(window).width() >= 992) {
                $('#sidebar').addClass('collapsed');
                $('#mainContent').addClass('expanded');
            }

            // Sidebar toggle functionality
            $('#sidebarToggle, #mobileToggle').on('click', function() {
                $('#sidebar').toggleClass('collapsed');

                // For mobile specifically
                if ($(window).width() < 992) {
                    if ($('#sidebar').hasClass('collapsed')) {
                        $('#sidebar').css('transform', 'translateX(0)');
                    } else {
                        $('#sidebar').css('transform', 'translateX(-100%)');
                    }
                }

                $('#mainContent').toggleClass('expanded');
            });

            // Set active class based on current URL
            const currentUrl = window.location.href;
            $('.sidebar-menu-item a').each(function() {
                const menuUrl = $(this).attr('href');
                if (menuUrl && currentUrl.includes(menuUrl)) {
                    $('.sidebar-menu-item').removeClass('active');
                    $(this).parent().addClass('active');
                }
            });
        });
    </script>
</body>
</html>