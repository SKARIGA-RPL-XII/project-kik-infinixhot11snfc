<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjual | UsahaKita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-100 min-h-screen flex items-center justify-center p-6 font-[Poppins]">

<div class="relative bg-white rounded-[48px] 
            shadow-[0_40px_120px_rgba(0,0,0,0.12)] 
            overflow-hidden w-full max-w-7xl min-h-[85vh] p-12">

    <!-- Decorative Accent -->
    <div class="absolute top-0 right-0 h-full w-1/3 
                bg-black/95 rounded-l-[220px] hidden lg:block"></div>

    <!-- Header -->
    <div class="relative z-10 mb-14">
        <h1 class="text-3xl font-semibold tracking-wide text-gray-900">
            Selamat Datang,
            <span class="font-light text-gray-500">
                {{ Auth::user()->name }}
            </span>
        </h1>
        <p class="text-gray-500 text-sm mt-2">
            Kelola performa usaha Anda secara profesional dan efisien
        </p>
    </div>

    <!-- Statistics -->
    <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <div class="bg-white rounded-3xl p-8 
                    shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                    transition duration-300 hover:-translate-y-2">

            <p class="text-gray-400 text-sm tracking-wide">
                Total Produk
            </p>
            <h2 class="text-4xl font-bold mt-4 text-gray-900">
                {{ $totalProduk ?? 0 }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-8 
                    shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                    transition duration-300 hover:-translate-y-2">

            <p class="text-gray-400 text-sm tracking-wide">
                Produk Aktif
            </p>
            <h2 class="text-4xl font-bold mt-4 text-gray-900">
                {{ $produkAktif ?? 0 }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-8 
                    shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                    transition duration-300 hover:-translate-y-2">

            <p class="text-gray-400 text-sm tracking-wide">
                Total Pesanan
            </p>
            <h2 class="text-4xl font-bold mt-4 text-gray-900">
                {{ $totalPesanan ?? 0 }}
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-8 
                    shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                    transition duration-300 hover:-translate-y-2">

            <p class="text-gray-400 text-sm tracking-wide">
                Pendapatan
            </p>
            <h2 class="text-4xl font-bold mt-4 text-gray-900">
                Rp {{ number_format($pendapatan ?? 0, 0, ',', '.') }}
            </h2>
        </div>

    </div>

    <!-- Menu Section -->
    <div class="relative z-10 mt-16 
                bg-white rounded-3xl p-10
                shadow-[0_25px_80px_rgba(0,0,0,0.08)]">

        <h3 class="text-xl font-semibold text-gray-900 mb-8 tracking-wide">
            Manajemen Usaha
        </h3>

        <div class="flex flex-wrap gap-5">

            @if (!$usaha)
                <a href="{{ route('usaha.create') }}"
                   class="px-8 py-3 rounded-full bg-black text-white 
                          text-sm tracking-wider font-medium
                          transition duration-300
                          hover:bg-gray-800 hover:scale-105
                          shadow-lg">
                    Buat Usaha
                </a>

                <span class="text-sm text-gray-500 self-center">
                    Buat usaha terlebih dahulu sebelum menambahkan produk
                </span>
            @else
                <a href="{{ route('penjual.produk.index') }}"
                   class="px-8 py-3 rounded-full bg-black text-white 
                          text-sm tracking-wider font-medium
                          transition duration-300
                          hover:bg-gray-800 hover:scale-105
                          shadow-lg">
                    Kelola Produk
                </a>
            @endif

            @if (Route::has('penjual.pesanan.index'))
                <a href="{{ route('penjual.pesanan.index') }}"
                   class="px-8 py-3 rounded-full border border-gray-300 
                          text-gray-900 text-sm tracking-wider font-medium
                          transition duration-300
                          hover:bg-gray-100 hover:scale-105">
                    Lihat Pesanan
                </a>
            @endif

            <a href="{{ route('penjual.profil') }}"
               class="px-8 py-3 rounded-full border border-gray-300 
                      text-gray-900 text-sm tracking-wider font-medium
                      transition duration-300
                      hover:bg-gray-100 hover:scale-105">
                Profil Toko
            </a>

        </div>

    </div>

</div>

</body>
</html>
