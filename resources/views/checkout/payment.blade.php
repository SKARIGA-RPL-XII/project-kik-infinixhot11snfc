@extends('layouts.app')

@section('content')

{{-- DEBUG SNAP TOKEN --}}
{{ dd($snapToken) }}
<h1>HALAMAN PAYMENT</h1>

<button id="pay-button">Bayar Sekarang</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = "/payment/success";
        },
        onPending: function(result){
            window.location.href = "/payment/pending";
        },
        onError: function(result){
            alert("Pembayaran gagal!");
        }
    });
};
</script>

@endsection
