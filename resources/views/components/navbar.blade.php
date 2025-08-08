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
                <li><a href="{{ route('dataset.index') }}"
                        class="{{ request()->routeIs('dataset.index') ? 'active' : '' }}">Dataset</a></li>
                <li><a href="{{ route('webgis') }}" class="{{ request()->routeIs('webgis') ? 'active' : '' }}">Open
                        Maps</a></li>
                <li><a href="{{ route('statistik.index') }}">Statistik Sektoral</a></li>
                <li><a href="{{ route('organisasi.index') }}"
                        class="{{ request()->routeIs('organisasi.index') ? 'active' : '' }}">Organisasi</a></li>
                <li><a href="{{ route('bantuan.index') }}"
                        class="{{ request()->routeIs('bantuan.index') ? 'active' : '' }}">Bantuan</a></li>
                <li>
                    @auth
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                    @endauth
                </li>
            </ul>
        </nav>
    </div>
</header>
