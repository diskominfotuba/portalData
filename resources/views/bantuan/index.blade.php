@extends('layouts.app')

@section('content')
    <section class="bg-portal-primary text-white py-5">
        <div class="container">
            <h1 class="text-center mb-4 display-5 mt-5 fw-bold">Bantuan</h1>
            <p class="text-center lead">Temukan informasi dan panduan terkait penggunaan portal Open Data Tulang Bawang.</p>
        </div>
    </section>

    <div class="container mb-5">
        <div class="row mt-5">
            <!-- Konten Kiri -->
            <div class="col-md-8">
                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h2 class="fw-bold">Open Data Tulang Bawang</h2>

                        <h5 id="apa-itu-open-data" class="mt-4 fw-semibold">Apa itu Open Data Tulang Bawang</h5>
                        <p>
                            Open Data Tulang Bawang merupakan portal resmi data terbuka milik Pemerintah Kabupaten Tulang
                            Bawang yang berisi data dari berbagai Organisasi Perangkat Daerah (OPD) guna memenuhi kebutuhan
                            masyarakat akan akses data yang akurat, transparan, dan dapat digunakan secara bebas.
                        </p>
                        <a href="#" class="text-primary">Baca Selengkapnya tentang Open Data Tulang Bawang.</a>

                        <h5 id="mekanisme-pengumpulan" class="mt-4 fw-semibold">Mekanisme Pengumpulan Data</h5>
                        <p>
                            Dinas Komunikasi dan Informatika Tulang Bawang berperan sebagai walidata. Data yang tersedia
                            pada portal ini dikumpulkan dari berbagai OPD dan divalidasi untuk memastikan kualitas dan
                            keterbukaannya kepada publik.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Kanan -->
            <div class="col-md-4">
                @include('bantuan.partials.sidebar')
            </div>
        </div>
    </div>
@endsection
