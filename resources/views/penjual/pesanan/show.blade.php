<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan | UsahaKita</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-100 min-h-screen font-[Inter]">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <x-sidebar-penjual />

    <!-- Main -->
    <main class="flex-1 p-10">

        <div class="max-w-6xl mx-auto space-y-8">

            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900">
                        Detail Pesanan
                    </h1>
                    <p class="text-gray-500 text-sm mt-2">
                        Informasi lengkap transaksi pelanggan
                    </p>
                </div>

                <a href="{{ route('penjual.pesanan.index') }}"
                   class="px-6 py-3 bg-gray-200 rounded-full text-sm hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>

            <!-- Info Pesanan -->
            <div class="bg-white rounded-[32px] shadow p-8">

                <div class="grid md:grid-cols-2 gap-6 text-sm">

                    <div>
                        <div class="text-gray-400">Kode Transaksi</div>
                        <div class="font-medium">{{ $order->kode_transaksi }}</div>
                    </div>

                    <div>
                        <div class="text-gray-400">Tanggal</div>
                        <div class="font-medium">
                            {{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y H:i') }}
                        </div>
                    </div>

                    <div>
                        <div class="text-gray-400">Pembeli</div>
                        <div class="font-medium">
                            {{ $order->user->name ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="text-gray-400">Status</div>
                        <span class="px-4 py-1 rounded-full text-xs font-medium bg-black text-white">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                </div>

            </div>

            <!-- Produk Dipesan -->
            <div class="bg-white rounded-[32px] shadow overflow-hidden">

                <div class="p-6 border-b text-sm font-medium text-gray-700">
                    Daftar Produk
                </div>

                <table class="w-full text-sm">

                    <thead class="bg-neutral-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 text-left">Produk</th>
                            <th class="px-6 py-4 text-left">Harga</th>
                            <th class="px-6 py-4 text-left">Qty</th>
                            <th class="px-6 py-4 text-left">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach($order->transaksiDetail as $item)
                            <tr>

                                <td class="px-6 py-4">
                                    {{ $item->produk->nama_produk ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->qty }}
                                </td>

                                <td class="px-6 py-4 font-medium">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="bg-white rounded-[32px] shadow p-8">

                <div class="space-y-3 text-sm">

                    <div class="flex justify-between">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Diskon</span>
                        <span>Rp {{ number_format($order->diskon, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Pajak</span>
                        <span>Rp {{ number_format($order->pajak, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($order->ongkir, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t pt-3 flex justify-between font-semibold text-lg">
                        <span>Grand Total</span>
                        <span>
                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>
