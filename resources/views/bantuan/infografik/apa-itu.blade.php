@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-5">
    <!-- Konten Kiri -->
    <div class="col-md-8">
      <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
          <h2 class="fw-bold">Open Data Tulang Bawang</h2>

          <h5 id="apa-itu-infografik" class="mt-4 fw-semibold">Apa itu Infografik?</h5>
          <p>
            Infografik merupakan informasi yang disajikan dalam bentuk grafik agar lebih mudah dipahami. Infografik digunakan untuk menggambarkan secara jelas hubungan kompleks dan kumpulan data komprehensif dengan cara yang tepat dan mudah dipahami serta diinterpretasikan.
          </p>

          <h5 id="cara-mencari-infografik" class="mt-4 fw-semibold">Cara Mencari Infografik</h5>
          <p>Untuk melakukan pencarian infografik, Anda dapat memilih satu di antara tiga cara berikut:</p>

          <p><strong>Cara Pertama: Melalui halaman Beranda</strong></p>
          <ul>
            <li>Masukkan kata kunci pencarian pada kolom "Cari Data", lalu tekan tombol “Enter”;</li>
            <li>Anda akan diarahkan pada halaman “Pencarian”;</li>
            <li>Klik tombol “Infografik” untuk menampilkan hasil berdasarkan jenis data infografik;</li>
            <li>Gunakan filter "Pilih Penyusun" dan “Pilih Topik” untuk pencarian lebih spesifik.</li>
          </ul>

          <p><strong>Cara Kedua: Melalui halaman Infografik</strong></p>
          <ul>
            <li>Pilih menu “Infografik”;</li>
            <li>Masukkan kata kunci pencarian pada kolom “Cari Infografik”, lalu tekan tombol “Enter”;</li>
            <li>Hasil pencarian akan ditampilkan dalam bentuk daftar infografik;</li>
            <li>Gunakan filter "Pilih Organisasi" dan “Filter Topik” untuk pencarian lebih spesifik.</li>
          </ul>

          <h5 id="cara-mengunduh-infografik" class="mt-4 fw-semibold">Cara Mengunduh Infografik</h5>
          <ul>
            <li>Pilih infografik yang ingin diunduh;</li>
            <li>Anda akan diarahkan ke laman “Detail Infografik”;</li>
            <li>Klik tombol “Unduh”, lalu pilih format dataset yang diinginkan (Gambar / PDF);</li>
            <li>Tunggu hingga proses selesai dan muncul notifikasi bahwa infografik berhasil diunduh.</li>
          </ul>

          <h5 id="format-unduh-infografik" class="mt-4 fw-semibold">Format Unduh Infografik</h5>
          <p><strong>Gambar:</strong> Infografik yang diunduh dalam bentuk gambar memiliki format .PNG (Portable Network Graphics).</p>
          <p><strong>PDF:</strong> PDF (Portable Document Format) adalah format dokumen digital yang dapat memuat teks, gambar, dan tautan. Format ini hanya bisa dibuka di perangkat yang memiliki perangkat lunak pembaca PDF.</p>
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
