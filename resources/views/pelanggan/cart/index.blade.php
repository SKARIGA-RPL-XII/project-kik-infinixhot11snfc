<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja | UsahaKita</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-zinc-50 min-h-screen text-zinc-800">

<div class="max-w-6xl mx-auto px-8 py-14 space-y-12">

    <!-- HEADER -->
    <div class="flex items-end justify-between">

        <div>
            <h1 class="text-3xl font-semibold tracking-tight">
                Keranjang Belanja
            </h1>
            <p class="text-zinc-500 text-sm mt-2">
                Tinjau kembali produk sebelum melanjutkan ke pembayaran
            </p>
        </div>

        <a href="{{ route('pelanggan.home') }}"
           class="px-5 py-2.5 rounded-full
                  border border-zinc-300
                  text-sm font-medium
                  hover:border-zinc-900
                  hover:bg-zinc-900 hover:text-white
                  transition duration-300">
            Kembali Belanja
        </a>
    </div>


    <!-- CONTENT -->
    <div class="bg-white rounded-3xl border border-zinc-200 overflow-hidden">

        @if ($cartItems->count())

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-zinc-100 text-zinc-600 uppercase tracking-wide text-xs">
                        <tr>
                            <th class="px-8 py-5 text-left font-medium">Produk</th>
                            <th class="px-8 py-5 text-left font-medium">Harga</th>
                            <th class="px-8 py-5 text-left font-medium">Jumlah</th>
                            <th class="px-8 py-5 text-left font-medium">Subtotal</th>
                            <th class="px-8 py-5 text-center font-medium">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-200">

                        @php $total = 0; @endphp

                        @foreach ($cartItems as $item)

                            @php
                                $subtotal = $item->quantity * $item->produk->harga_jual;
                                $total += $subtotal;
                            @endphp

                            <tr class="hover:bg-zinc-50 transition">

                                <!-- Produk -->
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-5">

                                        <img src="{{ $item->produk->gambar ? asset('uploads/produk/' . $item->produk->gambar) : asset('images/no-image.png') }}"
                                             class="w-20 h-20 object-cover rounded-2xl border border-zinc-200">

                                        <div>
                                            <p class="font-medium text-base">
                                                {{ $item->produk->nama_produk }}
                                            </p>
                                            <p class="text-zinc-500 text-xs mt-1">
                                                {{ $item->produk->satuan }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                <!-- Harga -->
                                <td class="px-8 py-6 font-medium">
                                    Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                </td>

                                <!-- Quantity -->
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">

                                        <form action="{{ route('pelanggan.cart.decrease', $item->id_cart) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-9 h-9 rounded-full
                                                       border border-zinc-300
                                                       hover:border-zinc-900
                                                       hover:bg-zinc-900 hover:text-white
                                                       transition">
                                                −
                                            </button>
                                        </form>

                                        <span class="w-8 text-center font-semibold text-base">
                                            {{ $item->quantity }}
                                        </span>

                                        <form action="{{ route('pelanggan.cart.increase', $item->id_cart) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-9 h-9 rounded-full
                                                       border border-zinc-300
                                                       hover:border-zinc-900
                                                       hover:bg-zinc-900 hover:text-white
                                                       transition">
                                                +
                                            </button>
                                        </form>

                                    </div>
                                </td>

                                <!-- Subtotal -->
                                <td class="px-8 py-6 font-semibold">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </td>

                                <!-- Aksi -->
                                <td class="px-8 py-6 text-center">
                                    <form action="{{ route('pelanggan.cart.delete', $item->id_cart) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus produk dari keranjang?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-zinc-500 hover:text-red-600 font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>


            <!-- TOTAL SECTION -->
            <div class="border-t border-zinc-200 px-8 py-8 flex items-center justify-between bg-zinc-50">

                <div>
                    <p class="text-sm text-zinc-500">Total Pembayaran</p>
                    <p class="text-2xl font-semibold mt-1">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                
                    <button type="submit"
                        class="px-8 py-3 rounded-full
                               bg-zinc-900 text-white
                               text-sm font-medium
                               hover:bg-black
                               transition duration-300">
                        Lanjut ke Checkout
                    </button>
                
                </form>

            </div>

        @else

            <div class="py-20 text-center text-zinc-500">
                <p class="text-lg font-medium">
                    Keranjang masih kosong
                </p>
                <p class="text-sm mt-2">
                    Tambahkan produk untuk mulai berbelanja.
                </p>
            </div>

        @endif

    </div>

</div>

</body>
</html>
