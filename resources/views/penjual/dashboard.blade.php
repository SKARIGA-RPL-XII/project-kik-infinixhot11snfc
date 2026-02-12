<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjual | UsahaKita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-100 min-h-screen flex font-[Poppins]">

    <!-- Sidebar -->
    <x-sidebar-penjual />

    <!-- Main Content -->
    <div class="flex-1 p-10">

        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-3xl font-semibold text-gray-900">
                Selamat Datang,
                <span class="font-light text-gray-500">
                    {{ Auth::user()->name }}
                </span>
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Kelola performa usaha Anda secara profesional dan efisien
            </p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-xl transition duration-300">
                <p class="text-gray-400 text-sm">Total Produk</p>
                <h2 class="text-4xl font-bold mt-4 text-gray-900">
                    {{ $totalProduk ?? 0 }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-xl transition duration-300">
                <p class="text-gray-400 text-sm">Produk Aktif</p>
                <h2 class="text-4xl font-bold mt-4 text-gray-900">
                    {{ $produkAktif ?? 0 }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-xl transition duration-300">
                <p class="text-gray-400 text-sm">Total Pesanan</p>
                <h2 class="text-4xl font-bold mt-4 text-gray-900">
                    {{ $totalPesanan ?? 0 }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-md hover:shadow-xl transition duration-300">
                <p class="text-gray-400 text-sm">Pendapatan</p>
                <h2 class="text-4xl font-bold mt-4 text-gray-900">
                    Rp {{ number_format($pendapatan ?? 0, 0, ',', '.') }}
                </h2>
            </div>

        </div>

        <!-- Manajemen -->
        <div class="mt-16 bg-white rounded-3xl p-10 shadow-md">

            <h3 class="text-xl font-semibold text-gray-900 mb-8">
                Manajemen Usaha
            </h3>

            <div class="flex flex-wrap gap-5">

                @if (!$usaha)
                    <a href="{{ route('usaha.create') }}"
                       class="px-8 py-3 rounded-full bg-black text-white text-sm font-medium
                              hover:bg-gray-800 transition duration-300">
                        Buat Usaha
                    </a>

                    <span class="text-sm text-gray-500 self-center">
                        Buat usaha terlebih dahulu sebelum menambahkan produk
                    </span>
                @else
                    <a href="{{ route('penjual.produk.index') }}"
                       class="px-8 py-3 rounded-full bg-black text-white text-sm font-medium
                              hover:bg-gray-800 transition duration-300">
                        Kelola Produk
                    </a>
                @endif

                @if (Route::has('penjual.pesanan.index'))
                    <a href="{{ route('penjual.pesanan.index') }}"
                       class="px-8 py-3 rounded-full border border-gray-300 text-gray-900 text-sm font-medium
                              hover:bg-gray-100 transition duration-300">
                        Lihat Pesanan
                    </a>
                @endif

                <a href="{{ route('penjual.profil') }}"
                   class="px-8 py-3 rounded-full border border-gray-300 text-gray-900 text-sm font-medium
                          hover:bg-gray-100 transition duration-300">
                    Profil Toko
                </a>

            </div>

        </div>

    </div>

</body>
</html>
