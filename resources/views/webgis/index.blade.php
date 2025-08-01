<!DOCTYPE html>
<html>
    <head>
        <title>Peta Interaktif Pendidikan Kota</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

            .category-btn.data-pemerintahan {
                background: linear-gradient(135deg, #11998e, #38ef7d);
                color: white;
                box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
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

            .filter-data {
                position: absolute;
                top: 20px;
                right: 40px;
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

            .filter-data.show {
                transform: translateX(0);
            }

            .filter-data h3 {
                color: #333;
                margin-bottom: 15px;
                font-size: 18px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .filter-data .stats {
                display: grid;
                gap: 10px;
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

            /* Modern Popup Styles */
        .info-window {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            min-width: 320px;
            max-width: 400px;
            position: relative;
            transform: translateY(0);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-window:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .info-window::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
            background-size: 300% 100%;
        }
        .popup-content {
            /* background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px); */
            padding: 24px;
            border-radius: 0 0 16px 16px;
            position: relative;
        }

        .popup-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            border-radius: 0 0 16px 16px;
            pointer-events: none;
        }

        .popup-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 12px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .popup-title i {
            font-size: 24px;
            color: #667eea;
            background: #fff;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .popup-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .popup-details > div {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 12px;
            font-size: 14px;
            color: #34495e;
            font-weight: 500;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        /* Responsive design */
        @media (max-width: 480px) {
            .info-window {
                min-width: 280px;
                max-width: 95vw;
            }
            
            .popup-content {
                padding: 20px;
            }
            
            .popup-title {
                font-size: 18px;
            }
            
            .popup-details > div {
                padding: 10px 14px;
                font-size: 13px;
            }
        }

        /* Animation for popup appearance */
        .info-window {
            animation: popupAppear 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes popupAppear {
            0% {
                opacity: 0;
                transform: scale(0.8) translateY(20px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .popup-content {
                background: rgb(24 49 83);
                color: #ecf0f1;
            }
            
            .popup-title {
                color: #ecf0f1;
                border-bottom-color: rgba(255, 255, 255, 0.1);
            }
            
            .popup-details > div {
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
                border-color: rgba(255, 255, 255, 0.1);
            }
            
            .popup-details > div:hover {
                background: rgba(255, 255, 255, 0.15);
            }
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
                            class="category-btn data-pemerintahan"
                            onclick="filterCategory('pemerintahan')"
                            data-category="pemerintahan"
                        >
                            <i class="fa-solid fa-building-columns"></i>
                            Pemerintahan
                        </button>
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
                {{-- <div class="filter-data" id="filterData">
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
                </div> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    let map;
    let currentMarkers = [];
    let currentCategory = "pemerintahan"; 
    let isFullscreen = false;
    let infoWindows = []; 
    let defaultLatCenter = -4.493986;
    let defaultLngCenter = 105.224569;
    let defaultZoom = 16;

    // Enhanced data with more details
    const data = {
        pemerintahan: [
        {
            "id": "1",
            "name": "Sekretariat Daerah",
            "lat": "-4.4953178",
            "lng": "105.2177069",
            "address": ""
        },
        {
            "id": "13",
            "name": "Badan Kepegawaian, Pendidikan dan Pelatihan",
            "lat": "-4.494248",
            "lng": "105.219772",
            "address": ""
        },
        {
            "id": "14",
            "name": "Badan Penanggulangan Bencana Daerah",
            "lat": "-4.4906058",
            "lng": "105.2485882"
        },
        {
            "id": "15",
            "name": "Badan Perencanaan Pembangunan Daerah",
            "lat": "-4.493166",
            "lng": "105.2201463"
        },
        {
            "id": "16",
            "name": "Badan Pendapatan Daerah",
            "lat": "-4.4953217",
            "lng": "105.2189622"
        },
        {
            "id": "17",
            "name": "Badan Pengelola Keuangan dan Aset Daerah",
            "lat": "-4.5388913",
            "lng": "105.2231292"
        },
        {
            "id": "18",
            "name": "Badan Kesatuan Bangsa dan Politik",
            "lat": "-4.4954266",
            "lng": "105.2188549"
        },
        {
            "id": "19",
            "name": "Dinas Penanamen Modal dan Pelayanan Terpadu Satu Pintu",
            "lat": "-4.538747399999999",
            "lng": "105.2213508"
        },
        {
            "id": "20",
            "name": "Dinas Komunikasi dan Informatika",
            "lat": "-4.538110570587915",
            "lng": "105.22144211350887"
        },
        {
            "id": "21",
            "name": "Dinas Pendidikan",
            "lat": "-4.495384",
            "lng": "105.219453"
        },
        {
            "id": "22",
            "name": "Dinas Pariwisata dan Kebudayaan",
            "lat": "-4.4935057",
            "lng": "105.2204596"
        },
        {
            "id": "23",
            "name": "Dinas Perikanan",
            "lat": "-4.492940695866368",
            "lng": "105.2184924926424"
        },
        {
            "id": "24",
            "name": "Dinas Kependudukan dan Pencatatan Sipil",
            "lat": "-4.539043899999999",
            "lng": "105.2217796"
        },
        {
            "id": "25",
            "name": "Dinas Perdagangan",
            "lat": "-4.4868312",
            "lng": "105.2565317"
        },
        {
            "id": "26",
            "name": "Dinas Pekerjaan Umum dan Penataan Ruang",
            "lat": "-4.492000599999982",
            "lng": "105.22003144110451",
            "address": "Jl. Cemara Komplek Perkantoran Pemda Kab. Tulang Bawang. Lingk. Gunung Sakti. Kel.Menggala Selatan. Kec. Menggala"
        },
        {
            "id": "27",
            "name": "Dinas Ketahanan Pangan",
            "lat": "-4.493568",
            "lng": "105.2173845"
        },
        {
            "id": "28",
            "name": "Dinas Lingkungan Hidup",
            "lat": "-4.495126",
            "lng": "105.2155771"
        },
        {
            "id": "30",
            "name": "Dinas Perhubungan",
            "lat": "-4.4938356",
            "lng": "105.244143"
        },
        {
            "id": "32",
            "name": "Dinas Koperasi dan Usaha Kecil Menengah",
            "lat": "-4.4925792",
            "lng": "105.2195773"
        },
        {
            "id": "33",
            "name": "Dinas Pertanian",
            "lat": "-4.4936821",
            "lng": "105.2160313"
        },
        {
            "id": "34",
            "name": "Dinas Tenaga Kerja dan Transmigrasi",
            "lat": "-4.4961208",
            "lng": "105.217716"
        },
        {
            "id": "35",
            "name": "Dinas Perpustakaan dan Kearsipan",
            "lat": "-4.47161",
            "lng": "105.2371181"
        },
        {
            "id": "36",
            "name": "Dinas Perumahan Rakyat dan Kawasan Permukiman",
            "lat": "-4.4928058",
            "lng": "105.2169827"
        },
        {
            "id": "37",
            "name": "Dinas Sosial",
            "lat": "-4.4955399",
            "lng": "105.2181537"
        },
        {
            "id": "38",
            "name": "Dinas Kesehatan",
            "lat": "-4.496239",
            "lng": "105.219849"
        },
        {
            "id": "39",
            "name": "Dinas Pengendalian Penduduk dan Keluarga Berencana",
            "lat": "-4.496387299999999",
            "lng": "105.2192756"
        },
        {
            "id": "41",
            "name": "Satuan Polisi Pamong Praja",
            "lat": "-4.4942336",
            "lng": "105.2176138"
        },
        {
            "id": "42",
            "name": "Sekretariat DPRD",
            "lat": "-4.4916446",
            "lng": "105.2476203"
        },
        {
            "id": "43",
            "name": "Badan Penelitian dan Pengembangan Daerah",
            "lat": "-4.4934061",
            "lng": "105.2179096"
        },
        {
            "id": "44",
            "name": "Inspektorat",
            "lat": "-4.5385509",
            "lng": "105.2211166"
        },
        {
            "id": "45",
            "name": "Bagian Umum Setdakab.",
            "lat": "-4.4948968",
            "lng": "105.2200656"
        },
        {
            "id": "46",
            "name": "Dinas Pemberdayaan Perempuan dan Perlindungan Anak",
            "lat": "-4.544357299999999",
            "lng": "105.2206848"
        },
        {
            "id": "47",
            "name": "Dinas Pemberdayaan Masyarakat dan Kampung/Kelurahan",
            "lat": "-4.5389888",
            "lng": "105.219049"
        },
        {
            "id": "48",
            "name": "Dinas Pemadam Kebakaran dan Penyelamatan",
            "lat": "-4.4934890",
            "lng": "105.2314780"
        },
        {
            "id": "49",
            "name": "RSUD Menggala",
            "lat": "-4.546934399999999",
            "lng": "105.221402"
        },
        {
            "id": "50",
            "name": "Dinas Kepemudaan dan Olahraga",
            "lat": "-4.5361762",
            "lng": "105.2261858"
        },
        {
            "id": "51",
            "name": "MPP Mini Tulang Bawang",
            "lat": "-4.4949066",
            "lng": "105.2200426"
        },
        {
            "id": "52",
            "name": "Anjungan Tulang Bawang",
            "lat": "-4.4949066",
            "lng": "105.2200426"
        },
        {
            "id": "53",
            "name": "Kecamatan Gedung Meneng",
            "lat": "-4.41194269856932",
            "lng": "105.67462583570733"
        },
        {
            "id": "54",
            "name": "Kecamatan Dente Teladas",
            "lat": "-4.4252426",
            "lng": "105.7921721"
        },
        {
            "id": "55",
            "name": "Kecamatan Menggala",
            "lat": "-4.491997802646671",
            "lng": "105.24561216565054"
        },
        {
            "id": "56",
            "name": "Kecamatan Menggala Timur",
            "lat": "-4.408341263227499",
            "lng": "105.25793409832012"
        },
        {
            "id": "57",
            "name": "Kecamatan Banjar Agung",
            "lat": "-4.3009843",
            "lng": "105.2200773"
        },
        {
            "id": "58",
            "name": "Kecamatan Banjar Baru",
            "lat": "-4.373186692442603",
            "lng": "105.23194190895443"
        },
        {
            "id": "59",
            "name": "Kecamatan Banjar Margo",
            "lat": "-4.246227399178258",
            "lng": "105.25712670935886"
        },
        {
            "id": "60",
            "name": "Kecamatan Gedung Aji",
            "lat": "-4.317308386706573",
            "lng": "105.36004306662473"
        },
        {
            "id": "61",
            "name": "Kecamatan Gedung Aji Baru",
            "lat": "-4.206713",
            "lng": "105.575550"
        },
        {
            "id": "63",
            "name": "Kecamatan Meraksa Aji",
            "lat": "-4.2814070200032",
            "lng": "105.41536985215417"
        },
        {
            "id": "64",
            "name": "Kecamatan Penawar Aji",
            "lat": "-4.280565290168361",
            "lng": "105.48967874626848"
        },
        {
            "id": "65",
            "name": "Kecamatan Penawar Tama",
            "lat": "-4.187488882041612",
            "lng": "105.4945270656319"
        },
        {
            "id": "66",
            "name": "Kecamatan Rawa Jitu Selatan",
            "lat": "-4.209592188897845",
            "lng": "105.70688586887535"
        },
        {
            "id": "67",
            "name": "Kecamatan Rawa Jitu Timur",
            "lat": "-4.21020",
            "lng": "105.7660"
        },
        {
            "id": "68",
            "name": "Kecamatan Rawa Pitu",
            "lat": "-4.306242486836919",
            "lng": "105.55779255584933"
        },
        {
            "id": "69",
            "name": "Bagian Tata Pemerintahan Setdakab.",
            "lat": "-4.4949066",
            "lng": "105.2200426"
        }
    ],
    pendidikan: [
        {
            "id": 1,
            "npsn": "10808209",
            "name": "SD INTEGRAL HIDAYATULLAH",
            "level": "SD",
            "alamat": "Rengas Cendung",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.5040184,
            "lng": 105.2098219
        },
        {
            "id": 2,
            "npsn": "70010213",
            "name": "SD ISLAM TERPADU GENERASI BERLIAN",
            "level": "SD",
            "alamat": "Jl. Raya Gunung Sakti",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.5066494,
            "lng": 105.2343803
        },
        {
            "id": 3,
            "npsn": "10808611",
            "name": "SD NEGERI 01 GUNUNG SAKTI",
            "level": "SD",
            "alamat": "Jl. Anggrek Menggala",
            "kelurahan": "Menggala Tengah",
            "status": "NEGERI",
            "lat": -6.9097717,
            "lng": 107.6318999
        },
        {
            "id": 4,
            "npsn": "10814923",
            "name": "SD NEGERI 01 LINGAI",
            "level": "SD",
            "alamat": "Jl. Lima Lk Lingai",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "NEGERI",
            "lat": -4.5480458,
            "lng": 105.2019295
        },
        {
            "id": 5,
            "npsn": "10808659",
            "name": "SD NEGERI 01 MENGGALA KOTA",
            "level": "SD",
            "alamat": "Menggala Kota",
            "kelurahan": "Menggala Kota",
            "status": "NEGERI",
            "lat": -4.4594333,
            "lng": 105.263367
        },
        {
            "id": 6,
            "npsn": "10808579",
            "name": "SD NEGERI 01 MENGGALA SELATAN",
            "level": "SD",
            "alamat": "Jl. Lintas Timur No. 140 Lk. Bujung Tenuk",
            "kelurahan": "Menggala Selatan",
            "status": "NEGERI",
            "lat": -4.563679,
            "lng": 105.2258972
        },
        {
            "id": 7,
            "npsn": "10808741",
            "name": "SD NEGERI 01 TIUH TOHO",
            "level": "SD",
            "alamat": "Tiuh Toho",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "NEGERI",
            "lat": -4.548771241126919,
            "lng": 105.22162909733531
        },
        {
            "id": 8,
            "npsn": "10808769",
            "name": "SD NEGERI 02 ASTRA KSETRA",
            "level": "SD",
            "alamat": "Astra Ksetra",
            "kelurahan": "Astra Ksetra",
            "status": "NEGERI",
            "lat": -4.607494099999999,
            "lng": 105.2253316
        },
        {
            "id": 9,
            "npsn": "10808037",
            "name": "SD NEGERI 02 MENGGALA KOTA",
            "level": "SD",
            "alamat": "Menggala",
            "kelurahan": "Menggala Kota",
            "status": "NEGERI",
            "lat": -4.4594333,
            "lng": 105.263367
        },
        {
            "id": 10,
            "npsn": "10809634",
            "name": "SD NEGERI 02 TIUH TOHO",
            "level": "SD",
            "alamat": "JL LINTAS TIMUR TIUH TOHO",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "NEGERI",
            "lat": -4.5535667,
            "lng": 105.2218327
        },
        {
            "id": 12,
            "npsn": "10808141",
            "name": "SD NEGERI 03 UJUNG GUNUNG ILIR",
            "level": "SD",
            "alamat": "Ujung Gunung Ilir",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "NEGERI",
            "lat": -4.540850982577701,
            "lng": 105.19561022417007
        },
        {
            "id": 13,
            "npsn": "10808168",
            "name": "SD NEGERI 05 UJUNG GUNUNG ILIR",
            "level": "SD",
            "alamat": "Ujung Gunung Ilir",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "NEGERI",
            "lat": -4.571496547726052,
            "lng": 105.19341799145326
        },
        {
            "id": 14,
            "npsn": "10808557",
            "name": "SD NEGERI 1 ASTRA KSETRA",
            "level": "SD",
            "alamat": "Astra Ksetra",
            "kelurahan": "Astra Ksetra",
            "status": "NEGERI",
            "lat": -4.607494099999999,
            "lng": 105.2253316
        },
        {
            "id": 15,
            "npsn": "10808181",
            "name": "SD NEGERI 1 JURANG UBUNG",
            "level": "SD",
            "alamat": "Jaln .sesat Agung",
            "kelurahan": "Menggala Tengah",
            "status": "NEGERI",
            "lat": -4.2432788,
            "lng": 105.1207277
        },
        {
            "id": 18,
            "npsn": "10809595",
            "name": "SD NEGERI 2 GUNUNG SAKTI",
            "level": "SD",
            "alamat": "Jl. Pahlawan Talang Tembesu",
            "kelurahan": "Menggala Selatan",
            "status": "NEGERI",
            "lat": -4.5129774,
            "lng": 105.2077798
        },
        {
            "id": 20,
            "npsn": "10808182",
            "name": "SD NEGERI KAGUNGAN DALAM",
            "level": "SD",
            "alamat": "KAGUNGAN DALAM",
            "kelurahan": "Menggala Kota",
            "status": "NEGERI",
            "lat": -4.482136,
            "lng": 105.248596
        },
        {
            "id": 21,
            "npsn": "10808187",
            "name": "SD NEGERI LEBUH DALEM",
            "level": "SD",
            "alamat": "Jl. 5 Lingkungan Lebuh Dalem",
            "kelurahan": "Menggala Tengah",
            "status": "NEGERI",
            "lat": -4.4769418,
            "lng": 105.2604409
        },
        {
            "id": 22,
            "npsn": "10808199",
            "name": "SD NEGERI TEGAL REJO",
            "level": "SD",
            "alamat": "Tegal Rejo",
            "kelurahan": "KAGUNGAN RAHAYU",
            "status": "NEGERI",
            "lat": -4.5509824,
            "lng": 105.1814554
        },
        {
            "id": 23,
            "npsn": "10808753",
            "name": "SDN 01 UJUNG GUNUNG UDIK",
            "level": "SD",
            "alamat": "JL. SUAY UMPU NO : 217",
            "kelurahan": "Ujung Gunung",
            "status": "NEGERI",
            "lat": -4.4651388,
            "lng": 105.2585112
        },
        {
            "id": 24,
            "npsn": "69856692",
            "name": "SDN 1 KIBANG",
            "level": "SD",
            "alamat": "Jl. 2 Kibang Kel. Menggala Tengah",
            "kelurahan": "Menggala Tengah",
            "status": "NEGERI",
            "lat": -4.4721383,
            "lng": 105.250707
        },
        {
            "id": 25,
            "npsn": "69928445",
            "name": "SDS BAHARI AL ISLAM",
            "level": "SD",
            "alamat": "CEMARA KOMPLEK PERKANTORAN PEMDA",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.4973963,
            "lng": 105.1193209
        },
        {
            "id": 26,
            "npsn": "60705629",
            "name": "MIN 1 TULANGBAWANG",
            "level": "SD",
            "alamat": "Jalan Cokro Aminoto No. 300",
            "kelurahan": "Menggala Kota",
            "status": "NEGERI",
            "lat": -4.4676343,
            "lng": 105.2583645
        },
        {
            "id": 27,
            "npsn": "69725745",
            "name": "MIS HIDAYATULLAH",
            "level": "SD",
            "alamat": "Jalan Ds. Rengas Cendung",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.5040184,
            "lng": 105.2098219
        },
        {
            "id": 28,
            "npsn": "60705630",
            "name": "MIS ISLAMIYAH",
            "level": "SD",
            "alamat": "Jalan 3 Ujung Gunung Ilir",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "SWASTA",
            "lat": -4.4744702,
            "lng": 105.2439546
        },
        {
            "id": 30,
            "npsn": "10816689",
            "name": "MTSN 1 TULANGBAWANG",
            "level": "SMP",
            "alamat": "Jalan IV Lk. Menggala",
            "kelurahan": "Menggala Kota",
            "status": "NEGERI",
            "lat": -4.4731391,
            "lng": 105.2517129
        },
        {
            "id": 31,
            "npsn": "69886386",
            "name": "MTSS Al Izzah",
            "level": "SMP",
            "alamat": "Rengas Cendung",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.5040184,
            "lng": 105.2098219
        },
        {
            "id": 33,
            "npsn": "10808296",
            "name": "SMP ANGKASA",
            "level": "SMP",
            "alamat": "Jl.Hercules Lanud Pangeran M. Bun Yamin",
            "kelurahan": "Astra Ksetra",
            "status": "SWASTA",
            "lat": -4.614447699999999,
            "lng": 105.2245236
        },
        {
            "id": 34,
            "npsn": "70013881",
            "name": "SMP ISLAM TERPADU GENERASI BERLIAN",
             "level": "SMP",
            "alamat": "JL.Raya Gunung Sakti",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.5066494,
            "lng": 105.2343803
        },
        {
            "id": 35,
            "npsn": "10808338",
            "name": "SMP MUHAMMADIYAH 01 MENGGALA",
             "level": "SMP",
            "alamat": "DUSUN CIMANGGUK",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "SWASTA",
            "lat": -4.5480458,
            "lng": 105.2019295
        },
        {
            "id": 36,
            "npsn": "10804099",
            "name": "SMP NEGERI 01 MENGGALA",
             "level": "SMP",
            "alamat": "Jl Suay Umpu No.308",
            "kelurahan": "Menggala Kota",
            "status": "NEGERI",
            "lat": -4.465201,
            "lng": 105.258595
        },
        {
            "id": 37,
            "npsn": "10808395",
            "name": "SMP NEGERI 2 MENGGALA",
             "level": "SMP",
            "alamat": "Jl.Akasia Gunung Sakti",
            "kelurahan": "Menggala Selatan",
            "status": "NEGERI",
            "lat": -4.4910451,
            "lng": 105.2342841
        },
        {
            "id": 38,
            "npsn": "10809224",
            "name": "SMP NEGERI 3 MENGGALA",
             "level": "SMP",
            "alamat": "Jl. Raya Lintas Timur Tiuh Toho",
            "kelurahan": "Ujung Gunung",
            "status": "NEGERI",
            "lat": -4.4889449,
            "lng": 105.2505434
        },
        {
            "id": 39,
            "npsn": "69991915",
            "name": "SMP NURUL QODIRI",
             "level": "SMP",
            "alamat": "Jln. Kayu Lemai",
            "kelurahan": "TIUH TOHOU",
            "status": "SWASTA",
            "lat": -4.5375576,
            "lng": 105.2253316
        },
        {
            "id": 40,
            "npsn": "69787361",
            "name": "SMP PEMBINA TULANG BAWANG",
             "level": "SMP",
            "alamat": "Jl Gala Ratu Komplek Pemda Tulang Bawang",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.5129774,
            "lng": 105.2077798
        },
        {
            "id": 41,
            "npsn": "10814638",
            "name": "SMPN 04 MENGGALA",
            "level": "SMP",
            "alamat": "Menggala",
            "kelurahan": "Bujung Tenuk",
            "status": "NEGERI",
            "lat": -4.575201799999999,
            "lng": 105.2165555
        },
        {
            "id": 42,
            "npsn": "10811029",
            "name": "SLB NEGERI TULANG BAWANG",
            "level": "SMA",
            "alamat": "Jl. Raya Lintas Timur Sumatera",
            "kelurahan": "TIUH TOHOU",
            "status": "NEGERI",
            "lat": -4.540763,
            "lng": 105.2196802
        },
        {
            "id": 43,
            "npsn": "10809290",
            "name": "SMAN 1 MENGGALA",
            "level": "SMA",
            "alamat": "JL. CENDANA NO.5",
            "kelurahan": "Menggala Selatan",
            "status": "NEGERI",
            "lat": -4.490203,
            "lng": 105.2335698
        },
        {
            "id": 44,
            "npsn": "10809299",
            "name": "SMAN 2 MENGGALA",
            "level": "SMA",
            "alamat": "Jl. Lintas Timur No. 2 Tiuh Toho Menggala Tulang Bawang",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "NEGERI",
            "lat": -4.5470779,
            "lng": 105.2203651
        },
        {
            "id": 45,
            "npsn": "69822723",
            "name": "SMAN 3 MENGGALA",
            "level": "SMA",
            "alamat": "Jalan Lintas Timur, Menggala",
            "kelurahan": "Menggala Tengah",
            "status": "NEGERI",
            "lat": -4.4825576,
            "lng": 105.2608627
        },
        {
            "id": 46,
            "npsn": "10810655",
            "name": "SMAS MUHAMMADIYAH 1 MENGGALA",
            "level": "SMA",
            "alamat": "JL. DUSUN CIMANGGUK",
            "kelurahan": "Ujung Gunung Ilir",
            "status": "SWASTA",
            "lat": -4.5480458,
            "lng": 105.2019295
        },
        {
            "id": 47,
            "npsn": "10810729",
            "name": "SMAS PEMBINA MENGGALA",
            "level": "SMA",
            "alamat": "JL. Gala Ratu Komplek Perkantoran Pemda Tulang Bawang",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.4973963,
            "lng": 105.1193209
        },
        {
            "id": 48,
            "npsn": "69820146",
            "name": "SMK PEMBINA TULANG BAWANG",
            "level": "SMA",
            "alamat": "JL. GALARATU KOMPLEK PERKANTORAN PEMDA KAB. TULANG BAWANG",
            "kelurahan": "Menggala Selatan",
            "status": "SWASTA",
            "lat": -4.5129774,
            "lng": 105.2077798
        }
    ],
    };

    // Initialize Google Maps
    async function initMap() {
        // Import Advanced Marker library
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
        // We can directly use AdvancedMarkerElement, no need to attach to window if not globally used elsewhere
        // window.AdvancedMarkerElement = AdvancedMarkerElement; // This line is not strictly necessary if used locally

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: defaultZoom,
            center: { lat: defaultLatCenter, lng: defaultLngCenter }, // Center for Tulang Bawang area
            mapId: 'YOUR_MAP_ID', // *** PENTING: Ganti dengan Map ID Anda ***
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [ // Gaya peta kustom
                { featureType: "water", elementType: "geometry", stylers: [{ color: "#e9e9e9" }, { lightness: 17 }] },
                { featureType: "landscape", elementType: "geometry", stylers: [{ color: "#f5f5f5" }, { lightness: 20 }] },
                { featureType: "road.highway", elementType: "geometry.fill", stylers: [{ color: "#ffffff" }, { lightness: 17 }] },
                { featureType: "road.highway", elementType: "geometry.stroke", stylers: [{ color: "#ffffff" }, { lightness: 29 }, { weight: 0.2 }] },
                { featureType: "road.arterial", elementType: "geometry", stylers: [{ color: "#ffffff" }, { lightness: 18 }] },
                { featureType: "road.local", elementType: "geometry", stylers: [{ color: "#ffffff" }, { lightness: 16 }] },
                { featureType: "poi", elementType: "geometry", stylers: [{ color: "#f5f5f5" }, { lightness: 21 }] }
            ],
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_BOTTOM
            },
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false // Disable default fullscreen control
        });

        // Pan the map slightly down for better initial view, after map is fully loaded
        google.maps.event.addListenerOnce(map, 'idle', () => {
            map.panBy(0, -10);
            // Initialize with the default category after the map is ready
            filterCategory(currentCategory);
        });

        // Add category button event listeners
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const category = e.currentTarget.getAttribute('data-category');
                filterCategory(category);
            });
        });

        // Search functionality
        const searchInput = document.getElementById("searchInput");
        if (searchInput) { // Check if element exists
            searchInput.addEventListener("input", function (e) {
                const searchTerm = e.target.value.toLowerCase();

                // If search term is too short, reset to current category markers
                if (searchTerm.length < 2 && searchTerm !== "") { // Allow empty string to reset
                    filterCategory(currentCategory);
                    return;
                }
                
                // Clear existing markers only if search term is active
                if (searchTerm.length >= 2) {
                    clearMarkers();

                    data[currentCategory].forEach((item) => {
                        if (
                            item.name.toLowerCase().includes(searchTerm) ||
                            item.alamat.toLowerCase().includes(searchTerm)
                        ) {
                            createMarker(item, currentCategory, AdvancedMarkerElement); // Pass AdvancedMarkerElement
                        }
                    });
                } else if (searchTerm === "") { // If search is cleared
                    filterCategory(currentCategory);
                }
            });
        }
    }

    // Create custom marker
    function createMarker(item, category, AdvancedMarkerElement) { // Pass AdvancedMarkerElement as argument
        const iconMap = {
            pemerintahan: 'fa-solid fa-building-columns',
            pendidikan: {
                SMA: 'fas fa-graduation-cap',
                SD: 'fas fa-school',
                TK: 'fas fa-child'
            },
            peternakan: 'fas fa-horse', // Changed to horse, was fa-cow in original thinking
            pertanian: 'fas fa-seedling'
        };

        let iconClass;
        if (category === 'pendidikan') {
            iconClass = iconMap.pendidikan[item.level] || iconMap.pendidikan.SD; // Fallback to SD if level not found
        } else {
            iconClass = iconMap[category];
        }

        const colors = {
            pemerintahan: 'linear-gradient(135deg, #11998e, #38ef7d)',
            pendidikan: 'linear-gradient(135deg, #4facfe, #00f2fe)', // Blue
            peternakan: 'linear-gradient(135deg, #43e97b, #38f9d7)', // Green
            pertanian: 'linear-gradient(135deg, #fa709a, #fee140)' // Orange/Pink
        };

        // Create Font Awesome icon element
        const faIcon = document.createElement("div");
        faIcon.innerHTML = `<i class="${iconClass}" style="font-size: 14px; color: white;"></i>`;
        faIcon.style.cssText = `
            width: 30px;
            height: 30px;
            background: ${colors[category]};
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            border: 3px solid white;
            transition: all 0.3s ease;
            cursor: pointer;
        `;

        // Add hover effect
        faIcon.addEventListener('mouseenter', () => {
            faIcon.style.transform = 'scale(1.1)';
            faIcon.style.boxShadow = '0 6px 20px rgba(0,0,0,0.4)';
        });

        faIcon.addEventListener('mouseleave', () => {
            faIcon.style.transform = 'scale(1)';
            faIcon.style.boxShadow = '0 4px 15px rgba(0,0,0,0.3)';
        });

        // Create Advanced Marker
        const marker = new AdvancedMarkerElement({ // Use AdvancedMarkerElement directly
            map: map,
            position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng) },
            content: faIcon,
            title: item.name
        });

        // Create info window content
        let popupContent = `
            <div class="info-window">
                <div class="popup-content">
                    <div class="popup-title">
                        <i class="${iconClass}"></i>
                        ${item.name}
                    </div>
                    <div class="popup-details">
                        <div><i class="fas fa-map-marker-alt"></i> Alamat:  ${item.alamat}</div>
        `;

        // Add category-specific details
        if (category === "pendidikan") {
            popupContent += `
                        <div><i class="fa-solid fa-key"></i>NPSN: ${item.npsn}</div>
                        <div><i class="fa-solid fa-tag"></i>Kelurahan: ${item.kelurahan}</div>
                        <div><i class="fa-solid fa-heart"></i>Status: ${item.status}</div>
            `;
        } else if (category === "peternakan") {
            popupContent += `
                        <div><i class="fas fa-cow"></i> ${item.animals}</div> <div><i class="fas fa-tag"></i> ${item.type}</div>
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
            </div>
        `;

        const infoWindow = new google.maps.InfoWindow({
            content: popupContent
        });

        marker.addListener("click", () => {
            // Close all open info windows
            infoWindows.forEach(iw => iw.close());
            
            if (map) { 

                switch (category) {
                case 'pemerintahan':
                targetZoom = 17;
                    break;
                case 'pendidikan':
                    targetZoom = 14;
                    break;
                default:
                    targetZoom = 16;
                    break;
                }

                map.setCenter({ lat: parseFloat(item.lat), lng: parseFloat(item.lng) });
                map.setZoom(targetZoom);
            }

            // Open clicked info window
            infoWindow.open(map, marker);
        });

        infoWindow.addListener('closeclick', () => {
        // Kembalikan peta ke pusat dan zoom default saat info window ditutup
        if (map) {
            switch (category) {
                case 'pemerintahan':
                targetZoom = 16;
                    break;
                case 'pendidikan':
                    targetZoom = 12;
                    break;
                default:
                    targetZoom = 16;
                    break;
            }
            
                map.setCenter({ lat: defaultLatCenter, lng: defaultLngCenter });
                map.setZoom(targetZoom);
            }
        });

        currentMarkers.push(marker);
        infoWindows.push(infoWindow);
    }

    // Clear all markers from map and reset arrays
    function clearMarkers() {
        currentMarkers.forEach(marker => {
            marker.map = null; // Detach marker from map
        });
        currentMarkers = []; // Clear array

        // Close and clear all info windows
        infoWindows.forEach(iw => iw.close());
        infoWindows = []; // Clear array
    }

    // Filter markers by category
    function filterCategory(category) {

        let targetLat = defaultLatCenter; 
        let targetLng = defaultLngCenter;
        let targetZoom = defaultZoom;

        if(category === 'pendidikan') {
            targetZoom = 12; 
        }
        showLoading();
        currentCategory = category; // Update current category

        // Set peta ke pusat dan zoom yang baru
        if (map) { 
            map.setCenter({ lat: targetLat, lng: targetLng });
            map.setZoom(targetZoom);
        }

        // Update active state of category buttons
        document.querySelectorAll(".category-btn").forEach((btn) => {
            btn.classList.remove("active");
        });
        document.querySelector(`[data-category="${category}"]`).classList.add("active");

        // Use a slight delay for smoother transition and to ensure loading indicator is seen
        setTimeout(() => {
            clearMarkers(); // Clear existing markers

            // Get AdvancedMarkerElement after it's been imported in initMap
            google.maps.importLibrary("marker").then(({AdvancedMarkerElement}) => {
                data[category].forEach((item) => {
                    createMarker(item, category, AdvancedMarkerElement); // Pass AdvancedMarkerElement
                });
            });

            updateInfoPanel(category); // Update side panel
            hideLoading(); // Hide loading indicator
        }, 300); // Reduced delay for quicker response
    }

    // Update info panel content based on category
    function updateInfoPanel(category) {
        const filterData = document.getElementById("filterData");
        const infoPanel = document.getElementById("infoPanel");
        const panelTitle = document.getElementById("panelTitle");
        const statsContent = document.getElementById("statsContent");
        const categoryData = data[category];

        const icons = {
            pendidikan: "fas fa-graduation-cap",
            peternakan: "fas fa-cow", // Consistent icon for info panel
            pertanian: "fas fa-seedling",
        };

        const titles = {
            pemerintahan: "Info Pemerintahan",
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

        // filterData.classList.add("show");
        infoPanel.classList.add("show"); // Ensure info panel is visible

    }

    // Show loading indicator
    function showLoading() {
        const loadingElement = document.getElementById("loading");
        if (loadingElement) {
            loadingElement.style.display = "block";
        }
    }

    // Hide loading indicator
    function hideLoading() {
        const loadingElement = document.getElementById("loading");
        if (loadingElement) {
            loadingElement.style.display = "none";
        }
    }

    // Fullscreen functionality
    function toggleFullscreen() {
        const fullscreenIcon = document.getElementById("fullscreenIcon");
        const fullscreenTooltip = document.getElementById("fullscreenTooltip");
        const fullscreenToggle = document.getElementById("fullscreenToggle");

        if (!document.fullscreenElement) { // Check browser's fullscreen state
            // Enter fullscreen
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        } else {
            // Exit fullscreen
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
        // UI updates are handled by handleFullscreenChange event listener
    }

    // Listen for fullscreen change events from browser
    document.addEventListener("fullscreenchange", handleFullscreenChange);
    document.addEventListener("webkitfullscreenchange", handleFullscreenChange);
    document.addEventListener("mozfullscreenchange", handleFullscreenChange);
    document.addEventListener("MSFullscreenChange", handleFullscreenChange);

    function handleFullscreenChange() {
        const fullscreenIcon = document.getElementById("fullscreenIcon");
        const fullscreenTooltip = document.getElementById("fullscreenTooltip");
        const fullscreenToggle = document.getElementById("fullscreenToggle");

        // Check if currently in fullscreen
        const isCurrentlyFullscreen = document.fullscreenElement || document.webkitFullscreenElement ||
                                      document.mozFullScreenElement || document.msFullscreenElement;
        
        isFullscreen = isCurrentlyFullscreen; // Update internal state

        if (isFullscreen) {
            fullscreenIcon.className = "fas fa-compress";
            fullscreenTooltip.textContent = "Keluar Layar Penuh";
            fullscreenToggle.classList.add("active");
        } else {
            fullscreenIcon.className = "fas fa-expand";
            fullscreenTooltip.textContent = "Mode Layar Penuh";
            fullscreenToggle.classList.remove("active");
        }

        // Trigger map resize after fullscreen state changes
        setTimeout(() => {
            if (map) { // Ensure map is initialized
                google.maps.event.trigger(map, 'resize');
            }
        }, 100);
    }

    // ESC key to exit fullscreen (already handled by browser for native fullscreen)
    // This part might be redundant as native fullscreen handles ESC, but good as a fallback
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape" && isFullscreen) {
            // No need to call toggleFullscreen() here, browser handles exit
            // If you had custom fullscreen, you would call it
        }
    });
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ciH1POERPcBC50HdxVN3h1Ts2bIWSOQ&callback=initMap&libraries=marker"
    async
    defer
></script>
    </body>
</html>
