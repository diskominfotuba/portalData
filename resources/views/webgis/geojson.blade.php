<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Tulang Bawang - Google Maps</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #7f8c8d;
            margin: 5px 0;
        }
        
        #map {
            height: 600px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid #34495e;
        }
        
        .info-panel {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .info-panel h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        
        .loading {
            text-align: center;
            padding: 50px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🗺️ Peta Stunting Kecamatan Tulang Bawang</h1>
        <p><strong>Provinsi:</strong> Lampung, Indonesia</p>
        <p><strong>Sumber Data Geografis:</strong> HDX-BPS-2020 | <strong>Data Stunting:</strong> Dinas Kesehatan</p>
    </div>
    
    <div id="map">
        <div class="loading">
            <p>Memuat peta... Pastikan koneksi internet aktif dan API key Google Maps valid.</p>
        </div>
    </div>
    
    <div class="info-panel">
        <h3>📊 Legenda Stunting</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; margin-bottom: 15px;">
            <div style="display: flex; align-items: center; padding: 8px; background: #fff; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div style="width: 20px; height: 20px; background: #2ECC71; margin-right: 10px; border-radius: 3px;"></div>
                <span><strong>Rendah:</strong> &lt; 5%</span>
            </div>
            <div style="display: flex; align-items: center; padding: 8px; background: #fff; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div style="width: 20px; height: 20px; background: #F1C40F; margin-right: 10px; border-radius: 3px;"></div>
                <span><strong>Rendah-Sedang:</strong> 5% - 9.9%</span>
            </div>
            <div style="display: flex; align-items: center; padding: 8px; background: #fff; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div style="width: 20px; height: 20px; background: #F39C12; margin-right: 10px; border-radius: 3px;"></div>
                <span><strong>Sedang:</strong> 10% - 19.9%</span>
            </div>
            <div style="display: flex; align-items: center; padding: 8px; background: #fff; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div style="width: 20px; height: 20px; background: #E74C3C; margin-right: 10px; border-radius: 3px;"></div>
                <span><strong>Tinggi:</strong> ≥ 20%</span>
            </div>
        </div>
    </div>

    <div class="info-panel">
        <h3>📍 Ranking Stunting per Kecamatan</h3>
        <div id="stunting-ranking">
            <div style="max-height: 300px; overflow-y: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead style="background: #f8f9fa; position: sticky; top: 0;">
                        <tr>
                            <th style="padding: 8px; text-align: left; border-bottom: 2px solid #dee2e6;">Rank</th>
                            <th style="padding: 8px; text-align: left; border-bottom: 2px solid #dee2e6;">Kecamatan</th>
                            <th style="padding: 8px; text-align: center; border-bottom: 2px solid #dee2e6;">% Stunting</th>
                            <th style="padding: 8px; text-align: center; border-bottom: 2px solid #dee2e6;">Kasus</th>
                            <th style="padding: 8px; text-align: center; border-bottom: 2px solid #dee2e6;">Target</th>
                        </tr>
                    </thead>
                    <tbody id="ranking-body">
                        <!-- Will be filled by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="info-panel">
        <h3>📈 Statistik Keseluruhan</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
            <div style="text-align: center; padding: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: bold;">5.93%</div>
                <div style="font-size: 12px; opacity: 0.9;">Rata-rata Stunting</div>
            </div>
            <div style="text-align: center; padding: 15px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: bold;">1,505</div>
                <div style="font-size: 12px; opacity: 0.9;">Total Kasus</div>
            </div>
            <div style="text-align: center; padding: 15px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: bold;">25,369</div>
                <div style="font-size: 12px; opacity: 0.9;">Total Target</div>
            </div>
            <div style="text-align: center; padding: 15px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: bold;">15</div>
                <div style="font-size: 12px; opacity: 0.9;">Kecamatan</div>
            </div>
        </div>
    </div>

    <script>
        // Data stunting berdasarkan kecamatan
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

        // Variabel global untuk menyimpan data GeoJSON
        let tulangbawangData = null;
        let map;
        let infoWindow;

        // Fungsi untuk memuat data GeoJSON dari file eksternal
        async function loadGeoJSONData() {
            try {
                // Ganti 'tulangbawang.json' dengan nama file GeoJSON Anda
                const response = await fetch('{{ asset('json/tulangbawang.geojson') }}');
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error loading GeoJSON data:', error);
                
                // Fallback: gunakan data sample jika file tidak ditemukan
                return {
                    "type": "FeatureCollection",
                    "name": "Tulangbawang's District",
                    "crs": {
                        "type": "name",
                        "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" }
                    },
                    "features": [
                        {
                            "type": "Feature",
                            "properties": {
                                "country_code": "id",
                                "country": "Indonesia",
                                "province_code": "id18",
                                "province": "Lampung",
                                "regency_code": "id1808",
                                "regency": "Tulangbawang",
                                "district_code": "id1808031",
                                "district": "Banjar Margo",
                                "village_code": "id1808031007",
                                "village": "Agung Dalem",
                                "source": "HDX-BPS-2020",
                                "date": "2019-12-20",
                                "valid_on": "2020-04-01"
                            },
                            "geometry": {
                                "type": "MultiPolygon",
                                "coordinates": [
                                    [
                                        [
                                            [105.26486060000008, -4.22092379999998],
                                            [105.26538840000006, -4.221118499999932],
                                            [105.26672060000004, -4.221444499999961],
                                            [105.26786870000007, -4.220983199999978],
                                            [105.269677, -4.246078699999941],
                                            [105.27379880000007, -4.246238399999925],
                                            [105.27401390000006, -4.24760079999993],
                                            [105.28535670000008, -4.247002799999962],
                                            [105.28572360000004, -4.25195],
                                            [105.27900250000005, -4.252605499999959],
                                            [105.27922010000003, -4.254782099999943],
                                            [105.27640130000003, -4.254347799999948],
                                            [105.27618610000007, -4.252638499999932],
                                            [105.26468840000007, -4.253468399999974],
                                            [105.26465320000005, -4.255550599999935],
                                            [105.265045, -4.269758299999978],
                                            [105.23209580000008, -4.26978779999996],
                                            [105.23229440000006, -4.27023939999998],
                                            [105.23205150000007, -4.27041429999997],
                                            [105.23024370000007, -4.271715799999924],
                                            [105.22875110000007, -4.268222299999934],
                                            [105.23080290000007, -4.26684819999997],
                                            [105.22877750000004, -4.262243],
                                            [105.22932880000008, -4.262370899999951],
                                            [105.23283410000005, -4.261481699999933],
                                            [105.23918540000005, -4.254861499999947],
                                            [105.25334760000004, -4.254213099999959],
                                            [105.25851060000008, -4.24003579999993],
                                            [105.26189880000004, -4.230731499999933],
                                            [105.26179650000006, -4.221762499999954],
                                            [105.261774, -4.219785299999955],
                                            [105.26486060000008, -4.22092379999998]
                                        ]
                                    ]
                                ]
                            }
                        }
                    ]
                };
            }
        }

        async function initMap() {
            // Muat data GeoJSON terlebih dahulu
            tulangbawangData = await loadGeoJSONData();
            
            if (!tulangbawangData || !tulangbawangData.features || tulangbawangData.features.length === 0) {
                console.error('Data GeoJSON kosong atau tidak valid');
                return;
            }
            // Hitung center dari koordinat polygon
            const bounds = new google.maps.LatLngBounds();
            const coords = tulangbawangData.features[0].geometry.coordinates[0][0];
            
            coords.forEach(coord => {
                bounds.extend(new google.maps.LatLng(coord[1], coord[0]));
            });

            const center = bounds.getCenter();

            // Inisialisasi peta
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: center,
                mapTypeId: 'hybrid', // Menampilkan satelit dengan label
                styles: [
                    {
                        featureType: "all",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#ffffff" }]
                    },
                    {
                        featureType: "all",
                        elementType: "labels.text.stroke",
                        stylers: [{ color: "#000000" }, { weight: 2 }]
                    }
                ]
            });

            // Inisialisasi InfoWindow
            infoWindow = new google.maps.InfoWindow();

            // Proses setiap feature dalam GeoJSON
            tulangbawangData.features.forEach(feature => {
                processFeature(feature);
            });

            // Fit peta ke bounds
            map.fitBounds(bounds);
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

            // Event listener untuk polygon
            polygon.addListener('click', (e) => {
                infoWindow.setContent(infoContent);
                infoWindow.setPosition(e.latLng);
                infoWindow.open(map);
            });

            // Hover effects dengan info stunting
            polygon.addListener('mouseover', (e) => {
                polygon.setOptions({
                    fillOpacity: 0.9,
                    strokeWeight: 3,
                    strokeColor: '#333333'
                });
                
                // Tampilkan tooltip sederhana
                if (stuntingInfo) {
                    const tooltip = `${districtName}: ${stuntingInfo.percentage}% stunting`;
                    polygon.setOptions({ title: tooltip });
                }
            });

            polygon.addListener('mouseout', () => {
                polygon.setOptions({
                    fillOpacity: 0.7,
                    strokeWeight: 1.5,
                    strokeColor: '#FFFFFF'
                });
            });
        }

        // Fungsi alternatif untuk membuat label dengan div overlay
        function createDistrictLabelOverlay(center, districtName, features) {
            console.log(`Creating overlay label for: ${districtName}`);
            
            class TextOverlay extends google.maps.OverlayView {
                constructor(position, text) {
                    super();
                    this.position = position;
                    this.text = text;
                    this.div = null;
                }

                onAdd() {
                    this.div = document.createElement('div');
                    this.div.style.position = 'absolute';
                    this.div.style.background = 'rgba(255, 255, 255, 0.8)';
                    this.div.style.border = '1px solid #333';
                    this.div.style.borderRadius = '3px';
                    this.div.style.padding = '2px 6px';
                    this.div.style.fontSize = '14px';
                    this.div.style.fontWeight = 'bold';
                    this.div.style.fontFamily = 'Arial, sans-serif';
                    this.div.style.color = '#333';
                    this.div.style.whiteSpace = 'nowrap';
                    this.div.style.cursor = 'pointer';
                    this.div.innerHTML = this.text;
                    
                    const panes = this.getPanes();
                    panes.overlayLayer.appendChild(this.div);
                    
                    // Click handler
                    this.div.addEventListener('click', () => {
                        const villageCount = features.length;
                        const villageNames = features.map(f => f.properties.village).filter(v => v).join(', ');
                        const sampleProps = features[0].properties;
                        
                        const districtInfoContent = `
                            <div style="max-width: 350px; font-family: Arial, sans-serif;">
                                <h3 style="margin: 0 0 10px 0; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px;">
                                    🏛️ Kecamatan ${districtName}
                                </h3>
                                <div style="line-height: 1.6;">
                                    <p><strong>📊 Jumlah Desa/Kelurahan:</strong> ${villageCount}</p>
                                    ${sampleProps.regency ? `<p><strong>🏙️ Kabupaten:</strong> ${sampleProps.regency}</p>` : ''}
                                    ${sampleProps.province ? `<p><strong>🗺️ Provinsi:</strong> ${sampleProps.province}</p>` : ''}
                                    ${sampleProps.district_code ? `<p><strong>🔢 Kode Kecamatan:</strong> ${sampleProps.district_code}</p>` : ''}
                                    <hr style="margin: 10px 0; border: 1px solid #ecf0f1;">
                                    <p><strong>🏘️ Desa/Kelurahan:</strong></p>
                                    <div style="max-height: 150px; overflow-y: auto; background: #f8f9fa; padding: 8px; border-radius: 4px; font-size: 12px;">
                                        ${villageNames || 'Tidak ada data nama desa'}
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        infoWindow.setContent(districtInfoContent);
                        infoWindow.setPosition(center);
                        infoWindow.open(map);
                    });
                }

                draw() {
                    const overlayProjection = this.getProjection();
                    const position = overlayProjection.fromLatLngToDivPixel(this.position);
                    
                    if (this.div) {
                        this.div.style.left = (position.x - this.div.offsetWidth / 2) + 'px';
                        this.div.style.top = (position.y - this.div.offsetHeight / 2) + 'px';
                    }
                }

                onRemove() {
                    if (this.div) {
                        this.div.parentNode.removeChild(this.div);
                        this.div = null;
                    }
                }
            }
            
            const overlay = new TextOverlay(center, districtName);
            overlay.setMap(map);
            return overlay;
        }

        // Fungsi untuk membuat label kecamatan (hanya satu per kecamatan)
        function createDistrictLabel(center, districtName, features) {
            // Debug: log informasi label
            console.log(`Creating label for: ${districtName} at position:`, center.lat(), center.lng());
            
            // Coba marker dulu
            const marker = new google.maps.Marker({
                position: center,
                map: map,
                title: `Kecamatan ${districtName}`,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 0,
                    fillOpacity: 0,
                    strokeWeight: 0
                },
                label: {
                    text: districtName,
                    color: '#1a1a1a',
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: 'Arial, sans-serif'
                },
                zIndex: 2000,
                optimized: false
            });

            // Jika marker tidak terlihat, gunakan overlay sebagai fallback
            setTimeout(() => {
                if (!marker.getVisible()) {
                    console.log(`Marker not visible for ${districtName}, creating overlay`);
                    createDistrictLabelOverlay(center, districtName, features);
                    marker.setMap(null); // Remove invisible marker
                }
            }, 1000);

            // Debug: konfirmasi marker berhasil dibuat
            console.log(`Marker created for ${districtName}:`, marker);

            // Info content untuk kecamatan (ringkasan semua desa)
            const villageCount = features.length;
            const villageNames = features.map(f => f.properties.village).filter(v => v).join(', ');
            const sampleProps = features[0].properties;
            
            const districtInfoContent = `
                <div style="max-width: 350px; font-family: Arial, sans-serif;">
                    <h3 style="margin: 0 0 10px 0; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px;">
                        🏛️ Kecamatan ${districtName}
                    </h3>
                    <div style="line-height: 1.6;">
                        <p><strong>📊 Jumlah Desa/Kelurahan:</strong> ${villageCount}</p>
                        ${sampleProps.regency ? `<p><strong>🏙️ Kabupaten:</strong> ${sampleProps.regency}</p>` : ''}
                        ${sampleProps.province ? `<p><strong>🗺️ Provinsi:</strong> ${sampleProps.province}</p>` : ''}
                        ${sampleProps.district_code ? `<p><strong>🔢 Kode Kecamatan:</strong> ${sampleProps.district_code}</p>` : ''}
                        <hr style="margin: 10px 0; border: 1px solid #ecf0f1;">
                        <p><strong>🏘️ Desa/Kelurahan:</strong></p>
                        <div style="max-height: 150px; overflow-y: auto; background: #f8f9fa; padding: 8px; border-radius: 4px; font-size: 12px;">
                            ${villageNames || 'Tidak ada data nama desa'}
                        </div>
                        <hr style="margin: 10px 0; border: 1px solid #ecf0f1;">
                        <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
                            Klik polygon desa untuk detail lebih lanjut
                        </p>
                    </div>
                </div>
            `;

            // Event listener untuk marker kecamatan
            marker.addListener('click', () => {
                infoWindow.setContent(districtInfoContent);
                infoWindow.setPosition(center);
                infoWindow.open(map);
            });

            // Return marker untuk debugging
            return marker;
        }

        // Event listener untuk menutup InfoWindow saat klik pada peta
        function setupMapClickListener() {
            map.addListener('click', () => {
                infoWindow.close();
            });
        }

        // Panggil setupMapClickListener setelah peta diinisialisasi
        window.addEventListener('load', () => {
            setTimeout(setupMapClickListener, 1000);
        });
    </script>
    
    <!-- 
    PENTING: Ganti YOUR_API_KEY dengan API key Google Maps yang valid
    Untuk mendapatkan API key:
    1. Kunjungi https://console.cloud.google.com/
    2. Buat project baru atau pilih project yang ada
    3. Aktifkan Maps JavaScript API
    4. Buat credentials (API key)
    5. Ganti YOUR_API_KEY di URL di bawah
    -->
    <script async defer 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ciH1POERPcBC50HdxVN3h1Ts2bIWSOQ&callback=initMap&libraries=geometry">
    </script>
    
    <div style="margin-top: 20px; padding: 15px; background: #fff3cd; border-radius: 5px; border-left: 4px solid #ffc107;">
        <h4 style="margin-top: 0; color: #856404;">⚠️ Petunjuk Penggunaan:</h4>
        <ol style="margin-bottom: 0; color: #856404;">
            <li>Ganti <code>YOUR_API_KEY</code> dengan API key Google Maps yang valid</li>
            <li>Simpan data GeoJSON Anda dalam file bernama <code>tulangbawang.json</code></li>
            <li>Letakkan file JSON di folder yang sama dengan file HTML ini</li>
            <li>Pastikan server web dijalankan (tidak bisa dibuka langsung dengan file://, gunakan http://localhost)</li>
            <li>Untuk testing lokal, bisa gunakan: <code>python -m http.server 8000</code> atau Live Server di VS Code</li>
        </ol>
    </div>

    <div style="margin-top: 15px; padding: 15px; background: #d4edda; border-radius: 5px; border-left: 4px solid #28a745;">
        <h4 style="margin-top: 0; color: #155724;">✅ Alternatif Cara Load Data:</h4>
        <p style="margin-bottom: 0; color: #155724; font-size: 14px;">
            <strong>1. File JSON eksternal:</strong> <code>fetch('tulangbawang.json')</code><br>
            <strong>2. URL online:</strong> <code>fetch('https://example.com/data.json')</code><br>
            <strong>3. Copy-paste manual:</strong> Ganti kode di <code>loadGeoJSONData()</code>
        </p>
    </div>
</body>
</html>