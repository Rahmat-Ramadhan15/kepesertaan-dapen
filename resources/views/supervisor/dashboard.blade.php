<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #3f51b5;
            --primary-light: #5c6bc0;
            --primary-dark: #303f9f;
            --accent: #ff4081;
            --text-on-primary: #ffffff;
            --border-radius: 8px;
            --sidebar-width: 280px;
            --sidebar-width-collapsed: 80px;
        }

        body {
            background-color: #f5f7ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--primary);
            color: var(--text-on-primary);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100%;
            z-index: 100;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: var(--text-on-primary);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background: var(--primary-dark);
        }

        .menu-item i {
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .sidebar.collapsed .menu-item {
            justify-content: center;
            padding: 15px 0;
        }

        .sidebar.collapsed .menu-item i {
            margin-right: 0;
            font-size: 1.5rem;
        }

        .content-area {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .content-area.expanded {
            margin-left: var(--sidebar-width-collapsed);
        }

        .dash-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            color: var(--primary);
            font-weight: 600;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .summary-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--text-on-primary);
            border-radius: var(--border-radius);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .summary-card .icon {
            position: absolute;
            bottom: -20px;
            right: -20px;
            font-size: 5rem;
            opacity: 0.1;
        }

        .summary-card .title {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .summary-card .value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .chart-container {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
            height: 300px;
        }

        .chart-title {
            color: var(--primary);
            margin-bottom: 20px;
            font-weight: 600;
        }

        table.data-table {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        table.data-table thead {
            background-color: var(--primary);
            color: var(--text-on-primary);
        }

        table.data-table th, table.data-table td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .logout-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            padding: 0.75rem 1.25rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95rem;
            background-color: var(--accent);
            color: var(--text-on-primary);
            border: none;
            transition: all 0.3s ease;
        }

        .logout-float:hover {
            background-color: #e03060;
            transform: scale(1.05);
        }

        .action-btn {
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 5px;
        }

        .edit-btn {
            background-color: var(--primary);
        }

        .delete-btn {
            background-color: var(--accent);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .profile-badge {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            padding: 10px;
            margin: 20px;
        }

        .profile-badge img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .profile-info .name {
            font-weight: 600;
            margin: 0;
        }

        .profile-info .role {
            font-size: 0.8rem;
            opacity: 0.8;
            margin: 0;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .notifications-badge {
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            margin-left: 5px;
        }
        
        /* Hide elements when sidebar is collapsed */
        .sidebar.collapsed .sidebar-header h3, 
        .sidebar.collapsed .profile-badge .profile-info, 
        .sidebar.collapsed .menu-item span {
            display: none;
        }
        
        /* Optimizations for performance */
        * {
            will-change: auto;
        }
        
        @media (max-width: 992px) {
            :root {
                --sidebar-width: 280px;
                --sidebar-width-collapsed: 80px;
            }
            
            .sidebar {
                width: var(--sidebar-width-collapsed);
            }
            
            .sidebar-header h3, .profile-badge .profile-info, .menu-item span {
                display: none;
            }
            
            .content-area {
                margin-left: var(--sidebar-width-collapsed);
            }
            
            .menu-item {
                justify-content: center;
                padding: 15px 0;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 1.5rem;
            }
            
            .sidebar.expanded {
                width: var(--sidebar-width);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }
            
            .sidebar.expanded .sidebar-header h3, 
            .sidebar.expanded .profile-badge .profile-info, 
            .sidebar.expanded .menu-item span {
                display: block;
            }
            
            .sidebar.expanded .menu-item {
                justify-content: flex-start;
                padding: 12px 20px;
            }
            
            .sidebar.expanded .menu-item i {
                margin-right: 15px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
<div class="main-container">
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Supervisor</h3>
            <button class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <div class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-chart-pie"></i>
                <span>Laporan & Statistik</span>
            </div>
        </div>
    </div>

    <div class="content-area" id="contentArea">
        <div class="dash-header">
            <h1 class="page-title">Dashboard Sistem</h1>
            <div>
                <a href="{{ route('export.peserta') }}" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Ekspor Data
                </a>
            </div>
        </div>

        <div class="stats-summary">
            <div class="summary-card">
                <div class="title">Total Peserta</div>
                <div class="value">{{ $totalPeserta }}</div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="summary-card">
                <div class="title">Laki-laki</div>
                <div class="value">{{ $totalLaki }}</div>
                <div class="icon"><i class="fas fa-male"></i></div>
            </div>
            <div class="summary-card">
                <div class="title">Perempuan</div>
                <div class="value">{{ $totalPerempuan }}</div>
                <div class="icon"><i class="fas fa-female"></i></div>
            </div>
            <div class="summary-card">
                <div class="title">Total PHDP</div>
                <div class="value">Rp {{ number_format($totalPHDP, 0, ',', '.') }}</div>
                <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Distribusi Jenis Kelamin</h5>
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
            <div class="col-md-8">
                <div class="chart-container">
                    <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Rata-rata PHDP per Jabatan</h5>
                    <canvas id="phdpChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="color: var(--primary);">Daftar Peserta</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover data-table">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>PHDP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $p)
                                <tr>
                                    <td>{{ $p->nip }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>
                                        @if($p->jenis_kelamin == 'Laki-laki')
                                            <span class="badge bg-primary"><i class="fas fa-male me-1"></i> L</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-female me-1"></i> P</span>
                                        @endif
                                    </td>
                                    <td>{{ $p->jabatan }}</td>
                                    <td>Rp {{ number_format($p->phdp, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('logout') }}" method="POST" class="logout-float-form">
    @csrf
    <button type="submit" class="btn logout-float shadow">
        <i class="fas fa-sign-out-alt me-1"></i> Logout
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle sidebar functionality
        const sidebar = document.getElementById('sidebar');
        const contentArea = document.getElementById('contentArea');
        const toggleBtn = document.getElementById('toggleSidebar');
        
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            contentArea.classList.toggle('expanded');
            
            // Save sidebar state to localStorage
            const isSidebarCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isSidebarCollapsed);
        });
        
        // Check if sidebar state is saved in localStorage
        const savedSidebarState = localStorage.getItem('sidebarCollapsed');
        if (savedSidebarState === 'true') {
            sidebar.classList.add('collapsed');
            contentArea.classList.add('expanded');
        }
        
        // Toggle sidebar on mobile
        if (window.innerWidth <= 992) {
            sidebar.classList.add('collapsed');
            contentArea.classList.add('expanded');
            
            // Different behavior for mobile - clicking sidebar expands it temporarily
            sidebar.addEventListener('click', function(e) {
                if (window.innerWidth <= 992 && 
                    !e.target.classList.contains('toggle-btn') && 
                    e.target.id !== 'toggleSidebar') {
                    sidebar.classList.toggle('expanded');
                }
            });
            
            // Close expanded sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 992 && 
                    !sidebar.contains(e.target) && 
                    sidebar.classList.contains('expanded')) {
                    sidebar.classList.remove('expanded');
                }
            });
        }

        // Grafik Jenis Kelamin - Optimized rendering
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $totalLaki }}, {{ $totalPerempuan }}],
                    backgroundColor: ['#3f51b5', '#ff4081'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 15
                        }
                    }
                },
                cutout: '65%',
                animation: {
                    duration: 1000
                }
            }
        });

        // Grafik PHDP rata-rata per jabatan - Fixed height and responsive
        const phdpCtx = document.getElementById('phdpChart').getContext('2d');
        const jabatanLabels = {!! json_encode(array_keys($phdpPerJabatan)) !!};
        const rataPhdpData = {!! json_encode(array_values($phdpPerJabatan)) !!};

        // Limit number of labels if there are too many
        let displayLabels = jabatanLabels;
        let displayData = rataPhdpData;
        
        if(jabatanLabels.length > 8) {
            // Sort data to display highest values
            const combined = jabatanLabels.map((label, i) => ({ label, value: rataPhdpData[i] }));
            combined.sort((a, b) => b.value - a.value);
            
            displayLabels = combined.slice(0, 7).map(item => item.label);
            displayData = combined.slice(0, 7).map(item => item.value);
            
            // Add "Lainnya" category
            const otherSum = combined.slice(7).reduce((sum, item) => sum + item.value, 0);
            if(otherSum > 0) {
                displayLabels.push('Lainnya');
                displayData.push(otherSum / (combined.length - 7)); // Average of others
            }
        }

        const phdpChart = new Chart(phdpCtx, {
            type: 'bar',
            data: {
                labels: displayLabels,
                datasets: [{
                    label: 'Rata-rata PHDP',
                    data: displayData,
                    backgroundColor: '#3f51b5',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            },
                            maxTicksLimit: 6
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                animation: {
                    duration: 1000
                },
                barThickness: displayLabels.length > 5 ? 'flex' : 30
            }
        });
        
        // Redraw charts when sidebar is toggled for better rendering
        toggleBtn.addEventListener('click', function() {
            setTimeout(function() {
                genderChart.resize();
                phdpChart.resize();
            }, 300);
        });
        
        // Resize charts when window size changes
        window.addEventListener('resize', function() {
            genderChart.resize();
            phdpChart.resize();
        });
    });
</script>
</body>
</html>