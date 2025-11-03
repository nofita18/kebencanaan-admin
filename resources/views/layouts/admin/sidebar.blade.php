<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        {{-- Dashboard --}}
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- Warga --}}
        {{-- <li class="nav-item {{ request()->is('warga*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('warga.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Warga</span>
            </a>
        </li> --}}

        {{-- Penanda Fitur Utama --}}
        <li class="nav-section-title">Fitur Utama</li>

        {{-- Kejadian Bencana --}}
        <li class="nav-item {{ request()->is('kejadian-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kejadian-bencana.index') }}">
                <i class="icon-cloud-upload menu-icon"></i>
                <span class="menu-title">Kejadian Bencana</span>
            </a>
        </li>

        {{-- Posko Bencana --}}
        <li class="nav-item {{ request()->is('posko-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('posko-bencana.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Posko Bencana</span>
            </a>
        </li>

        {{-- Penanda Master Data --}}
        <li class="nav-section-title">Master Data</li>

        {{-- Warga --}}
        <li class="nav-item {{ request()->is('warga*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('warga.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Warga</span>
            </a>
        </li>

        {{-- Users --}}
        <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>

        {{-- Donasi Bencana --}}
        {{-- <li class="nav-item {{ request()->is('donasi-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('donasi-bencana.index') }}">
                <i class="icon-wallet menu-icon"></i>
                <span class="menu-title">Donasi Bencana</span>
            </a>
        </li> --}}

        {{-- Logistik Bencana --}}
        {{-- <li class="nav-item {{ request()->is('logistik-bencana*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('logistik-bencana.index') }}">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Logistik Bencana</span>
            </a>
        </li> --}}

        {{-- Distribusi Logistik --}}
        {{-- <li class="nav-item {{ request()->is('distribusi-logistik*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('distribusi-logistik.index') }}">
                <i class="icon-share menu-icon"></i>
                <span class="menu-title">Distribusi Logistik</span>
            </a>
        </li> --}}

        {{-- Media --}}
        {{-- <li class="nav-item {{ request()->is('media*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('media.index') }}">
                <i class="icon-camera menu-icon"></i>
                <span class="menu-title">Media</span>
            </a>
        </li> --}}

    </ul>
</nav>
