@extends('layouts.app')

@section('title', 'Beranda Pelanggan')

@section('content')
<div class="space-y-8">

    <!-- HEADER + KERANJANG -->
    <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Selamat Datang, {{ Auth::user()->name }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Temukan produk UMKM terbaik untukmu
            </p>
        </div>

        <!-- Tombol Keranjang -->
        <a href="{{ route('pelanggan.cart.index') }}"
           class="relative flex items-center gap-2 border border-black text-black
                  px-5 py-2 rounded-full hover:bg-black hover:text-white
                  transition duration-300">

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9" />
            </svg>

            <span class="font-medium">Keranjang</span>

            @if($cartCount > 0)
                <span
                    class="absolute -top-2 -right-2 bg-black text-white text-xs
                           w-6 h-6 flex items-center justify-center rounded-full">
                    {{ $cartCount }}
                </span>
            @endif
        </a>
    </div>

    <!-- BANNER -->
    <div class="bg-black text-white rounded-2xl p-6 shadow">
        <h2 class="text-xl font-semibold mb-1">Promo Hari Ini</h2>
        <p class="text-sm text-gray-300">
            Dukung UMKM lokal dengan produk berkualitas
        </p>
    </div>

    <!-- PRODUK -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">
            Produk Tersedia
        </h3>

        @if($produkTersedia->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($produkTersedia as $produk)
                    <div
                        class="border border-gray-200 rounded-2xl overflow-hidden
                               hover:shadow-xl transition duration-300 bg-white">

                        <!-- Gambar -->
                        <img
                            src="{{ $produk->gambar ? asset('uploads/produk/'.$produk->gambar) : asset('images/no-image.png') }}"
                            class="w-full h-40 object-cover grayscale hover:grayscale-0 transition duration-300"
                            alt="{{ $produk->nama_produk }}">

                        <!-- Detail -->
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 truncate">
                                {{ $produk->nama_produk }}
                            </h4>

                            <p class="text-black font-bold mt-1">
                                Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Stok: {{ $produk->stok }} {{ $produk->satuan }}
                            </p>

                            <form action="{{ route('pelanggan.cart.add', $produk->id_produk) }}" method="POST">
                                @csrf
                                <button
                                    type="submit"
                                    class="mt-4 w-full border border-black text-black py-2
                                           rounded-full hover:bg-black hover:text-white
                                           transition duration-300">
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-sm">
                Belum ada produk tersedia
            </p>
        @endif
    </div>

</div>
@endsection
