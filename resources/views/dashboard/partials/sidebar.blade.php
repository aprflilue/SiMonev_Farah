<aside id="sidebar-wrapper">
    {{-- Head Logo --}}
    <div class="sidebar-brand mt-2 mb-2">
        <a href="/"><img src="/img/kementan/logo.png" alt=""> Si Monev</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/"><img src="/img/kementan/logo.png" alt=""></a>
    </div>

    
    <ul class="sidebar-menu mt-3">

        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i> 
                <span>Dashboard</span>
            </a>
        </li>

        {{-- ---------- --}}
        <li class="menu-header">Pengguna</li>

        <li class="dropdown {{ Request::is('dashboard/users*') ? 'active' : '' }} && {{ Request::is('dashboard/admin*')  ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-users"></i><span>Admin</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('dashboard/users*') ? 'active' : '' }}"><a class="nav-link" href="/dashboard/users">Pusat</a></li>
                <li class="{{ Request::is('dashboard/admin*')  ? 'active' : '' }}"><a class="nav-link" href="/dashboard/admin">Provinsi</a></li>
            </ul>
        </li>

        {{-- -------------- --}}
        <li class="menu-header">Unit</li>
        
        <li class="{{ Request::is('dashboard/uph*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/uph">
                <i class="fas fa-fw fa-cog"></i>
                <span>UPH</span>
            </a>
        </li>

        {{-- --------------- --}}
        <li class="menu-header">Monev</li>

        <li class="dropdown {{ Request::is('dashboard/tp*') ? 'active' : '' }} && {{ Request::is('dashboard/dekon*')  ? 'active' : '' }} && {{ Request::is('dashboard/anggaran*')  ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fw fa-file"></i></i><span>Monitoring</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('dashboard/tp*') ? 'active' : '' }}"><a class="nav-link" href="/dashboard/tp">TP</a></li>
                <li class="{{ Request::is('dashboard/dekon*')  ? 'active' : '' }}"><a class="nav-link" href="/dashboard/dekon">Dekon</a></li>
                <li class="{{ Request::is('dashboard/anggaran*')  ? 'active' : '' }}"><a class="nav-link" href="/dashboard/anggaran">Anggaran</a></li>
            </ul>
        </li>
        
        {{-- -------------- --}}
        <li class="{{ Request::is('dashboard/evaluasi*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/evaluasi">
                <i class="fas fa-fw fa-list-ul"></i>
                <span>Evaluasi</span>
            </a>
        </li>
        
        {{-- -------------- --}}
        <li class="{{ Request::is('dashboard/laporan*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/laporan">
                <i class="fas fa-fw fa-chart-bar"></i>
                {{-- <i class="fa fa-list-ul"></i> --}}
                <span>Laporan</span>
            </a>
        </li>

    </ul>

    
    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex mt-4 mb-4 hide-sidebar-mini">
        <img class="sidebar-card-illustration mb-2" src="/img/kementan/logo.png" alt="...">
        <h6 class="mt-3 ">SiMonev Kementan</h6>
        <p>Pengolahan Hasil Peternakan</p>
        {{-- <p class="">©2024 All Right Reserved</p> --}}
        <p class="mb-3 ">©2024 FarahFazira</p>
    </div>
</aside>