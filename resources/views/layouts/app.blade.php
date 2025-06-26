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
            background: #0d7866;
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

        .nav-menu a:hover,
        .nav-menu a.active {
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
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
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
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
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

        .stat-icon.topics {
            background: #16a085;
        }

        .stat-icon.orgs {
            background: #138d75;
        }

        .stat-icon.datasets {
            background: #0d7866;
        }

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
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
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

        .tag.open-data {
            background: #e3f2fd;
            color: #1976d2;
        }

        .tag.dataset {
            background: #fff3e0;
            color: #f57c00;
        }

        .tag.excel {
            background: #f3e5f5;
            color: #7b1fa2;
        }

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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .topic-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
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
    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @stack('styles')
</head>

<body>
    @include('components.navbar')

    @yield('content')

    @include('components.footer')

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
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>
