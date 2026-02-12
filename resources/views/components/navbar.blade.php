<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LOGO -->
            <div class="flex-shrink-0">
                <a href="{{ route('pelanggan.home') }}" class="text-2xl font-bold text-zinc-900">
                    UsahaKita
                </a>
            </div>

            <!-- MENU LINKS -->
            <div class="hidden md:flex space-x-6 items-center">
                <a href="{{ route('pelanggan.home') }}" class="text-zinc-700 hover:text-zinc-900 font-medium transition">
                    Beranda
                </a>
                <a href="{{ route('pelanggan.produk.index') }}" class="text-zinc-700 hover:text-zinc-900 font-medium transition">
                    Produ
                </a>
                <a href="" class="text-zinc-700 hover:text-zinc-900 font-medium transition">
                    Promo
                </a>
                <a href="" class="text-zinc-700 hover:text-zinc-900 font-medium transition">
                    Tentang
                </a>
            </div>

            <!-- USER & CART -->
            <div class="flex items-center space-x-4">
                
                <!-- Cart -->
                <a href="{{ route('pelanggan.cart.index') }}"
                   class="relative flex items-center gap-2 px-4 py-2 rounded-full border border-zinc-300 hover:border-zinc-900 hover:bg-zinc-900 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9"/>
                    </svg>
                    Keranjang
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-zinc-900 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- User dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 px-4 py-2 border border-zinc-300 rounded-full hover:bg-zinc-900 hover:text-white transition">
                        {{ Auth::user()->name }}
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <!-- Dropdown -->
                    <div class="absolute right-0 mt-2 w-48 bg-white border border-zinc-200 rounded-xl shadow-lg opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                        <a href="" class="block px-4 py-2 text-zinc-700 hover:bg-zinc-100 rounded-t-xl">Profil</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-zinc-700 hover:bg-zinc-100 rounded-b-xl"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>

            <!-- MOBILE MENU BUTTON -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-zinc-700 hover:text-zinc-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-zinc-200">
        <a href="{{ route('pelanggan.home') }}" class="block px-6 py-3 hover:bg-zinc-100">Beranda</a>
        <a href="{{ route('pelanggan.produk.index') }}" class="block px-6 py-3 hover:bg-zinc-100">Produk</a>
        <a href="" class="block px-6 py-3 hover:bg-zinc-100">Promo</a>
        <a href="" class="block px-6 py-3 hover:bg-zinc-100">Tentang</a>
    </div>

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</nav>
