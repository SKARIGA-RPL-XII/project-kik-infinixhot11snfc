@extends('layouts.app') <!-- pastikan layout pakai Tailwind -->

@section('title', 'Dashboard Penjual')

@section('content')
    <div class="container mx-auto p-6">

        <h3 class="text-2xl font-semibold mb-6">👋 Selamat Datang, {{ Auth::user()->name }}</h3>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-lg shadow p-5 text-center">
                <h6 class="text-gray-500">Total Produk</h6>
                <h3 class="text-3xl font-bold">{{ $totalProduk ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-lg shadow p-5 text-center">
                <h6 class="text-gray-500">Produk Aktif</h6>
                <h3 class="text-3xl font-bold">{{ $produkAktif ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-lg shadow p-5 text-center">
                <h6 class="text-gray-500">Total Pesanan</h6>
                <h3 class="text-3xl font-bold">{{ $totalPesanan ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-lg shadow p-5 text-center">
                <h6 class="text-gray-500">Pendapatan</h6>
                <h3 class="text-3xl font-bold text-green-600">Rp {{ number_format($pendapatan ?? 0, 0, ',', '.') }}</h3>
            </div>

        </div>

        <!-- Menu Penjual -->
        <div class="bg-white rounded-lg shadow mt-8 p-5">
            <h4 class="font-semibold mb-4">Menu Penjual</h4>

            <div class="flex flex-wrap gap-3">

                {{-- Jika BELUM punya usaha --}}
                @if (!$usaha)
                    <a href="{{ route('usaha.create') }}"
                        class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition">
                        🏪 Buat Usaha
                    </a>

                    <span class="text-sm text-gray-500 self-center">
                        ⚠️ Buat usaha terlebih dahulu sebelum menambahkan produk
                    </span>
                @else
                    {{-- Jika SUDAH punya usaha --}}
                    <a href="{{ route('penjual.produk.index') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        📦 Kelola Produk
                    </a>
                @endif

                @if (Route::has('penjual.pesanan.index'))
                    <a href="{{ route('penjual.pesanan.index') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        🧾 Lihat Pesanan
                    </a>
                @endif

                <a href="{{ route('penjual.profil') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    👤 Profil Toko
                </a>

            </div>
        </div>


    </div>
@endsection
