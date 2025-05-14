<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h1 class="sidebar-title">
            <i class="fas fa-users me-2"></i> Admin Panel
        </h1>
        <button class="sidebar-toggle btn btn-sm btn-light ms-3 mt-2" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-users"></i>
                <span>Daftar Pengguna</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="#" class="log-activity-btn">
                <i class="fas fa-clipboard-list"></i>
                <span>Log Aktivitas</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('admin.create-operator') }}">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Operator</span>
            </a>
        </li>
        <!-- Menu Parameter -->
        <li class="sidebar-menu-item">
            <a href="#parameterSubmenu" data-bs-toggle="collapse" class="collapsed">
                <i class="fas fa-cogs"></i>
                <span>Parameter</span>
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <ul id="parameterSubmenu" class="collapse sidebar-submenu">
                <!-- Submenu NS -->
                <li class="sidebar-menu-subitem">
                    <span class="submenu-header">NS</span>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('admin.parameter.ns.index') }}"><i class="fas fa-database"></i> Tabel
                                NS</a>
                        </li>
                        <li><a href="#"><i class="fas fa-user-tie"></i> NS Pegawai</a>
                        </li>
                        <li><a href="#"><i class="fas fa-heart-broken"></i> NS
                                Janda/Duda</a></li>
                        <li><a href="#"><i class="fas fa-child"></i> NS Anak</a></li>
                    </ul>
                </li>

                <!-- Submenu lainnya -->
                <li>
                    <a href="#">
                        <i class="fas fa-table"></i> Tabel PTKP
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-university"></i> Data Bank
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item">
            <a href="#">
                <i class="fas fa-user-plus"></i>
                <span>Rumus</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('cabang.index') }}">
                <i class="fas fa-code-branch"></i>
                <span>Data Cabang</span>
            </a>
        </li>
    </ul>
    <!-- Tambahkan form logout di bawah sidebar -->
    <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
        @csrf
        <button type="submit" class="sidebar-logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </form>
</div>
