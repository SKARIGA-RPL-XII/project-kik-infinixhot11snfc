@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8">

        <!-- HEADER -->
        <div class="border-b pb-6 mb-6">
            <h2 class="text-2xl font-bold text-green-700">
                Pembayaran Transaksi
            </h2>
            <p class="text-gray-500 text-sm mt-1">
                Kode Transaksi: <span class="font-semibold">{{ $transaksi->kode_transaksi }}</span>
            </p>
        </div>

        <!-- DETAIL TRANSAKSI -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">
                Detail Pesanan
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full border rounded-lg overflow-hidden">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="p-3 text-left">Produk</th>
                            <th class="p-3 text-center">Qty</th>
                            <th class="p-3 text-right">Harga</th>
                            <th class="p-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->detail as $item)
                        <tr class="border-b">
                            <td class="p-3">{{ $item->produk->nama_produk ?? '-' }}</td>
                            <td class="p-3 text-center">{{ $item->qty }}</td>
                            <td class="p-3 text-right">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-right">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right mt-6">
                <p class="text-lg font-bold text-green-700">
                    Total Bayar :
                    Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- FORM PEMBAYARAN -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-gray-700">
                Form Pembayaran
            </h3>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('checkout.bayar.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-4">

                @csrf

                <input type="hidden" name="id_transaksi"
                       value="{{ $transaksi->id_transaksi }}">

                <!-- METODE -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Metode Pembayaran
                    </label>
                    <select name="metode"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        <option value="transfer">Transfer Bank</option>
                        <option value="qris">QRIS</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>

                <!-- BUKTI -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Upload Bukti Transfer (jika transfer / qris)
                    </label>
                    <input type="file"
                           name="bukti"
                           class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- BUTTON -->
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-md">
                    Bayar Sekarang
                </button>

            </form>
        </div>

    </div>
</div>
@endsection
