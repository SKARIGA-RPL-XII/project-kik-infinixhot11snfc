<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Usaha Kita</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-zinc-900 to-black font-[Poppins]">

    <div class="w-[420px]">
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 
                    p-10 rounded-2xl shadow-2xl text-white 
                    transition duration-300 hover:-translate-y-1">

            <!-- Brand -->
            <div class="text-center mb-6 text-2xl font-semibold tracking-widest">
                USAHA <span class="font-light text-gray-400">KITA</span>
            </div>

            <h2 class="text-center text-xl font-semibold mb-2">Register</h2>
            <p class="text-center text-sm text-gray-400 mb-8">
                Buat akun untuk mulai menggunakan sistem
            </p>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/30 text-red-300 text-sm">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="text-sm text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" required
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-transparent 
                               border border-white/20 text-white text-sm
                               focus:outline-none focus:border-white
                               focus:ring-2 focus:ring-white/30 transition">
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm text-gray-300">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-transparent 
                               border border-white/20 text-white text-sm
                               focus:outline-none focus:border-white
                               focus:ring-2 focus:ring-white/30 transition">
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm text-gray-300">Password</label>
                    <input type="password" name="password" required
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-transparent 
                               border border-white/20 text-white text-sm
                               focus:outline-none focus:border-white
                               focus:ring-2 focus:ring-white/30 transition">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="text-sm text-gray-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-transparent 
                               border border-white/20 text-white text-sm
                               focus:outline-none focus:border-white
                               focus:ring-2 focus:ring-white/30 transition">
                </div>

                <!-- Role -->
                <div>
                    <label class="text-sm text-gray-300">Pilih Role</label>
                    <select name="role" required
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-transparent 
                               border border-white/20 text-white text-sm
                               focus:outline-none focus:border-white
                               focus:ring-2 focus:ring-white/30 transition">
                        <option value="" class="text-black">-- Pilih Role --</option>
                        <option value="penjual" class="text-black">Penjual</option>
                        <option value="pembeli" class="text-black">Pembeli</option>
                    </select>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-white text-black 
                           font-semibold tracking-wide
                           hover:bg-gray-200 hover:scale-[1.02]
                           transition duration-300">
                    DAFTAR
                </button>
            </form>

            <!-- Login -->
            <div class="mt-6 text-center text-sm text-gray-400">
                Sudah punya akun?
                <a href="/login" class="text-white font-medium hover:underline transition">
                    Login
                </a>
            </div>

        </div>
    </div>

</body>
</html>
