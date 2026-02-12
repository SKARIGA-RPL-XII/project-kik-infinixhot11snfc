<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border-radius: 6px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
        }
        textarea {
            resize: vertical;
        }
        button {
            padding: 10px 18px;
            background: #198754;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #157347;
        }
        .error {
            color: red;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Produk</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Usaha</label>
            <select name="id_usaha" required>
                <option value="">-- Pilih Usaha --</option>
                @foreach ($usaha as $u)
                    <option value="{{ $u->id_usaha }}">{{ $u->nama_usaha }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Kode Produk</label>
            <input type="text" name="kode_produk" value="{{ old('kode_produk') }}" required>
        </div>

        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required>
        </div>

        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" required>
        </div>

        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" value="{{ old('harga_jual') }}" required>
        </div>

        <div class="form-group">
            <label>Berat (gram)</label>
            <input type="number" name="berat" value="{{ old('berat') }}" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="{{ old('stok') }}" required>
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan') }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label>Gambar Produk</label>
            <input type="file" name="gambar" accept="image/*">
        </div>

        <button type="submit">Simpan Produk</button>
    </form>
</div>

</body>
</html>
