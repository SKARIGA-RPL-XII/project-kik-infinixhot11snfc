<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran | UsahaKita</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-zinc-50 min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-xl">

        <!-- CARD -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-12 text-center space-y-10">

            <!-- Title -->
            <div>
                <p class="text-sm tracking-[4px] uppercase text-zinc-400">
                    Secure Payment
                </p>

                <h1 class="text-3xl font-semibold mt-4 tracking-tight">
                    Konfirmasi Pembayaran
                </h1>
            </div>

            <!-- Total -->
            <div class="space-y-3">
                <p class="text-sm text-zinc-500">
                    Total yang harus dibayar
                </p>

                <h2 class="text-4xl font-semibold tracking-tight text-zinc-900">
                    Rp {{ number_format($transaksi->grand_total,0,',','.') }}
                </h2>
            </div>

            <!-- Divider -->
            <div class="h-px bg-zinc-200"></div>

            <!-- Pay Button -->
            <button type="button"
                id="pay-button"
                class="w-full py-4 rounded-full
                       bg-zinc-900 text-white
                       font-medium tracking-wide
                       hover:bg-black
                       transition duration-300
                       shadow-sm hover:shadow-md">
                Bayar Sekarang
            </button>

            <!-- Note -->
            <p class="text-xs text-zinc-400">
                Pembayaran diproses melalui sistem yang aman dan terenkripsi.
            </p>

        </div>

    </div>


    <!-- Midtrans Script -->
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

</body>
</html>