@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5 pb-4">
  <h2 class="fw-bold mb-2">Organisasi</h2>
  <p class="mb-4">
    Dapatkan daftar Perangkat Daerah (PD) yang berkontribusi dalam membangun ekosistem data yang terbuka dan terpercaya melalui publikasi data di Open Data Tulang Bawang.
  </p>

    <!-- Pencarian dan Filter -->
    <div class="row align-items-center mb-4">
    <div class="col-md-8 mb-2">
        <input type="text" class="form-control" placeholder="🔍 Cari organisasi" name="search" id="searchOrganisasi">
    </div>
    <div class="col-md-4 mb-2">
        <select class="form-select" name="sort" id="sortOrganisasi">
        <option value="dataset" selected>📁 Dataset Terbanyak</option>
        <option value="visualisasi">📊 Visualisasi Terbanyak</option>
        </select>
    </div>
    </div>

    <!-- Grid Organisasi -->
    <div class="row g-4">
    @for ($i = 1; $i <= 8; $i++)
    <div class="col-md-3 col-sm-6">
        <div class="card h-100 text-center border border-2 border-light-subtle shadow-sm p-3 rounded-4 organisasi-card transition-hover">
        <div class="d-flex justify-content-center align-items-center mb-3" style="height: 100px;">
            <img src="https://tulangbawangkab.go.id/img/logo/favicon.png"
                alt="Logo Organisasi {{ $i }}"
                class="img-fluid border rounded p-1 bg-white"
                style="max-height: 80px;">
        </div>
        <h6 class="fw-semibold">Dinas Contoh {{ $i }}</h6>
        <div class="d-flex justify-content-center gap-3 mt-2 text-muted small">
            <div><i class="fas fa-folder-open me-1"></i> {{ rand(100, 600) }}</div>
            <div><i class="fas fa-chart-bar me-1"></i> {{ rand(1, 10) }}</div>
        </div>
        </div>
    </div>
    @endfor
    </div>


  <!-- Pagination Dummy -->
  <div class="mt-4 d-flex justify-content-center">
    <nav>
      <ul class="pagination pagination-sm">
        <li class="page-item disabled"><span class="page-link">‹</span></li>
        <li class="page-item active"><span class="page-link">1</span></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">›</a></li>
      </ul>
    </nav>
  </div>
</div>
@endsection
