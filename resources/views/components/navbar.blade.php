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
                <li><a href="{{ route('home') }}" class="active">Home</a></li>
                <li><a href="{{ route('search-dataset.index') }}">Open Data</a></li>
                <li><a href="#">Statistik Sektoral</a></li>
                <li><a href="#">SPLD</a></li>
                <li><a href="{{ route('organisasi.index') }}">Organisasi</a></li>
                <li><a href="{{ route('bantuan.index') }}">Bantuan</a></li>
            </ul>
        </nav>
    </div>
</header>
