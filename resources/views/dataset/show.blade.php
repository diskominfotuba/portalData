@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero text-center text-white bg-portal-primary py-5">
        <div class="container">
            <h1 class="display-5  mt-5 fw-bold">{{ $dataset->nama_data }}</h1>
            <div class="d-flex justify-content-center align-items-center my-4 text-white">
                <img src="https://ui-avatars.com/api/?name=Dinas+Kesehatan&size=48" alt="">
                <h4 class="ms-3 mb-0">{{ $dataset->nama_opd }}</h4>
            </div>
        </div>
    </section>

    <!-- Filter & Search Section -->
    <section class="filters py-5 bg-light">
        <div class="container">
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary active" id="data-tab" data-bs-toggle="tab"
                                    data-bs-target="#data-tab-pane" type="button" role="tab"
                                    aria-controls="data-tab-pane" aria-selected="true">Data</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-success" id="metadata-tab" data-bs-toggle="tab"
                                    data-bs-target="#metadata-tab-pane" type="button" role="tab"
                                    aria-controls="metadata-tab-pane" aria-selected="false">Metadata</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="data-tab-pane" role="tabpanel"
                                aria-labelledby="data-tab" tabindex="0">
                                <p class="fw-bold mt-3">Deskripsi Dataset</p>
                                <p>{{ $dataset->deskripsi }}</p>
                            </div>
                            <div class="tab-pane fade" id="metadata-tab-pane" role="tabpanel" aria-labelledby="metadata-tab"
                                tabindex="0">...p</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Datatables -->
    <section class="pb-5 bg-light">
        <div class="container">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="btnradio1">Tabel</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-success" for="btnradio2">Grafik</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn btn-outline-success" for="btnradio3">Peta</label>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Unduh Dataset
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Excel</a></li>
                            <li><a class="dropdown-item" href="#">CSV</a></li>
                            <li><a class="dropdown-item" href="#">API</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Unduh Sesuai Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Excel</a></li>
                            <li><a class="dropdown-item" href="#">CSV</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded shadow-sm">
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-12">
                        <table id="kumuhTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    @foreach (array_keys($records->first()->getAttributes()) as $column)
                                        @continue(in_array($column, ['id', 'latitude', 'longitude', 'dataset_riwayat_id', 'created_at', 'updated_at']))
                                        <th>{{ $column }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $row)
                                    <tr>
                                        @foreach ($row->getAttributes() as $key => $value)
                                            @continue(in_array($key, ['id', 'latitude', 'longitude', 'dataset_riwayat_id', 'created_at', 'updated_at']))
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <canvas id="kumuhChart" style="display: none; height: 100px;"></canvas>
                        <div id="kumuhMap" style="display: none; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <!-- Tableau JS API -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var dataTable = $('#kumuhTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });

            // Ambil data dari tabel
            var tahun = [],
                jumlah = [];
            $('#kumuhTable tbody tr').each(function() {
                var tds = $(this).find('td');
                tahun.push($(tds[4]).text());
                jumlah.push(parseInt($(tds[2]).text()));
            });

            // Inisialisasi Chart.js
            var ctx = document.getElementById('kumuhChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: tahun,
                    datasets: [{
                        label: 'Jumlah KK',
                        data: jumlah,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Inisialisasi Leaflet
            var map = L.map('kumuhMap').setView([-4.2, 105.6], 8); // Koordinat Tulang Bawang
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
            L.marker([-4.2, 105.6]).addTo(map)
                .bindPopup('Kabupaten Tulang Bawang')
                .openPopup();

            // Event radio button
            $('input[name="btnradio"]').on('change', function() {
                if ($('#btnradio1').is(':checked')) {
                    $('#kumuhTable_wrapper').show(); // DataTables wrapper
                    $('#kumuhChart').hide();
                    $('#kumuhMap').hide();
                } else if ($('#btnradio2').is(':checked')) {
                    $('#kumuhTable_wrapper').hide();
                    $('#kumuhChart').show();
                    $('#kumuhMap').hide();
                } else if ($('#btnradio3').is(':checked')) {
                    $('#kumuhTable_wrapper').hide();
                    $('#kumuhChart').hide();
                    $('#kumuhMap').show();
                    map.invalidateSize(); // Penting untuk perbaiki tampilan map
                }
            });
        });
    </script>
@endpush
