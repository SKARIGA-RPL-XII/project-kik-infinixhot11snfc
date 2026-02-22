<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Produk | UsahaKita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-neutral-100 min-h-screen flex font-[Poppins]">

    <!-- Sidebar -->
    <x-sidebar-penjual />

    <div class="relative w-full max-w-6xl">

        <!-- Decorative Accent -->
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-black/90 rounded-full blur-3xl opacity-20"></div>

        <div
            class="relative bg-white rounded-[42px] 
                shadow-[0_40px_120px_rgba(0,0,0,0.12)] 
                p-12 overflow-hidden">

            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-semibold text-gray-900 tracking-wide">
                    Tambah Produk
                </h1>
                <p class="text-gray-500 text-sm mt-2">
                    Tambahkan produk baru ke dalam sistem manajemen usaha Anda
                </p>
            </div>

            {{-- Error Validation --}}
            @if ($errors->any())
                <div
                    class="mb-6 bg-red-50 border border-red-200 
                        text-red-600 p-4 rounded-2xl text-sm">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Grid Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Usaha -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Usaha</label>
                        <select name="id_usaha" required
                            class="w-full rounded-2xl border border-gray-200 
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                            <option value="">Pilih Usaha</option>
                            @foreach ($usaha as $u)
                                <option value="{{ $u->id_usaha }}">
                                    {{ $u->nama_usaha }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Kategori</label>
                        <select name="id_kategori" required
                            class="w-full rounded-2xl border border-gray-200 
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id_kategori }}">
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kode Produk -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Kode Produk</label>
                        <input type="text" name="kode_produk" value="{{ old('kode_produk') }}" required
                            class="w-full rounded-2xl border border-gray-200
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                    </div>

                    <!-- Nama Produk -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required
                            class="w-full rounded-2xl border border-gray-200
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                    </div>

                    <!-- Harga Beli -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Harga Beli</label>
                        <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" required
                            class="w-full rounded-2xl border border-gray-200
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                    </div>

                    <!-- Harga Jual -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Harga Jual</label>
                        <input type="number" name="harga_jual" value="{{ old('harga_jual') }}" required
                            class="w-full rounded-2xl border border-gray-200
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                    </div>

                    <!-- Berat -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Berat (gram)</label>
                        <input type="number" name="berat" value="{{ old('berat') }}" required
                            class="w-full rounded-2xl border border-gray-200
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Stok</label>
                        <input type="number" name="stok" value="{{ old('stok') }}" required
                            class="w-full rounded-2xl border border-gray-200
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Satuan</label>
                        <input type="text" name="satuan" value="{{ old('satuan') }}" required
                            class="w-full rounded-2xl border border-gray-200
                               focus:border-black focus:ring-0
                               transition duration-300 px-4 py-3">
                    </div>

                    <!-- Upload -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Gambar Produk</label>
                        <input type="file" name="gambar" accept="image/*" id="gambarInput"
                            class="w-full text-sm text-gray-500 
               file:mr-4 file:py-3 file:px-6
               file:rounded-full file:border-0
               file:bg-black file:text-white
               file:cursor-pointer
               hover:file:bg-gray-800 transition">

                        <!-- Preview Gambar -->
                        <div class="mt-4">
                            <img id="gambarPreview" src="#" alt="Preview Gambar"
                                class="hidden w-48 h-48 object-cover rounded-lg border border-gray-200 cursor-pointer">
                        </div>
                    </div>

                    <!-- Modal Preview -->
                    <div id="modalPreview"
                        class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
                        <span id="closeModal"
                            class="absolute top-5 right-5 text-white text-3xl cursor-pointer">&times;</span>
                        <img id="modalImage" src="#" alt="Gambar Full"
                            class="max-w-[90%] max-h-[90%] rounded-lg shadow-lg">
                    </div>


                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm text-gray-500 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full rounded-2xl border border-gray-200
                    focus:border-black focus:ring-0
                    transition duration-300 px-4 py-3">{{ old('deskripsi') }}</textarea>
                    </div>

                    <!-- Button -->
                    <div class="pt-6">
                        <button type="submit"
                            class="px-10 py-4 bg-black text-white 
                rounded-full tracking-wider text-sm font-medium
                shadow-lg transition duration-300
                hover:bg-gray-800 hover:scale-105">
                            Simpan Produk
                        </button>
                    </div>

            </form>

        </div>
    </div>
    <script>
        const gambarInput = document.getElementById('gambarInput');
        const gambarPreview = document.getElementById('gambarPreview');
        const modalPreview = document.getElementById('modalPreview');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.getElementById('closeModal');

        // Preview gambar setelah pilih file
        gambarInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    gambarPreview.src = e.target.result;
                    modalImage.src = e.target.result;
                    gambarPreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                gambarPreview.src = '#';
                modalImage.src = '#';
                gambarPreview.classList.add('hidden');
            }
        });

        // Klik gambar preview untuk buka modal
        gambarPreview.addEventListener('click', () => {
            modalPreview.classList.remove('hidden');
            modalPreview.classList.add('flex');
        });

        // Tutup modal
        closeModal.addEventListener('click', () => {
            modalPreview.classList.add('hidden');
            modalPreview.classList.remove('flex');
        });

        // Tutup modal kalau klik di luar gambar
        modalPreview.addEventListener('click', (e) => {
            if (e.target === modalPreview) {
                modalPreview.classList.add('hidden');
                modalPreview.classList.remove('flex');
            }
        });
    </script>

</body>

</html>
