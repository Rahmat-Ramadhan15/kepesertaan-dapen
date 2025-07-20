
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-scheme="navy">

<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
   <meta name="description" content="A table library that works everywhere">
   <title>Detail | Bank - Sulselbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <!-- STYLESHEETS -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

   <!-- Fonts [ OPTIONAL ] -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">


    <!-- Bootstrap CSS [ REQUIRED ] -->
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

   <!-- Nifty CSS [ REQUIRED ] -->
   <link rel="stylesheet" href="{{ asset('assets/css/nifty.min.css') }}">

   <!-- Nifty Demo Icons [ OPTIONAL ] -->
   <link rel="stylesheet" href="{{ asset('assets/css/demo-purpose/demo-icons.min.css') }}">

   <!-- Demo purpose CSS [ DEMO ] -->
   <link rel="stylesheet" href="{{ asset('assets/css/demo-purpose/demo-settings.min.css') }}">


   <!-- Favicons [ OPTIONAL ] -->
   <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
   <link rel="manifest" href="./site.webmanifest">
   <!-- GridJS Style [ OPTIONAL ] -->
   <link rel="stylesheet" href="{{ asset('assets/vendors/gridjs/gridjs.min.css') }}">


   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

   [ REQUIRED ]
   You must include this category in your project.


   [ OPTIONAL ]
   This is an optional plugin. You may choose to include it in your project.


   [ DEMO ]
   Used for demonstration purposes only. This category should NOT be included in your project.


   [ SAMPLE ]
   Here's a sample script that explains how to initialize plugins and/or components: This category should NOT be included in your project.


   Detailed information and more samples can be found in the documentation.

   ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->


</head>

