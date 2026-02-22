<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // 1️⃣ Tampilkan daftar transaksi
    public function index()
    {
        $userId = auth()->user()->id_user;
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

    public function processCheckout(Request $request)
{
    $userId = auth()->user()->id_user;

    $cartItems = DB::table('cart')
        ->join('produk', 'cart.id_produk', '=', 'produk.id_produk')
        ->where('cart.id_user', $userId)
        ->select('cart.*', 'produk.harga_jual')
        ->get();

    // ❌ HAPUS INI
    // dd($cartItems);

    if ($cartItems->isEmpty()) {
        return back()->with('error', 'Keranjang kosong');
    }

    DB::beginTransaction();

    try {

        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->quantity * $item->harga_jual;
        }

        $diskon = 0;
        $pajak = 0;
        $ongkir = 0;

        $grandTotal = $total - $diskon + $pajak + $ongkir;

        // SIMPAN TRANSAKSI
        $idTransaksi = DB::table('transaksi')->insertGetId([
            'id_usaha' => $request->id_usaha ?? 1,
            'id_user' => $userId,
            'kode_transaksi' => 'TRX' . time(),
            'tanggal' => now(),
            'total' => $total,
            'diskon' => $diskon,
            'pajak' => $pajak,
            'ongkir' => $ongkir,
            'grand_total' => $grandTotal,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // SIMPAN DETAIL
        foreach ($cartItems as $item) {

            $subtotal = $item->quantity * $item->harga_jual;

            DB::table('transaksi_detail')->insert([
                'id_transaksi' => $idTransaksi,
                'id_produk' => $item->id_produk,
                'qty' => $item->quantity,
                'harga' => $item->harga_jual,
                'subtotal' => $subtotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // HAPUS CART
        DB::table('cart')->where('id_user', $userId)->delete();

        DB::commit();

        return redirect()->route('checkout.success')
            ->with('success', 'Checkout berhasil');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
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
