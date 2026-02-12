<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda | UsahaKita</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-white min-h-screen text-zinc-900 font-sans">

    <!-- NAVBAR COMPONENT -->
    <x-navbar :cart-count="$cartCount" />

    <div class="max-w-7xl mx-auto px-8 py-12 space-y-14">

        <!-- HEADER WELCOME -->
        <div class="mt-6">
            <h1 class="text-3xl font-semibold tracking-tight">
                Selamat datang, {{ Auth::user()->name }}
            </h1>
            <p class="text-zinc-500 mt-2 text-sm">
                Jelajahi produk UMKM pilihan dengan kualitas terbaik
            </p>
        </div>

        <!-- PROMO EVENT / HITAM PUTIH -->
        <div class="space-y-6">

            <h2 class="text-xl font-semibold tracking-tight">
                Promo & Event Spesial
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <!-- Promo Card -->
                <div class="bg-zinc-900 text-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="{{ asset('images/promo1.jpg') }}" class="w-full h-40 object-cover" alt="Promo Makanan">
                    <div class="p-4 space-y-2">
                        <h3 class="font-bold text-lg">Diskon 20% Makanan Pedas</h3>
                        <p class="text-sm text-zinc-300">Nikmati hidangan pedas favoritmu dengan harga spesial!</p>
                        <span class="inline-block bg-white text-zinc-900 px-3 py-1 rounded-full text-xs font-medium">Berlaku hari ini</span>
                    </div>
                </div>

                <div class="bg-zinc-800 text-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="{{ asset('images/promo2.jpg') }}" class="w-full h-40 object-cover" alt="Promo Minuman">
                    <div class="p-4 space-y-2">
                        <h3 class="font-bold text-lg">Gratis Minuman</h3>
                        <p class="text-sm text-zinc-300">Dapatkan minuman gratis setiap pembelian paket utama.</p>
                        <span class="inline-block bg-white text-zinc-900 px-3 py-1 rounded-full text-xs font-medium">Promo minggu ini</span>
                    </div>
                </div>

                <div class="bg-zinc-900 text-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="{{ asset('images/promo3.jpg') }}" class="w-full h-40 object-cover" alt="Promo Dessert">
                    <div class="p-4 space-y-2">
                        <h3 class="font-bold text-lg">Dessert Spesial 15%</h3>
                        <p class="text-sm text-zinc-300">Manjakan diri dengan dessert favorit dengan diskon menarik.</p>
                        <span class="inline-block bg-white text-zinc-900 px-3 py-1 rounded-full text-xs font-medium">Hanya weekend</span>
                    </div>
                </div>

                <div class="bg-zinc-800 text-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="{{ asset('images/promo4.jpg') }}" class="w-full h-40 object-cover" alt="Promo Paket">
                    <div class="p-4 space-y-2">
                        <h3 class="font-bold text-lg">Paket Hemat Keluarga</h3>
                        <p class="text-sm text-zinc-300">Nikmati paket hemat untuk 4 orang dengan harga spesial.</p>
                        <span class="inline-block bg-white text-zinc-900 px-3 py-1 rounded-full text-xs font-medium">Promo bulan ini</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- PRODUK -->
        <div class="space-y-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-semibold tracking-tight">
                    Produk Tersedia
                </h3>
            </div>

            @if($produkTersedia->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                    @foreach($produkTersedia as $produk)
                        <div class="bg-white rounded-2xl border border-zinc-300 hover:border-zinc-800 shadow-sm hover:shadow-lg transition duration-300">

                            <!-- Image -->
                            <div class="overflow-hidden rounded-t-2xl">
                                <img
                                    src="{{ $produk->gambar ? asset('uploads/produk/'.$produk->gambar) : asset('images/no-image.png') }}"
                                    class="w-full h-56 object-cover"
                                    alt="{{ $produk->nama_produk }}">
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-3">
                                <h4 class="font-medium text-lg truncate">
                                    {{ $produk->nama_produk }}
                                </h4>

                                <p class="text-lg font-semibold">
                                    Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                </p>

                                <p class="text-sm text-zinc-500">
                                    Stok: {{ $produk->stok }} {{ $produk->satuan }}
                                </p>

                                <form action="{{ route('pelanggan.cart.add', $produk->id_produk) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="w-full mt-4 py-2.5 rounded-full border border-zinc-900 text-zinc-900 hover:bg-zinc-900 hover:text-white transition duration-300 text-sm font-medium">
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 text-zinc-500">
                    Belum ada produk tersedia.
                </div>
            @endif
        </div>

    </div>

</body>
</html>
