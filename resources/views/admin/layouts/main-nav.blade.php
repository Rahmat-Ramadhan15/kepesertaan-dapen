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
                    <img class="mainnav__avatar img-md rounded-circle hv-oc" src="./assets/img/profile-photos/1.png"
                        alt="Profile Picture" />
                </div>

                <div class="mininav-content collapse d-mn-max">
                    <span data-popper-arrow class="arrow"></span>
                    <div class="d-grid">
                        <!-- User name and position -->
                        <button class="mainnav-widget-toggle d-block btn border-0 p-2" data-bs-toggle="collapse"
                            data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
                            <span class="dropdown-toggle d-flex justify-content-center align-items-center">
                                <h5 class="mb-0 me-3">Aaron Chavez</h5>
                            </span>
                            <small class="text-body-secondary">Admin</small>
                        </button>

                        <!-- Collapsed user menu -->
                        <div id="usernav" class="nav flex-column collapse">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                                <span><i class="demo-pli-mail fs-5 me-2"></i><span class="ms-1">Messages</span></span>
                                <span class="badge bg-danger rounded-pill">14</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="demo-pli-male fs-5 me-2"></i>
                                <span class="ms-1">Profile</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="demo-pli-gear fs-5 me-2"></i>
                                <span class="ms-1">Settings</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="demo-pli-computer-secure fs-5 me-2"></i>
                                <span class="ms-1">Lock screen</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="demo-pli-unlock fs-5 me-2"></i>
                                <span class="ms-1">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End - Profile widget -->

            <!-- Navigation Category -->
            <div class="mainnav__categoriy py-3">
                <ul class="mainnav__menu nav flex-column">
                    <!-- Menu daftar pengguna -->
                    <li class="nav-item ">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link mininav-toggle active"><i
                                class="ti-user fs-5 me-2"></i>
                            <span data-popper-arrow class="arrow">Daftar Pengguna</span>
                        </a>
                    </li>
                    <!-- END : Menu daftar pengguna -->

                    <!-- Menu tambah operator -->
                    <li class="nav-item">
                        <a href="{{ route('admin.create-operator') }}" class="nav-link mininav-toggle"><i
                                class="demo-pli-gear fs-5 me-2"></i>

                            <span class="nav-label mininav-content ms-1">
                                <span data-popper-arrow class="arrow"></span>
                                Tambah Operator
                            </span>
                        </a>
                    </li>
                    <!-- END : Menu tambah operator -->

                    <!-- Menu nilai sekarang -->
                    <li class="nav-item has-sub">
                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-split-vertical-2 fs-5 me-2"></i>
                            <span class="nav-label ms-1">Nilai Sekarang</span>
                        </a>

                        <!-- Nilai sekarang submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="{{ route('admin.parameter.ns.index') }}" class="nav-link">Tabel NS</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.parameter.nspegawai.index') }}" class="nav-link">Tabel NS
                                    Pegawai</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.parameter.nsjanda.index') }}" class="nav-link">Tabel NS
                                    Janda/Duda</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.parameter.nsanak.index') }}" class="nav-link">Tabel NS Anak</a>
                            </li>
                        </ul>
                        <!-- END : Nilai sekarang submenu list -->
                    </li>
                    <!-- END : Menu nilai sekarang -->

                    <!-- Menu data cabang -->
                    <li class="nav-item">
                        <a href="{{ route('cabang.index') }}" class="nav-link mininav-toggle"><i
                                class="demo-pli-gear fs-5 me-2"></i>

                            <span class="nav-label mininav-content ms-1">
                                <span data-popper-arrow class="arrow"></span>
                                Data Cabang
                            </span>
                        </a>
                    </li>
                    <!-- END : Menu data cabang -->

                    <!-- Menu data cabang -->
                    <li class="nav-item">
                        <a href="{{ route('cabang.index') }}" class="nav-link mininav-toggle"><i
                                class="demo-pli-gear fs-5 me-2"></i>

                            <span class="nav-label mininav-content ms-1">
                                <span data-popper-arrow class="arrow"></span>
                                Data Bank
                            </span>
                        </a>
                    </li>
                    <!-- END : Menu data cabang -->

                    <!-- Menu data cabang -->
                    <li class="nav-item">
                        <a href="{{ route('admin.parameter.ptkp.index') }}" class="nav-link mininav-toggle"><i
                                class="demo-pli-gear fs-5 me-2"></i>

                            <span class="nav-label mininav-content ms-1">
                                <span data-popper-arrow class="arrow"></span>
                                PTKP
                            </span>
                        </a>
                    </li>
                    <!-- END : Menu data cabang -->

                    <!-- Menu rumus -->
                    <li class="nav-item">
                        <a href="#" class="nav-link mininav-toggle"><i class="demo-pli-gear fs-5 me-2"></i>

                            <span class="nav-label mininav-content ms-1">
                                <span data-popper-arrow class="arrow"></span>
                                Rumus
                            </span>
                        </a>
                    </li>
                    <!-- END : Menu rumus -->

                    <!-- Menu kenaikan -->
                    <li class="nav-item">
                        <a href="{{ route('admin.parameter.kenaikan.index') }}" class="nav-link mininav-toggle"><i
                                class="demo-pli-gear fs-5 me-2"></i>

                            <span class="nav-label mininav-content ms-1">
                                <span data-popper-arrow class="arrow"></span>
                                Kenaikan
                            </span>
                        </a>
                    </li>
                    <!-- END : Menu kenaikan -->

                    <!-- Menu audit trail -->
                    <li class="nav-item">
                        <a href="#" class="nav-link mininav-toggle"><i class="demo-pli-gear fs-5 me-2"></i>

                            <span class="nav-label mininav-content ms-1">
                                <span data-popper-arrow class="arrow"></span>
                                Log Aktivitas
                            </span>
                        </a>
                    </li>
                    <!-- END : Menu audit trail -->
                </ul>
            </div>
            <!-- END : Navigation Category -->

        </div>
        <!-- End - Navigation menu -->

        <!-- Bottom navigation menu -->
        <div class="mainnav__bottom-content border-top pb-2">
            <ul id="mainnav" class="mainnav__menu nav flex-column">
                <li class="nav-item has-sub">
                    <a href="#" class="nav-link mininav-toggle collapsed" aria-expanded="false">
                        <i class="demo-pli-unlock fs-5 me-2"></i>
                        <span class="nav-label ms-1">Logout</span>
                    </a>
                    <ul class="mininav-content nav flex-column collapse">
                        <li data-popper-arrow class="arrow"></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">This device only</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">All Devices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Lock
                                screen</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- End - Bottom navigation menu -->
    </div>
</nav>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END - MAIN NAVIGATION -->
