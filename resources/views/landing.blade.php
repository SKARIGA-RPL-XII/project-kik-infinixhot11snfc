<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UsahaKita | Solusi Penjualan UMKM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f5f5;
            overflow-x: hidden;
        }

        /* ================= HERO ================= */

        .hero-wrapper {
            background: white;
            border-radius: 30px;
            margin: 40px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.1);
        }

        .hero {
            display: flex;
            align-items: center;
            min-height: 85vh;
        }

        .hero-left {
            flex: 1;
            padding: 80px;
        }

        .hero-left h1 {
            font-size: 48px;
            font-weight: 700;
            color: #111;
            line-height: 1.2;
        }

        .hero-left p {
            margin-top: 20px;
            font-size: 18px;
            color: #666;
            max-width: 450px;
        }

        .btn-main {
            margin-top: 30px;
            display: inline-block;
            padding: 14px 36px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-main:hover {
            background: #333;
            transform: translateY(-3px);
        }

        /* ================= RIGHT SIDE ================= */

        .hero-right {
            flex: 1;
            background: #111;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 120px;
        }

        .hero-right img {
            width: 75%;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        /* ================= FEATURES ================= */

        .features {
            padding: 80px 60px;
            text-align: center;
        }

        .features h2 {
            font-size: 32px;
            margin-bottom: 40px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
        }

        .feature {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .feature:hover {
            transform: translateY(-5px);
        }

        .feature h5 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .feature p {
            color: #666;
            font-size: 14px;
        }

        footer {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 992px) {
            .hero {
                flex-direction: column;
            }

            .hero-left {
                padding: 50px 30px;
                text-align: center;
            }

            .hero-left p {
                margin: auto;
            }

            .hero-right {
                border-radius: 0;
                padding: 40px 0;
            }
        }

    </style>
</head>
<body>

<div class="hero-wrapper">

    <section class="hero">
        
        <!-- LEFT -->
        <div class="hero-left">
            <h1>Freshness<br>In Every Business</h1>
            <p>
                Platform digital modern untuk membantu UMKM mengelola produk,
                transaksi, dan laporan secara efisien dengan sistem berbasis Laravel.
            </p>

            <a href="/login" class="btn-main">Get Started</a>
        </div>

        <!-- RIGHT -->
        <div class="hero-right">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c"
                 alt="Business Image">
        </div>

    </section>

</div>

<section class="features">
    <h2>Why Choose Us?</h2>

    <div class="feature-grid">
        <div class="feature">
            <h5>Product Management</h5>
            <p>Kelola produk dengan sistem terstruktur dan mudah digunakan.</p>
        </div>

        <div class="feature">
            <h5>Transaction System</h5>
            <p>Proses penjualan cepat dengan monitoring real-time.</p>
        </div>

        <div class="feature">
            <h5>Automatic Reports</h5>
            <p>Laporan penjualan otomatis dan akurat.</p>
        </div>

        <div class="feature">
            <h5>Multi Role</h5>
            <p>Admin, Penjual, dan Pelanggan dalam satu platform.</p>
        </div>
    </div>
</section>

<footer>
    © {{ date('Y') }} UsahaKita — Elegant Digital Platform
</footer>

</body>
</html>
