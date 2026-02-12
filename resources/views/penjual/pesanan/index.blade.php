<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan | UsahaKita</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-100 min-h-screen font-[Inter]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="hidden lg:flex flex-col justify-between
                  bg-black text-white
                  w-72 min-h-screen
                  rounded-r-[48px]
                  px-8 py-12">

        <!-- Logo & Menu -->
        <div>
            <h2 class="text-2xl font-semibold tracking-wider mb-14">
                Usaha<span class="font-light text-gray-400">Kita</span>
            </h2>

            <nav class="space-y-3 text-sm tracking-wide">

                <a href="{{ route('penjual.dashboard') }}"
                   class="block px-5 py-3 rounded-2xl transition duration-300
                          hover:bg-white/10
                          {{ request()->routeIs('penjual.dashboard') ? 'bg-white/20' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('penjual.produk.index') }}"
                   class="block px-5 py-3 rounded-2xl transition duration-300
                          hover:bg-white/10
                          {{ request()->routeIs('penjual.produk.*') ? 'bg-white/20' : '' }}">
                    Produk
                </a>

                <a href="{{ route('penjual.pesanan.index') }}"
                   class="block px-5 py-3 rounded-2xl transition duration-300
                          hover:bg-white/10
                          {{ request()->routeIs('penjual.pesanan.*') ? 'bg-white/20' : '' }}">
                    Pesanan
                </a>

                <a href="{{ route('penjual.profil') }}"
                   class="block px-5 py-3 rounded-2xl transition duration-300
                          hover:bg-white/10
                          {{ request()->routeIs('penjual.profil') ? 'bg-white/20' : '' }}">
                    Profil Toko
                </a>

            </nav>
        </div>

        <!-- Bottom -->
        <div class="space-y-6">
            <div class="text-xs text-gray-400 leading-relaxed">
                Login sebagai <br>
                <span class="text-white font-medium">
                    {{ Auth::user()->name }}
                </span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-2xl
                           bg-white text-black
                           font-medium tracking-wide
                           transition duration-300
                           hover:scale-105">
                    Logout
                </button>
            </form>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10">

        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-semibold text-gray-900 tracking-wide">
                    Daftar Pesanan
                </h1>
                <p class="text-gray-500 text-sm mt-2">
                    Kelola dan pantau seluruh transaksi pelanggan
                </p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-black text-white px-6 py-4 rounded-2xl shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($pesanan->isEmpty())

                <div class="bg-white rounded-[32px]
                            shadow-[0_30px_90px_rgba(0,0,0,0.08)]
                            p-16 text-center text-gray-400">
                    Tidak ada pesanan saat ini.
                </div>

            @else

            <div class="bg-white rounded-[32px]
                        shadow-[0_30px_90px_rgba(0,0,0,0.08)]
                        overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-neutral-50 text-gray-500 uppercase tracking-wider text-xs">
                            <tr>
                                <th class="px-8 py-5 text-left">No</th>
                                <th class="px-8 py-5 text-left">Kode</th>
                                <th class="px-8 py-5 text-left">Pembeli</th>
                                <th class="px-8 py-5 text-left">Total</th>
                                <th class="px-8 py-5 text-left">Status</th>
                                <th class="px-8 py-5 text-left">Tanggal</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach($pesanan as $index => $order)
                                <tr class="hover:bg-neutral-50 transition duration-300">

                                    <td class="px-8 py-6 text-gray-500">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-8 py-6 font-medium text-gray-900">
                                        {{ $order->kode_transaksi }}
                                    </td>

                                    <td class="px-8 py-6 text-gray-700">
                                        {{ $order->user->name ?? '-' }}
                                    </td>

                                    <td class="px-8 py-6 font-semibold text-gray-900">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </td>

                                    <td class="px-8 py-6">
                                        <form action="{{ route('penjual.pesanan.switchStatus', $order->id_transaksi) }}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit"
                                                class="px-4 py-1.5 rounded-full text-xs font-medium
                                                       transition duration-300
                                                       bg-black text-white hover:bg-gray-800">
                                                {{ ucfirst($order->status) }}
                                            </button>
                                        </form>
                                    </td>

                                    <td class="px-8 py-6 text-gray-500">
                                        {{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y H:i') }}
                                    </td>

                                    <td class="px-8 py-6 text-center">
                                        <a href="{{ route('penjual.pesanan.show', $order->id_transaksi) }}"
                                           class="inline-block px-6 py-2 
                                                  bg-black text-white rounded-full
                                                  text-xs tracking-wide
                                                  transition duration-300
                                                  hover:bg-gray-800 hover:scale-105">
                                            Detail
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="mt-8">
                {{ $pesanan->links() }}
            </div>

            @endif

        </div>

    </main>

</div>

</body>
</html>
