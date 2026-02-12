<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UsahaKita | Elegant Platform</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-100 min-h-screen flex items-center justify-center p-6">

    <div class="relative bg-white rounded-[48px] shadow-[0_40px_120px_rgba(0,0,0,0.12)] 
                overflow-hidden w-full max-w-7xl min-h-[85vh] flex flex-col lg:flex-row">

        <!-- Decorative Accent Shape -->
        <div class="absolute right-0 top-0 h-full w-1/2 bg-black/90 
                    rounded-l-[220px] hidden lg:block"></div>

        <!-- Navbar -->
        <div class="absolute top-10 left-12 text-xl font-semibold tracking-wide z-20">
            USAHA <span class="font-light text-gray-400">KITA</span>
        </div>

        <!-- LEFT CONTENT -->
        <div class="flex-1 flex items-center px-10 md:px-20 py-24 relative z-10">
            <div class="max-w-xl animate-fadeUp">

                <p class="text-xs tracking-[6px] text-gray-400 uppercase">
                    Digital Platform
                </p>

                <h1 class="mt-6 text-5xl md:text-6xl font-bold leading-tight text-gray-900">
                    Freshness <br> In Every Business
                </h1>

                <p class="mt-6 text-gray-600 text-lg leading-relaxed">
                    Platform modern berbasis Laravel untuk membantu UMKM
                    mengelola produk, transaksi, dan laporan secara
                    profesional dengan tampilan elegan.
                </p>

                <a href="/login"
                   class="inline-block mt-10 px-12 py-4 bg-black text-white 
                          rounded-full text-sm tracking-wider font-medium 
                          transition duration-300 
                          hover:bg-gray-800 hover:scale-105 
                          shadow-lg hover:shadow-xl">
                    Get Started
                </a>

            </div>
        </div>

        <!-- RIGHT CONTENT -->
        <div class="flex-1 relative flex items-center justify-center z-10">

            <div class="relative group">

                <!-- Subtle Glow -->
                <div class="absolute -inset-4 bg-white/10 blur-3xl opacity-60 
                            group-hover:opacity-80 transition duration-500 rounded-full"></div>

                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c"
                     class="relative w-[75%] rounded-[28px] 
                            shadow-[0_30px_80px_rgba(0,0,0,0.35)] 
                            transition duration-500 
                            group-hover:scale-105 animate-float">

            </div>

        </div>

    </div>


    <!-- Animations -->
    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%,100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .animate-fadeUp {
            animation: fadeUp 1s ease-out forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>

</body>
</html>
