<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-scheme="navy">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Nifty is a responsive admin dashboard template based on Bootstrap 5 framework. There are a lot of useful components.">
    <title>Hitung Iuran | Operator - Sulselbar</title>
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
                                <a href="{{ route('hitung.index') }}" class="nav-link {{ request()->routeIs('operator.hitung.index') ? 'active' : '' }}">
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
                    <h1 class="page-title mb-2">Hitung Iuran</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('operator.hitung.index') }}">Hitung Iuran</a></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                                <form action="{{ route('operator.hitung.index') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2 m-0">
                                    <select name="cabang_id" class="form-select" style="width: auto;">
                                        <option value="">Semua Cabang</option>
                                        @foreach($listCabang as $cabang)
                                            <option value="{{ $cabang->kode_cabang }}" {{ request('cabang_id') == $cabang->kode_cabang ? 'selected' : '' }}>
                                                {{ $cabang->nama_cabang }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="text" name="nip" class="form-control" placeholder="Cari NIP..." value="{{ request('nip') }}" style="width: auto;">
                                    <input type="text" name="nama" class="form-control" placeholder="Cari Nama..." value="{{ request('nama') }}" style="width: auto;">

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('operator.hitung.index') }}" class="btn btn-primary">
                                        <i class="fas fa-sync-alt me-1"></i> Reset
                                    </a>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Cabang</th>
                                            <th>PHDP (Master)</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pesertas as $peserta)
                                        <tr>
                                            <td class="fw-semibold">{{ $peserta->nip }}</td>
                                            <td>{{ $peserta->nama }}</td>
                                            <td>{{ $peserta->cabang->nama_cabang ?? 'N/A' }}</td>
                                            <td>{{ number_format($peserta->phdp, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('operator.hitung.detail', ['nip' => $peserta->nip]) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-calculator me-1"></i> Hitung Iuran
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data peserta ditemukan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 d-flex justify-content-center">
                                {{ $pesertas->links() }}
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
</body>

</html>