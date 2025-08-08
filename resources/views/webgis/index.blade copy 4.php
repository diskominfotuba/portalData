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
            #map {
                height: 100%;
                width: 100%;
                border-radius: 20px;
            }
        </style>
        @vite(['resources/css/webgis.css', 'resources/js/app.js'])
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
                            <i class="fa-regular fa-building"></i>
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
                        {{-- <button
                            class="category-btn peternakan"
                            onclick="filterCategory('peternakan')"
                            data-category="peternakan"
                        >
                            <i class="fas fa-horse"></i>
                            Peternakan
                        </button> --}}
                        <button
                            class="category-btn pertanian"
                            onclick="filterCategory('stunting')"
                            data-category="stunting"
                        >
                            <i class="fa-regular fa-address-book"></i>
                            Stanting
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

                <div class="stunting-legend-panel" id="stuntingPanel">
                     <span class="close-btn" onclick="closePanel()">×</span>
                    <div class="panel-header">
                        <h3 id="panelTitle">
                            Warna Berdasarkan Persentase Stunting
                        </h3>
                    </div>

                    <div class="color-legend">
                        <div class="color-item">
                            <div class="color-box" style="background: #2ECC71;"></div>
                            <div class="color-info">
                                <div class="color-label">Rendah</div>
                                <div class="color-range">&lt; 5%</div>
                            </div>
                        </div>
                        
                        <div class="color-item">
                            <div class="color-box" style="background: #F1C40F;"></div>
                            <div class="color-info">
                                <div class="color-label">Rendah-Sedang</div>
                                <div class="color-range">5% - 9.9%</div>
                            </div>
                        </div>
                        
                        <div class="color-item">
                            <div class="color-box" style="background: #F39C12;"></div>
                            <div class="color-info">
                                <div class="color-label">Sedang</div>
                                <div class="color-range">10% - 19.9%</div>
                            </div>
                        </div>
                        
                        <div class="color-item">
                            <div class="color-box" style="background: #E74C3C;"></div>
                            <div class="color-info">
                                <div class="color-label">Tinggi</div>
                                <div class="color-range">≥ 20%</div>
                            </div>
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
        let markers = [];
        let infoWindow;
        let data = [];
        let defaultLatCenter = -4.493986;
        let defaultLngCenter = 105.224569;

        // Inisialisasi Google Maps
        function initMap() {
            const center = { lat: defaultLatCenter, lng: defaultLngCenter };

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                // *** BAGIAN INI YANG PERLU DITAMBAHKAN ***
                mapId: 'YOUR_MAP_ID', // <-- GANTI DENGAN MAP ID MILIK ANDA
                // *** AKHIR BAGIAN YANG DITAMBAHKAN ***
                styles: [
                    {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{ visibility: "on" }]
                    }
                ],
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: false
            });

            infoWindow = new google.maps.InfoWindow();

            getData();
        }

        // Fungsi untuk mengambil data (disesuaikan dengan kode Anda)
        async function getData(category = "pemerintahan") {
            switch (category) {
                case "pemerintahan":
                        fetchUrl = await fetch("{{ asset('json/pemerintahan.json') }}");
                    break;
                case "pendidikan": 
                        fetchUrl = await fetch("{{ asset('json/sekolah.json') }}");
                    break;
                case "stunting": 
                        fetchUrl = await fetch("{{ asset('json/tulangbawang.geojson') }}");
                    break;
                default:
                    return alert('Data belum tersedia!');
                    break;
            }
            try {
                showLoading();
                const response = fetchUrl;
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const responseData = await response.json();

                data = responseData;

                if(category !== 'stunting') {
                    addMarkersToMapWithCustomUI(data.category);
                }else{
                    markers.forEach(marker => marker.marker.map = null);
                    markers = [];

                    data.features.forEach(feature => {
                        processFeature(feature);
                    });
                };

                hideLoading();
            } catch (error) {
                hideLoading();
                console.error("Error loading data:", error);
                document.getElementById('location-list').innerHTML = 
                    '<div class="error">Error memuat data: ' + error.message + '</div>';
            }
            updateInfoPanel(data);
        }

        // Update info panel content based on category
        function updateInfoPanel(data) {
            const filterData = document.getElementById("filterData");
            const infoPanel = document.getElementById("infoPanel");
            const panelTitle = document.getElementById("panelTitle");
            const statsContent = document.getElementById("statsContent");
            const stuntingPanel = document.getElementById("stuntingPanel");

            if(data.category === 'stunting') {
                 stuntingPanel.style.display = 'flex';
            }else {
                stuntingPanel.style.display = 'none';
            };

            const icons = {
                pemerintahan: "fa-regular fa-building",
                pendidikan: "fas fa-graduation-cap",
                peternakan: "fas fa-cow", // Consistent icon for info panel
                pertanian: "fas fa-seedling",
            };

            panelTitle.innerHTML = `<i class="${icons[data.category]}"></i> ${data.message}`;
            if (data.category === "pendidikan") {
  
                const names = {};
                data.data.forEach((item) => {
                    names[item.name] = true;
                });
                
                statsContent.innerHTML = `
                    <div class="stat-item">
                        <span>Total Lokasi</span>
                        <strong>${data.data.length}</strong>
                    </div>
                    <div class="stat-item">
                        <span>SD</span>
                        <strong>${data.data.filter(item => item.level === 'SD').length}</strong>
                    </div>
                    <div class="stat-item">
                        <span>SMP</span>
                        <strong>${data.data.filter(item => item.level === 'SMP').length}</strong>
                    </div>
                   ${Object.keys(names)
                    .map(
                        (name) =>
                        `
                        <ul class="list-group list-group">
                            <li class="list-group-item">${name}</li>
                        </ul>
                            `
                        )
                    .join("")}`;
            } else if(data.category === 'pemerintahan') {
                const names = {};
                data.data.forEach((item) => {
                names[item.name] = true;
                });

                statsContent.innerHTML = `
                <div class="stat-item">
                    <span>Total Lokasi</span>
                    <strong>${data.data.length}</strong>
                </div>
                ${Object.keys(names)
                    .map(
                    (name) =>
                     `
                     <ul class="list-group list-group">
                        <li class="list-group-item">${name}</li>
                    </ul>
                        `
                    )
                    .join("")}
                `;
            }else {
                const dataStunting = Object.keys(stuntingData);
                statsContent.innerHTML = `
                <div class="stat-item">
                    <span>Total Lokasi</span>
                    <strong>${Object.keys(stuntingData).length}</strong>
                </div>
                <ul class="list-group">
                    ${Object.entries(stuntingData)
                    .map(
                        ([name, data]) => `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            ${name}
                            <span style="color: ${getStuntingColor(data.percentage)}">${data.percentage}%</span>
                        </li>
                        `
                    )
                    .join("")}
                </ul>
                `;
            }

            infoPanel.classList.add("show"); 

        }

        // Filter markers by category
        function filterCategory(category) {
            getData(category);
        }

       function getSVGIcon(category) {
        const icons = {
            'pendidikan': `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="marker-icon-svg">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
            </svg>`,
            'pemerintahan': `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="marker-icon-svg">
                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                <path d="M10 6h4"></path>
                <path d="M10 10h4"></path>
                <path d="M10 14h4"></path>
                <path d="M10 18h4"></path>
            </svg>`,
            'peternakan': `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="marker-icon-svg">
                <path d="M18 6L6 18"></path>
                <path d="M6 6h.01"></path>
                <path d="M18 6h.01"></path>
                <path d="M20 4L8.12 15.88"></path>
                <path d="M14.47 14.48L20 20"></path>
                <path d="M8.12 8.12L12 12"></path>
            </svg>`,
            'pertanian': `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="marker-icon-svg">
                <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"></path>
                <path d="M12 12L13 18L15 14L18 15L14 12L18 9L15 10L13 6L12 12Z"></path>
            </svg>`
        };
        return icons[category] || icons['pendidikan'];
    }

    // Function to create custom marker element seperti contoh
    function createCustomMarkerElement(location, category = 'pendidikan') {
        const markerDiv = document.createElement('div');
        markerDiv.className = `custom-marker-icon marker-${category}`;
        markerDiv.style.cssText = `
            margin-left: -18px; 
            margin-top: -54px; 
            width: 36px; 
            height: 54px;
        `;
        
        markerDiv.innerHTML = `
            <div style="position: relative; width: 36px; height: 54px; background: transparent; border: none;">
                <!-- Shadow -->
                <div class="marker-shadow"></div>
                
                <!-- Tail outline (putih) -->
                <div class="marker-tail-outline"></div>
                
                <!-- Tail berwarna -->
                <div class="marker-tail"></div>
                
                <!-- Circle utama dengan icon -->
                <div class="marker-circle">
                    ${getSVGIcon(category)}
                </div>
            </div>
        `;
        
        return markerDiv;
    }

    // Enhanced info window content
    function createEnhancedInfoContent(location, category = 'pendidikan') {
        const categoryNames = {
            'pendidikan': 'Pendidikan',
            'pemerintahan': 'Pemerintahan',
            'peternakan': 'Peternakan',
            'pertanian': 'Pertanian'
        };
        
        const categoryColors = {
            'pendidikan': 'linear-gradient(135deg, #1e40af 0%, #3730a3 100%)',
            'pemerintahan': 'linear-gradient(135deg, #059669 0%, #047857 100%)',
            'peternakan': 'linear-gradient(135deg, #dc2626 0%, #b91c1c 100%)',
            'pertanian': 'linear-gradient(135deg, #16a34a 0%, #15803d 100%)'
        };
        
        return `
            <div style="max-width: 350px; font-family: Arial, sans-serif;">
                <h5 style="margin: 0 0 10px 0; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px;">
                    <i class="fa-regular fa-building"></i> ${location.name || 'Kecamatan Tidak Diketahui'}
                </h5>
                <div style="line-height: 1.6;">
                    ${location.address ? `<p><strong>🏘️ Alamat:</strong> ${location.address}</p>` : 'Belum di set'}
                    <hr style="margin: 10px 0; border: 1px solid #ecf0f1;">
                    <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
                        Klik pada peta untuk menutup info ini
                    </p>
                </div>
            </div>
        `;
    }

            // Function to add pulse effect to active marker
        // Function to add pulse effect to active marker
    function addPulseEffect(markerId) {
        // Remove pulse from all markers
        markers.forEach(markerObj => {
            const markerElement = markerObj.marker.content;
            if (markerElement) {
                markerElement.querySelector('.marker-pin').classList.remove('marker-pulse');
            }
        });

        // Add pulse to selected marker
        const activeMarker = markers.find(m => m.id === markerId);
        if (activeMarker && activeMarker.marker.content) {
            const markerElement = activeMarker.marker.content;
            markerElement.querySelector('.marker-pin').classList.add('marker-pulse');
        }
    }

    // Replace your existing addMarkersToMap function with this enhanced version
    function addMarkersToMapWithCustomUI(category) {
        // Clear existing markers
        markers.forEach(marker => marker.marker.map = null);
        markers = [];

        const bounds = new google.maps.LatLngBounds();

        data.data.forEach(location => {
            const position = {
                lat: parseFloat(location.lat),
                lng: parseFloat(location.lng)
            };

            // Create custom marker element
            const markerElement = createCustomMarkerElement(location, category);

            // Create advanced marker with custom element
            const marker = new google.maps.marker.AdvancedMarkerElement({
                position: position,
                map: map,
                title: location.name,
                content: markerElement
            });

            // Enhanced info window content
            const infoContent = createEnhancedInfoContent(location, 'pendidikan');

            // Add click listener with enhanced animations
            marker.addListener('click', () => {
                infoWindow.setContent(infoContent);
                infoWindow.open(map, marker);
                // highlightLocation(location.id);
                addPulseEffect(location.id);

                // Smooth zoom to marker
                map.panTo(position);
                if (map.getZoom() < 15) {
                    map.setZoom(15);
                }
            });

            markers.push({
                marker: marker,
                id: location.id,
                data: location
            });

            bounds.extend(position);
        });

        // Fit map to show all markers
        if (data.length > 0) {
            map.fitBounds(bounds);
        }
    }

    // Function to update markers based on category
    function updateMarkersForCategory(category) {
        markers.forEach(markerObj => {
            const markerElement = markerObj.marker.getContent();
            if (markerElement) {
                const pinElement = markerElement.querySelector('.marker-pin');
                const iconElement = markerElement.querySelector('.marker-icon');
                
                // Update pin color
                pinElement.className = `marker-pin marker-${category}`;
                
                // Update icon
                iconElement.className = `marker-icon ${getCategoryIcon(category)}`;
            }
        });
    }

    // Focus ke lokasi tertentu
    function focusLocation(id) {
        const markerObj = markers.find(m => m.id === id);
        if (markerObj) {
            map.setCenter(markerObj.marker.getPosition());
            map.setZoom(16);
            
            // Trigger click on marker
            google.maps.event.trigger(markerObj.marker, 'click');
            
            highlightLocation(id);
        }
    }

    // Highlight lokasi di sidebar
    function highlightLocation(id) {
        // Remove active class from all items
        document.querySelectorAll('.location-item').forEach(item => {
            item.classList.remove('active');
        });
        
        // Add active class to selected item
        const items = document.querySelectorAll('.location-item');
        const index = data.findIndex(loc => loc.id === id);
        if (index >= 0 && items[index]) {
            items[index].classList.add('active');
        }
    }

    //proses data geojson
    const stuntingData = {
            "Banjar Margo": { percentage: 12.53, cases: 307, target: 2450, category: "Sedang" },
            "Rawa Pitu": { percentage: 9.26, cases: 121, target: 1306, category: "Rendah" },
            "Menggala Timur": { percentage: 7.22, cases: 73, target: 1011, category: "Rendah" },
            "Dente Teladas": { percentage: 7.18, cases: 186, target: 2590, category: "Rendah" },
            "Penawar Aji": { percentage: 6.66, cases: 89, target: 1337, category: "Rendah" },
            "Penawar Tama": { percentage: 6.61, cases: 117, target: 1769, category: "Rendah" },
            "Menggala": { percentage: 6.17, cases: 164, target: 2659, category: "Rendah" },
            "Gedung Aji Baru": { percentage: 5.40, cases: 103, target: 1906, category: "Rendah" },
            "Banjar Agung": { percentage: 5.22, cases: 125, target: 2395, category: "Rendah" },
            "Gedung Aji": { percentage: 4.70, cases: 46, target: 978, category: "Rendah" },
            "Meraksa Aji": { percentage: 3.23, cases: 38, target: 1175, category: "Rendah" },
            "Gedung Meneng": { percentage: 3.14, cases: 63, target: 2006, category: "Rendah" },
            "Rawajitu Selatan": { percentage: 2.58, cases: 54, target: 2094, category: "Rendah" },
            "Rawajitu Timur": { percentage: 2.52, cases: 18, target: 715, category: "Rendah" },
            "Banjar Baru": { percentage: 0.10, cases: 1, target: 978, category: "Rendah" }
        };

        // Fungsi untuk mendapatkan warna berdasarkan persentase stunting
        function getStuntingColor(percentage) {
            if (percentage >= 20) return '#E74C3C';      // Merah - Tinggi
            if (percentage >= 10) return '#F39C12';      // Orange - Sedang
            if (percentage >= 5) return '#F1C40F';       // Kuning - Rendah-Sedang
            if (percentage > 0) return '#2ECC71';        // Hijau - Rendah
            return '#95A5A6';                            // Abu-abu - Tidak ada data
        }

        // Fungsi untuk mendapatkan kategori stunting
        function getStuntingCategory(percentage) {
            if (percentage >= 20) return 'Tinggi';
            if (percentage >= 10) return 'Sedang';
            if (percentage >= 5) return 'Rendah-Sedang';
            if (percentage > 0) return 'Rendah';
            return 'Tidak Ada Data';
        }

    function processFeature(feature) {
            const geometry = feature.geometry;
            const properties = feature.properties;

            if (geometry.type === 'MultiPolygon') {
                geometry.coordinates.forEach(polygonCoords => {
                    createPolygon(polygonCoords[0], properties);
                });
            } else if (geometry.type === 'Polygon') {
                createPolygon(geometry.coordinates[0], properties);
            }
        }

        function createPolygon(coordinates, properties) {
            // Konversi koordinat untuk Google Maps
            const path = coordinates.map(coord => ({
                lat: coord[1],
                lng: coord[0]
            }));

            // Dapatkan data stunting untuk kecamatan ini
            const districtName = properties.district;
            const stuntingInfo = stuntingData[districtName];
            
            // Tentukan warna berdasarkan data stunting
            let polygonColor = '#95A5A6'; // Default abu-abu
            if (stuntingInfo) {
                polygonColor = getStuntingColor(stuntingInfo.percentage);
            }

            const polygon = new google.maps.Polygon({
                paths: path,
                strokeColor: '#FFFFFF',
                strokeOpacity: 0.9,
                strokeWeight: 1.5,
                fillColor: polygonColor,
                fillOpacity: 0.7,
                map: map
            });

            // Info content untuk InfoWindow (detail desa/kelurahan dengan data stunting)
            const stuntingDisplay = stuntingInfo ? `
                <div style="background: #f8f9fa; padding: 10px; border-radius: 5px; margin: 10px 0;">
                    <h4 style="margin: 0 0 8px 0; color: #e74c3c;">📊 Data Stunting</h4>
                    <p style="margin: 3px 0;"><strong>Persentase Stunting:</strong> <span style="color: ${polygonColor}; font-weight: bold; font-size: 16px;">${stuntingInfo.percentage}%</span></p>
                    <p style="margin: 3px 0;"><strong>Kategori:</strong> <span style="color: ${polygonColor}; font-weight: bold;">${getStuntingCategory(stuntingInfo.percentage)}</span></p>
                    <p style="margin: 3px 0;"><strong>Kasus Stunting:</strong> ${stuntingInfo.cases} anak</p>
                    <p style="margin: 3px 0;"><strong>Target Balita:</strong> ${stuntingInfo.target} anak</p>
                    <p style="margin: 3px 0;"><strong>Rasio:</strong> ${stuntingInfo.cases}/${stuntingInfo.target}</p>
                </div>
            ` : `
                <div style="background: #fff3cd; padding: 10px; border-radius: 5px; margin: 10px 0;">
                    <p style="margin: 0; color: #856404;"><strong>⚠️ Data stunting tidak tersedia untuk desa ini</strong></p>
                </div>
            `;

            const infoContent = `
                <div style="max-width: 350px; font-family: Arial, sans-serif;">
                    <h3 style="margin: 0 0 10px 0; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px;">
                        🏛️ ${properties.district || 'Kecamatan Tidak Diketahui'}
                    </h3>
                    ${stuntingDisplay}
                    <div style="line-height: 1.6;">
                        ${properties.village ? `<p><strong>🏘️ Desa/Kelurahan:</strong> ${properties.village}</p>` : ''}
                        ${properties.regency ? `<p><strong>🏙️ Kabupaten:</strong> ${properties.regency}</p>` : ''}
                        ${properties.province ? `<p><strong>🗺️ Provinsi:</strong> ${properties.province}</p>` : ''}
                        ${properties.district_code ? `<p><strong>🔢 Kode Kecamatan:</strong> ${properties.district_code}</p>` : ''}
                        ${properties.village_code ? `<p><strong>🔢 Kode Desa:</strong> ${properties.village_code}</p>` : ''}
                        ${properties.source ? `<p><strong>📊 Sumber:</strong> ${properties.source}</p>` : ''}
                        ${properties.date ? `<p><strong>📅 Tanggal Data:</strong> ${new Date(properties.date).toLocaleDateString('id-ID')}</p>` : ''}
                        <hr style="margin: 10px 0; border: 1px solid #ecf0f1;">
                        <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
                            Klik pada peta untuk menutup info ini
                        </p>
                    </div>
                </div>
            `;

        }

    function closePanel()
    {
        const stuntingPanel = document.getElementById("stuntingPanel");
        stuntingPanel.style.display = 'none';
    }
    // Event listener untuk jQuery ready (jika ingin tetap menggunakan jQuery)
    $(document).ready(function() {
        console.log("Document ready");
    });

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

    // Event listener untuk menutup InfoWindow saat klik pada peta
    function setupMapClickListener() {
        map.addListener('click', () => {
            infoWindow.close();
        });
    }

    // // Panggil setupMapClickListener setelah peta diinisialisasi
    window.addEventListener('load', () => {
        setTimeout(setupMapClickListener, 1000);
    });
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ciH1POERPcBC50HdxVN3h1Ts2bIWSOQ&callback=initMap&&libraries=marker&v=beta"
    async
    defer
></script>
    </body>
</html>