<body class="out-quart">


   <!-- PAGE CONTAINER -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <div id="root" class="root mn--max tm--expanded-hd">

      <!-- CONTENTS -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <section id="content" class="content">
         
         <div class="content__header content__boxed overlapping">
            <div class="content__wrap">


            <h1 class="page-title mb-0 mt-2">Detail Peserta</h1>
               <!-- Breadcrumb -->
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('operator.index') }}">Data Peserta</a></li>
                     <li class="breadcrumb-item"><a href="">Detail Peserta</a></li>
                  </ol>
               </nav>
               <!-- END : Breadcrumb -->


            </div>

         </div>


         <div class="content__boxed">
  <div class="content__wrap">
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex flex-wrap justify-content-start align-items-center gap-2 mb-3">
            <a href="{{ route('operator.edit', $peserta->nip) }}" class="btn btn-primary hstack gap-2">
               <i class="demo-psi-pencil fs-5"></i>
               <span class="vr"></span>
               Edit
            </a>
            <form action="{{ route('operator.destroy', $peserta->nip) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-primary hstack gap-2" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="padding: 0.6rem 1.2rem; border-radius: 0.5rem; font-weight: 500;">
                     <i class="demo-psi-trash fs-5"></i>
                     <span class="vr"></span>
                     Hapus
               </button>
            </form>

            <a href="{{ route('keluarga.create', $peserta->nip) }}" class="btn btn-primary hstack gap-2">
                  <i class="demo-psi-add fs-5"></i>
                  <span class="vr"></span>
                  Tambah Keluarga
            </a>
            <!-- Tombol Cetak PDF - TAMBAHKAN INI -->
            <a href="{{ route('operator.pdf', $peserta->nip) }}" class="btn btn-success hstack gap-2" target="_blank">
               <i class="fas fa-file-pdf fs-5"></i>
               <span class="vr"></span>
               Cetak PDF
            </a>

            <!-- Tombol Lihat PDF di Browser (Optional) -->
            <a href="{{ route('operator.view-pdf', $peserta->nip) }}" class="btn btn-info hstack gap-2" target="_blank">
               <i class="fas fa-eye fs-5"></i>
               <span class="vr"></span>
               Lihat PDF
            </a>

         </div>

        <!-- Data Pribadi & Kepegawaian -->
        <div class="card mb-4 shadow-sm rounded-3">
         
          <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-id-card me-2"></i> Data Pribadi
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">NIP</label>
                <div class="form-control bg-light border-0" readonly>{{ $peserta->nip }}</div>
                
                <label class="form-label fw-semibold mt-3">Nama Lengkap</label>
                <div class="form-control bg-light border-0" readonly>{{ $peserta->nama }}</div>
                
                <label class="form-label fw-semibold mt-3">Jenis Kelamin</label>
                <div class="form-control bg-light border-0" readonly>{{ $peserta->jenis_kelamin }}</div>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Tempat, Tanggal Lahir</label>
                <div class="form-control bg-light border-0" readonly>
                  {{ $peserta->tempat_lahir }},
                  @if($peserta->tanggal_lahir)
                    @if(is_string($peserta->tanggal_lahir))
                      {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d M Y') }}
                    @else
                      {{ $peserta->tanggal_lahir->format('d M Y') }}
                    @endif
                  @else
                    -
                  @endif
                </div>

                <label class="form-label fw-semibold mt-3">Usia</label>
                <div class="form-control bg-light border-0" readonly>{{ $peserta->usia ?? '-' }} tahun</div>

                <label class="form-label fw-semibold mt-3">Status Pernikahan</label>
                <div class="form-control bg-light border-0" readonly>{{ $peserta->status_kawin ?? '-' }}</div>
              </div>
            </div>
          </div>
</div>
          
          <div class="card mb-4 shadow-sm rounded-3">
          <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-briefcase me-2"></i> Data Kepegawaian
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Nomor SK</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>{{ $peserta->no_sk ?? '-' }}</div>

                <label class="form-label fw-semibold  mt-3">TMK</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>
                  @if($peserta->tmk)
                    @if(is_string($peserta->tmk))
                      {{ \Carbon\Carbon::parse($peserta->tmk)->format('d M Y') }}
                    @else
                      {{ $peserta->tmk->format('d M Y') }}
                    @endif
                  @else
                    -
                  @endif
                </div>

                <label class="form-label fw-semibold  mt-3">TPST</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>
                  @if($peserta->tpst)
                    @if(is_string($peserta->tpst))
                      {{ \Carbon\Carbon::parse($peserta->tpst)->format('d M Y') }}
                    @else
                      {{ $peserta->tpst->format('d M Y') }}
                    @endif
                  @else
                    -
                  @endif
                </div>

                @php
                     $labelGolongan = match($peserta->golongan) {
                        1 => 'Golongan 1',
                        2 => 'Golongan 2',
                        3 => 'Golongan 3',
                        4 => 'Golongan 4',
                        default => '-',
                     };
                  @endphp

                  <label class="form-label fw-semibold mt-3">Golongan</label>
                  <div class="form-control bg-light border-1 rounded-3" readonly>{{ $labelGolongan }}</div>

              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold ">Cabang</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>{{ $peserta->cabang->nama_cabang ?? 'Tidak ada cabang' }}</div>

               <label class="form-label fw-semibold mt-3">MKMK</label>
               <div class="form-control bg-light border-1 rounded-3">
               @if($peserta->tmk)
                  @php
                     $start = \Carbon\Carbon::parse($peserta->tmk);
                     $now = \Carbon\Carbon::now();
                     $selisih = $start->diff($now);
                  @endphp
                  {{ $selisih->y }} Tahun {{ $selisih->m }} Bulan {{ $selisih->d }} Hari
               @else
                  -
               @endif
               </div>

               <label class="form-label fw-semibold mt-3">MKMP</label>
               <div class="form-control bg-light border-1 rounded-3">
               @if($peserta->tpst)
                  @php
                     $start = \Carbon\Carbon::parse($peserta->tpst);
                     $now = \Carbon\Carbon::now();
                     $selisih = $start->diff($now);
                  @endphp
                  {{ $selisih->y }} Tahun {{ $selisih->m }} Bulan {{ $selisih->d }} Hari
               @else
                  -
               @endif
               </div>

                <label class="form-label fw-semibold  mt-3">Jabatan</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>{{ $peserta->jabatan ?? '-' }}</div>
              </div>
            </div>

            <div class="row g-3 mt-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Kode Direktorat</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>{{ $peserta->kode_dir ?? '-' }}</div>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Tahun Menjabat</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>
               @if($peserta->tahun_jabat)
                  @if(is_string($peserta->tahun_jabat))
                     {{ \Carbon\Carbon::parse($peserta->tahun_jabat)->format('d M Y') }}
                  @else
                     {{ $peserta->tahun_jabat->format('d M Y') }}
                  @endif
               @else
                  -
               @endif
               </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Pendidikan -->
        <div class="card mb-4 shadow-sm rounded-3">
          <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-graduation-cap me-2"></i> Data Pendidikan
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Pendidikan Terakhir</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>
                  {{ $peserta->pendidikan ?? '-' }}
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Jurusan</label>
                <div class="form-control bg-light border-1 rounded-3" readonly>
                  {{ $peserta->jurusan ?? '-' }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Keuangan -->
        <div class="card mb-4 shadow-sm rounded-3">
          <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-money-bill-wave me-2"></i> Data Keuangan
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold ">PHDP</label>
                <div class="form-control bg-light border rounded-3" readonly>
                  Rp {{ number_format($peserta->phdp ?? 0, 2, ',', '.') }}
                </div>
                <label class="form-label fw-semibold  mt-3">Kode PTKP</label>
                <div class="form-control bg-light border rounded-3" readonly>
                  {{ $peserta->kode_ptkp ?? '-' }}
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Akumulasi IBHP</label>
               <div class="form-control bg-light border rounded-3" readonly>
               Rp {{ number_format($peserta->akumulasi_ibhp, 2, ',', '.') }}
               </div>
                <label class="form-label fw-semibold  mt-3">Kode Peserta</label>
                <div class="form-control bg-light border rounded-3" readonly>
                  {{ $peserta->kode_peserta ?? '-' }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Alamat -->
        <div class="card mb-4 shadow-sm rounded-3">
          <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-map-marker-alt me-2"></i> Data Alamat
          </div>
          <div class="card-body">
            <label class="form-label fw-semibold  mb-1">Alamat Lengkap</label>
            <div class="form-control bg-light border rounded-3" style="min-height: 60px;" readonly>
              {{ $peserta->alamat ?? '-' }}
            </div>

            <div class="row g-3 mt-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Kelurahan</label>
                <div class="form-control bg-light border rounded-3" readonly>
                  {{ $peserta->kelurahan ?? '-' }}
                </div>
                <label class="form-label fw-semibold  mt-3">Kabupaten/Kota</label>
                <div class="form-control bg-light border rounded-3" readonly>
                  {{ $peserta->kabupaten_kota ?? '-' }}
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Kecamatan</label>
                <div class="form-control bg-light border rounded-3" readonly>
                  {{ $peserta->kecamatan ?? '-' }}
                </div>
                <label class="form-label fw-semibold  mt-3">Kode Pos</label>
                <div class="form-control bg-light border rounded-3" readonly>
                  {{ $peserta->kode_pos ?? '-' }}
                </div>
              </div>
            </div>

            <div class="row g-3 mt-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold ">Telepon</label>
                <div class="form-control bg-light border rounded-3 d-flex align-items-center" readonly>
                  <i class="fas fa-phone me-2"></i> {{ $peserta->telpon ?? '-' }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Keluarga -->
        <div class="card mb-4 shadow-sm rounded-3">
          <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-users me-2"></i> Data Keluarga
          </div>
          <div class="card-body">
            @if($peserta->keluargas->isEmpty())
              <div class="text-center py-4 text-muted">
                <i class="fas fa-users" style="font-size: 3rem;"></i>
                <p class="mt-3">Tidak ada data keluarga.</p>
              </div>
            @else
              <div class="table-responsive">
                <table class="table table-striped align-middle">
                  <thead class="table-light">
                    <tr>
                      <th class="fw-semibold">Nama</th>
                      <th class="fw-semibold">Jenis Kelamin</th>
                      <th class="fw-semibold">Tanggal Lahir</th>
                      <th class="fw-semibold">Usia</th>
                      <th class="fw-semibold">Hubungan</th>
                      <th class="fw-semibold">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($peserta->keluargas as $keluarga)
                      <tr>
                        <td>{{ $keluarga->nama }}</td>
                        <td>{{ $keluarga->jenis_kelamin }}</td>
                        <td>{{ $keluarga->tanggal_lahir }}</td>
                        <td>{{ $keluarga->usia ?? '-' }}</td>
                        <td>{{ $keluarga->hubungan ?? '-' }}</td>
                        <td>
                          <form action="{{ route('keluarga.destroy', $keluarga->id) }}" method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm px-2 py-1 rounded-2" type="submit" title="Hapus">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
          </div>
        </div>

      </div>
    </div>


         <!-- FOOTER -->

         <footer class="mt-auto">
            <div class="content__boxed">
               <div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
                  <div class="text-nowrap mb-4 mb-md-0">Copyright &copy; 2025 <a href="#" class="ms-1 btn-link fw-bold">Dapen Bank Sulselbar</a></div>
               </div>
            </div>
         </footer>

         <!-- END - FOOTER -->


      </section>

      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!-- END - CONTENTS -->


      <!-- HEADER -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <header class="header">
         <div class="header__inner">

            <!-- Brand -->
            <div class="header__brand">
               <div class="brand-wrap">

                  <!-- Brand logo -->
                  <a href="{{ route('supervisor.dashboard') }}" class="brand-img stretched-link">
                     <img src="{{asset ('images/sulselbar.jpg') }}" alt="Nifty Logo" class="Nifty logo" width="16" height="16">
                  </a>


                  <!-- Brand title -->
                  <div class="brand-title">Dapen</div>


                  <!-- You can also use IMG or SVG instead of a text element. -->
                  <!--
            <div class="brand-title">
               <img src="./assets/img/brand-title.svg" alt="Brand Title">
            </div>
            -->

               </div>
            </div>
            <!-- End - Brand -->


            <div class="header__content">

               <!-- Content Header - Left Side: -->
               <div class="header__content-start">


                  <!-- Navigation Toggler -->
                  <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
                     <i class="demo-psi-list-view"></i>
                  </button>


                  
               </div>
               <!-- End - Content Header - Left Side -->


               <!-- Content Header - Right Side: -->
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
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!-- END - HEADER -->


      <!-- MAIN NAVIGATION -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <nav id="mainnav-container" class="mainnav">
    <div class="mainnav__inner">

        <!-- Navigation menu -->
        <div class="mainnav__top-content scrollable-content pb-5">

            <!-- Profile Widget -->
               <div id="_dm-mainnavProfile" class="mainnav__widget my-3 hv-outline-parent">

                  <!-- Profile picture  -->
                  <div class="mininav-toggle text-center py-2 " >
                     <img class="mainnav__avatar img-md rounded-circle hv-oc" src="{{ asset('assets/img/profile-photos/1.png') }}" alt="Profile Picture">
                  </div>


                  <div class="mininav-content collapse d-mn-max">
                     <span data-popper-arrow class="arrow"></span>
                     <div class="d-grid">

                        <!-- User name and position -->
                        <button class="mainnav-widget-toggle d-block btn border-0 p-2" data-bs-toggle="collapse" data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
                           <span class="d-flex justify-content-center align-items-center">
                              <h5 class="mb-0" style="margin-left: 0px;">Operator</h5>
                           </span>
                        </button>
                        <!-- Collapsed user menu -->
                        <div id="usernav" class="nav flex-column collapse">
                           <a href="{{ route('ubah-password.form') }}" class="nav-link">
                              <i class="fas fa-key me-2"></i>
                              <span class="ms-1">Ganti Password</span>
                           </a>
                        </div>
                     </div>
                  </div>

               </div>
               <!-- End - Profile widget -->

            <!-- Navigation Category -->
            <div class="mainnav__categoriy py-3">
                <ul class="mainnav__menu nav flex-column">

                    <li class="nav-item">
                        <a href="{{ route('operator.index') }}" class="nav-link active {{ request()->routeIs('operator.index') ? 'active' : '' }}">
                            <i class="fas fa-users me-2"></i>
                            <span class="nav-label">Data Peserta</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('operator.parameters.databank') }}" class="nav-link {{ request()->routeIs('operator.parameters.databank') ? 'active' : '' }}">
                           <i class="fas fa-landmark me-2"></i> <span class="nav-label">Data Bank</span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ route('operator.parameters.datacabang') }}" class="nav-link {{ request()->routeIs('operator.parameters.datacabang') ? 'active' : '' }}">
                           <i class="fas fa-sitemap me-2"></i> <span class="nav-label">Data Cabang</span>
                        </a>
                     </li>
                     <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i class="fas fa-cogs me-2"></i>
                           <span class="nav-label ms-1">Parameter</span>
                        </a>

                        <!-- Dashboard submenu list -->
                        <ul class="mininav-content nav collapse">
                           <li data-popper-arrow class="arrow"></li>
                           <li class="nav-item">
                              <a href="{{ route('operator.parameters.nilaisekarang') }}" class="nav-link {{ request()->routeIs('operator.parameters.nilaisekarang') ? 'active' : '' }}">
                                    <i class="fas fa-chart-line me-2"></i> Nilai Sekarang
                                 </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('operator.parameters.nsanak') }}" class="nav-link {{ request()->routeIs('operator.parameters.nsanak') ? 'active' : '' }}">
                                    <i class="fas fa-child me-2"></i> NS Anak
                                 </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('operator.parameters.nsjanda') }}" class="nav-link {{ request()->routeIs('operator.parameters.nsjanda') ? 'active' : '' }}">
                                    <i class="fas fa-female me-2"></i> NS Janda
                                 </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('operator.parameters.nspegawai') }}" class="nav-link {{ request()->routeIs('operator.parameters.nspegawai') ? 'active' : '' }}">
                                    <i class="fas fa-user-tie me-2"></i> NS Pegawai
                                 </a>
                           </li>

                        </ul>
                        <!-- END : Dashboard submenu list -->

                     </li>

                     <li class="nav-item">
                        <a href="{{ route('operator.parameters.ptkp') }}" class="nav-link {{ request()->routeIs('operator.parameters.ptkp') ? 'active' : '' }}">
                           <i class="fas fa-percent me-2"></i> <span class="nav-label">Tabel PTKP</span>
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

                    <!-- Tambahkan menu lainnya di sini -->

                </ul>
            </div>

        </div>
        <!-- End: top content -->

        <!-- Spacer to push logout to bottom -->
        <div class="mt-auto"></div>

        <!-- Bottom navigation menu -->
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
        <!-- End - Bottom navigation menu -->

    </div>
