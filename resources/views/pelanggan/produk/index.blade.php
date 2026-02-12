<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk | UsahaKita</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-white min-h-screen text-zinc-900 font-sans">

    <!-- NAVBAR COMPONENT -->
    <x-navbar :cart-count="$cartCount" />
    
    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-8 py-12 space-y-14">

        <!-- HEADER -->
        <div class="mt-6">
            <h1 class="text-3xl font-semibold tracking-tight">
                Semua Produk
            </h1>
            <p class="text-zinc-500 mt-2 text-sm">
                Jelajahi produk UMKM pilihan dengan kualitas terbaik
            </p>
        </div>

        <!-- PRODUK GRID -->
        @if($produkTersedia->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @foreach($produkTersedia as $produk)
                    <div class="bg-white rounded-2xl border border-zinc-300 hover:border-zinc-900 shadow-sm hover:shadow-lg transition duration-300">

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

</body>
</html>
