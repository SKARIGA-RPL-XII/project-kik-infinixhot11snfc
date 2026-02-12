@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container mx-auto p-6">

    <h3 class="text-2xl font-semibold mb-6">🧾 Daftar Pesanan</h3>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($pesanan->isEmpty())
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
        Tidak ada pesanan saat ini.
    </div>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Kode Transaksi</th>
                    <th class="py-3 px-4 text-left">Nama Pembeli</th>
                    <th class="py-3 px-4 text-left">Total Harga</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Tanggal</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan as $index => $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 font-medium">{{ $order->kode_transaksi }}</td>
                        <td class="py-3 px-4">{{ $order->user->name ?? '-' }}</td>
                        <td class="py-3 px-4">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('penjual.pesanan.switchStatus', $order->id_transaksi) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                        
                                <button type="submit">
                                    @if($order->status == 'pending')
                                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full text-xs hover:bg-yellow-300">
                                            Pending
                                        </span>
                                    @elseif($order->status == 'diproses')
                                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs hover:bg-blue-300">
                                            Diproses
                                        </span>
                                    @elseif($order->status == 'dikirim')
                                        <span class="bg-indigo-200 text-indigo-800 px-2 py-1 rounded-full text-xs hover:bg-indigo-300">
                                            Dikirim
                                        </span>
                                    @elseif($order->status == 'selesai')
                                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-xs">
                                            {{ $order->status }}
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </td>                        
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y H:i') }}</td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('penjual.pesanan.show', $order->id_transaksi) }}"
                               class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pesanan->links() }}
    </div>
@endif


</div>
@endsection
