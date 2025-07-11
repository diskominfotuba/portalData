@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <h1 class="hero-title">Portal Data Terpadu <br> Kabupaten Tulang Bawang</h1>
        <div class="search-container">
            <div class="search-wrapper">
                <select class="search-dropdown">
                    <option>Dataset</option>
                    <option>Topik</option>
                    <option>Organisasi</option>
                </select>
                <input type="text" class="search-input" placeholder="Dashboard, Topik, Organisasi, Dataset apa yang ingin dicari...">
                <button class="search-btn">🔍</button>
            </div>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon topics">💬</div>
                <div class="stat-content">
                    <h3>30</h3>
                    <p>Topik</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orgs">🏢</div>
                <div class="stat-content">
                    <h3>53</h3>
                    <p>Organisasi</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon datasets">📊</div>
                <div class="stat-content">
                    <h3>4640</h3>
                    <p>Dataset</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <h2 class="section-title">Pencarian Berdasarkan Dataset</h2>
            <div class="dataset-grid">
                <div class="dataset-card">
                    <div class="dataset-icon">📊</div>
                    <div class="dataset-content">
                        <h4>Data Indeks Standar Pencemar Udara (ISPU) di Provi...</h4>
                        <div class="dataset-tags">
                            <span class="tag open-data">Open Data</span>
                            <span class="tag dataset">Dataset</span>
                            <span class="tag excel">Excel</span>
                        </div>
                        <p class="dataset-desc">Data ini berisikan Data Indeks Standar Pencemar Udara (ISPU), Indeks Standar Pencemar Udara (ISPU) merupakan angka tanpa sat...</p>
                    </div>
                </div>

                <div class="dataset-card">
                    <div class="dataset-icon">🗑️</div>
                    <div class="dataset-content">
                        <h4>Data Volume Pengangkutan Sampah di Kali Sungai Sit...</h4>
                        <div class="dataset-tags">
                            <span class="tag open-data">Open Data</span>
                            <span class="tag dataset">Dataset</span>
                            <span class="tag excel">Excel</span>
                        </div>
                        <p class="dataset-desc">Dataset ini berisi mengenai Data Volume Pengangkutan Sampah di Kali Sungai Situ Waduk Tahun 2021</p>
                    </div>
                </div>

                <div class="dataset-card">
                    <div class="dataset-icon">👥</div>
                    <div class="dataset-content">
                        <h4>Data Jumlah Pekerja/Buruh pada Perusahaan di Wilay...</h4>
                        <div class="dataset-tags">
                            <span class="tag open-data">Open Data</span>
                            <span class="tag dataset">Dataset</span>
                            <span class="tag excel">Excel</span>
                        </div>
                        <p class="dataset-desc">Jumlah pekerja dan nomor NPIP (Nomor Pendaftaran Perusahaan) pendaftaran kepesertaan BPJS Ketenagakerjaan oleh perusahaan yang...</p>
                    </div>
                </div>

                <div class="dataset-card">
                    <div class="dataset-icon">💰</div>
                    <div class="dataset-content">
                        <h4>Data Perkembangan Harga Eceran di Pasar Wilayah Ta...</h4>
                        <div class="dataset-tags">
                            <span class="tag open-data">Open Data</span>
                            <span class="tag dataset">Dataset</span>
                            <span class="tag excel">Excel</span>
                        </div>
                        <p class="dataset-desc">Dataset ini Berisi Data Perkembangan Harga Eceran di Pasar Wilayah</p>
                    </div>
                </div>
            </div>

            <h2 class="section-title">Pencarian Berdasarkan Topik Terpopuler</h2>
            <div class="topics-grid">
                <div class="topic-card">
                    <div class="topic-icon">👥</div>
                    <h5>Pekerjaan Umum</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">🌿</div>
                    <h5>Kehutanan, Pertanian & Ketahanan Pangan</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">📚</div>
                    <h5>Perpustakaan & Arsip</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">🏙️</div>
                    <h5>Penataan Kota</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">🚴</div>
                    <h5>Olahraga & Pemuda</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">📈</div>
                    <h5>Penanaman Modal</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">🏠</div>
                    <h5>Perumahan dan Kawasan Permukiman</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">🏛️</div>
                    <h5>Pemerintahan</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">🤝</div>
                    <h5>Kesatuan Bangsa & Politik</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">👨‍👩‍👧‍👦</div>
                    <h5>Kependudukan</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">🌳</div>
                    <h5>Pertamanan & Pemakaman</h5>
                </div>
                <div class="topic-card">
                    <div class="topic-icon">📊</div>
                    <h5>Perekonomian</h5>
                </div>
            </div>
        </div>
    </section>
@endsection


<!-- Elfsight AI Chatbot | Untitled AI Chatbot -->
<script src="https://static.elfsight.com/platform/platform.js" async></script>
<div class="elfsight-app-9954e14a-3889-4b73-8da4-6e5fb89473de" data-elfsight-app-lazy></div>




