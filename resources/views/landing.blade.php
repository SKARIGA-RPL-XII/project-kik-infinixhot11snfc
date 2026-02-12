<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UsahaKita | Solusi Penjualan UMKM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ================= LOADING ================= */
        #loading {
            position: fixed;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, #e8f5e9, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader-container {
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .logo {
            font-size: 42px;
            font-weight: 700;
            color: #2e7d32;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 25px;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #c8e6c9;
            border-top: 6px solid #4caf50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: auto;
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        /* ================= LANDING ================= */
        body {
            background: linear-gradient(to right, #f7fbe7, #ffffff);
        }

        .hero {
            padding: 90px 0;
        }

        .hero h1 {
            font-size: 44px;
            font-weight: 700;
            color: #2e7d32;
        }

        .hero p {
            font-size: 18px;
            color: #555;
        }

        .btn-main {
            background: #4caf50;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
        }

        .feature {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
        }
    </style>
</head>
<body>

<!-- ================= LOADING SCREEN ================= -->
<div id="loading">
    <div class="loader-container">
        <div class="logo">UsahaKita</div>
        <div class="subtitle">Solusi Digital Penjualan UMKM</div>
        <div class="spinner"></div>
    </div>
</div>

<!-- ================= LANDING PAGE ================= -->
<div id="content" style="display:none;">

<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Solusi Modern<br>Manajemen Penjualan UMKM</h1>
                <p class="mt-3">
                    Platform penjualan online berbasis web untuk membantu UMKM
                    mengelola produk, transaksi, dan laporan secara efisien
                    menggunakan <b>Laravel 12</b>.
                </p>
                <a href="" class="btn-main mt-4 d-inline-block">
                    Mulai Sekarang
                </a>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/1170/1170576.png"
                     class="img-fluid" style="max-height: 360px">
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="feature">
                    <h5>Kelola Produk</h5>
                    <p class="text-muted">Manajemen produk UMKM lebih mudah</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature">
                    <h5>Transaksi</h5>
                    <p class="text-muted">Proses jual beli cepat & aman</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature">
                    <h5>Laporan</h5>
                    <p class="text-muted">Rekap penjualan otomatis</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature">
                    <h5>Multi User</h5>
                    <p class="text-muted">Admin & penjual terpisah</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-center text-muted py-4">
    © {{ date('Y') }} UsahaKita | Web Programming
</footer>

</div>

<script>
    // Loading selama 2.5 detik
    setTimeout(() => {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('content').style.display = 'block';
    }, 2500);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
