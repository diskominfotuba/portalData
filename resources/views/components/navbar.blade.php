<header class="header">
    <div class="nav-container">
        <div class="logo">
            <div class="logo-icon">
                <img src="{{ asset('assets/img/logo-tulang-bawang.png') }}" alt="logo tulang bawang" width="30">
            </div>
            <div>
                <div>Portal Data</div>
                <div style="font-size: 0.8rem; font-weight: normal;">KABUPATEN TULANG BAWANG</div>
            </div>
        </div>
        <nav>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('search-dataset.index') }}" class="{{ request()->routeIs('search-dataset.index') ? 'active' : '' }}">Open Data</a></li>
                <li><a href="{{ route('statistik.index') }}">Statistik Sektoral</a></li>
                <li><a href="#">SPLD</a></li>
                <li><a href="{{ route('organisasi.index') }}" class="{{ request()->routeIs('organisasi.index') ? 'active' : '' }}">Organisasi</a></li>
                <li><a href="{{ route('bantuan.index') }}" class="{{ request()->routeIs('bantuan.index') ? 'active' : '' }}">Bantuan</a></li>
            </ul>
        </nav>
    </div>
</header>
