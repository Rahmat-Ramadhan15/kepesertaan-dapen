<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Operator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            background-color: rgba(255, 255, 255, 0.1);
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
        
        .btn-success {
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
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
        
        /* Form styles */
        .form-label {
            font-weight: 500;
            color: #555;
        }
        
        .form-control {
            border-radius: var(--border-radius);
            padding: 0.6rem 1rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(63, 81, 181, 0.15);
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
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h1 class="sidebar-title">
                <i class="fas fa-users me-2"></i> Admin Panel
            </h1>
            <button class="sidebar-toggle btn btn-sm btn-light ms-3 mt-2" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-users"></i>
                    <span>Daftar Pengguna</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#" class="log-activity-btn">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Log Aktivitas</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ route('admin.create-operator') }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah Operator</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ route('cabang.index') }}">
                    <i class="fas fa-code-branch"></i>
                    <span>Data Cabang</span>
                </a>
            </li>
        </ul>
        <!-- Tambahkan form logout di bawah sidebar -->
        <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
            @csrf
            <button type="submit" class="sidebar-logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    <!-- Mobile Toggle Button (only visible on small screens) -->
    <button class="mobile-toggle d-lg-none" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1 class="dashboard-title">
                    <i class="fas fa-user-edit me-2"></i> Edit Operator
                </h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    <form action="{{ route('admin.update-user', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" id="nip" class="form-control" value="{{ $user->nip }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama operator">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru (Opsional)</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru">
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                        </div>
                        <div class="d-flex gap-2 justify-content-between">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Log Aktivitas -->
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Set initial state (collapsed by default on desktop)
            if ($(window).width() >= 992) {
                $('#sidebar').addClass('collapsed');
                $('#mainContent').addClass('expanded');
            }
            
            // Sidebar toggle functionality
            $('#sidebarToggle, #mobileToggle').on('click', function() {
                $('#sidebar').toggleClass('collapsed');
                $('#mainContent').toggleClass('expanded');
            });
            
            // Log aktivitas modal
            $('.log-activity-btn').on('click', function () {
                $('#auditLogModal').modal('show');
                $('#auditLogContent').html(`
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-spinner fa-spin fa-2x"></i><br>
                        Memuat data log...
                    </div>
                `);

                $.ajax({
                    url: "{{ route('admin.audit-log') }}",
                    method: "GET",
                    success: function (data) {
                        $('#auditLogContent').html(data);
                    },
                    error: function () {
                        $('#auditLogContent').html('<div class="alert alert-danger">Gagal memuat log aktivitas.</div>');
                    }
                });
            });
            
            // Make sidebar menu items clickable
            $('.sidebar-menu-item:not(.active)').on('click', function() {
                // Handle menu item clicks
                const menuText = $(this).find('span').text().trim();
                
                if (menuText === 'Log Aktivitas') {
                    $('#auditLogModal').modal('show');
                } else if (menuText === 'Daftar Pengguna') {
                    window.location.href = "{{ route('admin.dashboard') }}";
                } else if (menuText === 'Tambah Operator') {
                    window.location.href = "{{ route('admin.create-operator') }}";
                } else if (menuText === 'Data Cabang') {
                    window.location.href = "{{ route('cabang.index') }}";
                }
                
                // Close sidebar on mobile when menu item is clicked
                if ($(window).width() < 992) {
                    $('#sidebar').toggleClass('collapsed');
                }
            });
        });
    </script>
</body>
</html>