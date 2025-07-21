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
    <section class="hero text-center text-white bg-success py-5">
        <div class="container">
            <p class="mt-5">Beranda / Explorasi Dashboard / <span class="fw-bold">Jumlah Pegawai, OPD dan
                    Lainnya</span></p>
            <h1 class="display-5 fw-bold">Jumlah Pegawai, OPD dan Lainnya</h1>
            <div class="d-flex justify-content-center align-items-center my-4 text-white">
                <img src="https://ui-avatars.com/api/?name=Badan+Kepegawaian+Pendidikan+dan+Pelatihan&size=48"
                    alt="">
                <h4 class="ms-3 mb-0">Badan Kepegawaian Pendidikan dan Pelatihan</h4>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="iframe-container">
                <iframe src="{{ $iframeUrl }}" allowtransparency="true" title="Metabase Dashboard"></iframe>
            </div>
        </div>
    </section>
@endsection
