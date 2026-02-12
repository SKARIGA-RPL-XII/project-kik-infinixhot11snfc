<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda | UsahaKita</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-zinc-50 min-h-screen text-zinc-800">

<div class="max-w-7xl mx-auto px-8 py-12 space-y-14">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-semibold tracking-tight">
                Selamat datang, {{ Auth::user()->name }}
            </h1>
            <p class="text-zinc-500 mt-2 text-sm">
                Jelajahi produk UMKM pilihan dengan kualitas terbaik
            </p>
        </div>

        <!-- Cart -->
        <a href="{{ route('pelanggan.cart.index') }}"
           class="relative flex items-center gap-3 
                  px-6 py-2.5 rounded-full
                  border border-zinc-300
                  hover:border-zinc-800
                  hover:bg-zinc-900 hover:text-white
                  transition duration-300 text-sm font-medium">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9" />
            </svg>

            Keranjang

            @if($cartCount > 0)
                <span class="absolute -top-2 -right-2 
                             bg-zinc-900 text-white text-xs
                             w-5 h-5 flex items-center justify-center
                             rounded-full">
                    {{ $cartCount }}
                </span>
            @endif
        </a>

    </div>

    <!-- PROMO SECTION -->
    <div class="bg-zinc-900 text-white rounded-3xl px-10 py-12 shadow-sm">
        <h2 class="text-xl font-medium">
            Promo Spesial Hari Ini
        </h2>
        <p class="text-zinc-300 text-sm mt-2">
            Dukung UMKM lokal dan temukan produk berkualitas terbaik untuk kebutuhanmu.
        </p>
    </div>

    <!-- PRODUK -->
    <div>

        <div class="flex items-center justify-between mb-8">
            <h3 class="text-2xl font-semibold">
                Produk Tersedia
            </h3>
        </div>

        @if($produkTersedia->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">

                @foreach($produkTersedia as $produk)
                    <div class="bg-white rounded-2xl 
                                border border-zinc-200
                                hover:border-zinc-300
                                transition duration-300">

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
                                <button
                                    type="submit"
                                    class="w-full mt-4 py-2.5 
                                           rounded-full
                                           border border-zinc-800
                                           text-zinc-800
                                           hover:bg-zinc-900 hover:text-white
                                           transition duration-300 text-sm font-medium">
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
