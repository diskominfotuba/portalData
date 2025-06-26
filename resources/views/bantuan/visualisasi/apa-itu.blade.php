@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-5">
    <!-- Konten Kiri -->
    <div class="col-md-8">
      <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
          <h2 class="fw-bold">Open Data Tulang Bawang</h2>

          <h5 id="apa-itu-visualisasi" class="mt-4 fw-semibold">Apa itu Visualisasi?</h5>
          <p>
            Visualisasi merupakan gambaran informasi data tertentu dalam bentuk grafik. Tujuan utama dari visualisasi data adalah untuk mengkomunikasikan informasi secara jelas dan efisien kepada penggunanya melalui grafik informasi yang dipilih, seperti tabel-tabel atau grafik.
          </p>

          <h5 id="cara-mencari-visualisasi" class="mt-4 fw-semibold">Cara Mencari Visualisasi</h5>
          <p>Untuk melakukan pencarian visualisasi, Anda dapat memilih satu di antara tiga cara berikut:</p>

          <p><strong>Cara Pertama: Melalui halaman Beranda</strong></p>
          <ul>
            <li>Masukkan kata kunci pencarian pada kolom “Cari Data”, lalu tekan tombol “Enter”;</li>
            <li>Anda akan diarahkan pada halaman “Pencarian”;</li>
            <li>Klik tombol “Visualisasi” untuk mengubah hasil pencarian berdasarkan jenis data visualisasi;</li>
            <li>Gunakan filter “Pilih Organisasi” dan “Pilih Topik” untuk pencarian lebih spesifik.</li>
          </ul>

          <p><strong>Cara Kedua: Melalui halaman Visualisasi</strong></p>
          <ul>
            <li>Pilih menu “Visualisasi”;</li>
            <li>Masukkan kata kunci pencarian pada kolom “Cari Visualisasi”, lalu tekan tombol “Enter”;</li>
            <li>Hasil pencarian muncul dalam bentuk list visualisasi;</li>
            <li>Gunakan filter “Pilih Organisasi” dan “Pilih Topik” untuk pencarian lebih spesifik.</li>
          </ul>

          <p><strong>Cara Ketiga: Melalui halaman Profil Organisasi</strong></p>
          <ul>
            <li>Pilih menu “Organisasi” dan pilih Perangkat Daerah (PD) terkait;</li>
            <li>Pada halaman “Profil Organisasi”, masukkan kata kunci pada kolom “Cari Data” lalu tekan “Enter”;</li>
            <li>Pilih tab “Visualisasi” untuk hasil pencarian visualisasi;</li>
            <li>Gunakan filter “Pilih Topik” untuk mempersempit pencarian.</li>
          </ul>

          <h5 id="cara-mengunduh-visualisasi" class="mt-4 fw-semibold">Cara Mengunduh Visualisasi</h5>
          <ul>
            <li>Pilih visualisasi yang ingin diunduh;</li>
            <li>Akan diarahkan ke laman “Detail Visualisasi”;</li>
            <li>Klik tombol “Unduh”, lalu pilih format (Gambar/PDF);</li>
            <li>Klik tombol “Download” pada pop-up yang muncul;</li>
            <li>Tunggu hingga muncul pemberitahuan bahwa unduhan berhasil.</li>
          </ul>

          <h5 id="format-unduh-visualisasi" class="mt-4 fw-semibold">Format Unduh Visualisasi</h5>
          <p><strong>Gambar:</strong> Format .PNG (Portable Network Graphics).</p>
          <p><strong>PDF:</strong> Dokumen digital berisi teks, gambar, dan tautan yang hanya bisa dibuka dengan aplikasi khusus seperti Adobe Reader.</p>

          <h5 id="kontribusi-komunitas" class="mt-4 fw-semibold">Panduan Kontribusi Visualisasi oleh Komunitas</h5>
          <p>Portal Open Data Tulang Bawang mendukung partisipasi masyarakat untuk menampilkan hasil karya visualisasi berbasis dataset yang tersedia.</p>

          <p><strong>Visualisasi Interaktif</strong></p>
          <p>
            Visualisasi yang dibuat oleh masyarakat harus dalam bentuk Tableau Public, untuk menghasilkan karya yang menarik dan interaktif.
            Disarankan menggunakan infografik yang jelas dan analitis.
          </p>

          <p><strong>Langkah Pengajuan Visualisasi:</strong></p>
          <ol>
            <li>Baca panduan visualisasi interaktif (bisa disediakan tautan lokal oleh admin portal);</li>
            <li>Pilih dataset dari portal Open Data Tulang Bawang;</li>
            <li>Buat visualisasi pada Tableau Public, lengkapi dokumen pendukung
              (<a href="https://bit.ly/Storyboard_JDS" target="_blank">Download di sini</a>);
            </li>
            <li>Unggah hasil Anda ke: <a href="http://bit.ly/Upload-OpenData" target="_blank">bit.ly/Upload-OpenData</a>;</li>
            <li>Tunggu konfirmasi via email dalam 5 hari kerja dari tim Data Insight Open Data Tulang Bawang:
              <code>data-insight@tulangbawangkab.go.id</code>;
            </li>
            <li>Jika lolos, file Tableau Public Anda akan diterbitkan di portal Open Data Tulang Bawang.</li>
          </ol>
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
