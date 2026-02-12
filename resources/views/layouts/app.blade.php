<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Logo / Judul -->
            <div class="text-xl font-bold text-blue-600">
                UsahaKita
            </div>

            <!-- User Menu -->
            <div class="flex items-center gap-4">
                @auth
                    <span class="text-gray-700 text-sm">
                        👋 {{ Auth::user()->name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-6 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-6 py-4 text-center text-sm text-gray-500">
            © {{ date('Y') }} UsahaKita • All rights reserved
        </div>
    </footer>

</body>
</html>
