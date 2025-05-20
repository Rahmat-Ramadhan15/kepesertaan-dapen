<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Iuran</title>
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
            font-weight: 600;
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
        
        /* Calculator specific styles */
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(63, 81, 181, 0.25);
        }
        
        .calculator-card {
            transition: all 0.3s ease;
        }
        
        .calculator-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .result-box {
            background-color: var(--primary-light);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-top: 1rem;
        }
        
        .result-title {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .result-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
        }
        
        .pie-chart {
            width: 100%;
            height: 250px;
        }
        
        .info-icon {
            color: var(--primary-color);
            cursor: pointer;
        }
        
        .table-premium th {
            background-color: var(--primary-light);
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
                <a href="{{ route('hitung.index') }}" class="active">
                    <i class="fas fa-calculator"></i>
                    <span>Hitung Iuran</span>
                </a>
            </li>
            
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
                    <i class="fas fa-calculator me-2"></i> Hitung Iuran Pensiun
                </h1>
            </div>

            <div class="row">
                <!-- Calculator Card -->
                <div class="col-lg-8 mb-4">
                    <div class="card calculator-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Kalkulator Iuran</strong>
                            <button class="btn btn-sm btn-outline-primary" id="resetBtn">
                                <i class="fas fa-redo-alt me-1"></i> Reset
                            </button>
                        </div>
                        <div class="card-body">
                            <form id="calculatorForm">
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="gaji" class="form-label">Gaji Pokok (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Contoh: 5000000" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tunjangan" class="form-label">Tunjangan Tetap (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" id="tunjangan" name="tunjangan" placeholder="Contoh: 1500000">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="usia" class="form-label">Usia Saat Ini (Tahun)</label>
                                        <input type="number" class="form-control" id="usia" name="usia" placeholder="Contoh: 35" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="masaKerja" class="form-label">Masa Kerja (Tahun)</label>
                                        <input type="number" class="form-control" id="masaKerja" name="masaKerja" placeholder="Contoh: 10" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="usiaTarget" class="form-label">Target Usia Pensiun</label>
                                        <select class="form-select" id="usiaTarget" name="usiaTarget">
                                            <option value="56">56 tahun (Normal)</option>
                                            <option value="55">55 tahun</option>
                                            <option value="54">54 tahun</option>
                                            <option value="53">53 tahun</option>
                                            <option value="52">52 tahun</option>
                                            <option value="51">51 tahun</option>
                                            <option value="50">50 tahun</option>
                                            <option value="49">49 tahun</option>
                                            <option value="48">48 tahun</option>
                                            <option value="47">47 tahun</option>
                                            <option value="46">46 tahun (Minimal)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="persentasePengusaha" class="form-label">Iuran Pengusaha (%)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="persentasePengusaha" name="persentasePengusaha" value="8" min="0" max="20">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary action-button">
                                        <i class="fas fa-calculator me-2"></i> Hitung Iuran
                                    </button>
                                </div>
                            </form>
                            
                            <!-- Results Section -->
                            <div id="resultsSection" class="mt-4 d-none">
                                <h5 class="result-title">
                                    <i class="fas fa-chart-pie me-2"></i> Hasil Perhitungan
                                </h5>
                                
                                <div class="result-box">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <p class="mb-1">Total Penghasilan Dasar Pensiun (PhDP):</p>
                                            <h4 class="result-value mb-3" id="totalPhdp">Rp 0</h4>
                                            
                                            <p class="mb-1">Iuran Peserta (2% dari PhDP):</p>
                                            <h4 class="result-value mb-3" id="iuranPeserta">Rp 0</h4>
                                            
                                            <p class="mb-1">Iuran Pengusaha:</p>
                                            <h4 class="result-value mb-3" id="iuranPengusaha">Rp 0</h4>
                                            
                                            <p class="mb-1">Total Iuran Bulanan:</p>
                                            <h4 class="result-value" id="totalIuran">Rp 0</h4>
                                        </div>
                                        <div class="col-md-6">
                                            <canvas id="chartIuran" class="pie-chart"></canvas>
                                        </div>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    <div>
                                        <p class="mb-1">Estimasi Akumulasi Dana Hingga Pensiun:</p>
                                        <h4 class="result-value mb-3" id="estimasiAkumulasi">Rp 0</h4>
                                        
                                        <p class="mb-1">Estimasi Manfaat Pensiun Bulanan:</p>
                                        <h4 class="result-value" id="estimasiManfaat">Rp 0</h4>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center mt-4">
                                    <button id="printReport" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-print me-1"></i> Cetak Laporan
                                    </button>
                                    <button id="saveCalculation" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan Perhitungan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar Information -->
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <strong>Informasi Iuran Pensiun</strong>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fw-bold">Penghasilan Dasar Pensiun (PhDP)</h5>
                                <p>PhDP adalah jumlah gaji pokok dan tunjangan tetap yang menjadi dasar perhitungan iuran dan manfaat pensiun.</p>
                            </div>
                            
                            <div class="mb-4">
                                <h5 class="fw-bold">Besaran Iuran</h5>
                                <ul>
                                    <li>Iuran peserta: <strong>2% dari PhDP</strong></li>
                                    <li>Iuran pengusaha: <strong>8% dari PhDP</strong> (dapat disesuaikan)</li>
                                </ul>
                            </div>
                            
                            <div class="mb-4">
                                <h5 class="fw-bold">Masa Pembayaran Iuran</h5>
                                <p>Iuran dibayarkan setiap bulan sejak menjadi peserta hingga mencapai usia pensiun atau berhenti bekerja.</p>
                            </div>
                            
                            <div>
                                <h5 class="fw-bold">Manfaat Pensiun</h5>
                                <p>Estimasi manfaat pensiun dihitung berdasarkan formula:</p>
                                <p><strong>2.5% × PhDP × Masa Kerja</strong></p>
                                <p>Maksimal manfaat pensiun adalah 80% dari PhDP.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Table of Premium Information -->
            <div class="card">
                <div class="card-header">
                    <strong>Tabel Proyeksi Manfaat Berdasarkan Masa Kerja</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-premium">
                            <thead>
                                <tr>
                                    <th>Masa Kerja</th>
                                    <th>Persentase Manfaat</th>
                                    <th>Contoh (PhDP Rp 5.000.000)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10 tahun</td>
                                    <td>25% dari PhDP</td>
                                    <td>Rp 1.250.000 / bulan</td>
                                </tr>
                                <tr>
                                    <td>15 tahun</td>
                                    <td>37.5% dari PhDP</td>
                                    <td>Rp 1.875.000 / bulan</td>
                                </tr>
                                <tr>
                                    <td>20 tahun</td>
                                    <td>50% dari PhDP</td>
                                    <td>Rp 2.500.000 / bulan</td>
                                </tr>
                                <tr>
                                    <td>25 tahun</td>
                                    <td>62.5% dari PhDP</td>
                                    <td>Rp 3.125.000 / bulan</td>
                                </tr>
                                <tr>
                                    <td>30 tahun</td>
                                    <td>75% dari PhDP</td>
                                    <td>Rp 3.750.000 / bulan</td>
                                </tr>
                                <tr>
                                    <td>32+ tahun</td>
                                    <td>80% dari PhDP (maksimal)</td>
                                    <td>Rp 4.000.000 / bulan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 small text-muted">
                        <i class="fas fa-info-circle me-1"></i> Proyeksi di atas mengasumsikan pensiun pada usia normal (56 tahun). Pensiun dipercepat akan dikenakan faktor diskonto yang mengurangi nilai manfaat.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.body.classList.toggle('sidebar-hidden');
    });
    
    // Calculator functionality
    $(document).ready(function() {
        let iuranChart = null;
        
        $('#calculatorForm').on('submit', function(e) {
            e.preventDefault();
            calculateIuran();
        });
        
        $('#resetBtn').on('click', function() {
            $('#calculatorForm')[0].reset();
            $('#resultsSection').addClass('d-none');
            if (iuranChart) {
                iuranChart.destroy();
                iuranChart = null;
            }
        });
        
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID').format(amount);
        }
        
        function calculateIuran() {
            // Get input values
            const gaji = parseFloat($('#gaji').val()) || 0;
            const tunjangan = parseFloat($('#tunjangan').val()) || 0;
            const usia = parseInt($('#usia').val()) || 0;
            const masaKerja = parseInt($('#masaKerja').val()) || 0;
            const usiaTarget = parseInt($('#usiaTarget').val()) || 56;
            const persentasePengusaha = parseFloat($('#persentasePengusaha').val()) || 8;
            
            // Calculate PhDP
            const phdp = gaji + tunjangan;
            
            // Calculate contributions
            const iuranPeserta = phdp * 0.02; // 2% for employee
            const iuranPengusaha = phdp * (persentasePengusaha / 100);
            const totalIuran = iuranPeserta + iuranPengusaha;
            
            // Calculate years until retirement
            const yearsUntilRetirement = usiaTarget - usia;
            
            // Simple estimation of retirement accumulation (very simplified)
            // This is just a rough estimation for demonstration purposes
            // In reality, this would involve complex actuarial calculations
            const monthsUntilRetirement = yearsUntilRetirement * 12;
            const estimasiAkumulasi = totalIuran * monthsUntilRetirement * 1.05; // Simple 5% growth factor
            
            // Calculate estimated monthly benefit
            // Formula: 2.5% x PhDP x Total Years of Service at retirement
            const totalMasaKerja = masaKerja + yearsUntilRetirement;
            let persentaseManfaat = 0.025 * totalMasaKerja; // 2.5% per year
            
            // Cap at 80%
            if (persentaseManfaat > 0.8) {
                persentaseManfaat = 0.8;
            }
            
            // Apply discount factor for early retirement
            let discountFactor = 1.0;
            if (usiaTarget < 56) {
                // Simple discount factor (in reality this would be more complex)
                discountFactor = 0.94 + ((usiaTarget - 46) * 0.01); // 6% discount at age 46, decreasing by 1% per year
            }
            
            const estimasiManfaat = phdp * persentaseManfaat * discountFactor;
            
            // Update result fields
            $('#totalPhdp').text('Rp ' + formatCurrency(phdp));
            $('#iuranPeserta').text('Rp ' + formatCurrency(iuranPeserta));
            $('#iuranPengusaha').text('Rp ' + formatCurrency(iuranPengusaha));
            $('#totalIuran').text('Rp ' + formatCurrency(totalIuran));
            $('#estimasiAkumulasi').text('Rp ' + formatCurrency(estimasiAkumulasi));
            $('#estimasiManfaat').text('Rp ' + formatCurrency(estimasiManfaat));
            
            // Show results section
            $('#resultsSection').removeClass('d-none');
            
            // Create or update chart
            createChart(iuranPeserta, iuranPengusaha);
        }
        
        function createChart(iuranPeserta, iuranPengusaha) {
            const ctx = document.getElementById('chartIuran').getContext('2d');
            
            if (iuranChart) {
                iuranChart.destroy();
            }
            
            iuranChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Iuran Peserta (2%)', 'Iuran Pengusaha'],
                    datasets: [{
                        data: [iuranPeserta, iuranPengusaha],
                        backgroundColor: [
                            '#3f51b5',
                            '#8c9eff'
                        ],
                        borderColor: [
                            '#303f9f',
                            '#5870cb'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    const percentage = Math.round((value / (iuranPeserta + iuranPengusaha)) * 100);
                                    return `Rp ${formatCurrency(value)} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }
        
        // Button handlers (these would need backend integration in a real app)
        $('#printReport').on('click', function() {
            alert('Fitur cetak laporan akan segera hadir.');
        });
        
        $('#saveCalculation').on('click', function() {
            alert('Perhitungan berhasil disimpan!');
        });
    });
</script>