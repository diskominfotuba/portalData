@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-5">
    <!-- Konten Kiri -->
    <div class="col-md-8">
      <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
          <h2 class="fw-bold">Dataset</h2>

          <h5 class="mt-4 fw-semibold">Apa itu Dataset?</h5>
          <p>Dataset merupakan kumpulan data mentah berupa tabel yang dapat diolah lebih lanjut.</p>

          <h5 id="cara-mencari" class="mt-4 fw-semibold">Cara Mencari Dataset</h5>
          <p>Anda dapat mencari dataset dengan beberapa cara berikut:</p>

          <ol>
            <li>
              <strong>Melalui halaman Beranda</strong><br>
              Masukkan kata kunci pada kolom "Cari data", lalu tekan “Enter”. Anda akan diarahkan ke halaman hasil pencarian. Gunakan filter “Wilayah”, “Organisasi”, dan “Topik” untuk hasil lebih spesifik.
            </li>
            <li class="mt-3">
              <strong>Melalui halaman Dataset</strong><br>
              Klik menu “Dataset”, masukkan kata kunci, lalu tekan “Enter”. Hasil pencarian akan muncul dalam bentuk daftar dataset.
            </li>
            <li class="mt-3">
              <strong>Melalui halaman Profil OPD</strong><br>
              Masuk ke menu “Organisasi”, lalu pilih salah satu Organisasi Perangkat Daerah (OPD) Kabupaten Tulang Bawang. Cari dataset sesuai kebutuhan pada tab Dataset.
            </li>
          </ol>

          <h5 id="cara-mengunduh"  class="mt-4 fw-semibold">Cara Mengunduh Dataset</h5>
          <p>
            Untuk mengunduh dataset:
            <ul>
              <li>Pilih dataset yang diinginkan.</li>
              <li>Masuk ke halaman detail dataset.</li>
              <li>Klik tombol “Unduh Dataset” dan pilih format (CSV, Excel, atau API).</li>
              <li>Dataset akan diunduh dalam bentuk file ZIP berisi data dan metadata.</li>
            </ul>
          </p>

          <h5 id="format-unduh"  class="mt-4 fw-semibold">Format Unduhan Dataset</h5>
          <ul>
            <li><strong>CSV:</strong> Format sederhana berbasis teks, dipisahkan koma atau titik koma.</li>
            <li><strong>Excel (.xlsx):</strong> Dapat dibuka dengan MS Excel, Google Sheets, atau Numbers.</li>
            <li><strong>API:</strong> Mendukung interoperabilitas antar aplikasi dan integrasi data digital.</li>
          </ul>

          <h5  id="format-grafik" class="mt-4 fw-semibold">Preview Dataset dalam Bentuk Grafik</h5>
          <ol>
            <li>Pilih dataset dan buka tab “Grafik”.</li>
            <li>Atur tampilan: Bar/Line Chart, sumbu X/Y, dan pengelompokan data.</li>
            <li>Klik “Pratinjau” untuk melihat grafik sesuai pengaturan.</li>
          </ol>

          <h5 id="format-peta" class="mt-4 fw-semibold">Preview Dataset dalam Bentuk Peta</h5>
          <ol>
            <li>Pilih dataset dan buka tab “Peta”.</li>
            <li>Pilih kolom untuk spasial (wilayah) dan nilai (value).</li>
            <li>Gunakan grup nilai untuk klasifikasi tambahan, lalu klik “Pratinjau”.</li>
          </ol>

          <h5 id="format-permohonan" class="mt-4 fw-semibold">Permohonan Dataset</h5>
          <p>Jika dataset tidak tersedia:</p>
          <ul>
            <li>Klik tombol “Permohonan Dataset” di halaman Dataset.</li>
            <li>Isi formulir secara lengkap dan kirim.</li>
            <li>Anda akan mendapat balasan maksimal dalam 1x24 jam ke email yang didaftarkan.</li>
          </ul>
          <p>Catatan: Walidata Kabupaten Tulang Bawang akan mengoordinasikan permohonan ke OPD terkait jika data tersedia namun belum dipublikasikan.</p>
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
