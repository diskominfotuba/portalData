@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .iframe-container {
            flex: 1;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 850px;
            border: none;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero text-center text-white bg-portal-primary py-5">
        <div class="container">
            <p class="mt-5">Beranda / <span class="fw-bold">Statistik Sektoral</span></p>
            <h1 class="display-5 fw-bold">Statistik Sektoral</h1>
            <p class="text-center lead">Temukan visualisasi data dalam bentuk dashboard interaktif dari berbagai topik yang
                relevan dan dapat dianalisis lebih lanjut, khususnya yang berkaitan dengan Kabupaten Tulang Bawang, di sini.
            </p>
        </div>
    </section>

    <section>
        <div class="container pt-3">
            <div class="py-3">
                <div class="row d-flex align-items-center mt-5 mb-3">
                    <div class="col-auto">
                        <h3 class="mb-0">Pemerintah</h3>
                    </div>
                    <div class="col">
                        <hr class="my-0">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="border p-3 d-flex flex-column align-items-center rounded">
                            <img src="https://data.jabarprov.go.id/api-dashboard-jabar/static/upload/e2e815fc79401879ce623446bf3bc287bc899b581a7cc53859717ca195fe7dd6.svg"
                                alt="">
                            <a class="fw-bold mt-3 text-center text-decoration-none"
                                href="{{ route('statistik.show', ['dashboard' => 'kinerja-pegawai']) }}">Jumlah
                                Pegawai, OPD dan
                                Lainnya</a>
                        </div>
                    </div>
                </div>

                <div class="row d-flex align-items-center mt-5 mb-3">
                    <div class="col-auto">
                        <h3 class="mb-0">Pendidikan</h3>
                    </div>
                    <div class="col">
                        <hr class="my-0">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="border p-3 d-flex flex-column align-items-center rounded">
                            <img src="https://data.jabarprov.go.id/api-dashboard-jabar//static/upload/icon%20jumlah%20sekolah%20SMK.svg"
                                alt="">
                            <a class="fw-bold mt-3 text-center text-decoration-none"
                                href="{{ route('statistik.show', ['dashboard' => 'kinerja-pegawai']) }}">Jumlah
                                Sekolah, Guru, dan Siswa (SD)</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="border p-3 d-flex flex-column align-items-center rounded">
                            <img src="https://data.jabarprov.go.id/api-dashboard-jabar//static/upload/icon%20jumlah%20sekolah%20SMK.svg"
                                alt="">
                            <a class="fw-bold mt-3 text-center text-decoration-none"
                                href="{{ route('statistik.show', ['dashboard' => 'kinerja-pegawai']) }}">Jumlah
                                Sekolah, Guru, dan Siswa (SMP)</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="border p-3 d-flex flex-column align-items-center rounded">
                            <img src="https://data.jabarprov.go.id/api-dashboard-jabar//static/upload/icon%20jumlah%20sekolah%20SMK.svg"
                                alt="">
                            <a class="fw-bold mt-3 text-center text-decoration-none"
                                href="{{ route('statistik.show', ['dashboard' => 'kinerja-pegawai']) }}">Jumlah
                                Sekolah, Guru, dan Siswa (SMA)</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="border p-3 d-flex flex-column align-items-center rounded">
                            <img src="https://data.jabarprov.go.id/api-dashboard-jabar//static/upload/icon%20jumlah%20sekolah%20SMK.svg"
                                alt="">
                            <a class="fw-bold mt-3 text-center text-decoration-none"
                                href="{{ route('statistik.show', ['dashboard' => 'kinerja-pegawai']) }}">Jumlah
                                Sekolah, Guru, dan Siswa (SMK)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
