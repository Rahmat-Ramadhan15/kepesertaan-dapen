<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manfaat Pensiun</title>
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
        
        .benefit-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .benefit-card {
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .benefit-title {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
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
        
        .download-btn {
            background-color: #4caf50;
            border-color: #4caf50;
        }
        
        .download-btn:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }
        
        .benefit-table th {
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
                <a href="{{ route('manfaat.index') }}" class="active">
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
                    <i class="fas fa-book me-2"></i> Manfaat Pensiun
                </h1>
            </div>

            <!-- Overview Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card benefit-card h-100">
                        <div class="card-body text-center">
                            <div class="benefit-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <h4 class="benefit-title">Manfaat Pensiun Normal</h4>
                            <p class="text-muted">Manfaat pensiun yang dibayarkan kepada peserta yang mencapai usia pensiun normal (56 tahun).</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card benefit-card h-100">
                        <div class="card-body text-center">
                            <div class="benefit-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <h4 class="benefit-title">Manfaat Pensiun Dipercepat</h4>
                            <p class="text-muted">Manfaat pensiun yang dibayarkan kepada peserta yang pensiun sebelum usia pensiun normal (minimal 46 tahun).</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card benefit-card h-100">
                        <div class="card-body text-center">
                            <div class="benefit-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h4 class="benefit-title">Manfaat Pensiun Cacat</h4>
                            <p class="text-muted">Manfaat pensiun yang dibayarkan kepada peserta yang mengalami cacat total dan tetap.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Cards -->
            <div class="row">
                <!-- Jenis Manfaat Pensiun -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Jenis Manfaat Pensiun</strong>
                            <button class="btn btn-sm download-btn text-white">
                                <i class="fas fa-download me-1"></i> Download PDF
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover benefit-table">
                                    <thead>
                                        <tr>
                                            <th>Jenis Manfaat</th>
                                            <th>Persyaratan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Manfaat Pensiun Normal</strong></td>
                                            <td>Usia pensiun 56 tahun</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Manfaat Pensiun Dipercepat</strong></td>
                                            <td>Usia minimal 46 tahun dengan masa kerja minimal 10 tahun</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Manfaat Pensiun Cacat</strong></td>
                                            <td>Cacat total dan tetap berdasarkan keterangan dokter</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pensiun Ditunda</strong></td>
                                            <td>Berhenti bekerja sebelum usia pensiun dengan masa kerja minimal 3 tahun</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Manfaat Pensiun Janda/Duda</strong></td>
                                            <td>Peserta meninggal dunia sebelum atau setelah pensiun</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formula Perhitungan -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <strong>Formula Perhitungan Manfaat Pensiun</strong>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h5 class="fw-bold">Formula Dasar</h5>
                                <p>Manfaat Pensiun Normal (MPN) = Faktor Penghargaan Masa Kerja × PhDP × Masa Kerja</p>
                                <ul>
                                    <li>Faktor Penghargaan = 2.5%</li>
                                    <li>PhDP = Penghasilan Dasar Pensiun</li>
                                    <li>Masa Kerja = Jumlah tahun masa kerja peserta</li>
                                </ul>
                            </div>
                            
                            <div class="mb-3">
                                <h5 class="fw-bold">Manfaat Pensiun Dipercepat</h5>
                                <p>MPN × Faktor Diskonto</p>
                                <ul>
                                    <li>Faktor diskonto berbeda untuk setiap usia</li>
                                    <li>Semakin muda usia pensiun, semakin kecil faktor diskonto</li>
                                </ul>
                            </div>
                            
                            <div>
                                <h5 class="fw-bold">Manfaat Pensiun Janda/Duda</h5>
                                <p>60% × Manfaat Pensiun yang menjadi hak peserta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dokumen & Syarat -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Persyaratan Dokumen</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Pensiun Normal & Dipercepat</h5>
                            <ol>
                                <li>Formulir permohonan manfaat pensiun</li>
                                <li>Fotokopi KTP</li>
                                <li>Fotokopi Kartu Keluarga</li>
                                <li>Fotokopi Buku Rekening Bank</li>
                                <li>Surat Keputusan Pemberhentian dari Perusahaan</li>
                                <li>Pas foto ukuran 4x6 (2 lembar)</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Pensiun Janda/Duda</h5>
                            <ol>
                                <li>Formulir permohonan manfaat pensiun</li>
                                <li>Fotokopi KTP penerima manfaat</li>
                                <li>Fotokopi Kartu Keluarga</li>
                                <li>Fotokopi Buku Rekening Bank</li>
                                <li>Surat Keterangan Kematian</li>
                                <li>Pas foto ukuran 4x6 (2 lembar)</li>
                                <li>Fotokopi Surat Nikah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="card">
                <div class="card-header">
                    <strong>Pertanyaan Umum (FAQ)</strong>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    Kapan saya bisa mengajukan pensiun dini?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat mengajukan pensiun dipercepat (dini) jika sudah mencapai usia minimal 46 tahun dan memiliki masa kepesertaan minimal 10 tahun. Pengajuan harus disetujui oleh perusahaan dan Dana Pensiun.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Bagaimana cara pembayaran manfaat pensiun?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Manfaat pensiun dibayarkan setiap bulan melalui transfer ke rekening bank penerima manfaat. Pembayaran dilakukan setiap tanggal 25 bulan berjalan.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Apakah manfaat pensiun dikenakan pajak?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, manfaat pensiun dikenakan pajak penghasilan (PPh) pasal 21 sesuai dengan ketentuan perpajakan yang berlaku. Dana Pensiun akan memotong pajak tersebut sebelum membayarkan manfaat pensiun Anda.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Bagaimana jika saya meninggal sebelum menerima manfaat pensiun?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Jika peserta meninggal sebelum menerima manfaat pensiun, maka janda/duda akan menerima manfaat pensiun janda/duda sebesar 60% dari manfaat pensiun yang seharusnya diterima peserta. Jika tidak ada janda/duda, manfaat akan diberikan kepada anak yang memenuhi syarat.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    Apakah manfaat pensiun dapat diambil sekaligus?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sesuai dengan peraturan, maksimal 20% dari total nilai manfaat pensiun dapat diambil sekaligus, sedangkan sisanya akan dibayarkan secara berkala setiap bulan. Pengambilan sekaligus ini harus diajukan pada saat pengajuan pembayaran manfaat pensiun.
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
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.body.classList.toggle('sidebar-hidden');
    });
</script>
</body>
</html>