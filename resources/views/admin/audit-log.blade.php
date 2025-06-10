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
        <section id="content" class="content">
            <div class="container">
                <h3 class="mb-4">Audit Log</h3>

                {{-- FORM FILTER --}}
                <form method="GET" id="filter-form" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" name="tanggal" class="form-control"
                                value="{{ $tanggal ?? \Carbon\Carbon::today()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <button type="button" id="reset-btn" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>

                {{-- TABEL AUDIT LOG --}}
                <div id="audit-log-table">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Aksi</th>
                                <th>Deskripsi</th>
                                <th>Perubahan</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                                    <td class="text-uppercase">{{ $log->action }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        @if (!empty($log->old_values) || !empty($log->new_values))
                                            <ul class="mb-0 small">
                                                @php
                                                    $fields = array_unique(
                                                        array_merge(
                                                            array_keys($log->old_values ?? []),
                                                            array_keys($log->new_values ?? []),
                                                        ),
                                                    );
                                                @endphp

                                                @foreach ($fields as $field)
                                                    <li>
                                                        <strong>{{ $field }}:</strong>
                                                        {{ $log->old_values[$field] ?? '-' }} →
                                                        {{ $log->new_values[$field] ?? '-' }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <em class="text-muted">-</em>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada log ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>



            <!-- FOOTER -->

            @include('admin.layouts.footer')

            <!-- END - FOOTER -->


        </section>
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
    <{{-- SCRIPT AJAX --}} <script>
        $(document).ready(function() {
            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                let tanggal = $('input[name="tanggal"]').val();

                $.ajax({
                    url: "{{ route('admin.audit-log') }}",
                    type: "GET",
                    data: {
                        tanggal: tanggal
                    },
                    success: function(data) {
                        let newTable = $(data).find('#audit-log-table').html();
                        $('#audit-log-table').html(newTable);
                    }
                });
            });

            $('#reset-btn').on('click', function() {
                $('input[name="tanggal"]').val('');
                $('#filter-form').submit();
            });
        });
    </script>


</body>

</html>
