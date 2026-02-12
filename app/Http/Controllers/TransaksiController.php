<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // 1️⃣ Tampilkan daftar transaksi
    public function index()
    {
        $transaksi = DB::table('transaksi')
            ->join('usaha', 'transaksi.id_usaha', '=', 'usaha.id_usaha')
            ->join('users', 'transaksi.id_user', '=', 'users.id_user')
            ->select('transaksi.*', 'usaha.nama_usaha', 'users.name as kasir')
            ->get();

            return view('penjual.pesanan.index', compact('transaksi'));
    }

    // 2️⃣ Tampilkan form tambah transaksi
    public function create()
    {
        $usaha = DB::table('usaha')->get();
        $users = DB::table('users')->get();

        return view('transaksi.create', compact('usaha', 'users'));
    }

    // 3️⃣ Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_usaha' => 'required|exists:usaha,id_usaha',
            'id_user' => 'required|exists:users,id_user',
            'kode_transaksi' => 'required|unique:transaksi,kode_transaksi',
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'pajak' => 'nullable|numeric',
            'ongkir' => 'nullable|numeric',
            'grand_total' => 'required|numeric',
            'status' => 'required|in:pending,diproses,dikirim,selesai,batal',
        ]);

        DB::table('transaksi')->insert([
            'id_usaha' => $request->id_usaha,
            'id_user' => $request->id_user,
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => $request->tanggal,
            'total' => $request->total,
            'diskon' => $request->diskon ?? 0,
            'pajak' => $request->pajak ?? 0,
            'ongkir' => $request->ongkir ?? 0,
            'grand_total' => $request->grand_total,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    // 4️⃣ Tampilkan form edit transaksi
    public function edit($id)
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi', $id)->first();
        $usaha = DB::table('usaha')->get();
        $users = DB::table('users')->get();

        return view('transaksi.edit', compact('transaksi', 'usaha', 'users', 'pelanggan'));
    }

    // 5️⃣ Update transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_usaha' => 'required|exists:usaha,id_usaha',
            'id_user' => 'required|exists:users,id_user',
            'kode_transaksi' => 'required|unique:transaksi,kode_transaksi,'.$id.',id_transaksi',
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'pajak' => 'nullable|numeric',
            'ongkir' => 'nullable|numeric',
            'grand_total' => 'required|numeric',
            'status' => 'required|in:pending,diproses,dikirim,selesai,batal',
        ]);

        DB::table('transaksi')->where('id_transaksi', $id)->update([
            'id_usaha' => $request->id_usaha,
            'id_user' => $request->id_user,
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => $request->tanggal,
            'total' => $request->total,
            'diskon' => $request->diskon ?? 0,
            'pajak' => $request->pajak ?? 0,
            'ongkir' => $request->ongkir ?? 0,
            'grand_total' => $request->grand_total,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    // 6️⃣ Hapus transaksi
    public function destroy($id)
    {
        DB::table('transaksi')->where('id_transaksi', $id)->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
