<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satu Data Kabupaten Tulang Bawang - Portal Data</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .header {
            background: transparent;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            background: rgba(22, 160, 133, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #16a085;
            border-radius: 8px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover, .nav-menu a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .hero-section {
            text-align: center;
            padding: 4rem 2rem;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(rgba(22, 160, 133, 0.8), rgba(19, 141, 117, 0.8)), 
                        url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(22, 160, 133, 0.7), rgba(19, 141, 117, 0.7));
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            z-index: 1;
        }

        .search-container {
            min-width: 960px;
            margin: 0 auto;
            position: relative;
        }

        .search-wrapper {
            display: flex;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .search-dropdown {
            background: #f8f9fa;
            border: none;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            min-width: 120px;
            cursor: pointer;
        }

        .search-input {
            flex: 1;
            border: none;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            outline: none;
        }

        .search-btn {
            background: #16a085;
            border: none;
            padding: 1rem 2rem;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .search-btn:hover {
            background: #138d75;
        }

        .stats-section {
            max-width: 1200px;
            margin: 4rem auto 0;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.topics { background: #16a085; }
        .stat-icon.orgs { background: #138d75; }
        .stat-icon.datasets { background: #0d7866; }

        .stat-content h3 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .stat-content p {
            color: #666;
            font-size: 1.1rem;
        }

        .content-section {
            background: white;
            margin-top: 4rem;
            padding: 4rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 3rem;
            font-weight: bold;
        }

        .dataset-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .dataset-card {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 2rem;
            display: flex;
            gap: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .dataset-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .dataset-icon {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, #16a085, #138d75);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .dataset-content h4 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .dataset-tags {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .tag {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .tag.open-data { background: #e3f2fd; color: #1976d2; }
        .tag.dataset { background: #fff3e0; color: #f57c00; }
        .tag.excel { background: #f3e5f5; color: #7b1fa2; }

        .dataset-desc {
            color: #666;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .topics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
        }

        .topic-card {
            background: white;
            border-radius: 12px;
            padding: 2rem 1rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .topic-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .topic-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            background: linear-gradient(135deg, #16a085, #138d75);
            color: white;
        }

        .topic-card h5 {
            color: #333;
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .hero-section {
                min-height: 100vh;
                padding: 2rem 1rem;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .dataset-grid {
                grid-template-columns: 1fr;
            }
            
            .dataset-card {
                flex-direction: column;
                text-align: center;
            }
            
            .topics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .footer {
            background: #0d7866;
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h4 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: #FFF;
            font-weight: bold;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.8rem;
        }

        .footer-section ul li a {
            color: #b8e6d1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: white;
        }

        .footer-about {
            line-height: 1.6;
            color: #b8e6d1;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .footer-logo-icon {
            width: 50px;
            height: 50px;
            background: #16a085;
            border-radius: 10px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .footer-logo-text {
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .footer-bottom {
            border-top: 1px solid #138d75;
            padding-top: 2rem;
            text-align: center;
            color: #b8e6d1;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: #16a085;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: white;
            color: #16a085;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">
                  <img src="{{ asset('assets/img/logo-tulang-bawang.png') }}" alt="logo tulang bawang" width="30">
                </div>
                <div>
                    <div>Portal Data</div>
                    <div style="font-size: 0.8rem; font-weight: normal;">KABUPATEN TULANG BAWANG</div>
                </div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Open Data</a></li>
                    <li><a href="#">Statistik Sektoral</a></li>
                    <li><a href="#">SPLD</a></li>
                </ul>
            </nav>
        </div>
    </header>

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

     <footer class="footer">
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                          <img src="{{ asset('assets/img/logo-tulang-bawang.png') }}" alt="logo tulang bawang" width="30">
                        </div>
                        <div class="footer-logo-text">Portal Data <br/>Tulang Bawang</div>
                    </div>
                    <p class="footer-about">
                        Portal resmi data terbuka Pemerintah Kabupaten Tulang Bawang. Menyediakan akses mudah ke berbagai dataset, statistik, dan informasi publik untuk mendukung transparansi dan inovasi.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">📘</a>
                        <a href="#" class="social-link">🐦</a>
                        <a href="#" class="social-link">📸</a>
                        <a href="#" class="social-link">💼</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Kategori Data</h4>
                    <ul>
                        <li><a href="#">Pemerintahan</a></li>
                        <li><a href="#">Kependudukan</a></li>
                        <li><a href="#">Perekonomian</a></li>
                        <li><a href="#">Lingkungan</a></li>
                        <li><a href="#">Transportasi</a></li>
                        <li><a href="#">Kesehatan</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Bantuan & Informasi</h4>
                    <ul>
                        <li><a href="#">Cara Menggunakan</a></li>
                        <li><a href="#">API Documentation</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kontak Kami</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 Pemerintah Kabupaten Tulang Bawang. Semua hak dilindungi undang-undang.</p>
                <p>Dikembangkan dengan ❤️ oleh TIM IT Dinas Komunikasi dan Informatika untuk transparansi dan akuntabilitas publik</p>
            </div>
        </div>
    </footer>

    <script>
        // Add some interactivity
        document.querySelectorAll('.stat-card, .dataset-card, .topic-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Search functionality
        document.querySelector('.search-btn').addEventListener('click', function() {
            const searchTerm = document.querySelector('.search-input').value;
            if (searchTerm) {
                alert(`Mencari: ${searchTerm}`);
            }
        });

        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('.search-btn').click();
            }
        });
    </script>
</body>
</html>