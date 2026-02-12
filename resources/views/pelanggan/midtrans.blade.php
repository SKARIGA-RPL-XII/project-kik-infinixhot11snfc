@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto text-center py-10">

    <h1 class="text-2xl font-bold mb-6">
        Pembayaran {{ $transaksi->kode_transaksi }}
    </h1>

    <button id="pay-button"
        class="bg-green-600 text-white px-6 py-3 rounded-xl">
        Bayar Sekarang
    </button>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = "/checkout/success";
        },
        onPending: function(result){
            window.location.href = "/checkout/pending";
        },
        onError: function(result){
            alert("Pembayaran gagal!");
        }
    });
};
</script>
@endsection
