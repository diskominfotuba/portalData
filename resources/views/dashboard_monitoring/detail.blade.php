<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monitoring | Kabupaten Tulang Bawang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('assets_monitoring/css/style.css') }}" rel="stylesheet" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Dashboard Monitoring, Kabupaten Tulang Bawang</h2>
            <row>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-secondary" onclick="toggleFullScreen()">
                        <i class="bi bi-arrows-fullscreen"></i> Full Screen
                    </button>
                    <a href="{{ route('dashboard-monitoring.index') }}" class="btn btn-secondary">
                        <i class="bi bi-globe2"></i> Kembali ke Beranda
                    </a>
                </div>
            </row>
            <div class="d-flex align-items-center gap-3">
                <div id="tanggalWaktu"></div>
                <img src="images/tb_1.png" class="rounded-circle" width="30" />
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
            <div class="col-md-6">
                <div class="card glass info-box p-3 rounded-4">
                    <h6 class="text-dark mb-3">Jumlah Penduduk per Kecamatan</h6>
                    <canvas id="barChart" height="180"></canvas>
                </div>
                <div class="col-12 mt-5">
                    <div class="card glass info-box p-3 rounded-4">
                        <h6 class="text-dark mb-3">Peta Kabupaten Tulang Bawang</h6>
                        <div id="map" style="height: 320px; border-radius: 12px"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card glass info-box rounded-4">
                    <h6 class="text-dark mb-1">Rasio Jenis Kelamin</h6>
                    <canvas id="pieChart" height="180"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const barCtx = document.getElementById("barChart").getContext("2d");

        new Chart(barCtx, {
            type: "bar",
            data: {
                labels: [
                    "Menggala",
                    "Banjar Agung",
                    "Banjar Margo",
                    "Gedung Aji",
                    "Rawajitu Selatan",
                    "Gedung Meneng",
                    "Penawar Aji",
                    "Dente Teladas",
                    "Rawapitu",
                    "Meraksa Aji",
                ],
                datasets: [{
                    label: "Jumlah Penduduk",
                    data: [
                        52000, 48000, 45000, 30000, 27000, 34000, 36000, 25000, 29000,
                        31000,
                    ],
                    backgroundColor: "rgba(0, 123, 255, 0.6)",
                    borderColor: "rgba(0, 123, 255, 1)",
                    borderWidth: 1,
                }, ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${
                    context.dataset.label
                  }: ${context.raw.toLocaleString()} jiwa`;
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString(); // Format angka
                            },
                        },
                        title: {
                            display: true,
                            text: "Jumlah Penduduk",
                        },
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45,
                        },
                    },
                },
            },
        });

        const pieCtx = document.getElementById("pieChart").getContext("2d");
        new Chart(pieCtx, {
            type: "pie",
            data: {
                labels: ["Laki-laki", "Perempuan"],
                datasets: [{
                    data: [49, 51],
                    backgroundColor: ["#007bff", "#ffc107"],
                }, ],
            },
        });
    </script>
    <script>
        const map = L.map("map").setView([-4.1952, 105.6426], 9);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors",
        }).addTo(map);
        const icons = {
            normal: new L.Icon({
                iconUrl: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            }),
            waspada: new L.Icon({
                iconUrl: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            }),
        };

        const kecamatanData = [{
                nama: "Kec. Menggala",
                coords: [-4.485611, 105.239913],
                jumlah: 52000,
            },
            {
                nama: "Kec. Banjar Agung",
                coords: [-4.290148, 105.223917],
                jumlah: 48000,
            },
            {
                nama: "Kec. Banjar Margo",
                coords: [-4.217383, 105.295535],
                jumlah: 45000,
            },
            {
                nama: "Kec. Gedung Aji",
                coords: [-4.307413, 105.344076],
                jumlah: 30000,
            },
            {
                nama: "Kec. Rawajitu Selatan",
                coords: [-4.2281, 105.708701],
                jumlah: 27000,
            },
            {
                nama: "Kec. Gedung Meneng",
                coords: [-4.408353, 105.491368],
                jumlah: 34000,
            },
            {
                nama: "Kec. Penawar Aji",
                coords: [-4.269767, 105.501002],
                jumlah: 36000,
            },
            {
                nama: "Kec. Dente Teladas",
                coords: [-4.490761, 105.804333],
                jumlah: 25000,
            },
            {
                nama: "Kec. Rawapitu",
                coords: [-4.309896, 105.588873],
                jumlah: 29000,
            },
            {
                nama: "Kec. Meraksa Aji",
                coords: [-4.26807, 105.427553],
                jumlah: 31000,
            },
        ];

        // Tambahkan marker untuk tiap kecamatan
        kecamatanData.forEach((kec) => {
            const icon = icons[kec.jumlah] || icons.normal;

            L.marker(kec.coords, {
                    icon: icon
                })
                .addTo(map)
                .bindPopup(`<strong>${kec.nama}</strong><br>Jumlah: ${kec.jumlah}`);
        });

        // Marker pusat kabupaten (jika perlu ditonjolkan)
        L.marker([-4.1952, 105.6426], {
                icon: icons.normal
            })
            .addTo(map)
            .bindPopup("<strong>Kabupaten Tulang Bawang</strong>");
    </script>

    <script>
        function updateTanggalWaktu() {
            const hari = [
                "Minggu",
                "Senin",
                "Selasa",
                "Rabu",
                "Kamis",
                "Jumat",
                "Sabtu",
            ];
            const bulan = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ];

            const now = new Date();
            const namaHari = hari[now.getDay()];
            const tanggal = now.getDate();
            const namaBulan = bulan[now.getMonth()];
            const tahun = now.getFullYear();
            const jam = now.getHours().toString().padStart(2, "0");
            const menit = now.getMinutes().toString().padStart(2, "0");

            const teksTanggal = `${namaHari}, ${tanggal} ${namaBulan} ${tahun} ${jam}:${menit}`;
            document.getElementById("tanggalWaktu").textContent = teksTanggal;
        }

        updateTanggalWaktu();
        setInterval(updateTanggalWaktu, 60000);
    </script>

    <script>
        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch((err) => {
                    alert(`Gagal masuk full screen: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        }
    </script>
</body>

</html>
