@extends('layouts.app')

@section('content')

<div class="text-center mt-10">
    <h2 class="text-xl font-bold mb-6">
        Total Bayar: Rp {{ number_format($transaksi->grand_total,0,',','.') }}
    </h2>

    <button type="button"
        id="pay-button"
        class="bg-green-600 text-white px-6 py-3 rounded-xl">
        Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script type="text/javascript">
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
    window.location.href = "{{ route('checkout.success') }}";
},
        onPending: function(result){
            alert("Menunggu pembayaran...");
        },
        onError: function(result){
            alert("Pembayaran gagal!");
        }
    });
};
</script>

@endsection
