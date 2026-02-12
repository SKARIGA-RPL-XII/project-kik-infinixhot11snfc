@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Keranjang Belanja
                </h1>
                <p class="text-sm text-gray-500">
                    Periksa kembali produk sebelum checkout
                </p>
            </div>

            <a href="{{ route('pelanggan.home') }}"
                class="border border-black text-black px-4 py-2 rounded-full
                  hover:bg-black hover:text-white transition">
                ← Kembali Belanja
            </a>
        </div>

        <!-- ISI KERANJANG -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            @if ($cartItems->count())

                <table class="w-full">
                    <thead class="bg-black text-white">
                        <tr class="text-left text-sm">
                            <th class="p-4">Produk</th>
                            <th class="p-4">Harga</th>
                            <th class="p-4">Jumlah</th>
                            <th class="p-4">Subtotal</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $total = 0; @endphp

                        @foreach ($cartItems as $item)
                            @php
                                $subtotal = $item->quantity * $item->produk->harga_jual;
                                $total += $subtotal;
                            @endphp

                            <tr class="border-b hover:bg-gray-50">
                                <!-- Produk -->
                                <td class="p-4 flex items-center gap-4">
                                    <img src="{{ $item->produk->gambar ? asset('uploads/produk/' . $item->produk->gambar) : asset('images/no-image.png') }}"
                                        class="w-16 h-16 object-cover rounded-lg grayscale">

                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ $item->produk->nama_produk }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $item->produk->satuan }}
                                        </p>
                                    </div>
                                </td>

                                <!-- Harga -->
                                <td class="p-4 text-gray-800 font-medium">
                                    Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                </td>

                                <!-- Quantity -->
                                <td class="p-4">
                                    <div class="flex items-center gap-2">

                                        {{-- tombol minus --}}
                                        <form action="{{ route('pelanggan.cart.decrease', $item->id_cart) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center
                       rounded-full border border-gray-300
                       hover:bg-gray-200 transition">
                                                −
                                            </button>
                                        </form>

                                        {{-- jumlah --}}
                                        <span class="w-8 text-center font-semibold">
                                            {{ $item->quantity }}
                                        </span>

                                        {{-- tombol plus --}}
                                        <form action="{{ route('pelanggan.cart.increase', $item->id_cart) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center
                       rounded-full border border-gray-300
                       hover:bg-gray-200 transition">
                                                +
                                            </button>
                                        </form>

                                    </div>
                                </td>


                                <!-- Subtotal -->
                                <td class="p-4 font-semibold">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </td>

                                <!-- Aksi -->
                                <td class="p-4 text-center">
                                    <form action="{{ route('pelanggan.cart.delete', $item->id_cart) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk dari keranjang?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- TOTAL -->
                <div class="p-6 flex items-center justify-between border-t">
                    <p class="text-lg font-semibold">
                        Total:
                        <span class="text-black">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </p>

                    <a href="{{ route('checkout.index') }}"
                        class="bg-black text-white px-6 py-3 rounded-full
                        hover:bg-gray-800 transition">
                        Checkout
                    </a>

                </div>
            @else
                <div class="p-10 text-center">
                    <p class="text-gray-500">
                        Keranjang kamu masih kosong 🛒
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
