<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | UsahaKita</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gradient-to-br from-neutral-950 via-neutral-900 to-black 
             flex items-center justify-center px-6 relative overflow-hidden">

    <!-- Subtle Background Glow -->
    <div class="absolute w-[500px] h-[500px] bg-white/5 blur-[120px] 
                rounded-full top-[-100px] left-[-100px]"></div>

    <div class="absolute w-[400px] h-[400px] bg-white/5 blur-[100px] 
                rounded-full bottom-[-80px] right-[-80px]"></div>


    <div class="relative w-full max-w-5xl grid lg:grid-cols-2 
                bg-white/5 backdrop-blur-2xl 
                border border-white/10 
                rounded-[40px] shadow-[0_40px_120px_rgba(0,0,0,0.6)] 
                overflow-hidden">

        <!-- LEFT SIDE (Brand Section) -->
        <div class="hidden lg:flex flex-col justify-center px-16 py-20 
                    bg-gradient-to-br from-white/5 to-white/0 
                    relative">

            <h1 class="text-4xl font-semibold text-white tracking-wide">
                USAHA <span class="font-light text-gray-400">KITA</span>
            </h1>

            <p class="mt-8 text-gray-400 leading-relaxed text-lg max-w-sm">
                Platform modern untuk membantu UMKM berkembang dengan 
                sistem manajemen penjualan yang profesional dan elegan.
            </p>

            <div class="mt-12 w-32 h-1 bg-white/20 rounded-full"></div>

        </div>


        <!-- RIGHT SIDE (Login Form) -->
        <div class="px-10 md:px-16 py-16 text-white">

            <h2 class="text-3xl font-semibold text-center tracking-wide">
                Welcome Back
            </h2>

            <p class="text-center text-gray-400 mt-2 text-sm">
                Masuk untuk melanjutkan ke dashboard
            </p>

            @if(session('error'))
                <div class="mt-6 bg-red-500/10 border border-red-400/30 
                            text-red-300 text-sm p-4 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login" class="mt-10 space-y-6">
                @csrf

                <div>
                    <label class="text-sm text-gray-400">Email</label>
                    <input type="email" name="email" required
                           class="w-full mt-2 px-4 py-3 
                                  bg-white/5 border border-white/10 
                                  rounded-xl text-white 
                                  focus:outline-none focus:ring-2 
                                  focus:ring-white/30 focus:border-white/30 
                                  transition duration-300">
                </div>

                <div>
                    <label class="text-sm text-gray-400">Password</label>
                    <input type="password" name="password" required
                           class="w-full mt-2 px-4 py-3 
                                  bg-white/5 border border-white/10 
                                  rounded-xl text-white 
                                  focus:outline-none focus:ring-2 
                                  focus:ring-white/30 focus:border-white/30 
                                  transition duration-300">
                </div>

                <button type="submit"
                        class="w-full py-3 mt-4 bg-white text-black 
                               rounded-xl font-semibold tracking-wide 
                               transition duration-300 
                               hover:bg-gray-200 hover:scale-[1.02] 
                               shadow-lg hover:shadow-xl">
                    MASUK
                </button>
            </form>

            <div class="mt-8 text-center text-gray-400 text-sm">
                Belum punya akun?
                <a href="/register" 
                   class="text-white hover:underline transition">
                    Daftar sekarang
                </a>
            </div>

        </div>

    </div>

</body>
</html>
