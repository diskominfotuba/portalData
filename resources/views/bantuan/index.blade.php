@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="container my-5 py-5">
  <div class="row mt-5">
    <!-- Konten Kiri -->
    <div class="col-md-8">
      <h2 class="fw-bold">Open Data Tulang Bawang</h2>

      <h5 class="mt-4 fw-semibold">Apa itu Open Data Tulang Bawang</h5>
      <p>Open Data Tulang Bawang merupakan portal resmi data terbuka milik Pemerintah Kabupaten Tulang Bawang yang berisi data dari berbagai Organisasi Perangkat Daerah (OPD) guna memenuhi kebutuhan masyarakat akan akses data yang akurat, transparan, dan dapat digunakan secara bebas.</p>
      <a href="#" class="text-primary">Baca Selengkapnya tentang Open Data Tulang Bawang.</a>

      <h5 class="mt-4 fw-semibold">Mekanisme Pengumpulan Data</h5>
      <p>Dinas Komunikasi dan Informatika Tulang Bawang berperan sebagai walidata. Data yang tersedia pada portal ini dikumpulkan dari berbagai OPD dan divalidasi untuk memastikan kualitas dan keterbukaannya kepada publik.</p>
    </div>

    <!-- Sidebar Kanan -->
    <div class="col-md-4">
<div class="accordion" id="accordionMenu">
  <!-- Open Data -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed text-success fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
        Open Data Tulang Bawang
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionMenu">
      <div class="accordion-body">
        <ul class="list-unstyled">
            <li>
            <a href="{{ url('/open-data/apa-itu') }}" class="text-decoration-none text-dark">📖 Apa itu Open Data Tulang Bawang</a>
            </li>
            <li>
            <a href="{{ url('/open-data/mekanisme') }}" class="text-decoration-none text-dark">⚙️ Mekanisme Pengumpulan Data</a>
            </li>
      </ul>
      </div>
    </div>
  </div>

  <!-- Dataset -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed text-success fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
        Dataset
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionMenu">
      <div class="accordion-body">
        <ul class="list-unstyled">
          <li><a href="{{ url('/dataset/apa-itu') }}" class="text-decoration-none text-dark">📘 Apa itu Dataset?</a></li>
          <li><a href="{{ url('/dataset/cara-mencari') }}" class="text-decoration-none text-dark">🔍 Cara mencari Dataset</a></li>
          <li><a href="{{ url('/dataset/unduh') }}" class="text-decoration-none text-dark">⬇️ Cara mengunduh Dataset</a></li>
          <li><a href="{{ url('/dataset/format-unduh') }}" class="text-decoration-none text-dark">📂 Format Unduh Dataset</a></li>
          <li><a href="{{ url('/dataset/grafik') }}" class="text-decoration-none text-dark">📊 Preview dalam bentuk Grafik</a></li>
          <li><a href="{{ url('/dataset/peta') }}" class="text-decoration-none text-dark">🗺️ Preview dalam bentuk Peta</a></li>
          <li><a href="{{ url('/dataset/permohonan') }}" class="text-decoration-none text-dark">📝 Permohonan Dataset</a></li>
        </ul>
      </div>
    </div>
  </div>

    <!-- Visualisasi -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed text-success fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
            Visualisasi
        </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionMenu">
        <div class="accordion-body">
            <ul class="list-unstyled">
                <li>
                <a href="{{ url('/visualisasi/apa-itu') }}" class="text-decoration-none text-dark">📖 Apa itu Visualisasi?</a>
                </li>
                <li>
                <a href="{{ url('/visualisasi/cara-mencari') }}" class="text-decoration-none text-dark">🔍 Cara mencari Visualisasi</a>
                </li>
                <li>
                <a href="{{ url('/visualisasi/unduh') }}" class="text-decoration-none text-dark">⬇️ Cara mengunduh Visualisasi</a>
                </li>
                <li>
                <a href="{{ url('/visualisasi/format-unduh') }}" class="text-decoration-none text-dark">📂 Format Unduh Visualisasi</a>
                </li>
                <li>
                <a href="{{ url('/visualisasi/panduan-kontribusi') }}" class="text-decoration-none text-dark">🤝 Panduan Kontribusi oleh Komunitas</a>
                </li>
            </ul>
        </div>
        </div>
    </div>

    <!-- Infografik -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed text-success fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
            Infografik
        </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionMenu">
        <div class="accordion-body">
            <ul class="list-unstyled">
                <li>
                <a href="{{ url('/infografik/apa-itu') }}" class="text-decoration-none text-dark">🖼️ Apa itu Infografik?</a>
                </li>
                <li>
                <a href="{{ url('/infografik/cara-mencari') }}" class="text-decoration-none text-dark">🔍 Cara mencari Infografik</a>
                </li>
                <li>
                <a href="{{ url('/infografik/unduh') }}" class="text-decoration-none text-dark">⬇️ Cara mengunduh Infografik</a>
                </li>
                <li>
                <a href="{{ url('/infografik/format-unduh') }}" class="text-decoration-none text-dark">📂 Format Unduh Infografik</a>
                </li>
            </ul>
        </div>
        </div>
    </div>

    <div class="card p-3 mt-5">
        <h6 class="fw-bold">Kontak Kami</h6>
        <p><i class="fas fa-envelope me-2"></i>data@tulangbawangkab.go.id</p>
        <p><i class="fab fa-whatsapp me-2"></i>+62 812-XXXX-XXXX (Whatsapp)</p>
      </div>
    </div>
  </div>
</div>
@endsection
