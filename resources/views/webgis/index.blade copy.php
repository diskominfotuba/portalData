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
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <!-- Kolom Video -->
                <div class="col-md-6">
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
                <div class="col-md-6">
                <p>
                    <strong>Deskripsi Video:</strong><br />
                    Ini adalah contoh deskripsi yang akan menyesuaikan ukuran layar.
                </p>
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ciH1POERPcBC50HdxVN3h1Ts2bIWSOQ&callback=initMap" async defer></script>
<script>
    let map;
    let currentMarkers = [];
    let currentCategory = "pendidikan";
    let isFullscreen = false;
    
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
                name: "SDN 2 Menggala",
                level: "SD",
                type: "Negeri",
                lat: -4.219,
                lng: 105.243,
                address: "Jl. Cendana",
                students: "320 siswa",
                established: "1978",
            },
            {
                name: "TK ABA Menggala",
                level: "TK",
                type: "Swasta",
                lat: -4.2145,
                lng: 105.238,
                address: "Jl. Dahlia",
                students: "85 siswa",
                established: "1995",
            },
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

    function initMap() {
        // Initialize map with custom styling
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -4.2165, lng: 105.235 },
            zoom: 12,
            zoomControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false,
            styles: [
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                }
            ]
        });

        // Add custom zoom control
        const zoomControlDiv = document.createElement('div');
        const zoomControl = new ZoomControl(zoomControlDiv, map);
        
        zoomControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(zoomControlDiv);

        // Initialize with education category
        setTimeout(() => {
            filterCategory("pendidikan");
        }, 100);
    }

    function ZoomControl(controlDiv, map) {
        const zoomInButton = document.createElement('div');
        const zoomOutButton = document.createElement('div');
        
        controlDiv.style.padding = '5px';
        
        // Set CSS for the control wrapper
        controlDiv.style.backgroundColor = 'white';
        controlDiv.style.borderRadius = '5px';
        controlDiv.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlDiv.style.cursor = 'pointer';
        controlDiv.style.margin = '10px';
        
        // Set CSS for the control interior
        zoomInButton.innerHTML = '+';
        zoomInButton.style.fontSize = '16px';
        zoomInButton.style.padding = '5px 10px';
        zoomInButton.style.color = 'rgb(25,25,25)';
        
        zoomOutButton.innerHTML = '-';
        zoomOutButton.style.fontSize = '16px';
        zoomOutButton.style.padding = '5px 10px';
        zoomOutButton.style.color = 'rgb(25,25,25)';
        zoomOutButton.style.borderTop = '1px solid #e6e6e6';
        
        controlDiv.appendChild(zoomInButton);
        controlDiv.appendChild(zoomOutButton);
        
        // Setup the click event listeners
        zoomInButton.addEventListener('click', function() {
            map.setZoom(map.getZoom() + 1);
        });
        
        zoomOutButton.addEventListener('click', function() {
            map.setZoom(map.getZoom() - 1);
        });
    }

    // Fullscreen functionality
    function toggleFullscreen() {
        const fullscreenIcon = document.getElementById("fullscreenIcon");
        const fullscreenTooltip = document.getElementById("fullscreenTooltip");
        const fullscreenToggle = document.getElementById("fullscreenToggle");

        if (!isFullscreen) {
            // Enter fullscreen
            fullscreenIcon.className = "fas fa-compress";
            fullscreenTooltip.textContent = "Keluar Layar Penuh";
            fullscreenToggle.classList.add("active");
            isFullscreen = true;

            // Request browser fullscreen API
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen().catch((err) => {
                    console.log("Fullscreen API not supported or denied");
                });
            } else if (document.documentElement.webkitRequestFullscreen) {
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

        // Trigger map resize after fullscreen toggle
        setTimeout(() => {
            google.maps.event.trigger(map, 'resize');
        }, 100);
    }

    // Listen for fullscreen change events
    document.addEventListener("fullscreenchange", handleFullscreenChange);
    document.addEventListener("webkitfullscreenchange", handleFullscreenChange);
    document.addEventListener("mozfullscreenchange", handleFullscreenChange);
    document.addEventListener("MSFullscreenChange", handleFullscreenChange);

    function handleFullscreenChange() {
        const fullscreenIcon = document.getElementById("fullscreenIcon");
        const fullscreenTooltip = document.getElementById("fullscreenTooltip");
        const fullscreenToggle = document.getElementById("fullscreenToggle");

        if (!document.fullscreenElement && 
            !document.webkitFullscreenElement && 
            !document.mozFullScreenElement && 
            !document.msFullscreenElement) {
            // Exited fullscreen
            fullscreenIcon.className = "fas fa-expand";
            fullscreenTooltip.textContent = "Mode Layar Penuh";
            fullscreenToggle.classList.remove("active");
            isFullscreen = false;

            setTimeout(() => {
                google.maps.event.trigger(map, 'resize');
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
        currentMarkers.forEach(marker => marker.setMap(null));
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

    function getMarkerIcon(category, level) {
        const colors = {
            pendidikan: '#4facfe',
            peternakan: '#43e97b',
            pertanian: '#fa709a'
        };
        
        const color = colors[category] || '#4facfe';
        
        return {
            path: google.maps.SymbolPath.CIRCLE,
            fillColor: color,
            fillOpacity: 1,
            strokeColor: 'white',
            strokeWeight: 2,
            scale: 8
        };
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
                const marker = new google.maps.Marker({
                    position: { lat: item.lat, lng: item.lng },
                    map: map,
                    icon: getMarkerIcon(category, item.level),
                    title: item.name
                });

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
                            <div><i class="fas fa-map-marker-alt"></i> ${item.address}</div>
                `;

                if (category === "pendidikan") {
                    popupContent += `
                            <div><i class="fas fa-users"></i> ${item.students}</div>
                            <div><i class="fas fa-calendar"></i> Didirikan ${item.established}</div>
                            <span class="popup-badge badge-${item.type.toLowerCase()}">${item.type}</span>
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

                const infoWindow = new google.maps.InfoWindow({
                    content: popupContent
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                    // Or show modal if preferred
                    // $("#exampleModal").modal("show");
                });

                currentMarkers.push(marker);
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
                const marker = new google.maps.Marker({
                    position: { lat: item.lat, lng: item.lng },
                    map: map,
                    icon: getMarkerIcon(currentCategory, item.level),
                    title: item.name
                });

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
                            <div><i class="fas fa-map-marker-alt"></i> ${item.address}</div>
                `;

                if (currentCategory === "pendidikan") {
                    popupContent += `
                            <div><i class="fas fa-users"></i> ${item.students}</div>
                            <div><i class="fas fa-calendar"></i> Didirikan ${item.established}</div>
                            <span class="popup-badge badge-${item.type.toLowerCase()}">${item.type}</span>
                    `;
                }

                popupContent += `
                        </div>
                    </div>
                `;

                const infoWindow = new google.maps.InfoWindow({
                    content: popupContent
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });

                currentMarkers.push(marker);
            }
        });
    });

    // Add custom CSS for map
    const style = document.createElement("style");
    style.textContent = `
        .gm-style .gm-style-iw-c {
            padding: 0 !important;
            max-width: 300px !important;
        }
        
        .gm-style .gm-style-iw-d {
            overflow: hidden !important;
        }
        
        .popup-content {
            padding: 12px;
            font-family: Arial, sans-serif;
        }
        
        .popup-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        
        .popup-details div {
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
        }
        
        .popup-details i {
            width: 16px;
            text-align: center;
            margin-right: 5px;
            color: #4facfe;
        }
        
        .popup-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            margin-top: 8px;
            color: white;
        }
        
        .badge-negeri {
            background-color: #4facfe;
        }
        
        .badge-swasta {
            background-color: #fa709a;
        }
    `;
    document.head.appendChild(style);
</script>
    </body>
</html>
