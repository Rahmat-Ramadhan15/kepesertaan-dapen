<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-scheme="navy">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description"
        content="Nifty is a responsive admin dashboard template based on Bootstrap 5 framework. There are a lot of useful components.">
    <title>Dashboard | Bank - Sulselbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Fonts [ OPTIONAL ] -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap"
        rel="stylesheet">


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

<body class="out-quart">



    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max tm--expanded-hd">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- Modal Log Aktivitas -->
        <div class="modal fade" id="auditLogModal" tabindex="-1" aria-labelledby="auditLogModalLabel"
            aria-hidden="true">
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

        <!-- Mobile Toggle Button (only visible on small screens) -->
        <button class="mobile-toggle d-lg-none" id="mobileToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Main Content -->
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card p-4">
                        <h3 class="card-title text-center">Edit NS Janda/Duda</h3>
                        <div class="card-body">
                            <form action="{{ route('admin.parameter.nspegawai.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="usia" class="form-label">Usia</label>
                                    <input type="text" class="form-control" id="usia" name="usia"
                                        value="{{ $data->usia }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai_sekarang" class="form-label">Nilai Sekarang</label>
                                    <input type="number" class="form-control" id="nilai_sekarang" name="nilai_sekarang"
                                        step="0.000001"
                                        oninput="this.value = this.value.match(/^\d*\.?\d{0,6}/)?.[0] || ''"
                                        value="{{ $data->nilai_sekarang }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ns_janda" class="form-label">NS Janda/Duda</label>
                                    <input type="number" class="form-control" id="ns_janda" name="ns_janda"
                                        step="0.000001"
                                        oninput="this.value = this.value.match(/^\d*\.?\d{0,6}/)?.[0] || ''"
                                        value="{{ $data->ns_janda }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ns_anak" class="form-label">NS Anak</label>
                                    <input type="number" class="form-control" id="ns_anak" name="ns_anak"
                                        step="0.000001"
                                        oninput="this.value = this.value.match(/^\d*\.?\d{0,6}/)?.[0] || ''"
                                        value="{{ $data->ns_anak }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>
                                <a href="{{ route('admin.parameter.nspegawai.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->


        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        @include('admin.layouts.header')
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->


        <!-- MAIN NAVIGATION -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        @include('admin.layouts.main-nav')

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - MAIN NAVIGATION -->


        <!-- SIDEBAR -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        @include('admin.layouts.sidebar')
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
    @include('admin.layouts.boxed-layout')
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - BOXED LAYOUT : BACKGROUND IMAGES CONTENT [ DEMO ] -->


    <!-- SETTINGS CONTAINER [ DEMO ] -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    @include('admin.layouts.setting-container')
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SETTINGS CONTAINER [ DEMO ] -->


    <!-- OFFCANVAS [ DEMO ] -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="_dm-offcanvas" class="offcanvas" tabindex="-1">

        <!-- Offcanvas header -->
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Offcanvas Header</h5>
            <button type="button" class="btn-close btn-lg text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <!-- Offcanvas content -->
        <div class="offcanvas-body">
            <h5>Content Here</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente eos nihil earum aliquam quod in dolor,
                aspernatur obcaecati et at. Dicta, ipsum aut, fugit nam dolore porro non est totam sapiente animi
                recusandae obcaecati dolorum, rem ullam cumque. Illum quidem reiciendis autem neque excepturi odit est
                accusantium, facilis provident molestias, dicta obcaecati itaque ducimus fuga iure in distinctio
                voluptate nesciunt dignissimos rem error a. Expedita officiis nam dolore dolores ea. Soluta repellendus
                delectus culpa quo. Ea tenetur impedit error quod exercitationem ut ad provident quisquam omnis! Nostrum
                quasi ex delectus vero, facilis aut recusandae deleniti beatae. Qui velit commodi inventore.</p>
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

            // Log aktivitas button
            $('.log-activity-btn').on('click', function(e) {
                e.preventDefault();
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
                    success: function(data) {
                        $('#auditLogContent').html(data);
                    },
                    error: function() {
                        $('#auditLogContent').html(
                            '<div class="alert alert-danger">Gagal memuat log aktivitas.</div>'
                        );
                    }
                });

                // Close sidebar on mobile when button is clicked
                if ($(window).width() < 992) {
                    $('#sidebar').removeClass('collapsed');
                    $('#sidebar').css('transform', 'translateX(-100%)');
                }
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
