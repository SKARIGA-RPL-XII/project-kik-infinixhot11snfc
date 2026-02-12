@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-xl shadow p-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                👋 Selamat Datang, Admin
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola sistem dan pantau aktivitas aplikasi
            </p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total User -->
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total User</p>
                    <h2 class="text-2xl font-bold">120</h2>
                </div>
                <div class="text-3xl">👥</div>
            </div>
        </div>

        <!-- Penjual -->
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Penjual</p>
                    <h2 class="text-2xl font-bold">45</h2>
                </div>
                <div class="text-3xl">🏪</div>
            </div>
        </div>

        <!-- Pembeli -->
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pembeli</p>
                    <h2 class="text-2xl font-bold">75</h2>
                </div>
                <div class="text-3xl">🛒</div>
            </div>
        </div>

        <!-- Transaksi -->
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Transaksi</p>
                    <h2 class="text-2xl font-bold">230</h2>
                </div>
                <div class="text-3xl">💳</div>
            </div>
        </div>

    </div>

    <!-- Menu Admin -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold text-lg mb-4">⚙️ Menu Admin</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

            <a href="#" class="p-4 rounded-lg border hover:bg-gray-50 transition">
                👥 Manajemen User
            </a>

            <a href="#" class="p-4 rounded-lg border hover:bg-gray-50 transition">
                🏪 Data Usaha
            </a>

            <a href="#" class="p-4 rounded-lg border hover:bg-gray-50 transition">
                📦 Produk
            </a>

            <a href="#" class="p-4 rounded-lg border hover:bg-gray-50 transition">
                🧾 Transaksi
            </a>

        </div>
    </div>

    <!-- Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-sm text-blue-700">
        Sistem berjalan normal • Tidak ada error terdeteksi
    </div>

</div>
@endsection
