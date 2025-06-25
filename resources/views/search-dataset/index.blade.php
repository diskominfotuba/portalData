@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero text-center text-white bg-success py-5">
  <div class="container">
    <h1 class="display-5 mt-5 fw-bold">Dataset Terbuka</h1>
    <p class="lead">Temukan kumpulan data mentah berupa tabel yang bisa diolah lebih lanjut di sini.</p>
   <div class="d-flex justify-content-center gap-5 my-4 text-white">
    <div class="text-center">
        <div class="fs-2 fw-bold">3.532</div>
        <div class="fs-6">Jumlah Dataset</div>
    </div>
    <div class="text-center">
        <div class="fs-2 fw-bold">91.991</div>
        <div class="fs-6">Dataset Kabupaten/Kota</div>
    </div>
    </div>

    <div class="buttons">
      <button class="btn btn-outline-light me-2">Lacak Permohonan Dataset</button>
      <button class="btn btn-light text-success fw-semibold" data-bs-toggle="modal" data-bs-target="#confirmModal">
        Permohonan Dataset
      </button>
    </div>
  </div>
</section>

<!-- Filter & Search Section -->
<section class="filters py-5 bg-light">
  <div class="container">
    <div class="bg-white p-4 rounded shadow-sm">
      <div class="row justify-content-center mb-4">
        <div class="col-12 text-center">
        <div class="dataset-header">
            <h4 class="fw-bold text-white mb-0">
            <i class="fas fa-database me-2"></i> Daftar Dataset
            </h4>
        </div>
        </div>
      </div>

      <div class="row g-4 justify-content-center">
        <div class="col-12 col-md-12">
          <label for="searchDataset" class="form-label fw-semibold">Cari Dataset</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" id="searchDataset" placeholder="Masukkan kata kunci..." />
          </div>
        </div>
      </div>

      <div class="row g-4 justify-content-center mt-3">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Wilayah</label>
          <select class="form-select"><option selected>Pilih Wilayah</option></select>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold">Organisasi</label>
          <select class="form-select"><option selected>Pilih Organisasi</option></select>
        </div>
        <div class="col-md-4">
          <label class="form-label fw-semibold">Topik</label>
          <select class="form-select"><option selected>Pilih Topik</option></select>
        </div>
      </div>
    </div>

    <!-- Dataset List -->
    <div class="mt-5" id="datasetList">
        @for ($i = 1; $i <= 10; $i++)
            <div class="dataset-item shadow-sm mb-3 p-3 d-flex align-items-start rounded border bg-white">
            {{-- Icon --}}
            <div class="me-3">
                <img src="https://img.icons8.com/office/40/document--v1.png" alt="icon" width="48" />
            </div>

            {{-- Konten Dataset --}}
            <div class="dataset-content flex-grow-1">
                <h6 class="fw-semibold mb-1 text-dark">
                Jumlah Hasil Survei dan Penetapan Lokasi Perumahan dan Permukiman Kumuh
                </h6>

                <div class="d-flex flex-wrap gap-3 align-items-center small text-muted">
                <div><i class="fas fa-map-marker-alt me-1"></i> Pemerintah Kab Tulang Bawang</div>
                <div><i class="fas fa-building me-1"></i> Dinas Perumahan dan Kawasan Permukiman</div>
                </div>

                <div class="d-flex flex-wrap gap-3 align-items-center mt-2 small">
                <div class="badge bg-success-subtle text-success border border-success px-2 py-1">
                    <i class="fas fa-check-circle me-1"></i> Tetap
                </div>
                <div class="text-muted">
                    <i class="fas fa-clock me-1"></i> {{ $i }} hari yang lalu
                </div>
                </div>
            </div>

            {{-- Jumlah View --}}
            <div class="ms-auto text-muted small d-flex align-items-center">
                <i class="fas fa-eye me-1"></i> {{ 1000 + $i * 10 }}
            </div>
            </div>
        @endfor
    </div>


    <!-- Pagination -->
    <nav class="mt-5 d-flex justify-content-center">
      <ul class="pagination custom-pagination">
        <li class="page-item disabled"><a class="page-link shadow-sm">← Sebelumnya</a></li>
        <li class="page-item active"><a class="page-link shadow-sm" href="#">1</a></li>
        <li class="page-item"><a class="page-link shadow-sm" href="#">2</a></li>
        <li class="page-item"><a class="page-link shadow-sm" href="#">3</a></li>
        <li class="page-item"><a class="page-link shadow-sm" href="#">Berikutnya →</a></li>
      </ul>
    </nav>
  </div>
</section>
@endsection

{{-- Modal Konfirmasi --}}
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        <p class="mt-3">
        Halo wargi Tulang Bawang, mohon maaf saat ini tim layanan data sedang menindaklanjuti 12 permohonan dataset.
        </p>
        <p>
        Hal ini dapat menyebabkan proses permohonan Anda sedikit lebih lama. Lanjutkan permohonan dataset?
        </p>
      <div class="d-flex justify-content-center gap-3 mt-4">
        <button class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#requestFormModal">Ajukan Permohonan</button>
        <button class="btn btn-outline-success" data-bs-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

{{-- Modal Form Permohonan Dataset --}}
<div class="modal fade" id="requestFormModal" tabindex="-1" aria-labelledby="requestFormModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h5 class="modal-title">Form Permohonan Dataset</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form>
        <div class="modal-body">
          <h6>Identitas</h6>
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="Masukkan nama Anda">
          </div>
          <div class="mb-3">
            <label>Nomor Telepon</label>
            <input type="text" class="form-control" placeholder="Masukkan nomor telepon">
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Masukkan email">
          </div>

          <h6 class="mt-4">Informasi Pekerjaan</h6>
          <div class="mb-3">
            <label>Pekerjaan</label>
            <select class="form-select">
              <option selected disabled>Pilih Pekerjaan</option>
              <option>PNS</option>
              <option>Mahasiswa</option>
              <option>Peneliti</option>
              <option>Lainnya</option>
            </select>
          </div>

          <h6 class="mt-4">Informasi Kebutuhan Dataset</h6>
          <div class="mb-3">
            <label>Judul dataset yang dimohon</label>
            <input type="text" class="form-control" placeholder="Masukkan judul">
          </div>

          <div class="mb-3">
            <label>Apakah Anda mengetahui OPD penghasil dataset?</label><br>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" name="opd" id="opdYa">
              <label class="form-check-label" for="opdYa">Ya</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" name="opd" id="opdTidak">
              <label class="form-check-label" for="opdTidak">Tidak</label>
            </div>
          </div>

          <div class="mb-3">
            <label>Deskripsi kebutuhan dataset</label>
            <textarea class="form-control" rows="3" placeholder="Deskripsikan kebutuhan dataset anda"></textarea>
          </div>

          <div class="mb-3">
            <label>Tujuan penggunaan dataset</label>
            <select class="form-select">
              <option selected disabled>Pilih Tujuan</option>
              <option>Penelitian</option>
              <option>Analisis Bisnis</option>
              <option>Pembangunan</option>
              <option>Lainnya</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Apakah Anda bersedia dihubungi oleh tim kami?</label><br>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" name="hubungi" id="hubungiYa">
              <label class="form-check-label" for="hubungiYa">Ya</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" name="hubungi" id="hubungiTidak">
              <label class="form-check-label" for="hubungiTidak">Tidak</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Kirim Permohonan</button>
        </div>
      </form>
    </div>
  </div>
</div>

