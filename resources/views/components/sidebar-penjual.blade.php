<aside class="hidden lg:flex flex-col justify-between
              bg-black text-white
              w-72 min-h-[85vh]
              rounded-r-[48px]
              px-8 py-10 shadow-xl">

    <!-- Logo -->
    <div>
        <h2 class="text-2xl font-semibold tracking-wide mb-12">
            Usaha<span class="font-light text-gray-400">Kita</span>
        </h2>

        <!-- Menu -->
        <nav class="space-y-3 text-sm">

            <!-- Dashboard -->
            <a href="{{ route('penjual.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
               {{ request()->routeIs('penjual.dashboard')
                   ? 'bg-white text-black font-medium shadow-md'
                   : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12h7V3H3v9zm11 9h7v-7h-7v7zM14 3v7h7V3h-7zM3 21h7v-7H3v7z"/>
                </svg>

                Dashboard
            </a>

            <!-- Produk -->
            <a href="{{ route('penjual.produk.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
               {{ request()->routeIs('penjual.produk.*')
                   ? 'bg-white text-black font-medium shadow-md'
                   : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"/>
                </svg>

                Produk
            </a>

            <!-- Pesanan -->
            <a href="{{ route('penjual.pesanan.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
               {{ request()->routeIs('penjual.pesanan.*')
                   ? 'bg-white text-black font-medium shadow-md'
                   : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12h6m-6 4h6M5 7h14M5 3h14M5 21h14"/>
                </svg>

                Pesanan
            </a>

            <!-- Profil -->
            <a href="{{ route('penjual.profil') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
               {{ request()->routeIs('penjual.profil')
                   ? 'bg-white text-black font-medium shadow-md'
                   : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"/>
                </svg>

                Profil Toko
            </a>

        </nav>
    </div>

    <!-- Bottom Section -->
    <div class="border-t border-white/10 pt-6 space-y-5">

        <div>
            <p class="text-xs text-gray-400">Login sebagai</p>
            <p class="text-sm font-medium mt-1">
                {{ Auth::user()->name }}
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full py-3 rounded-xl bg-white text-black text-sm font-medium
                       hover:bg-gray-200 transition duration-300">
                Logout
            </button>
        </form>

    </div>

</aside>
