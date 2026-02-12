<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Usaha | UsahaKita</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-zinc-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-3xl">
        <div class="bg-white shadow-xl rounded-2xl p-8">

            <h2 class="text-2xl font-bold mb-6 text-zinc-900">🏪 Buat Usaha Baru</h2>

            {{-- Alert --}}
            @if(session('warning'))
                <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4 shadow-sm">
                    {{ session('warning') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usaha.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block font-medium mb-1 text-zinc-800">Nama Usaha</label>
                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}"
                           class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-zinc-500 focus:border-transparent transition" required>
                </div>

                <div>
                    <label class="block font-medium mb-1 text-zinc-800">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-zinc-500 focus:border-transparent transition" required>{{ old('alamat') }}</textarea>
                </div>

                <div>
                    <label class="block font-medium mb-1 text-zinc-800">Kota</label>
                    <input type="text" name="kota" value="{{ old('kota') }}"
                           class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-zinc-500 focus:border-transparent transition" required>
                </div>

                <div>
                    <label class="block font-medium mb-1 text-zinc-800">No Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                           class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-zinc-500 focus:border-transparent transition" required>
                </div>

                <div>
                    <label class="block font-medium mb-1 text-zinc-800">Email Usaha (Opsional)</label>
                    <input type="email" name="email_usaha" value="{{ old('email_usaha') }}"
                           class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-zinc-500 focus:border-transparent transition">
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('penjual.dashboard') }}"
                       class="px-4 py-2 bg-zinc-500 text-white rounded-lg hover:bg-zinc-600 transition">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-5 py-2 bg-zinc-900 text-white rounded-lg hover:bg-black transition">
                        Simpan Usaha
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
