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
                    <img class="mainnav__avatar img-md rounded-circle hv-oc"
                        src="{{ asset('assets/img/profile-photos/1.png') }}" alt="Profile Picture" />
                </div>

                <div class="mininav-content collapse d-mn-max">
                    <span data-popper-arrow class="arrow"></span>
                    <div class="d-grid">
                        <!-- User name and position -->
                        <button class="mainnav-widget-toggle d-block btn border-0 p-2" data-bs-toggle="collapse"
                            data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
                            <span class="d-flex justify-content-center align-items-center">
                                <h5 class="mb-0" style="margin-left: 0px;">Admin</h5>
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
                    <!-- Menu daftar pengguna -->
                    <li class="nav-item ">
                        <a href="{{ route('admin.dashboard') }}"
                            class="mininav-toggle nav-link {{ request()->routeIs('admin.dashboard', 'admin.edit-user') ? 'active' : '' }}"><i
                                class="demo-pli-gear fs-5 me-2"></i>
                            <span data-popper-arrow class="arrow">Daftar Pengguna</span>
                        </a>
                    </li>
                    <!-- END : Menu daftar pengguna -->

                    <!-- Menu tambah operator -->
                    <li class="nav-item">
                        <a href="{{ route('admin.create-operator') }}"
                            class="mininav-toggle nav-link {{ request()->routeIs('admin.create-operator') ? 'active' : '' }}"><i
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
                        <a href="#"
                            class="mininav-toggle nav-link {{ request()->routeIs('admin.parameter.ns*') ? 'active' : '' }}"><i
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
                                <a href="{{ route('admin.parameter.nsanak.index') }}" class="nav-link">Tabel NS
                                    Anak</a>
                            </li>
                        </ul>
                        <!-- END : Nilai sekarang submenu list -->
                    </li>
                    <!-- END : Menu nilai sekarang -->

                    <!-- Menu data cabang -->
                    <li class="nav-item">
                        <a href="{{ route('cabang.index') }}"
                            class="mininav-toggle nav-link {{ request()->routeIs('cabang.index', 'cabang.edit', 'cabang.create') ? 'active' : '' }}"><i
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
                        <a href="{{ route('admin.parameter.databank.index') }}"
                            class="mininav-toggle nav-link {{ request()->routeIs('admin.parameter.databank.index', 'admin.parameter.databank.create', 'admin.parameter.databank.edit') ? 'active' : '' }}"><i
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
                        <a href="{{ route('admin.parameter.ptkp.index') }}"
                            class="mininav-toggle nav-link {{ request()->routeIs('admin.parameter.ptkp.index', 'admin.parameter.ptkp.create', 'admin.parameter.ptkp.edit') ? 'active' : '' }}"><i
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
                        <a href="{{ route('admin.parameter.kenaikan.index') }}"
                            class="mininav-toggle nav-link {{ request()->routeIs('admin.parameter.kenaikan.index', 'admin.parameter.kenaikan.create', 'admin.parameter.kenaikan.edit') ? 'active' : '' }}"><i
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
                        <a href="{{ route('admin.audit-log') }}"
                            class="mininav-toggle nav-link {{ request()->routeIs('admin.audit-log') ? 'active' : '' }}"><i
                                class="demo-pli-gear fs-5 me-2"></i>

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
