<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-scheme="navy">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Nifty is a responsive admin dashboard template based on Bootstrap 5 framework. There are a lot of useful components.">
    <title>Detail Iuran Peserta {{ $peserta->nip }} | Operator - Sulselbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nifty.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo-purpose/demo-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo-purpose/demo-settings.min.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
</head>

<body class="out-quart">
    <div id="root" class="root mn--max tm--expanded-hd">

        <header class="header">
            <div class="header__inner">
                <div class="header__brand">
                    <div class="brand-wrap">
                        <a href="{{ route('operator.dashboard') }}" class="brand-img stretched-link">
                            <img src="{{asset ('images/sulselbar.png') }}" alt="Nifty Logo" class="Nifty logo" width="36" height="36">
                        </a>
                        <div class="brand-title">Sulselbar</div>
                    </div>
                </div>
                <div class="header__content">
                    <div class="header__content-start">
                        <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
                            <i class="demo-psi-list-view"></i>
                        </button>
                    </div>
                    <div class="header__content-end">
                        <div class="form-check form-check-alt form-switch mx-md-2">
                            <input id="headerThemeToggler" class="form-check-input mode-switcher" type="checkbox" role="switch">
                            <label class="form-check-label ps-1 fw-bold d-none d-md-flex align-items-center " for="headerThemeToggler">
                                <i class="mode-switcher-icon icon-light demo-psi-sun fs-5"></i>
                                <i class="mode-switcher-icon icon-dark d-none demo-psi-half-moon"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <nav id="mainnav-container" class="mainnav">
            <div class="mainnav__inner">
                <div class="mainnav__top-content scrollable-content pb-5">
                    <div id="_dm-mainnavProfile" class="mainnav__widget my-3 hv-outline-parent">
                        <div class="mininav-toggle text-center py-2">
                            <img class="mainnav__avatar img-md rounded-circle hv-oc" src="{{ asset('assets/img/profile-photos/1.png') }}" alt="Profile Picture" loading="lazy">
                        </div>
                        <div class="mininav-content collapse d-mn-max">
                            <span data-popper-arrow class="arrow"></span>
                            <div class="d-grid">
                                <button class="mainnav-widget-toggle d-block btn border-0 p-2" data-bs-toggle="collapse" aria-expanded="false" aria-controls="usernav">
                                    <span class="d-flex justify-content-center align-items-center">
                                        <h5 class="mb-0" style="margin-left: 0px;">Operator</h5>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mainnav__categoriy py-3">
                        <ul class="mainnav__menu nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('operator.index') }}" class="nav-link {{ request()->routeIs('operator.index') ? 'active' : '' }}">
                                    <i class="fas fa-users me-2"></i>
                                    <span class="nav-label">Data Peserta</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.parameters.databank') }}" class="nav-link {{ request()->routeIs('operator.parameters.databank') ? 'active' : '' }}">
                                    <i class="fas fa-landmark me-2"></i>
                                    <span class="nav-label">Data Bank</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.parameters.datacabang') }}" class="nav-link {{ request()->routeIs('operator.parameters.datacabang') ? 'active' : '' }}">
                                    <i class="fas fa-sitemap me-2"></i>
                                    <span class="nav-label">Data Cabang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.parameters.ptkp') }}" class="nav-link {{ request()->routeIs('operator.parameters.ptkp') ? 'active' : '' }}">
                                    <i class="fas fa-percent me-2"></i>
                                    <span class="nav-label">Tabel PTKP</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.parameters.nilaisekarang') }}" class="nav-link {{ request()->routeIs('operator.parameters.nilaisekarang') ? 'active' : '' }}">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    <span class="nav-label">Nilai Sekarang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.parameters.nsanak') }}" class="nav-link {{ request()->routeIs('operator.parameters.nsanak') ? 'active' : '' }}">
                                    <i class="fas fa-child me-2"></i>
                                    <span class="nav-label">NS Anak</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.parameters.nsjanda') }}" class="nav-link {{ request()->routeIs('operator.parameters.nsjanda') ? 'active' : '' }}">
                                    <i class="fas fa-female me-2"></i>
                                    <span class="nav-label">NS Janda</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.parameters.nspegawai') }}" class="nav-link {{ request()->routeIs('operator.parameters.nspegawai') ? 'active' : '' }}">
                                    <i class="fas fa-user-tie me-2"></i>
                                    <span class="nav-label">NS Pegawai</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('operator.hitung.index') }}" class="nav-link {{ request()->routeIs('operator.hitung.index') || request()->routeIs('operator.hitung.detail') ? 'active' : '' }}">
                                    <i class="fas fa-calculator me-2"></i>
                                    <span class="nav-label">Hitung Iuran</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cetak.index') }}" class="nav-link {{ request()->routeIs('cetak.index') ? 'active' : '' }}">
                                    <i class="fas fa-print me-2"></i>
                                    <span class="nav-label">Menu Cetak</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manfaat.index') }}" class="nav-link {{ request()->routeIs('manfaat.index') ? 'active' : '' }}">
                                    <i class="fas fa-book me-2"></i>
                                    <span class="nav-label">Manfaat Pensiun</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('hitung.index') }}" class="nav-link {{ request()->routeIs('hitung.index') ? 'active' : '' }}">
                                    <i class="fas fa-calculator me-2"></i>
                                    <span class="nav-label">Hitung Iuran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-auto"></div>
                <div class="mainnav__bottom-content border-top pb-2">
                    <ul id="mainnav" class="mainnav__menu nav flex-column">
                        <li class="nav-item mt-5 pt-2">
                            <a href="{{ route('logout') }}" class="nav-link text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                <span class="nav-label">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="content" class="content">
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">
                    <h1 class="page-title mb-2">Detail Iuran Peserta {{ $peserta->nip }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('operator.hitung.index') }}">Hitung Iuran</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    {{-- Pesan Sukses atau Error --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Peserta: {{ $peserta->nama }} (NIP: {{ $peserta->nip }})</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('operator.hitung.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nip" value="{{ $peserta->nip }}">

                                <div class="row g-3 mb-4">
                                    <div class="col-md-3">
                                        <label for="tahun" class="form-label">Tahun</label>
                                        <select class="form-select @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required>
                                            @for ($y = date('Y') - 5; $y <= date('Y') + 5; $y++)
                                                <option value="{{ $y }}" {{ old('tahun', $tahun) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endfor
                                        </select>
                                        @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bulan" class="form-label">Bulan</label>
                                        <select class="form-select @error('bulan') is-invalid @enderror" id="bulan" name="bulan" required>
                                            @php
                                                $months = [
                                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                                ];
                                            @endphp
                                            @foreach($months as $num => $name)
                                                <option value="{{ $num }}" {{ old('bulan', $bulan) == $num ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('bulan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="phdp" class="form-label">PHDP</label>
                                        <input type="number" step="0.01" class="form-control @error('phdp') is-invalid @enderror" id="phdp" name="phdp" value="{{ old('phdp', $peserta->phdp) }}" required>
                                        @error('phdp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="ir" class="form-label">IR (%)</label>
                                        <input type="number" step="0.001" class="form-control @error('ir') is-invalid @enderror" id="ir" name="ir" value="{{ old('ir', 5.5) }}" required>
                                        @error('ir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-calculator me-1"></i> Hitung & Simpan
                                    </button>
                                </div>
                            </form>
                            <hr class="my-4">

                            <form action="{{ route('operator.hitung.detail', ['nip' => $peserta->nip]) }}" method="GET" class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                <label for="filter_tahun" class="form-label mb-0">Tahun Histori:</label>
                                <select name="tahun" id="filter_tahun" class="form-select" style="width: auto;">
                                    @foreach($availableYearsForPeserta as $ay)
                                        <option value="{{ $ay }}" {{ request('tahun', date('Y')) == $ay ? 'selected' : '' }}>{{ $ay }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Tampilkan</button>
                            </form>


                            <h5 class="mt-4 mb-3">Histori Perhitungan Iuran (Tahun {{ $tahun }})</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th rowspan="2" class="align-middle text-center">Bulan</th>
                                            <th colspan="6" class="text-center">Peserta</th>
                                            <th colspan="4" class="text-center">Pemberi Kerja</th>
                                            <th rowspan="2" class="align-middle text-center">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>PHDP</th>
                                            <th>IR</th>
                                            <th>Saldo Awal</th>
                                            <th>Iuran</th>
                                            <th>Hsl. Peng.</th>
                                            <th>Saldo Akhir</th>
                                            <th>Saldo Awal</th>
                                            <th>Iuran</th>
                                            <th>Hsl. Peng.</th>
                                            <th>Saldo Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $currentYear = request('tahun', date('Y'));
                                            $monthsDisplay = [
                                                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                                                5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
                                                9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                                            ];
                                        @endphp

                                        @forelse($historiIuran as $histori)
                                        <tr>
                                            <td class="text-center">{{ $monthsDisplay[$histori->bulan] }}</td>
                                            <td>{{ number_format($histori->phdp_bulan_ini, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->ir_bulan_ini, 3, ',', '.') }}</td>
                                            <td>{{ number_format($histori->saldo_awal_peserta, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->iuran_peserta, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->hasil_pengembangan_peserta, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->saldo_akhir_peserta, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->saldo_awal_pemberi_kerja, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->iuran_pemberi_kerja, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->hasil_pengembangan_pemberi_kerja, 2, ',', '.') }}</td>
                                            <td>{{ number_format($histori->saldo_akhir_pemberi_kerja, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('operator.hitung.destroyHistori', $histori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus histori ini? Menghapus histori bisa mempengaruhi perhitungan bulan selanjutnya.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="12" class="text-center">Belum ada histori perhitungan untuk tahun ini.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="mt-auto">
                <div class="content__boxed">
                    <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
                        <div class="text-nowrap mb-4 mb-md-0">Copyright &copy; 2025 <a href="#" class="ms-1 btn-link fw-bold">Dapen Bank Sulselbar</a></div>
                    </div>
                </div>
            </footer>
        </section>
    </div>

    <script src="{{ asset('assets/vendors/popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/nifty.js') }}"></script>
    <script src="{{ asset('assets/js/demo-purpose-only.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.min.js') }}"></script>
    <script src="{{ asset('assets/pages/dashboard-1.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch previous month's data via AJAX
            function fetchPreviousMonthData() {
                const nip = $('input[name="nip"]').val();
                let currentYear = parseInt($('#tahun').val());
                let currentMonth = parseInt($('#bulan').val());

                // Calculate previous month/year
                let prevMonth = currentMonth - 1;
                let prevYear = currentYear;
                if (prevMonth === 0) {
                    prevMonth = 12;
                    prevYear--;
                }

                $.ajax({
                    url: '{{ route("operator.hitung.getPreviousMonthData") }}',
                    method: 'GET',
                    data: {
                        nip: nip,
                        tahun: prevYear,
                        bulan: prevMonth
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update PHDP and IR fields if data is returned
                            $('#phdp').val(response.phdp);
                            $('#ir').val(response.ir);
                            // Note: Saldo awal is handled by backend logic (from last month's saldo_akhir)
                            // The display of saldo awal in the form is not needed as it's part of the table
                        } else {
                            // Reset PHDP and IR to master data if no previous month history
                            // This part of the logic is handled by the backend's hitung method if no histori is found
                            // For UI display, we can clear or revert to default
                            // $('#phdp').val('{{ $peserta->phdp ?? 0 }}'); // This is a Blade variable, cannot be used directly in JS without being passed.
                            // $('#ir').val('5.5'); // Default value
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching previous month data:", error);
                        // Optionally display an error message to the user
                    }
                });
            }

            // Trigger fetch on month/year change
            $('#tahun, #bulan').on('change', fetchPreviousMonthData);

            // Initial fetch on page load if old('tahun') and old('bulan') are present
            // This ensures fields are filled if form was submitted with errors
            if ($('#tahun').val() && $('#bulan').val()) {
                fetchPreviousMonthData();
            }


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
            $('.mainnav__menu .nav-link').each(function() {
                const menuUrl = $(this).attr('href');
                if (menuUrl && currentUrl.includes(menuUrl)) {
                    // Remove 'active' from all siblings
                    $(this).closest('ul').find('.nav-link').removeClass('active');
                    // Add 'active' to the current link
                    $(this).addClass('active');
                }
            });
        });
    </script>
</body>

</html>