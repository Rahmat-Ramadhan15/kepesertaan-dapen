
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-scheme="ocean">

<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
   <meta name="description" content="Dashboard page with OffCanvas navigation.">
   <title>Supervisor | Dapen - Bank Sulselbar</title>


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

<body class="out-quart centered-layout">


   <!-- PAGE CONTAINER -->
   <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
   <div id="root" class="root mn--slide tm--expanded-hd">

      <!-- CONTENTS -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <section id="content" class="content">
         <div class="content__header content__boxed rounded-0">
            <div class="content__wrap">


               <!-- Page title and information -->
               <div class="text-center">
                  <h1 class="page-title mb-3 mt-4">Dashboard</h1>
                  <p class="lead mb-0">Hi Supervisor! Welcome back to the Dashboard.</p>
               </div>
               <!-- END : Page title and information -->

               <div class="py-4 my-5">


                  <!-- Line Chart -->
                  <div style="height: 300px">
                     <canvas id="_dm-lineChart"></canvas>
                  </div>
                  <!-- END : Line Chart -->


               </div>

               <div class="row mb-4">
                  <div class="col-md-7">


                     <!-- Statistic list -->
                     <h3>Statistics</h3>
                        <ol class="list-group list-group-borderless mb-4">
                        <li class="list-group-item text-body-emphasis d-flex justify-content-between align-items-start px-0">
                            <div class="me-auto">
                                <div class="text-reset fs-5 fw-semibold">Total Peserta</div>
                                <small class="text-reset opacity-50">Jumlah seluruh peserta.</small>
                            </div>
                            <span class="badge bg-success rounded-pill">{{ $totalPeserta }}</span>
                        </li>
                        <li class="list-group-item text-body-emphasis d-flex justify-content-between align-items-start px-0">
                            <div class="me-auto">
                                <div class="text-reset fs-5 fw-semibold">Laki-laki</div>
                                <small class="text-reset opacity-50">Peserta laki-laki.</small>
                            </div>
                            <span class="badge bg-info rounded-pill">{{ $totalLaki }}</span>
                        </li>
                        <li class="list-group-item text-body-emphasis d-flex justify-content-between align-items-start px-0">
                            <div class="me-auto">
                                <div class="text-reset fs-5 fw-semibold">Perempuan</div>
                                <small class="text-reset opacity-50">Peserta perempuan.</small>
                            </div>
                            <span class="badge bg-danger rounded-pill">{{ $totalPerempuan }}</span>
                        </li>
                        <li class="list-group-item text-body-emphasis d-flex justify-content-between align-items-start px-0">
                            <div class="me-auto">
                                <div class="text-reset fs-5 fw-semibold">Total PHDP</div>
                                <small class="text-reset opacity-50">Jumlah total PHDP dari semua peserta.</small>
                            </div>
                            <span class="badge bg-success rounded-pill">Rp {{ number_format($totalPHDP, 0, ',', '.') }}</span>
                        </li>
                        </ol>

                     <!-- END : Statistic list -->


                  </div>
                  <div class="col-md-5">


                     <!-- Doughnut Chart -->
                     <div class="pt-4" style="height: 250px">
                        <canvas id="_dm-doughnutChart"></canvas>
                     </div>
                     <!-- END : Doughnut Chart -->

                  </div>
               </div>


            </div>

         </div>


         <div class="content__boxed pt-4">
            <div class="content__wrap">

               <!-- Tiles -->
               <div class="row">
                  <div class="col-sm-6 col-lg-3">


                     <!-- Stat widget -->
                     <div class="card bg-cyan text-white mb-3 mb-xl-3 hv-grow">
                        <div class="card-body py-3 d-flex align-items-stretch">
                           <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-start">
                              <i class="demo-psi-lock-user fs-1"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <h5 class="h2 mb-0">{{ $totalPeserta }}</h5>
                              <p class="mb-0">Total Peserta</p>
                           </div>
                        </div>
                     </div>
                     <!-- END : Stat widget -->


                  </div>
                  <div class="col-sm-6 col-lg-3">


                     <!-- Stat widget -->
                     <div class="card bg-purple text-white mb-3 mb-xl-3 hv-grow">
                        <div class="card-body py-3 d-flex align-items-stretch">
                           <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-start">
                              <i class="demo-psi-male fs-1"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <h5 class="h2 mb-0">{{ $totalLaki }}</h5>
                              <p class="mb-0">Total Laki-laki</p>
                           </div>
                        </div>
                     </div>
                     <!-- END : Stat widget -->


                  </div>
                  <div class="col-sm-6 col-lg-3">


                     <!-- Stat widget -->
                     <div class="card bg-orange text-white mb-3 mb-xl-3 hv-grow">
                        <div class="card-body py-3 d-flex align-items-stretch">
                           <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-start">
                              <i class="demo-psi-female-2 fs-1"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <h5 class="h2 mb-0">{{ $totalPerempuan }}</h5>
                              <p class="mb-0">Total Perempuan</p>
                           </div>
                        </div>
                     </div>
                     END : Stat widget


                  </div>
                  <div class="col-sm-6 col-lg-3">


                     <!-- Stat widget -->
                     <div class="card bg-pink text-white mb-3 mb-xl-3 hv-grow">
                        <div class="card-body py-3 d-flex align-items-stretch">
                           <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-start">
                              <i class="demo-psi-idea-2 fs-1"></i>
                           </div>
                           <div class="flex-grow-1 ms-3">
                              <h5 class="h2 mb-0">{{ $totalJabatan }}</h5>
                              <p class="mb-0">Total Jabatan</p>
                           </div>
                        </div>
                     </div>
                     <!-- END : Stat widget -->


                  </div>
               </div>
               <!-- END : Tiles -->


               <div class="row">
                  <div class="col-md-12 mb-3">


                     <!-- Top Users table -->
                     <div class="card">
                        <div class="card-body">
                           <h5 class="card-title">Top Users</h5>
                           <div class="table-responsive">
                              <table class="table table-striped">
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

                     <!-- END : Top Users table -->


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
                     <img src="{{ asset('images/Logo_Bank_Sulselbar.png') }}" alt="Nifty Logo" class="Nifty logo" width="16" height="16">
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
                  <div class="mininav-toggle text-center py-2">
                     <img class="mainnav__avatar img-md rounded-circle hv-oc" src="./assets/img/profile-photos/1.png" alt="Profile Picture">
                  </div>


                  <div class="mininav-content collapse d-mn-max">
                     <span data-popper-arrow class="arrow"></span>
                     <div class="d-grid">

                        <!-- User name and position -->
                        <button class="mainnav-widget-toggle d-block btn border-0 p-2" data-bs-toggle="collapse" aria-expanded="false" aria-controls="usernav">
                           <span class="d-flex justify-content-center align-items-center">
                              <h5 class="mb-0" style="margin-left: 0px;">Supervisor</h5>
                           </span>
                        </button>
                     </div>
                  </div>

               </div>
               <!-- End - Profile widget -->


               <!-- Navigation Category -->
               <div class="mainnav__categoriy py-3">
                  <h6 class="mainnav__caption mt-0 fw-bold">Navigation</h6>
                  <ul class="mainnav__menu nav flex-column">

                     <!-- Link with submenu -->
                     <li class="nav-item has-sub">


                        <a href="#" class=" nav-link active"><i class="demo-pli-home fs-5 me-2"></i>
                           <span class="nav-label ms-1">Dashboard</span>
                        </a>

                     </li>
                     <!-- END : Link with submenu -->

                     <!-- Link with submenu -->
                     

                     <!-- Regular menu link -->
                     <li class="nav-item">
                        <a href="{{ route('supervisor.laporan') }}" class="nav-link mininav-toggle"><i class="demo-pli-file fs-5 me-2"></i>

                           <span class="nav-label mininav-content ms-1">
                              <span data-popper-arrow class="arrow"></span>
                              Laporan
                           </span>
                        </a>
                     </li>
                     <!-- END : Regular menu link -->


                  </ul>
               </div>
               <!-- END : Navigation Category -->


               <!-- Widget -->
               <div class="mainnav__widget">

                  <!-- Widget buttton form small navigation -->
                  <div class="mininav-toggle text-center py-2 d-mn-min">
                     <i class="demo-pli-monitor-2"></i>
                  </div>

                  <div class="d-mn-max mt-5"></div>
               </div>
               <!-- End - Profile widget -->


            </div>
            <!-- End - Navigation menu -->


            <!-- Bottom navigation menu -->
            <div class="mainnav__bottom-content border-top pb-2">
                <ul id="mainnav" class="mainnav__menu nav flex-column">
                    <li class="nav-item has-sub">
                        <form action="{{ route('logout') }}" method="POST" class="logout-float-form w-100">
                            @csrf
                            <button type="submit" class="btn logout-float shadow w-100 text-start">
                                <i class="demo-pli-unlock fs-5 me-2"></i>
                                <span class="nav-label ms-1">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- End - Bottom navigation menu -->


         </div>
      </nav>
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!-- END - MAIN NAVIGATION -->


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
                              <img src="./assets/img/color-schemes/expanded-header.png" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>


                     <!-- Fair Header -->
                     <div class="col-md-4">
                        <h6 class="m-0">Fair Header</h6>
                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--fair-hd">
                              <img src="./assets/img/color-schemes/fair-header.png" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>


                     <div class="col-md-4">
                        <h6 class="m-0">Full Header</h6>

                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--full-hd">
                              <img src="./assets/img/color-schemes/full-header.png" alt="color scheme illusttration" loading="lazy">
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
                              <img src="./assets/img/color-schemes/navigation.png" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>

                     <div class="col-md-4">
                        <h6 class="m-0">Brand</h6>

                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--primary-brand">
                              <img src="./assets/img/color-schemes/brand.png" alt="color scheme illusttration" loading="lazy">
                           </button>

                        </div>
                     </div>

                     <div class="col-md-4">
                        <h6 class="m-0">Tall Header</h6>
                        <div class="_dm-colorShcemesMode">

                           <!-- Scheme Button -->
                           <button type="button" class="_dm-colorModeBtn btn p-1 shadow-none" data-color-mode="tm--tall-hd">
                              <img src="./assets/img/color-schemes/tall-header.png" alt="color scheme illusttration" loading="lazy">
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
   <script src="./assets/vendors/popperjs/popper.min.js"></script>


   <!-- Bootstrap JS [ OPTIONAL ] -->
   <script src="./assets/vendors/bootstrap/bootstrap.min.js"></script>


   <!-- Nifty JS [ OPTIONAL ] -->
   <script src="./assets/js/nifty.js"></script>


   <!-- Nifty Settings [ DEMO ] -->
   <script src="./assets/js/demo-purpose-only.js"></script>


   <!-- Chart JS Scripts [ OPTIONAL ] -->
   <script src="./assets/vendors/chart.js/chart.umd.min.js"></script>

   <script>
      const lineData = [
         @foreach($phdpPerJabatan as $jabatan => $avgPhdp)
            { elapsed: "{{ $jabatan }}", value: {{ $avgPhdp }} },
         @endforeach
      ];
   </script>

   <script>
      window.jumlahPerJabatan = @json($jumlahPerJabatan);
      window.doughnutLabels = Object.keys(window.jumlahPerJabatan);
      window.doughnutData   = Object.values(window.jumlahPerJabatan);
   </script>

   <!-- Initialize [ SAMPLE ] -->
   <script src="{{ asset('assets/pages/dashboard-3.js') }}"></script>

    
</body>

</html>