<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="40" class="app-brand-logo demo">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ Auth::user()->role }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Data Karyawan -->
        <li class="menu-item {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
            <a href="{{ route('karyawan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Data Karyawan</div>
            </a>
        </li>

        <!-- Logout -->
        <li class="menu-item {{ request()->routeIs('logout') ? 'active' : '' }}">
            <a href="{{ route('logout') }}" class="menu-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div>Logout</div>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</aside>