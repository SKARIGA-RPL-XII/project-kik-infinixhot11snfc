@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">Checkout</h1>

    @php $total = 0; @endphp

    <div class="bg-white rounded-2xl shadow p-6 space-y-4">

        @foreach($cartItems as $item)
            @php
                $subtotal = $item->quantity * $item->produk->harga_jual;
                $total += $subtotal;
            @endphp

            <div class="flex justify-between border-b pb-3">
                <div>
                    <p class="font-semibold">{{ $item->produk->nama_produk }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $item->quantity }} x Rp {{ number_format($item->produk->harga_jual,0,',','.') }}
                    </p>
                </div>

                <p class="font-semibold">
                    Rp {{ number_format($subtotal,0,',','.') }}
                </p>
            </div>
        @endforeach

        <div class="flex justify-between text-lg font-bold pt-4">
            <span>Total</span>
            <span>Rp {{ number_format($total,0,',','.') }}</span>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full bg-black text-white py-3 rounded-full hover:bg-gray-800 transition">
                Bayar Sekarang
            </button>
        </form>        
        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    </div>
</div>
@endsection
