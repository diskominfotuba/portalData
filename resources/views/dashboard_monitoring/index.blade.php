<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitoring | Kabupaten Tulang Bawang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('assets_monitoring/css/style.css') }}">
    <script src="{{ asset('assets_monitoring/js/script.js') }}"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Dashboard Monitoring, Kabupaten Tulang Bawang</h2>
            <div class="row">
                <div class="col-auto d-flex align-items-center gap-3">
                    <!-- Ganti bagian ini -->
                    <div class="dropdown">
                        <button class="btn btn-outline-success dropdown-toggle text-white" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filter Kategori
                        </button>
                        <ul class="dropdown-menu p-3" style="min-width: 250px;">
                            <li><label><input type="checkbox" class="filter-checkbox me-2" value="penduduk" checked>
                                    Jumlah Penduduk</label></li>
                            <li><label><input type="checkbox" class="filter-checkbox me-2" value="wilayah" checked> Luas
                                    Wilayah</label></li>
                            <li><label><input type="checkbox" class="filter-checkbox me-2" value="kesehatan" checked>
                                    Fasilitas Kesehatan</label></li>
                            <li><label><input type="checkbox" class="filter-checkbox me-2" value="umkm" checked>
                                    UMKM</label></li>
                            <li><label><input type="checkbox" class="filter-checkbox me-2" value="sekolah" checked>
                                    Jumlah Sekolah</label></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div id="tanggalWaktu"></div>
                <img src="{{ asset('assets_monitoring/images/tb_1.png') }}" class="rounded-circle" width="30" />
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card card-custom p-3 overflow-hidden rounded-4"
                    style="background: rgba(255, 255, 255, 0.1)">
                    <div class="running-text">
                        <span>
                            Data realtime: 12 kasus DBD | Cuaca ekstrem di 3 kecamatan |
                            Harga beras naik 5% | Penduduk aktif: 400.890 jiwa | Status
                            siaga banjir wilayah timur
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <!-- Grafik -->
            <div class="col-md-6">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <div class="glass info-box flip-card-front flip-face p-2"
                            style="max-height: 280px; overflow-y: auto">
                            <div class="card text-white bg-opacity-75 border-0 p-2 rounded-3 shadow-sm"
                                style="backdrop-filter: blur(4px);  background: linear-gradient(to right, #bdc3c7, #16a085);">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0 fs-4">Hari Ini</h6>
                                    <small id="cuaca-tanggal" class="text-white small fs-5">Memuat...</small>
                                </div>

                                <div class="row align-items-center mb-2">
                                    <div class="col-6">
                                        <h3 class="fw-bold mb-0 fs-4">
                                            <span id="suhu" class="fs-4">26</span><span
                                                class="text-warning">°C</span>
                                        </h3>
                                        <p class="mb-0 small" id="cuaca-kondisi">Berawan</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <img src="https://openweathermap.org/img/wn/04d@2x.png" alt="ikon-cuaca"
                                            id="icon-cuaca" width="48" />
                                    </div>
                                </div>

                                <div class="mb-2 d-flex align-items-center text-white small">
                                    <i class="bi bi-geo-alt-fill me-1"></i>
                                    <span class="fs-6">Kabupaten Tulang Bawang</span>
                                </div>

                                <div
                                    class="row text-center text-white border-top border-white border-opacity-25 pt-2 small">
                                    <div class="col">
                                        <div class="fw-bold fs-6" id="kelembapan">63%</div>
                                        <div class="text-muted">Kelembapan</div>
                                    </div>
                                    <div class="col border-start border-end border-white border-opacity-25">
                                        <div class="fw-bold fs-6" id="angin">8.1 km/jam</div>
                                        <div class="text-muted">Angin</div>
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold fs-6" id="arah">Selatan</div>
                                        <div class="text-muted">Arah</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-graph-up-arrow icon"></i>

                            <div class="d-flex flex-row justify-content-around align-items-start w-100">
                                <div class="text-center">
                                    <div class="card-title">Jumlah Pegawai</div>
                                    <div class="card-value">3.100</div>
                                </div>
                                <div class="text-center">
                                    <div class="card-title">Sudah Absen</div>
                                    <div class="card-value">2.500</div>
                                </div>
                                <div class="text-center">
                                    <div class="card-title">Belum Absen</div>
                                    <div class="card-value">500</div>
                                </div>
                                <div class="text-center">
                                    <div class="card-title">Cuti</div>
                                    <div class="card-value">100</div>
                                </div>
                            </div>
                        </div>

                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-bar-chart-line-fill icon"></i>
                            <div class="card-title">Jumlah OPD</div>
                            <div class="card-value">29</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3" data-kategori="penduduk">
                <a href="{{ route('dashboard-monitoring.show') }}" style="text-decoration: none; color: inherit">
                    <div class="flip-card card rounded-4">
                        <div class="flip-card-inner">
                            <div class="glass info-box flip-card-front flip-face">
                                <i class="bi bi-people-fill icon"></i>
                                <div class="card-title">Jumlah Penduduk</div>
                                <div class="card-value">430.630</div>
                            </div>
                            <div class="card glass info-box flip-card-back flip-face">
                                <i class="bi bi-gender-ambiguous icon"></i>
                                <div class="card-title">Rasio Gender</div>
                                <div class="card-value">L: 49% • P: 51%</div>
                            </div>
                            <div class="card glass info-box flip-card-third flip-face">
                                <i class="bi bi-person-standing icon"></i>
                                <div class="card-title">Pertumbuhan</div>
                                <div class="card-value">+12.000 / tahun</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Luas Wilayah -->
            <div class="col-md-3" data-kategori="wilayah">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-globe2 icon"></i>
                            <div class="card-title">Luas Wilayah</div>
                            <div class="card-value">4.386 km²</div>
                        </div>
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-geo icon"></i>
                            <div class="card-title">Wilayah Adm.</div>
                            <div class="card-value">15 Kecamatan</div>
                        </div>
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-map-fill icon"></i>
                            <div class="card-title">Kepadatan</div>
                            <div class="card-value">98/km²</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Infografis -->
            <div class="col-md-4">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <!-- Front -->
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-tree-fill icon"></i>
                            <div class="card-title">Pertanian</div>
                            <div class="card-value">149.420h</div>
                        </div>

                        <!-- Back -->
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-person-workspace icon"></i>
                            <div class="card-title">Petani Aktif</div>
                            <div class="card-value">56.000 orang</div>
                        </div>

                        <!-- Third -->
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-basket-fill icon"></i>
                            <div class="card-title">Pertumbuhan Sektor</div>
                            <div class="card-value">+3.2% / tahun</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Potensi Daerah -->
            <div class="col-md-4">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-building-fill icon"></i>
                            <div class="card-title">Potensi Daerah</div>
                            <div class="card-value">...</div>
                        </div>
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-graph-up icon"></i>
                            <div class="card-title">Sektor Unggulan</div>
                            <div class="card-value">Pertanian & Perikanan</div>
                        </div>
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-bank icon"></i>
                            <div class="card-title">Potensi Ekonomi</div>
                            <div class="card-value">Rp 1,2 Triliun</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kesehatan -->
            <div class="col-md-4" data-kategori="kesehatan">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-heart-pulse-fill icon"></i>
                            <div class="card-title">Fasilitas Kesehatan</div>
                            <div class="card-value">...</div>
                        </div>
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-person-plus-fill icon"></i>
                            <div class="card-title">Tenaga Medis</div>
                            <div class="card-value">1.230 orang</div>
                        </div>
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-activity icon"></i>
                            <div class="card-title">Rasio Layanan</div>
                            <div class="card-value">1:350</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ketahanan Pangan -->
            <div class="col-md-4">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-basket-fill icon"></i>
                            <div class="card-title">Ketahanan Pangan</div>
                            <div class="card-value">85%</div>
                        </div>
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-tree-fill icon"></i>
                            <div class="card-title">Jumlah Pertanian</div>
                            <div class="card-value">12.340 unit</div>
                        </div>
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-droplet-half icon"></i>
                            <div class="card-title">Irigasi Aktif</div>
                            <div class="card-value">75%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Puskesmas -->
            <div class="col-md-4">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-hospital-fill icon"></i>
                            <div class="card-title">Jumlah Puskesmas</div>
                            <div class="card-value">3.000</div>
                        </div>
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-hospital icon"></i>
                            <div class="card-title">Faskes Terakreditasi</div>
                            <div class="card-value">2.100 unit</div>
                        </div>
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-patch-check-fill icon"></i>
                            <div class="card-title">Kepuasan Publik</div>
                            <div class="card-value">92%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sekolah -->
            <div class="col-md-4" data-kategori="sekolah">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <!-- Front -->
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-mortarboard-fill icon"></i>
                            <div class="card-title">Jumlah Sekolah</div>
                            <div class="card-value">8.440</div>
                        </div>

                        <!-- Back -->
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-journal icon"></i>
                            <div class="card-title">Guru Aktif</div>
                            <div class="card-value">5.100 orang</div>
                        </div>

                        <!-- Side 3 -->
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-people-fill icon"></i>
                            <div class="card-title">Siswa Aktif</div>
                            <div class="card-value">78.200 orang</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- UMKM -->
            <div class="col-md-4" data-kategori="umkm">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <!-- Front -->
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-shop-window icon"></i>
                            <div class="card-title">Jumlah UMKM</div>
                            <div class="card-value">15.200 unit</div>
                        </div>
                        <!-- Back -->
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-graph-up-arrow icon"></i>
                            <div class="card-title">Pertumbuhan UMKM</div>
                            <div class="card-value">+5.4% / tahun</div>
                        </div>
                        <!-- Third -->
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-bag-check icon"></i>
                            <div class="card-title">UMKM Aktif</div>
                            <div class="card-value">12.800 unit</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ketahanan Pangan -->
            <div class="col-md-4">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <!-- Front -->
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-basket-fill icon"></i>
                            <div class="card-title">Stok Pangan</div>
                            <div class="card-value">12.300 ton</div>
                        </div>
                        <!-- Back -->
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-tree-fill icon"></i>
                            <div class="card-title">Lahan Pertanian</div>
                            <div class="card-value">149.420 ha</div>
                        </div>
                        <!-- Third -->
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-patch-check icon"></i>
                            <div class="card-title">Indeks Ketahanan</div>
                            <div class="card-value">85%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aset Daerah -->
            <div class="col-md-4">
                <div class="flip-card card rounded-4">
                    <div class="flip-card-inner">
                        <!-- Front -->
                        <div class="glass info-box flip-card-front flip-face">
                            <i class="bi bi-building icon"></i>
                            <div class="card-title">Aset Tetap</div>
                            <div class="card-value">Rp 1,2 T</div>
                        </div>
                        <!-- Back -->
                        <div class="card glass info-box flip-card-back flip-face">
                            <i class="bi bi-layers icon"></i>
                            <div class="card-title">Jumlah Aset</div>
                            <div class="card-value">6.540 unit</div>
                        </div>
                        <!-- Third -->
                        <div class="card glass info-box flip-card-third flip-face">
                            <i class="bi bi-clipboard-data icon"></i>
                            <div class="card-title">Tercatat SIMDA</div>
                            <div class="card-value">98.5%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.filter-checkbox');
            const cards = document.querySelectorAll('[data-kategori]');

            function filterCards() {
                const selected = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                cards.forEach(card => {
                    const kategori = card.getAttribute('data-kategori');
                    if (selected.includes(kategori)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', filterCards);
            });

            filterCards();
        });
    </script>


    <button class="btn btn-success align-items-center gap-2 px-3 btn-sticky" onclick="toggleFullScreen()"
        style="white-space: nowrap;">
        <i class="bi bi-arrows-fullscreen"></i>
    </button>

    <script src="{{ asset('assets_monitoring/js/script.js') }}"></script>
    @stack('scripts')

</body>

</html>
