<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk Saya | UsahaKita</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-100 min-h-screen font-[Inter] p-8">

<div class="max-w-7xl mx-auto">

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 tracking-wide">
                Produk Saya
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Kelola dan pantau seluruh produk usaha Anda
            </p>
        </div>

        <a href="{{ route('penjual.produk.create') }}"
           class="px-8 py-3 bg-black text-white rounded-full
                  text-sm tracking-wide font-medium
                  transition duration-300
                  hover:bg-gray-800 hover:scale-105
                  shadow-lg hover:shadow-xl">
            Tambah Produk
        </a>
    </div>


    <!-- Card Container -->
    <div class="bg-white rounded-[32px]
                shadow-[0_30px_90px_rgba(0,0,0,0.08)]
                overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-neutral-50 text-gray-500 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-8 py-5 text-left">Nama Produk</th>
                        <th class="px-8 py-5 text-left">Harga</th>
                        <th class="px-8 py-5 text-left">Stok</th>
                        <th class="px-8 py-5 text-left">Status</th>
                        <th class="px-8 py-5 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse ($produk as $item)
                        <tr class="hover:bg-neutral-50 transition duration-300">

                            <!-- Nama -->
                            <td class="px-8 py-6 font-medium text-gray-900">
                                {{ $item->nama_produk }}
                            </td>

                            <!-- Harga -->
                            <td class="px-8 py-6">
                                <div class="font-semibold text-gray-900">
                                    Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                                </div>
                                <div class="text-gray-400 text-xs mt-1">
                                    Modal: Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                                </div>
                            </td>

                            <!-- Stok -->
                            <td class="px-8 py-6 text-gray-700">
                                {{ $item->stok }}
                            </td>

                            <!-- Status -->
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 rounded-full text-xs font-medium
                                    {{ $item->status == 'tersedia' 
                                        ? 'bg-black text-white' 
                                        : 'bg-gray-200 text-gray-600' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="px-8 py-6 space-x-4 text-sm">

                                <a href="{{ route('penjual.produk.edit', $item->id_produk) }}"
                                   class="text-gray-600 hover:text-black transition">
                                    Edit
                                </a>

                                <a href="#"
                                   onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                   class="text-gray-400 hover:text-red-600 transition">
                                    Hapus
                                </a>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center py-16 text-gray-400 text-sm">
                                Belum ada produk yang ditambahkan
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>
