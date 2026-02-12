<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk Saya</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: #f4fdf8;
            color: #1f2937;
        }

        .container {
            padding: 28px;
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .header h2 {
            margin: 0;
            font-weight: 600;
        }

        .btn-add {
            background: #22c55e;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-add:hover {
            background: #16a34a;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f0fdf4;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            font-weight: 600;
            color: #065f46;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .aktif {
            background: #dcfce7;
            color: #166534;
        }

        .nonaktif {
            background: #fee2e2;
            color: #991b1b;
        }

        .action a {
            text-decoration: none;
            font-size: 13px;
            margin-right: 10px;
            font-weight: 500;
        }

        .edit {
            color: #2563eb;
        }

        .delete {
            color: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Produk Saya</h2>
        <a href="{{ route('penjual.produk.create') }}" class="btn-add">+ Tambah Produk</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk as $produk)
                    <tr>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>
                            <div class="font-medium">
                                Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                            </div>
                            <div style="font-size:12px;color:#6b7280">
                                Modal: Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                            </div>
                        </td>                        
                        <td>{{ $produk->stok }}</td>
                        <td>
                            <span class="badge {{ $produk->status == 'tersedia' ? 'aktif' : 'nonaktif' }}">
                                {{ ucfirst($produk->status) }}
                            </span>                            
                        </td>
                        <td class="action">
                            <a href="{{ route('penjual.produk.edit', $produk->id_produk) }}" class="edit">Edit</a>
                            <a href="#" class="delete"
                               onclick="return confirm('Yakin ingin menghapus produk ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada produk yang ditambahkan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
