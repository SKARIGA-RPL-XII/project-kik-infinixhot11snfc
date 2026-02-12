<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class PelangganController extends Controller
{
    public function home()
    {
        $produkTersedia = DB::table('produk')
            ->where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->get();

        $cartCount = Cart::where('id_user', auth()->user()->id_user)->count();

        // ✅ cartCount WAJIB DIKIRIM
        return view('pelanggan.home', compact('produkTersedia', 'cartCount'));
    }

    // Tampilkan daftar pelanggan
    public function index()
    {
        $pelanggan = Pelanggan::where('id_usaha', Auth::user()->id_usaha)->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    // Simpan pelanggan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:150',
            'email'     => 'nullable|email',
            'no_hp'     => 'required|string|max:20',
            'alamat'    => 'required|string',
            'kota'      => 'required|string|max:100',
            'kode_pos'  => 'nullable|string|max:10',
        ]);

        Pelanggan::create([
            'id_usaha'  => Auth::user()->id_usaha,
            'nama'      => $request->nama,
            'email'     => $request->email,
            'no_hp'     => $request->no_hp,
            'alamat'    => $request->alamat,
            'kota'      => $request->kota,
            'kode_pos'  => $request->kode_pos,
        ]);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    // Form edit pelanggan
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Update pelanggan
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama'      => 'required|string|max:150',
            'email'     => 'nullable|email',
            'no_hp'     => 'required|string|max:20',
            'alamat'    => 'required|string',
            'kota'      => 'required|string|max:100',
            'kode_pos'  => 'nullable|string|max:10',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui');
    }

    // Hapus pelanggan
    public function destroy($id)
    {
        Pelanggan::findOrFail($id)->delete();

        return back()->with('success', 'Pelanggan berhasil dihapus');
    }
}
