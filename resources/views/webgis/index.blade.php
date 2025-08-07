<!DOCTYPE html>
<html>
    <head>
        <title>Peta Interaktif Pendidikan Kota</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
        />
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                overflow: hidden;
            }

            .webgis-container {
                position: relative;
                height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .header {
                width: 100%;
                position: absolute;
                top: 20px;
                left: 51%;
                transform: translateX(-50%);
                z-index: 1000;
            }

            .header-content {
                display: flex;
                align-items: center;
                gap: 20px;
            }

            .search-container {
                display: flex;
                align-items: center;
            }

            .category-buttons {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
            }

            .category-btn {
                padding: 12px 24px;
                border: none;
                border-radius: 25px;
                cursor: pointer;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                gap: 8px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .category-btn:before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, 0.3),
                    transparent
                );
                transition: left 0.5s;
            }

            .category-btn:hover:before {
                left: 100%;
            }

            .category-btn.pendidikan {
                background: linear-gradient(135deg, #4facfe, #00f2fe);
                color: white;
                box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
            }

            .category-btn.peternakan {
                background: linear-gradient(135deg, #43e97b, #38f9d7);
                color: white;
                box-shadow: 0 4px 15px rgba(67, 233, 123, 0.4);
            }

            .category-btn.pertanian {
                background: linear-gradient(135deg, #fa709a, #fee140);
                color: white;
                box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
            }

            .category-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            }

            .category-btn.active {
                transform: scale(1.05);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            }

            .map-container {
                flex: 1;
                position: relative;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }

            #map {
                height: 100%;
                width: 100%;
                border-radius: 20px;
            }

            .info-panel {
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 15px;
                padding: 20px;
                min-width: 250px;
                max-width: 300px;
                z-index: 1000;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transform: translateX(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .info-panel.show {
                transform: translateX(0);
            }

            .info-panel h3 {
                color: #333;
                margin-bottom: 15px;
                font-size: 18px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .info-panel .stats {
                display: grid;
                gap: 10px;
            }

            .stat-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 12px;
                background: rgba(102, 126, 234, 0.1);
                border-radius: 8px;
                border-left: 4px solid #16a085;
            }

            .custom-popup {
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            }

            .popup-content {
                padding: 5px;
            }

            .popup-title {
                font-weight: 700;
                font-size: 16px;
                color: #333;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .popup-details {
                color: #666;
                font-size: 14px;
                line-height: 1.5;
            }

            .popup-badge {
                display: inline-block;
                padding: 4px 8px;
                border-radius: 12px;
                font-size: 12px;
                font-weight: 600;
                margin-top: 8px;
            }

            .badge-negeri {
                background: #e3f2fd;
                color: #1976d2;
            }

            .badge-swasta {
                background: #f3e5f5;
                color: #7b1fa2;
            }

            .loading {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 2000;
                background: rgba(255, 255, 255, 0.95);
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                display: none;
            }

            .spinner {
                width: 40px;
                height: 40px;
                border: 4px solid #f3f3f3;
                border-top: 4px solid #16a085;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                margin: 0 auto 10px;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }

            .search-box {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 25px;
                padding: 12px 20px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                display: flex;
                align-items: center;
                gap: 10px;
                min-width: 250px;
            }

            .search-box input {
                border: none;
                outline: none;
                background: transparent;
                flex: 1;
                font-size: 14px;
                color: #333;
            }

            .search-box input::placeholder {
                color: #999;
            }

            .search-box i {
                color: #667eea;
            }

            /* Fullscreen Toggle Button */
            .fullscreen-toggle {
                position: absolute;
                bottom: 20px;
                left: 20px;
                z-index: 1001;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                cursor: pointer;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                color: #16a085;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .fullscreen-toggle:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
                background: rgba(102, 126, 234, 0.1);
            }

            .fullscreen-toggle:active {
                transform: scale(0.95);
            }

            .fullscreen-toggle.active {
                background: linear-gradient(135deg, #16a085, #1abc9c);
                color: white;
                box-shadow: 0 6px 20px rgba(22, 160, 133, 0.4);
            }

            /* Fullscreen mode styles */
            .fullscreen-mode {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100vw !important;
                height: 100vh !important;
                z-index: 9999 !important;
                background: #fff;
                border-radius: 0 !important;
            }

            .fullscreen-mode .header {
                top: 10px;
            }

            .fullscreen-mode .fullscreen-toggle {
                top: 10px;
                left: 10px;
            }

            .fullscreen-mode .info-panel {
                top: 10px;
                right: 10px;
            }

            /* Tooltip */
            .tooltip {
                position: absolute;
                bottom: -35px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.8);
                color: white;
                padding: 6px 10px;
                border-radius: 6px;
                font-size: 12px;
                white-space: nowrap;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                pointer-events: none;
            }

            .tooltip:before {
                content: "";
                position: absolute;
                top: -5px;
                left: 50%;
                transform: translateX(-50%);
                border: 5px solid transparent;
                border-bottom-color: rgba(0, 0, 0, 0.8);
            }

            .fullscreen-toggle:hover .tooltip {
                opacity: 1;
                visibility: visible;
            }
            @media (max-width: 768px) {
                .header {
                    position: relative;
                    top: auto;
                    left: auto;
                    transform: none;
                    padding: 20px;
                }

                .header-content {
                    flex-direction: column;
                    text-align: center;
                    gap: 15px;
                }

                .category-buttons {
                    justify-content: center;
                }

                .map-container {
                    margin: 10px;
                    border-radius: 15px;
                }

                .info-panel {
                    position: relative;
                    top: auto;
                    right: auto;
                    margin: 10px;
                    transform: none;
                    max-width: none;
                }

                .search-box {
                    min-width: auto;
                    width: 100%;
                }
            }

            .leaflet-popup-content-wrapper {
                border-radius: 15px !important;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
            }

            .leaflet-popup-tip {
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
            }
            
        </style>
    </head>
    <body>
        <div class="webgis-container">
            <!-- Fullscreen Toggle Button -->
            <button
                class="fullscreen-toggle"
                id="fullscreenToggle"
                onclick="toggleFullscreen()"
            >
                <i class="fas fa-expand" id="fullscreenIcon"></i>
                <div class="tooltip" id="fullscreenTooltip">
                    Mode Layar Penuh
                </div>
            </button>
            <div class="header">
                <div class="header-content">
                    <div class="search-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input
                                type="text"
                                placeholder="Cari lokasi..."
                                id="searchInput"
                            />
                        </div>
                    </div>
                    <div class="category-buttons">
                        <button
                            class="category-btn pendidikan active"
                            onclick="filterCategory('pendidikan')"
                            data-category="pendidikan"
                        >
                            <i class="fas fa-graduation-cap"></i>
                            Pendidikan
                        </button>
                        <button
                            class="category-btn peternakan"
                            onclick="filterCategory('peternakan')"
                            data-category="peternakan"
                        >
                            <i class="fas fa-horse"></i>
                            Peternakan
                        </button>
                        <button
                            class="category-btn pertanian"
                            onclick="filterCategory('pertanian')"
                            data-category="pertanian"
                        >
                            <i class="fas fa-seedling"></i>
                            Pertanian
                        </button>
                    </div>
                </div>
            </div>

            <div class="map-container" id="mapContainer">
                <div class="info-panel" id="infoPanel">
                    <h3 id="panelTitle">
                        <i class="fas fa-graduation-cap"></i>
                        Info Pendidikan
                    </h3>
                    <div class="stats" id="statsContent">
                        <div class="stat-item">
                            <span id="test">Total Lokasi</span>
                            <strong id="totalCount">3</strong>
                        </div>
                        <div class="stat-item">
                            <span>SMA</span>
                            <strong>1</strong>
                        </div>
                        <div class="stat-item">
                            <span>SD</span>
                            <strong>1</strong>
                        </div>
                        <div class="stat-item">
                            <span>TK</span>
                            <strong>1</strong>
                        </div>
                    </div>
                </div>

                <div id="map"></div>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <div>Memuat data...</div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <!-- Kolom Video -->
                <div class="col-md-12">
                <div class="ratio ratio-16x9">
                    <iframe
                    src="https://www.youtube.com/embed/VD4Qka__-pM?si=GzwakFGBbwtlaMk6"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                    ></iframe>
                </div>
                </div>

                <!-- Kolom Deskripsi -->
                <div class="col-md-12 mt-3">
                    <p><strong>Deskripsi Data:</strong></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Nama Peternakan</span><span>Peternakan Sapi Sejahtera</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Kategori</span><span>Sapi Perah</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Jumlah Ternak</span><span>45</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Kapasitas Kandang</span><span>60</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Luas Lahan</span><span>1500 m²</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Alamat</span><span>Jl. Raya Peternakan No. 12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Kecamatan</span><span>Menggala</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Kelurahan</span><span>Ujung Gunung</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Koordinat</span><span>-4.200345, 105.214567</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Pemilik</span><span>Bapak Ahmad Fauzi</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Status Usaha</span><span>Terdaftar</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Tahun Berdiri</span><span>2018</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Jenis Pakan</span><span>Rumput Gajah dan Konsentrat</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Produksi/Bulan</span><span>1200 liter susu</span>
                        </li>
                    </ul>
                    </div>

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script>
            // Initialize map with custom styling
            const map = L.map("map", {
                zoomControl: false,
            }).setView([-4.2165, 105.235], 12);

            map.whenReady(() => {
                map.panBy([0, 100]);
            });

            // Add custom zoom control
            L.control
                .zoom({
                    position: "bottomright",
                })
                .addTo(map);

            // Custom tile layer with better styling
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
                maxZoom: 19,
            }).addTo(map);

            // Enhanced data with more details
            const data = {
                pendidikan: [
                                {
                                    name: "SMAN 1 Tulang Bawang",
                                    level: "SMA",
                                    type: "Negeri",
                                    lat: -4.217,
                                    lng: 105.2415,
                                    address: "Jl. Lintas Timur",
                                    students: "650 siswa",
                                    established: "1985",
                                },
                                {
                                    // -4.226610455740125, 105.24861985015588
                                    name: "SDN 2 Menggala",
                                    level: "SD",
                                    type: "Negeri",
                                    lat: -4.226610455740125,
                                    lng: 105.24861985015588,
                                    address: "Jl. Cendana",
                                    students: "320 siswa",
                                    established: "1978",
                                },
                                {
                                    // -4.235391423303888, 105.2954893064454
                                    name: "SDN 2 Menggala",
                                    level: "SD",
                                    type: "Negeri",
                                    lat: -4.235391423303888,
                                    lng: 105.2954893064454,
                                    address: "Jl. Cendana",
                                    students: "320 siswa",
                                    established: "1978",
                                },
                                
                                {
                                    name: "SMP Negeri 3 Tulang Bawang",
                                    level: "SMP",
                                    type: "Negeri",
                                    lat: -4.280787087103252,
                                    lng: 105.221751371158,
                                    address: "Jl. Pendidikan Raya",
                                    students: "450 siswa",
                                    established: "1990",
                                },
                                {
                                    name: "SD IT Nurul Ilmi",
                                    level: "SD",
                                    type: "Swasta",
                                    lat: -4.277021090701013,
                                    lng: 105.22243799891304,
                                    address: "Jl. Sejahtera",
                                    students: "280 siswa",
                                    established: "2005",
                                },
                                {
                                    name: "SMK Muhammadiyah 1",
                                    level: "SMK",
                                    type: "Swasta",
                                    lat: -4.289610055271473,
                                    lng: 105.36089947858301,
                                    address: "Jl. Industri",
                                    students: "500 siswa",
                                    established: "2010",
                                },
                                {
                                    name: "MI Al-Hidayah",
                                    level: "MI",
                                    type: "Swasta",
                                    lat: -4.174344676984864,
                                    lng: 105.41363257531664,
                                    address: "Jl. Pesantren",
                                    students: "230 siswa",
                                    established: "1988",
                                },
                                {
                                    name: "TK Bina Anak Bangsa",
                                    level: "TK",
                                    type: "Swasta",
                                    lat: -4.288925332960755,
                                    lng: 105.35918286490501,
                                    address: "Jl. Mawar",
                                    students: "60 siswa",
                                    established: "2012",
                                },
                                {
                                    name: "SMA PGRI Tulang Bawang",
                                    level: "SMA",
                                    type: "Swasta",
                                    lat: -4.422637333080764,
                                    lng: 105.26222508218656,
                                    address: "Jl. Kemerdekaan",
                                    students: "370 siswa",
                                    established: "1993",
                                },
                                {
    name: "SD Negeri 1 Sido Makmur",
    level: "SD",
    type: "Negeri",
    lat: -4.211635885981006,
    lng: 105.62532483654894,
    address: "Jl. Melati",
    students: "300 siswa",
    established: "1982",
},
{
    name: "SMP Islam Terpadu Al-Furqan",
    level: "SMP",
    type: "Swasta",
    lat: -4.273533473312072,
    lng: 105.49344926768977,
    address: "Jl. Pesantren Al-Furqan",
    students: "410 siswa",
    established: "2008",
},
{
    name: "MAN 2 Tulang Bawang",
    level: "MA",
    type: "Negeri",
    lat: -4.2914443301896,
    lng: 105.5543807620035,
    address: "Jl. Pendidikan Islam",
    students: "520 siswa",
    established: "1999",
},
{
    name: "SDN 5 Gunung Agung",
    level: "SD",
    type: "Negeri",
    lat: -4.8656282430002475,
    lng: 103.51132582504117,
    address: "Jl. Raya Gunung Agung",
    students: "210 siswa",
    established: "1975",
},
{
    name: "PAUD Kasih Bunda",
    level: "PAUD",
    type: "Swasta",
    lat: -4.254138454686935,
    lng: 105.25723668482395,
    address: "Jl. Kenanga",
    students: "45 siswa",
    established: "2018",
},
{
    name: "SMAN 2 Tulang Bawang",
    level: "SMA",
    type: "Negeri",
    lat: -4.287471636889803,
    lng: 105.304638,
    address: "Jl. Merdeka",
    students: "680 siswa",
    established: "1992",
}

                            ],

                peternakan: [
                                {
                                    name: "Kandang Sapi Pak Budi",
                                    lat: -4.234792249060658,
                                    lng: 105.29583262918102,
                                    address: "Kampung Sido Makmur",
                                    animals: "25 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Budi",
                                    lat: -4.272923080288238,
                                    lng: 105.22274236893841,
                                    address: "Kampung Sido Makmur",
                                    animals: "25 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Budi",
                                    lat: -4.225696778287871,
                                    lng: 105.24883059045094,
                                    address: "Kampung Sido Makmur",
                                    animals: "25 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Budi",
                                    lat: -4.253368106423917,
                                    lng: 105.25732251550785,
                                    address: "Kampung Sido Makmur",
                                    animals: "25 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Budi",
                                    lat: -4.260897111989327,
                                    lng: 105.19912043348776,
                                    address: "Kampung Sido Makmur",
                                    animals: "25 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Joko",
                                    lat: -4.196935665310233,
                                    lng: 105.23682003369983,
                                    address: "Kampung Sumber Rejeki",
                                    animals: "30 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Ibu Sari",
                                    lat: -4.285455717254856,
                                    lng: 105.45632164875605,
                                    address: "Kampung Makmur Jaya",
                                    animals: "20 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Darto",
                                    lat: -4.172975027907284,
                                    lng: 105.41397589805226,
                                    address: "Kampung Sukamaju",
                                    animals: "28 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Bu Tini",
                                    lat: -4.294106591354376,
                                    lng: 105.27132213525505,
                                    address: "Kampung Sinar Mulya",
                                    animals: "22 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Wawan",
                                    lat: -4.288240610036367,
                                    lng: 105.36089947858301,
                                    address: "Kampung Harapan",
                                    animals: "18 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Bu Lina",
                                    lat: -4.206357854329648,
                                    lng: 105.70440993722413,
                                    address: "Kampung Tunas Baru",
                                    animals: "35 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Rudi",
                                    lat: -4.2473812879020825,
                                    lng: 105.67082074277609,
                                    address: "Kampung Bina Karya",
                                    animals: "27 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Pak Herman",
                                    lat: -4.200021999375241,
                                    lng: 105.76787444099241,
                                    address: "Kampung Subur Makmur",
                                    animals: "33 ekor sapi",
                                    type: "Peternakan Sapi",
                                },
                                {
                                    name: "Kandang Sapi Ibu Marni",
                                    lat: -4.259478070607817,
                                    lng: 105.79421193834,
                                    address: "Kampung Mekar Jaya",
                                    animals: "19 ekor sapi",
                                    type: "Peternakan Sapi",
                                }
                            ],
                pertanian: [
                    {
                        name: "Lahan Jagung Kelompok Tani Sejahtera",
                        lat: -4.215,
                        lng: 105.239,
                        address: "Dusun IV",
                        area: "5 hektar",
                        crop: "Jagung",
                    },
                ],
            };

            let currentMarkers = [];
            let currentCategory = "pendidikan";
            let isFullscreen = false;

            // Custom icons for different categories
            const icons = {
                pendidikan: {
                    SMA: L.divIcon({
                        html: '<i class="fas fa-graduation-cap"></i>',
                        iconSize: [30, 30],
                        className: "custom-div-icon",
                        iconAnchor: [15, 30],
                        popupAnchor: [0, -30],
                    }),
                    SD: L.divIcon({
                        html: '<i class="fas fa-school"></i>',
                        iconSize: [30, 30],
                        className: "custom-div-icon",
                        iconAnchor: [15, 30],
                        popupAnchor: [0, -30],
                    }),
                    TK: L.divIcon({
                        html: '<i class="fas fa-child"></i>',
                        iconSize: [30, 30],
                        className: "custom-div-icon",
                        iconAnchor: [15, 30],
                        popupAnchor: [0, -30],
                    }),
                },
                peternakan: L.divIcon({
                    html: '<i class="fas fa-horse"></i>',
                    iconSize: [30, 30],
                    className: "custom-div-icon peternakan-icon",
                    iconAnchor: [15, 30],
                    popupAnchor: [0, -30],
                }),
                pertanian: L.divIcon({
                    html: '<i class="fas fa-seedling"></i>',
                    iconSize: [30, 30],
                    className: "custom-div-icon pertanian-icon",
                    iconAnchor: [15, 30],
                    popupAnchor: [0, -30],
                }),
            };

            // Fullscreen functionality - FIXED VERSION
            function toggleFullscreen() {
                const fullscreenIcon =
                    document.getElementById("fullscreenIcon");
                const fullscreenTooltip =
                    document.getElementById("fullscreenTooltip");
                const fullscreenToggle =
                    document.getElementById("fullscreenToggle");

                if (!isFullscreen) {
                    // Enter fullscreen - hanya meminta browser fullscreen tanpa mengubah layout
                    fullscreenIcon.className = "fas fa-compress";
                    fullscreenTooltip.textContent = "Keluar Layar Penuh";
                    fullscreenToggle.classList.add("active");
                    isFullscreen = true;

                    // Request browser fullscreen API
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement
                            .requestFullscreen()
                            .catch((err) => {
                                console.log(
                                    "Fullscreen API not supported or denied"
                                );
                            });
                    } else if (
                        document.documentElement.webkitRequestFullscreen
                    ) {
                        document.documentElement.webkitRequestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.msRequestFullscreen) {
                        document.documentElement.msRequestFullscreen();
                    }
                } else {
                    // Exit fullscreen
                    fullscreenIcon.className = "fas fa-expand";
                    fullscreenTooltip.textContent = "Mode Layar Penuh";
                    fullscreenToggle.classList.remove("active");
                    isFullscreen = false;

                    // Exit browser fullscreen API
                    if (document.exitFullscreen) {
                        document.exitFullscreen().catch((err) => {
                            console.log("Exit fullscreen failed");
                        });
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    }
                }

                // Invalidate map size after fullscreen toggle
                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            }

            // Listen for fullscreen change events
            document.addEventListener(
                "fullscreenchange",
                handleFullscreenChange
            );
            document.addEventListener(
                "webkitfullscreenchange",
                handleFullscreenChange
            );
            document.addEventListener(
                "mozfullscreenchange",
                handleFullscreenChange
            );
            document.addEventListener(
                "MSFullscreenChange",
                handleFullscreenChange
            );

            function handleFullscreenChange() {
                const fullscreenIcon =
                    document.getElementById("fullscreenIcon");
                const fullscreenTooltip =
                    document.getElementById("fullscreenTooltip");
                const fullscreenToggle =
                    document.getElementById("fullscreenToggle");

                if (
                    !document.fullscreenElement &&
                    !document.webkitFullscreenElement &&
                    !document.mozFullScreenElement &&
                    !document.msFullscreenElement
                ) {
                    // Exited fullscreen - hanya mengubah tombol, tidak mengubah layout
                    fullscreenIcon.className = "fas fa-expand";
                    fullscreenTooltip.textContent = "Mode Layar Penuh";
                    fullscreenToggle.classList.remove("active");
                    isFullscreen = false;

                    setTimeout(() => {
                        map.invalidateSize();
                    }, 100);
                }
            }

            // ESC key to exit fullscreen
            document.addEventListener("keydown", function (event) {
                if (event.key === "Escape" && isFullscreen) {
                    toggleFullscreen();
                }
            });

            function showLoading() {
                document.getElementById("loading").style.display = "block";
            }

            function hideLoading() {
                document.getElementById("loading").style.display = "none";
            }

            function clearMarkers() {
                currentMarkers.forEach((marker) => map.removeLayer(marker));
                currentMarkers = [];
            }

            function updateInfoPanel(category) {
                const infoPanel = document.getElementById("infoPanel");
                const panelTitle = document.getElementById("panelTitle");
                const statsContent = document.getElementById("statsContent");
                const categoryData = data[category];

                const icons = {
                    pendidikan: "fas fa-graduation-cap",
                    peternakan: "fas fa-horse",
                    pertanian: "fas fa-seedling",
                };

                const titles = {
                    pendidikan: "Info Pendidikan",
                    peternakan: "Info Peternakan",
                    pertanian: "Info Pertanian",
                };

                panelTitle.innerHTML = `<i class="${icons[category]}"></i> ${titles[category]}`;

                if (category === "pendidikan") {
                    const levels = {};
                    categoryData.forEach((item) => {
                        levels[item.level] = (levels[item.level] || 0) + 1;
                    });

                    statsContent.innerHTML = `
                        <div class="stat-item">
                            <span>Total Lokasi</span>
                            <strong>${categoryData.length}</strong>
                        </div>
                        ${Object.entries(levels)
                            .map(
                                ([level, count]) =>
                                    `<div class="stat-item">
                                <span>${level}</span>
                                <strong>${count}</strong>
                            </div>`
                            )
                            .join("")}
                    `;
                } else {
                    statsContent.innerHTML = `
                        <div class="stat-item">
                            <span>Total Lokasi</span>
                            <strong>${categoryData.length}</strong>
                        </div>
                    `;
                }

                infoPanel.classList.add("show");
            }

            function filterCategory(category) {
                showLoading();
                currentCategory = category;

                // Update button states
                document.querySelectorAll(".category-btn").forEach((btn) => {
                    btn.classList.remove("active");
                });
                document
                    .querySelector(`[data-category="${category}"]`)
                    .classList.add("active");

                setTimeout(() => {
                    clearMarkers();

                    data[category].forEach((item) => {
                        let icon;

                        if (category === "pendidikan") {
                            icon =
                                icons.pendidikan[item.level] ||
                                icons.pendidikan.SD;
                        } else {
                            icon = icons[category];
                        }

                        const marker = L.marker([item.lat, item.lng], {
                            icon,
                        }).addTo(map);

                        let popupContent = `
                            <div class="popup-content">
                                <div class="popup-title">
                                    <i class="fas fa-${
                                        category === "pendidikan"
                                            ? "graduation-cap"
                                            : category === "peternakan"
                                            ? "horse"
                                            : "seedling"
                                    }"></i>
                                    ${item.name}
                                </div>
                                <div class="popup-details">
                                    <div><i class="fas fa-map-marker-alt"></i> ${
                                        item.address
                                    }</div>
                        `;

                        if (category === "pendidikan") {
                            popupContent += `
                                    <div><i class="fas fa-users"></i> ${
                                        item.students
                                    }</div>
                                    <div><i class="fas fa-calendar"></i> Didirikan ${
                                        item.established
                                    }</div>
                                    <span class="popup-badge badge-${item.type.toLowerCase()}">${
                                item.type
                            }</span>
                            `;
                        } else if (category === "peternakan") {
                            popupContent += `
                                    <div><i class="fas fa-horse"></i> ${item.animals}</div>
                                    <div><i class="fas fa-tag"></i> ${item.type}</div>
                            `;
                        } else if (category === "pertanian") {
                            popupContent += `
                                    <div><i class="fas fa-expand-arrows-alt"></i> ${item.area}</div>
                                    <div><i class="fas fa-seedling"></i> ${item.crop}</div>
                            `;
                        }

                        popupContent += `
                                </div>
                            </div>
                        `;

                        marker.bindPopup(popupContent);
                        currentMarkers.push(marker);
                        // marker.on("click", () => {
                        //     $("#exampleModal").modal("show");
                        // });
                    });

                    updateInfoPanel(category);
                    hideLoading();
                }, 500);
            }

            // Search functionality
            const searchInput = document.getElementById("searchInput");
            searchInput.addEventListener("input", function (e) {
                const searchTerm = e.target.value.toLowerCase();

                if (searchTerm.length < 2) {
                    filterCategory(currentCategory);
                    return;
                }

                clearMarkers();

                data[currentCategory].forEach((item) => {
                    if (
                        item.name.toLowerCase().includes(searchTerm) ||
                        item.address.toLowerCase().includes(searchTerm)
                    ) {
                        let icon;
                        if (currentCategory === "pendidikan") {
                            icon =
                                icons.pendidikan[item.level] ||
                                icons.pendidikan.SD;
                        } else {
                            icon = icons[currentCategory];
                        }

                        const marker = L.marker([item.lat, item.lng], {
                            icon,
                        }).addTo(map);

                        let popupContent = `
                            <div class="popup-content">
                                <div class="popup-title">
                                    <i class="fas fa-${
                                        currentCategory === "pendidikan"
                                            ? "graduation-cap"
                                            : currentCategory === "peternakan"
                                            ? "horse"
                                            : "seedling"
                                    }"></i>
                                    ${item.name}
                                </div>
                                <div class="popup-details">
                                    <div><i class="fas fa-map-marker-alt"></i> ${
                                        item.address
                                    }</div>
                        `;

                        if (currentCategory === "pendidikan") {
                            popupContent += `
                                    <div><i class="fas fa-users"></i> ${
                                        item.students
                                    }</div>
                                    <div><i class="fas fa-calendar"></i> Didirikan ${
                                        item.established
                                    }</div>
                                    <span class="popup-badge badge-${item.type.toLowerCase()}">${
                                item.type
                            }</span>
                            `;
                        }

                        popupContent += `
                                </div>
                            </div>
                        `;

                        marker.bindPopup(popupContent);
                        currentMarkers.push(marker);
                    }
                });
            });

            // Add custom CSS for icons
            const style = document.createElement("style");
            style.textContent = `
                .custom-div-icon {
                    background: linear-gradient(135deg, #4facfe, #00f2fe);
                    border-radius: 50%;
                    color: white;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 14px;
                    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
                    border: 3px solid white;
                    transition: all 0.3s ease;
                }

                .custom-div-icon:hover {
                    transform: scale(1.1);
                    box-shadow: 0 6px 20px rgba(79, 172, 254, 0.6);
                }

                .peternakan-icon {
                    background: linear-gradient(135deg, #43e97b, #38f9d7) !important;
                    box-shadow: 0 4px 15px rgba(67, 233, 123, 0.4) !important;
                }

                .peternakan-icon:hover {
                    box-shadow: 0 6px 20px rgba(67, 233, 123, 0.6) !important;
                }

                .pertanian-icon {
                    background: linear-gradient(135deg, #fa709a, #fee140) !important;
                    box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4) !important;
                }

                .pertanian-icon:hover {
                    box-shadow: 0 6px 20px rgba(250, 112, 154, 0.6) !important;
                }
            `;
            document.head.appendChild(style);

            // Initialize with education category
            setTimeout(() => {
                filterCategory("pendidikan");
            }, 100);

            // Map interaction effects removed to prevent icon changes during zoom
        </script>

        <!-- start GEO JSON -->
        <script>
        // Fungsi load GeoJSON
        async function loadGeoJSON(url, color = 'blue') {
            const response = await fetch(url);
            const data = await response.json();

            L.geoJSON(data, {
                style: {
                    color: color,
                    weight: 1,
                    fillOpacity: 0.3
                },

                onEachFeature: function (feature, layer) {
                    if (feature.properties) {
                        const props = feature.properties;

                        const popupContent = `
                            <div style="font-size: 13px; line-height: 1.5;">
                                <strong>📍 Kecamatan:</strong> ${props.district || '-'}<br>
                                <strong>📌 Desa/Kelurahan:</strong> ${props.village || '-'}<br>
                                <strong>🗺️ Kabupaten:</strong> ${props.regency || '-'}<br>
                                <strong>🌐 Provinsi:</strong> ${props.province || '-'}<br>
                                <strong>📅 Sejak:</strong> ${props.valid_on || '-'}<br>
                                <strong>🔗 Sumber:</strong> ${props.source || '-'}
                            </div>
                        `;
                        layer.bindPopup(popupContent);
                    }
                }
                
            }).addTo(map);
        }

        const geojsonFiles = [
            'geojson/id1808030_banjar_agung.geojson',
            'geojson/id1808031_banjar_margo.geojson',
            'geojson/id1808032_banjar_baru.geojson',
            'geojson/id1808040_gedung_aji.geojson',
            'geojson/id1808041_penawar_aji.geojson',
            'geojson/id1808042_meraksa_aji.geojson',
            'geojson/id1808050_menggala.geojson',
            'geojson/id1808051_penawar_tama.geojson',
            'geojson/id1808052_rawajitu_selatan.geojson',
            'geojson/id1808053_gedung_meneng.geojson',
            'geojson/id1808054_rawajitu_timur.geojson',
            'geojson/id1808055_rawa_pitu.geojson',
            'geojson/id1808056_gedung_aji_baru.geojson',
            'geojson/id1808057_dente_teladas.geojson',
            'geojson/id1808058_menggala_timur.geojson'
        ];

        const colors = [
            'red', 'blue', 'green', 'orange', 'purple',
            'brown', 'cyan', 'magenta', 'lime', 'yellow',
            'pink', 'gray', 'teal', 'indigo', 'black'
        ];

        // Load semua GeoJSON dengan warna berbeda
        geojsonFiles.forEach((file, index) => {
            const color = colors[index % colors.length]; 
            loadGeoJSON(`/storage/${file}`, color);
        });
        </script>
        <!-- End GEO JSON -->
    </body>
</html>
