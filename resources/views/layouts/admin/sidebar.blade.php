<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-section-title">Fitur Utama</li>
        <li class="nav-item {{ request()->is('kejadian-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kejadian-bencana.index') }}">
                <i class="icon-cloud-upload menu-icon"></i>
                <span class="menu-title">Kejadian Bencana</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('posko-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('posko-bencana.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Posko Bencana</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('donasi-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('donasi-bencana.index') }}">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Donasi Bencana</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('logistik-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('logistik-bencana.index') }}">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Logistik Bencana</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('distribusi-logistik*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('distribusi-logistik.index') }}">
                <i class="icon-share menu-icon"></i>
                <span class="menu-title">Distribusi Logistik</span>
            </a>
        </li>
        <li class="nav-section-title">Master Data</li>
        <li class="nav-item {{ request()->is('warga*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('warga.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Warga</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="#"
                onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="menu-title">Logout</span>
            </a>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
