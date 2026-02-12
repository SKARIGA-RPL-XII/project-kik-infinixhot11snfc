<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Tampilkan semua produk
    public function index()
{
    $produk = DB::table('produk')
        ->join('usaha', 'produk.id_usaha', '=', 'usaha.id_usaha')
        ->join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
        ->where('usaha.id_user', auth()->id())
        ->select(
            'produk.*',
            'usaha.nama_usaha',
            'kategori.nama_kategori'
        )
        ->get();

    return view('penjual.produk.index', compact('produk'));
}

    // Tampilkan form tambah produk
    public function create()
    {
        $usaha = DB::table('usaha')
            ->where('id_user', auth()->id())
            ->get();
        $kategori = DB::table('kategori')->get();
        return view('penjual.produk.create', compact('usaha', 'kategori'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'id_usaha' => 'required|exists:usaha,id_usaha',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'kode_produk' => 'required|unique:produk,kode_produk',
            'nama_produk' => 'required|string|max:200',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'berat' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', 'gambar']);


        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $filename);
            $data['gambar'] = $filename;
        }

        DB::table('produk')->insert($data);

        return redirect()->route('penjual.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $produk = DB::table('produk')->where('id_produk', $id)->first();
        $usaha = DB::table('usaha')
            ->where('id_user', auth()->id())
            ->get();
        $kategori = DB::table('kategori')->get();

        return view('produk.edit', compact('produk', 'usaha', 'kategori'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_usaha' => 'required|exists:usaha,id_usaha',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'kode_produk' => 'required|unique:produk,kode_produk,' . $id . ',id_produk',
            'nama_produk' => 'required|string|max:200',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'berat' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', 'gambar']);


        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            $produk = DB::table('produk')->where('id_produk', $id)->first();
            if ($produk && $produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))) {
                unlink(public_path('uploads/produk/' . $produk->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $filename);
            $data['gambar'] = $filename;
        }

        DB::table('produk')->where('id_produk', $id)->update($data);

        return redirect()->route('penjual.produk.index')->with('success', 'Produk berhasil diupdate');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = DB::table('produk')->where('id_produk', $id)->first();
        if ($produk && $produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))) {
            unlink(public_path('uploads/produk/' . $produk->gambar));
        }

        DB::table('produk')->where('id_produk', $id)->delete();

        return redirect()->route('penjual.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