</nav>
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!-- END - MAIN NAVIGATION -->


      <!-- SIDEBAR -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <aside class="sidebar">
         <div class="sidebar__inner scrollable-content">


            <!-- This element is only visible when sidebar Stick mode is active. -->
            <div class="sidebar__stuck align-items-center mb-3 px-3">
               <button type="button" class="sidebar-toggler btn-close btn-lg rounded-circle" aria-label="Close"></button>
               <p class="m-0 text-danger fw-bold">&lt;= Close the sidebar</p>
            </div>


            <!-- Sidebar tabs nav -->
            <div class="sidebar__wrap">
               <nav>
                  <div class="nav nav-underline nav-fill nav-component flex-nowrap border-bottom" id="nav-tab" role="tablist">
                     <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-chat" type="button" role="tab" aria-controls="nav-chat" aria-selected="true">
                        <i class="d-block demo-pli-speech-bubble-5 fs-3 mb-2"></i>
                        <span>Chat</span>
                     </button>

                     <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-reports" type="button" role="tab" aria-controls="nav-reports" aria-selected="false">
                        <i class="d-block demo-pli-information fs-3 mb-2"></i>
                        <span>Reports</span>
                     </button>

                     <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-settings" type="button" role="tab" aria-controls="nav-settings" aria-selected="false">
                        <i class="d-block demo-pli-wrench fs-3 mb-2"></i>
                        <span>Settings</span>
                     </button>
                  </div>
               </nav>
            </div>
            <!-- End - Sidebar tabs nav -->


            <!-- Sideabar tabs content -->
            <div class="tab-content sidebar__wrap" id="nav-tabContent">

               <!-- Chat tab Content -->
               <div id="nav-chat" class="tab-pane fade py-4 show active" role="tabpanel" aria-labelledby="nav-chat-tab">

                  <!-- Family list group -->
                  <h5 class="px-3">Family</h5>
                  <div class="list-group list-group-borderless">

                     <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                           <img class="img-xs rounded-circle" src="./assets/img/profile-photos/2.png" alt="Profile Picture" loading="lazy">
                        </div>
                        <div class="flex-grow-1 ">
                           <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Stephen Tran</a>
                           <small class="text-body-secondary">Available</small>
                        </div>
                     </div>


                     <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                           <img class="img-xs rounded-circle" src="./assets/img/profile-photos/8.png" alt="Profile Picture" loading="lazy">
                        </div>
                        <div class="flex-grow-1 ">
                           <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Betty Murphy</a>
                           <small class="text-body-secondary">Iddle</small>
                        </div>
                     </div>


                     <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                           <img class="img-xs rounded-circle" src="./assets/img/profile-photos/7.png" alt="Profile Picture" loading="lazy">
                        </div>
                        <div class="flex-grow-1 ">
                           <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Brittany Meyer</a>
                           <small class="text-body-secondary">I think so!</small>
                        </div>
                     </div>


                     <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                           <img class="img-xs rounded-circle" src="./assets/img/profile-photos/4.png" alt="Profile Picture" loading="lazy">
                        </div>
                        <div class="flex-grow-1 ">
                           <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Jack George</a>
                           <small class="text-body-secondary">Last seen 2 hours ago</small>
                        </div>
                     </div>

                  </div>
                  <!-- End - Family list group -->


                  <!-- Friends Group -->
                  <h5 class="d-flex mt-5 px-3">Friends <span class="badge bg-success ms-auto">587 +</span></h5>
                  <div class="list-group list-group-borderless">
                     <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-success rounded-circle p-1 me-2"></span>
                        Joey K. Greyson
                     </a>
                     <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-info rounded-circle p-1 me-2"></span>
                        Andrea Branden
                     </a>
                     <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-warning rounded-circle p-1 me-2"></span>
                        Johny Juan
                     </a>
                     <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-secondary rounded-circle p-1 me-2"></span>
                        Susan Sun
                     </a>
                  </div>
                  <!-- End - Friends Group -->


                  <!-- Simple news widget -->
                  <div class="p-3 mt-5 rounded bg-info-subtle text-info-emphasis">
                     <h5 class="text-info-emphasis">News</h5>
                     <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui consequatur ipsum porro a repellat eaque exercitationem necessitatibus esse voluptate corporis.</p>
                     <small class="fst-italic">Last Update : Today 13:54</small>
                  </div>
                  <!-- End - Simple news widget -->

               </div>
               <!-- End - Chat tab content -->


               <!-- Reports tab content -->
               <div id="nav-reports" class="tab-pane fade py-4" role="tabpanel" aria-labelledby="nav-reports-tab">

                  <!-- Billing and Resports -->
                  <div class="px-3">
                     <h5 class="mb-3">Billing &amp; Reports</h5>
                     <p>Get <span class="badge bg-danger">$15.00 off</span> your next bill by making sure your full payment reaches us before August 5th.</p>

                     <h5 class="mt-5 mb-0">Amount Due On</h5>
                     <p>August 17, 2028</p>
                     <p class="h1">$83.09</p>

                     <div class="d-grid">
                        <button class="btn btn-success" type="button">Pay now</button>
                     </div>
                  </div>
                  <!-- End - Billing and Resports -->


                  <!-- Additional actions nav -->
                  <h5 class="mt-5 px-3">Additional Actions</h5>
                  <div class="list-group list-group-borderless">
                     <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-information me-2 fs-5"></i>
                        Services Information
                     </a>
                     <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-mine me-2 fs-5"></i>
                        Usage
                     </a>
                     <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-credit-card-2 me-2 fs-5"></i>
                        Payment Options
                     </a>
                     <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-support me-2 fs-5"></i>
                        Messages Center
                     </a>
                  </div>
                  <!-- End - Additional actions nav -->


                  <!-- Contact widget -->
                  <div class="px-3 mt-5 text-center">
                     <div class="mb-3">
                        <i class="demo-pli-old-telephone display-4 text-primary"></i>
                     </div>
                     <p>Have a question ?</p>
                     <p class="h5 mb-0"> (415) 234-53454 </p>
                     <small><em>We are here 24/7</em></small>
                  </div>
                  <!-- End - Contact widget -->

               </div>
               <!-- End - Reports tab content -->


               <!-- Settings content -->
               <div id="nav-settings" class="tab-pane fade py-4" role="tabpanel" aria-labelledby="nav-settings-tab">

                  <!-- Account settings -->
                  <h5 class="px-3">Account Settings</h5>
                  <div class="list-group list-group-borderless">

                     <div class="list-group-item mb-1">
                        <div class="d-flex justify-content-between mb-1">
                           <label class="form-check-label text-body-emphasis stretched-link" for="_dm-sbPersonalStatus">Show my personal status</label>
                           <div class="form-check form-switch">
                              <input id="_dm-sbPersonalStatus" class="form-check-input" type="checkbox" checked>
                           </div>
                        </div>
                        <small class="text-body-secondary">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
                     </div>

                     <div class="list-group-item mb-1">
                        <div class="d-flex justify-content-between mb-1">
                           <label class="form-check-label text-body-emphasis stretched-link" for="_dm-sbOfflineContact">Show offline contact</label>
                           <div class="form-check form-switch">
                              <input id="_dm-sbOfflineContact" class="form-check-input" type="checkbox">
                           </div>
                        </div>
                        <small class="text-body-secondary">Aenean commodo ligula eget dolor. Aenean massa.</small>
                     </div>

                     <div class="list-group-item mb-1">
                        <div class="d-flex justify-content-between mb-1">
                           <label class="form-check-label text-body-emphasis stretched-link" for="_dm-sbInvisibleMode">Invisible Mode</label>
                           <div class="form-check form-switch">
                              <input id="_dm-sbInvisibleMode" class="form-check-input" type="checkbox">
                           </div>
                        </div>
                        <small class="text-body-secondary">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</small>
                     </div>

                  </div>
                  <!-- End - Account settings -->


                  <!-- Public Settings -->
                  <h5 class="mt-5 px-3">Public Settings</h5>
                  <div class="list-group list-group-borderless">

                     <div class="list-group-item d-flex justify-content-between mb-1">
                        <label class="form-check-label" for="_dm-sbOnlineStatus">Online Status</label>
                        <div class="form-check form-switch">
                           <input id="_dm-sbOnlineStatus" class="form-check-input" type="checkbox" checked>
                        </div>
                     </div>

                     <div class="list-group-item d-flex justify-content-between mb-1">
                        <label class="form-check-label" for="_dm-sbMuteNotifications">Mute Notifications</label>
                        <div class="form-check form-switch">
                           <input id="_dm-sbMuteNotifications" class="form-check-input" type="checkbox" checked>
                        </div>
                     </div>

                     <div class="list-group-item d-flex justify-content-between mb-1">
                        <label class="form-check-label" for="_dm-sbMyDevicesName">Show my device name</label>
                        <div class="form-check form-switch">
                           <input id="_dm-sbMyDevicesName" class="form-check-input" type="checkbox" checked>
                        </div>
                     </div>

                  </div>
                  <!-- End - Public Settings -->

               </div>
               <!-- End - Settings content -->

            </div>
            <!-- End - Sidebar tabs content -->

         </div>
      </aside>
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!-- END - SIDEBAR -->


   </div>
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <!-- END - PAGE CONTAINER -->


   <!-- SCROLL TO TOP BUTTON -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <div class="scroll-container">
      <a href="#root" class="scroll-page ratio ratio-1x1" aria-label="Scroll button"></a>
   </div>
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <!-- END - SCROLL TO TOP BUTTON -->


   <!-- BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <div id="_dm-boxedBgContent" class="_dm-boxbg offcanvas offcanvas-bottom" data-bs-scroll="true" tabindex="-1">
      <div class="offcanvas-body px-4">

         <!-- Content Header -->
         <div class="offcanvas-header border-bottom p-0 pb-3">
            <div>
               <h4 class="offcanvas-title">Background Images</h4>
               <span class="text-body-secondary">Add an image to replace the solid background color</span>
            </div>
            <button type="button" class="btn-close btn-lg text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <!-- End - Content header -->


         <!-- Collection Of Images -->
         <div id="_dm-boxedBgContainer" class="row mt-3">

            <!-- Blurred Background Images -->
            <div class="col-lg-4">
               <h5 class="mb-2">Blurred</h5>
               <div class="_dm-boxbg__img-container d-flex flex-wrap">
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/1.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/2.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/3.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/4.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/5.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/6.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/7.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/8.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/9.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/10.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/11.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/12.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/13.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/14.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/15.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/blurred/thumbs/16.jpg" alt="Background Image" loading="lazy">
                  </a>
               </div>
            </div>
            <!-- End - Blurred Background Images -->


            <!-- Polygon Background Images -->
            <div class="col-lg-4">
               <h5 class="mb-2">Polygon &amp; Geometric</h5>
               <div class="_dm-boxbg__img-container d-flex flex-wrap mb-4">
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/1.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/2.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/3.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/4.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/5.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/6.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/7.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/8.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/9.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/10.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/11.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/12.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/13.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/14.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/15.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/polygon/thumbs/16.jpg" alt="Background Image" loading="lazy">
                  </a>
               </div>
            </div>
            <!-- End - Polygon Background Images -->


            <!-- Abstract Background Images -->
            <div class="col-lg-4">
               <h5 class="mb-2">Abstract</h5>
               <div class="_dm-boxbg__img-container d-flex flex-wrap">
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/1.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/2.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/3.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/4.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/5.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/6.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/7.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/8.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/9.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/10.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/11.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/12.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/13.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/14.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/15.jpg" alt="Background Image" loading="lazy">
                  </a>
                  <a href="#" class="_dm-boxbg__thumb ratio ratio-16x9">
                     <img class="img-responsive" src="./assets/premium/boxed-bg/abstract/thumbs/16.jpg" alt="Background Image" loading="lazy">
                  </a>
               </div>
            </div>
            <!-- End - Abstract Background Images -->


         </div>
         <!-- End - Collection Of Images -->


      </div>
   </div>
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <!-- END - BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->


   <!-- SETTINGS CONTAINER [ DEMO ] -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <div id="_dm-settingsContainer" class="_dm-settings-container offcanvas offcanvas-end rounded-start" tabindex="-1">
      <button id="_dm-settingsToggler" class="_dm-btn-settings btn btn-sm btn-danger p-2 rounded-0 rounded-start shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#_dm-settingsContainer" aria-label="Customization button" aria-controls="#_dm-settingsContainer">
         <i class="demo-psi-gear fs-1"></i>
      </button>


      <div class="offcanvas-body py-0">
         <div class="_dm-settings-container__content row">
            <div class="col-lg-3 p-4">

               <h4 class="fw-bold pb-3 mb-2">Layouts</h4>


               <!-- OPTION : Centered Layout -->
               <h6 class="mb-2 pb-1">Layouts</h6>
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-fluidLayoutRadio">Fluid Layout</label>
                  <div class="form-check form-switch">
                     <input id="_dm-fluidLayoutRadio" class="form-check-input ms-0" type="radio" name="settingLayouts" autocomplete="off" checked>
                  </div>
               </div>


               <!-- OPTION : Boxed layout -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-boxedLayoutRadio">Boxed Layout</label>
                  <div class="form-check form-switch">
                     <input id="_dm-boxedLayoutRadio" class="form-check-input ms-0" type="radio" name="settingLayouts" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Boxed layout with background images -->
               <div id="_dm-boxedBgOption" class="opacity-50 d-flex align-items-center pt-1 mb-2">
                  <label class="form-label flex-fill mb-0">BG for Boxed Layout</label>

                  <button id="_dm-boxedBgBtn" class="btn btn-icon btn-primary btn-xs" type="button" data-bs-toggle="offcanvas" data-bs-target="#_dm-boxedBgContent" disabled>
                     <i class="demo-psi-dot-horizontal"></i>
                  </button>
               </div>


               <!-- OPTION : Centered Layout -->
               <div class="d-flex align-items-start pt-1 pb-3 mb-2">
                  <label class="form-check-label flex-fill text-nowrap" for="_dm-centeredLayoutRadio">Centered Layout</label>
                  <div class="form-check form-switch">
                     <input id="_dm-centeredLayoutRadio" class="form-check-input ms-0" type="radio" name="settingLayouts" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Transition timing -->
               <h6 class="mt-4 mb-2 py-1">Transitions</h6>
               <div class="d-flex align-items-center pt-1 pb-3 mb-2">
                  <select id="_dm-transitionSelect" class="form-select" aria-label="select transition timing">
                     <option value="in-quart">In Quart</option>
                     <option value="out-quart" selected>Out Quart</option>
                     <option value="in-back">In Back</option>
                     <option value="out-back">Out Back</option>
                     <option value="in-out-back">In Out Back</option>
                     <option value="steps">Steps</option>
                     <option value="jumping">Jumping</option>
                     <option value="rubber">Rubber</option>
                  </select>
               </div>


               <!-- OPTION : Sticky Header -->
               <h6 class="mt-4 mb-2 py-1">Header</h6>
               <div class="d-flex align-items-center pt-1 pb-3 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-stickyHeaderCheckbox">Sticky header</label>
                  <div class="form-check form-switch">
                     <input id="_dm-stickyHeaderCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Additional Offcanvas -->
               <h6 class="mt-4 mb-2 py-1">Additional Offcanvas</h6>
               <p>Select the offcanvas placement.</p>
               <div class="text-nowrap">
                  <button type="button" class="_dm-offcanvasBtn btn btn-sm btn-primary" value="offcanvas-top">Top</button>
                  <button type="button" class="_dm-offcanvasBtn btn btn-sm btn-primary" value="offcanvas-end">Right</button>
                  <button type="button" class="_dm-offcanvasBtn btn btn-sm btn-primary" value="offcanvas-bottom">Btm</button>
                  <button type="button" class="_dm-offcanvasBtn btn btn-sm btn-primary" value="offcanvas-start">Left</button>
               </div>


            </div>
            <div class="col-lg-3 p-4 bg-body">

               <h4 class="fw-bold pb-3 mb-2">Sidebars</h4>


               <!-- OPTION : Sticky Navigation -->
               <h6 class="mb-2 pb-1">Navigation</h6>
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-stickyNavCheckbox">Sticky navigation</label>
                  <div class="form-check form-switch">
                     <input id="_dm-stickyNavCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Navigation Profile Widget -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-profileWidgetCheckbox">Widget Profile</label>
                  <div class="form-check form-switch">
                     <input id="_dm-profileWidgetCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off" checked>
                  </div>
               </div>


               <!-- OPTION : Mini navigation mode -->
               <div class="d-flex align-items-center pt-3 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-miniNavRadio">Min / Collapsed Mode</label>
                  <div class="form-check form-switch">
                     <input id="_dm-miniNavRadio" class="form-check-input ms-0" type="radio" name="navigation-mode" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Maxi navigation mode -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-maxiNavRadio">Max / Expanded Mode</label>
                  <div class="form-check form-switch">
                     <input id="_dm-maxiNavRadio" class="form-check-input ms-0" type="radio" name="navigation-mode" autocomplete="off" checked>
                  </div>
               </div>


               <!-- OPTION : Push navigation mode -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-pushNavRadio">Push Mode</label>
                  <div class="form-check form-switch">
                     <input id="_dm-pushNavRadio" class="form-check-input ms-0" type="radio" name="navigation-mode" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Slide on top navigation mode -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-slideNavRadio">Slide on top</label>
                  <div class="form-check form-switch">
                     <input id="_dm-slideNavRadio" class="form-check-input ms-0" type="radio" name="navigation-mode" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Slide on top navigation mode -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-revealNavRadio">Reveal Mode</label>
                  <div class="form-check form-switch">
                     <input id="_dm-revealNavRadio" class="form-check-input ms-0" type="radio" name="navigation-mode" autocomplete="off">
                  </div>
               </div>

               <div class="d-flex align-items-center justify-content-between gap-3 py-3">
                  <button class="nav-toggler btn btn-primary btn-sm" type="button">
                     Navigation
                  </button>
                  <button class="sidebar-toggler btn btn-primary btn-sm" type="button">
                     Sidebar
                  </button>
               </div>


               <h6 class="mt-3 mb-2 py-1">Sidebar</h6>


               <!-- OPTION : Disable sidebar backdrop -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-disableBackdropCheckbox">Disable backdrop</label>
                  <div class="form-check form-switch">
                     <input id="_dm-disableBackdropCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Static position -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-staticSidebarCheckbox">Static position</label>
                  <div class="form-check form-switch">
                     <input id="_dm-staticSidebarCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Stuck sidebar -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-stuckSidebarCheckbox">Stuck Sidebar </label>
                  <div class="form-check form-switch">
                     <input id="_dm-stuckSidebarCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Unite Sidebar -->
               <div class="d-flex align-items-center pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-uniteSidebarCheckbox">Unite Sidebar</label>
                  <div class="form-check form-switch">
                     <input id="_dm-uniteSidebarCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                  </div>
               </div>


               <!-- OPTION : Pinned Sidebar -->
               <div class="d-flex align-items-start pt-1 mb-2">
                  <label class="form-check-label flex-fill" for="_dm-pinnedSidebarCheckbox">Pinned Sidebar</label>
                  <div class="form-check form-switch">
                     <input id="_dm-pinnedSidebarCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                  </div>
               </div>

            </div>
            <div class="col-lg-6 p-4">
               <h4 class="fw-bold pb-3 mb-2">Colors</h4>

               <div class="d-flex mb-4 pb-4">
                  <div class="d-flex flex-column">
                     <h5 class="h6">Modes</h5>
                     <div class="form-check form-check-alt form-switch">
                        <input id="settingsThemeToggler" class="form-check-input mode-switcher" type="checkbox" role="switch">
                        <label class="form-check-label ps-3 fw-bold d-none d-md-flex align-items-center " for="settingsThemeToggler">
                           <i class="mode-switcher-icon icon-light demo-psi-sun fs-3"></i>
                           <i class="mode-switcher-icon icon-dark d-none demo-psi-half-moon fs-5"></i>
                        </label>
                     </div>
                  </div>
                  <div class="vr mx-4"></div>
                  <div class="_dm-colorSchemesMode__colors">
                     <h5 class="h6">Color Schemes</h5>
                     <div id="dm_colorSchemesContainer" class="d-flex flex-wrap justify-content-center">
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-gray" type="button" data-color="gray"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-navy" type="button" data-color="navy"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-ocean" type="button" data-color="ocean"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-lime" type="button" data-color="lime"></button>

                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-violet" type="button" data-color="violet"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-orange" type="button" data-color="orange"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-teal" type="button" data-color="teal"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-corn" type="button" data-color="corn"></button>

                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-cherry" type="button" data-color="cherry"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-coffee" type="button" data-color="coffee"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-pear" type="button" data-color="pear"></button>
                        <button class="_dm-colorSchemes _dm-box-xs _dm-bg-night" type="button" data-color="night"></button>
                     </div>
                  </div>
               </div>


               <div id="dm_colorModeContainer">
                  <div class="row text-center mb-2">

                     <!-- Expanded Header -->
                     <div class="col-md-4">
                        <h6 class="m-0">Expanded Header</h6>
                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--expanded-hd">
                              <img src="{{ asset('assets/img/color-schemes/expanded-header.png') }}" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>


                     <!-- Fair Header -->
                     <div class="col-md-4">
                        <h6 class="m-0">Fair Header</h6>
                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--fair-hd">
                              <img src="{{ asset('assets/img/color-schemes/fair-header.png') }}" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>


                     <div class="col-md-4">
                        <h6 class="m-0">Full Header</h6>

                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--full-hd">
                              <img src="{{ asset('assets/img/color-schemes/full-header.png') }}" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>
                  </div>


                  <div class="row text-center mb-2">
                     <div class="col-md-4">
                        <h6 class="m-0">Primary Nav</h6>

                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--primary-mn">
                              <img src="{{ asset('assets/img/color-schemes/navigation.png') }}" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>

                     <div class="col-md-4">
                        <h6 class="m-0">Brand</h6>

                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--primary-brand">
                              <img src="{{ asset('assets/img/color-schemes/brand.png') }}" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>

                     <div class="col-md-4">
                        <h6 class="m-0">Tall Header</h6>
                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--tall-hd">
                              <img src="{{ asset('assets/img/color-schemes/tall-header.png') }}" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>


                  </div>
               </div>

               <div class="pt-3">

                  <h5 class="fw-bold mt-2">Miscellaneous</h5>

                  <div class="d-flex gap-3 my-3">
                     <label for="_dm-fontSizeRange" class="form-label flex-shrink-0 mb-0">Root Font sizes</label>
                     <div class="position-relative flex-fill">
                        <input type="range" class="form-range" min="9" max="19" step="1" value="16" id="_dm-fontSizeRange">
                        <output id="_dm-fontSizeValue" class="range-bubble"></output>
                     </div>
                  </div>

                  <h5 class="fw-bold mt-4">Scrollbars</h5>
                  <p class="mb-2">Hides native scrollbars and creates custom styleable overlay scrollbars.</p>
                  <div class="row">
                     <div class="col-5">

                        <!-- OPTION : Apply the OverlayScrollBar to the body. -->
                        <div class="d-flex align-items-center pt-1 mb-2">
                           <label class="form-check-label flex-fill" for="_dm-bodyScrollbarCheckbox">Body scrollbar</label>
                           <div class="form-check form-switch">
                              <input id="_dm-bodyScrollbarCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                           </div>
                        </div>


                        <!-- OPTION : Apply the OverlayScrollBar to content containing class .scrollable-content. -->
                        <div class="d-flex align-items-center pt-1 mb-2">
                           <label class="form-check-label flex-fill" for="_dm-sidebarsScrollbarCheckbox">Navigation and Sidebar</label>
                           <div class="form-check form-switch">
                              <input id="_dm-sidebarsScrollbarCheckbox" class="form-check-input ms-0" type="checkbox" autocomplete="off">
                           </div>
                        </div>

                     </div>
                     <div class="col-7">

                        <div class="alert alert-warning mb-0" role="alert">
                           Please consider the performance impact of using any scrollbar plugin.
                        </div>

                     </div>
                  </div>

               </div>


            </div>
         </div>


      </div>
   </div>
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <!-- END - SETTINGS CONTAINER [ DEMO ] -->


   <!-- OFFCANVAS [ DEMO ] -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <div id="_dm-offcanvas" class="offcanvas" tabindex="-1">

      <!-- Offcanvas header -->
      <div class="offcanvas-header">
         <h5 class="offcanvas-title">Offcanvas Header</h5>
         <button type="button" class="btn-close btn-lg text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <!-- Offcanvas content -->
      <div class="offcanvas-body">
         <h5>Content Here</h5>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente eos nihil earum aliquam quod in dolor, aspernatur obcaecati et at. Dicta, ipsum aut, fugit nam dolore porro non est totam sapiente animi recusandae obcaecati dolorum, rem ullam cumque. Illum quidem reiciendis autem neque excepturi odit est accusantium, facilis provident molestias, dicta obcaecati itaque ducimus fuga iure in distinctio voluptate nesciunt dignissimos rem error a. Expedita officiis nam dolore dolores ea. Soluta repellendus delectus culpa quo. Ea tenetur impedit error quod exercitationem ut ad provident quisquam omnis! Nostrum quasi ex delectus vero, facilis aut recusandae deleniti beatae. Qui velit commodi inventore.</p>
      </div>

   </div>
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <!-- END - OFFCANVAS [ DEMO ] -->


   <!-- JAVASCRIPTS -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->


   <!-- Popper JS [ OPTIONAL ] -->
   <script src="{{ asset('assets/vendors/popperjs/popper.min.js') }}"></script>


   <!-- Bootstrap JS [ OPTIONAL ] -->
   <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>


   <!-- Nifty JS [ OPTIONAL ] -->
   <script src="{{ asset('assets/js/nifty.js') }}"></script>


   <!-- Nifty Settings [ DEMO ] -->
   <script src="{{ asset('assets/js/demo-purpose-only.js') }}"></script>


   <!-- Chart JS Scripts [ OPTIONAL ] -->
   <script src="{{ asset('assets/vendors/chart.js/chart.umd.min.js') }}"></script>


   <!-- Initialize [ SAMPLE ] -->
   <script src="{{ asset('assets/pages/dashboard-1.js') }}"></script>


</body>

</html>