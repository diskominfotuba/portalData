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

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Deklarasi variabel global untuk peta dan marker
    let map;
    let markers = [];
    let geojsonLayer;
    // Menyimpan status panel info
    let infoPanelState = {}; 

    // Fungsi untuk membuat dan menginisialisasi peta Leaflet
    function initMap() {

        const defaultLatCenter = -4.493986;
        const defaultLngCenter = 105.224569;
        const center = [defaultLatCenter, defaultLngCenter];

        map = L.map("map", {
            zoomControl: false,
        }).setView(center, 12);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
            maxZoom: 19,
        }).addTo(map);

        L.control.zoom({
            position: "bottomright",
        }).addTo(map);

        if (typeof getData === "function") {
            getData();
        }

        map.on('click', () => {
            map.closePopup();
        });
    }

    // Jalankan fungsi initMap saat halaman dimuat
    document.addEventListener("DOMContentLoaded", initMap);

    async function getData(category = "pemerintahan") {
        let fetchUrl;

        switch (category) {
            case "pemerintahan":
                fetchUrl = "{{ asset('json/pemerintahan.json') }}";
                break;
            case "pendidikan":
                fetchUrl = "{{ asset('json/sekolah.json') }}";
                break;
            case "stunting":
                fetchUrl = "{{ asset('json/tulangbawang.geojson') }}";
                break;
            default:
                alert('Data belum tersedia!');
                return;
        }

        try {
            showLoading();

            const response = await fetch(fetchUrl);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const responseData = await response.json();
            const categoryData = category === 'stunting' ? responseData : responseData.data;

            clearMap();

            if (category !== 'stunting') {
                addMarkersToMapWithCustomUI(categoryData, category);
            } else {
                processGeoJSON(responseData);
            }

            hideLoading();
            updateInfoPanel(responseData, category);
        } catch (error) {
            hideLoading();
            console.error("Error loading data:", error);
            document.getElementById('statsContent').innerHTML = 
                '<div class="error">Error memuat data: ' + error.message + '</div>';
        }
    }

    // Fungsi untuk membersihkan peta dari marker dan layer GeoJSON
    function clearMap() {
        markers.forEach(markerObj => {
            map.removeLayer(markerObj.marker);
        });
        markers = [];
        
        if (geojsonLayer) {
            map.removeLayer(geojsonLayer);
        }
    }

    // Fungsi untuk memperbarui panel informasi di sidebar
    function updateInfoPanel(data, category) {
        const infoPanel = document.getElementById("infoPanel");
        const panelTitle = document.getElementById("panelTitle");
        const statsContent = document.getElementById("statsContent");
        const stuntingPanel = document.getElementById("stuntingPanel");
        const filterButtons = document.querySelectorAll('.filter-btn');

        filterButtons.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.category === category);
        });

        stuntingPanel.style.display = (category === 'stunting') ? 'flex' : 'none';

        const icons = {
            pemerintahan: "fa-regular fa-building",
            pendidikan: "fas fa-graduation-cap",
            stunting: "fas fa-heartbeat"
        };

        panelTitle.innerHTML = `<i class="${icons[category] || ''}"></i> ${data.message || ''}`;

        if (category === "pendidikan" || category === "pemerintahan") {
            const names = {};
            (data.data || []).forEach(item => {
                names[item.name] = true;
            });

            statsContent.innerHTML = `
                <div class="stat-item">
                    <span>Total Lokasi</span>
                    <strong>${data.data ? data.data.length : 0}</strong>
                </div>
                ${Object.keys(names).map(name => `
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item" style="border: 1px solid #ddd; border-radius: 5px;">${name}</li>
                    </ul>
                `).join('')}
            `;
        } else if (category === 'stunting') {
            const stuntingDataFromResponse = data.stuntingData || stuntingData; 
            statsContent.innerHTML = `
                <div class="stat-item">
                    <span>Total Lokasi</span>
                    <strong>${Object.keys(stuntingDataFromResponse).length}</strong>
                </div>
                <ul class="list-group list-group-flush">
                    ${Object.entries(stuntingDataFromResponse).map(([name, val]) => `
                        <li class="list-group-item d-flex justify-content-between align-items-center mt-2" style="border: 1px solid #ddd; border-radius: 5px;">
                            ${name}
                            <span style="color: ${getStuntingColor(val.percentage)}">${val.percentage}%</span>
                        </li>
                    `).join('')}
                </ul>
            `;
        } else {
            statsContent.innerHTML = '<div class="stat-item">Data tidak tersedia</div>';
        }
        infoPanel.classList.add("show");
    }

    // Fungsi untuk mengganti kategori data
    function filterCategory(category) {
        getData(category);
    }

    // Fungsi untuk membuat elemen HTML SVG sebagai ikon
    function getSVGIcon(category) {
        const icons = {
            'pendidikan': `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="marker-icon-svg"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>`,
            'pemerintahan': `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="marker-icon-svg"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>`,
        };
        return icons[category] || icons['pendidikan'];
    }

    // Fungsi untuk membuat DivIcon kustom Leaflet
    function createCustomDivIcon(category) {
        return L.divIcon({
            className: '',
            html: createCustomMarkerElement(category).outerHTML,
            iconSize: [36, 54],
            iconAnchor: [18, 54],
            popupAnchor: [0, -54],
        });
    }

    // Fungsi untuk membuat elemen HTML marker kustom
    function createCustomMarkerElement(category = 'pendidikan') {
        const markerDiv = document.createElement('div');
        markerDiv.className = `custom-marker-icon marker-${category}`;
        markerDiv.style.cssText = `
            margin-left: -18px;
            margin-top: -54px;
            width: 36px;
            height: 54px;
            position: relative;
            background: transparent;
            border: none;
        `;
        markerDiv.innerHTML = `
            <div class="marker-shadow"></div>
            <div class="marker-tail-outline"></div>
            <div class="marker-tail"></div>
            <div class="marker-circle">
                ${getSVGIcon(category)}
            </div>
        `;
        return markerDiv;
    }

    // Fungsi untuk membuat konten popup dengan ikon yang dinamis
    const popupIcons = {
        pemerintahan: "fa-regular fa-building",
        pendidikan: "fas fa-graduation-cap",
        stunting: "fas fa-heartbeat"
    };

    function createEnhancedInfoContent(location, category) {
        const iconClass = popupIcons[category] || popupIcons.pemerintahan;
        let details = '';

        // Tambahkan detail spesifik untuk kategori pendidikan
        if (category === 'pendidikan') {
            details = `
                ${location.npsn ? `<p  style="margin: 0; line-height: 1.8;"><strong>🔢 NPSN:</strong> ${location.npsn}</p>` : ''}
                ${location.level ? `<p  style="margin: 0; line-height: 1.8;"><strong>🎓 Tingkat:</strong> ${location.level}</p>` : ''}
                ${location.status ? `<p  style="margin: 0; line-height: 1.8;"><strong>📜 Status:</strong> ${location.status}</p>` : ''}
                ${location.kelurahan ? `<p  style="margin: 0; line-height: 1.8;"><strong>🏘️ Kelurahan:</strong> ${location.kelurahan}</p>` : ''}
                ${location.alamat ? `<p  style="margin: 0; line-height: 1.8;"><strong>📍 Alamat:</strong> ${location.alamat}</p>` : ''}
            `;
        } else {
            // Tampilkan detail umum untuk kategori lain
            details = `
                ${location.alamat ? `<p><strong>📍 Alamat:</strong> ${location.alamat}</p>` : 'Alamat belum di set'}
            `;
        }

        return `
            <div style="max-width: 350px; font-family: Arial, sans-serif;">
                <h5 style="margin: 0 0 10px 0; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px;">
                    <i class="${iconClass}"></i> ${location.name || 'Lokasi Tidak Diketahui'}
                </h5>
                <div style="line-height: 1.6;">
                    ${details}
                    <hr style="margin: 10px 0; border: 1px solid #ecf0f1;">
                    <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
                        Klik pada peta untuk menutup info ini
                    </p>
                </div>
            </div>
        `;
    }

    // Fungsi untuk menambahkan efek pulse pada marker
    function addPulseEffect(markerId) {
        markers.forEach(markerObj => {
            const markerEl = markerObj.marker.getElement();
            if (markerEl) {
                const pin = markerEl.querySelector('.marker-tail'); 
                if (pin) pin.classList.remove('marker-pulse');
            }
        });

        const activeMarker = markers.find(m => m.id === markerId);
        if (activeMarker) {
            const markerEl = activeMarker.marker.getElement();
            if (markerEl) {
                const pin = markerEl.querySelector('.marker-tail');
                if (pin) pin.classList.add('marker-pulse');
            }
        }
    }

    // Fungsi untuk menambahkan marker ke peta dari data
    function addMarkersToMapWithCustomUI(data, category) {
        const bounds = L.latLngBounds();

        data.forEach(location => {
            const position = [parseFloat(location.lat), parseFloat(location.lng)];
            const icon = createCustomDivIcon(category);
            const marker = L.marker(position, {
                icon: icon,
                title: location.name
            }).addTo(map);

            const infoContent = createEnhancedInfoContent(location, category);
            marker.bindPopup(infoContent);

            marker.on('click', () => {
                addPulseEffect(location.id);
                // map.panTo(position);
                // if (map.getZoom() < 15) {
                //     map.setZoom(15);
                // }
            });

            markers.push({
                marker: marker,
                id: location.id,
                data: location
            });

            bounds.extend(position);
        });

        if (bounds.isValid()) {
            map.fitBounds(bounds);
        }
    }

    // Fungsi untuk memproses fitur GeoJSON
    function processGeoJSON(data) {
        geojsonLayer = L.geoJSON(data, {
            style: function(feature) {
                const properties = feature.properties;
                const districtName = properties.district;
                const stuntingInfo = stuntingData[districtName];
                let polygonColor = '#95A5A6';
                if (stuntingInfo) {
                    polygonColor = getStuntingColor(stuntingInfo.percentage);
                }
                return {
                    color: '#FFFFFF',
                    weight: 1.5,
                    fillColor: polygonColor,
                    fillOpacity: 0.7,
                };
            },
            onEachFeature: function(feature, layer) {
                const properties = feature.properties;
                const districtName = properties.district;
                const stuntingInfo = stuntingData[districtName];
                const infoContent = createGeoJSONInfoContent(properties, stuntingInfo);

                layer.bindPopup(infoContent);
            }
        }).addTo(map);
        map.fitBounds(geojsonLayer.getBounds());
    }

    // Fungsi untuk membuat konten popup GeoJSON
    function createGeoJSONInfoContent(properties, stuntingInfo) {
        const stuntingDisplay = stuntingInfo ? `
            <div style="background: #f8f9fa; padding: 10px; border-radius: 5px; margin: 10px 0;">
                <h4 style="margin: 0 0 8px 0; color: #e74c3c;">📊 Data Stunting</h4>
                <p style="margin: 3px 0;"><strong>Persentase Stunting:</strong> <span style="color: ${getStuntingColor(stuntingInfo.percentage)}; font-weight: bold; font-size: 16px;">${stuntingInfo.percentage}%</span></p>
                <p style="margin: 3px 0;"><strong>Kategori:</strong> <span style="color: ${getStuntingColor(stuntingInfo.percentage)}; font-weight: bold;">${getStuntingCategory(stuntingInfo.percentage)}</span></p>
            </div>
        ` : `
            <div style="background: #fff3cd; padding: 10px; border-radius: 5px; margin: 10px 0;">
                <p style="margin: 0; color: #856404;"><strong>⚠️ Data stunting tidak tersedia untuk kecamatan ini</strong></p>
            </div>
        `;

        return `
            <div style="max-width: 350px; font-family: Arial, sans-serif;">
                <h3 style="margin: 0 0 10px 0; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px;">
                    🏛️ ${properties.district || 'Kecamatan Tidak Diketahui'}
                </h3>
                ${stuntingDisplay}
            </div>
        `;
    }

    // Data stunting yang disiapkan (seperti di kode Google Maps)
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
        if (percentage >= 20) return '#E74C3C';
        if (percentage >= 10) return '#F39C12';
        if (percentage >= 5) return '#F1C40F';
        if (percentage > 0) return '#2ECC71';
        return '#95A5A6';
    }

    // Fungsi untuk mendapatkan kategori stunting
    function getStuntingCategory(percentage) {
        if (percentage >= 20) return 'Tinggi';
        if (percentage >= 10) return 'Sedang';
        if (percentage >= 5) return 'Rendah-Sedang';
        if (percentage > 0) return 'Rendah';
        return 'Tidak Ada Data';
    }

    // Fungsi untuk menampilkan loading spinner
    function showLoading() {
        const loadingElement = document.getElementById("loading");
        if (loadingElement) loadingElement.style.display = "block";
    }

    // Fungsi untuk menyembunyikan loading spinner
    function hideLoading() {
        const loadingElement = document.getElementById("loading");
        if (loadingElement) loadingElement.style.display = "none";
    }
</script>
</body>
</html>

