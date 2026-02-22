<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Daftar pesanan penjual
    public function index()
{
    // Ambil id usaha
    $idUsaha = Auth::user()->usaha->id_usaha ?? null; // kalau hasOne
    // atau
    // $idUsaha = Auth::user()->usaha->first()->id_usaha ?? null; // kalau hasMany

    if (!$idUsaha) {
        return redirect()->route('penjual.produk.index')
            ->with('error', 'Anda belum memiliki usaha.');
    }

    $pesanan = Transaksi::with(['user', 'transaksiDetail.produk'])
    ->where('id_usaha', $idUsaha) // langsung pakai id_usaha di transaksi
    ->orderBy('tanggal', 'desc')
    ->paginate(10);

    return view('penjual.pesanan.index', compact('pesanan')); // pastikan compact('pesanan')
}


    // Detail pesanan
    public function show($id)
{
    $idUsaha = Auth::user()->usaha->id_usaha ?? null;

    $order = Transaksi::with(['user', 'transaksiDetail.produk'])
        ->where('id_transaksi', $id)
        ->where('id_usaha', $idUsaha) // filter usaha di transaksi saja
        ->firstOrFail();

    return view('penjual.pesanan.show', compact('order'));
}
    
     // 🔥 TAMBAHKAN DI SINI
     public function edit($id)
     {
         $order = Transaksi::findOrFail($id);
         return view('penjual.pesanan.edit', compact('order'));
     }
 
     // 🔥 TAMBAHKAN DI SINI
     public function update(Request $request, $id)
     {
         $request->validate([
             'status' => 'required|in:pending,diproses,dikirim,selesai,batal'
         ]);
 
         $order = Transaksi::findOrFail($id);
         $order->status = $request->status;
         $order->save();
 
         return redirect()->route('penjual.pesanan.index')
             ->with('success', 'Status pesanan berhasil diperbarui!');
     }
     public function switchStatus($id)
{
    $order = Transaksi::findOrFail($id);

    switch ($order->status) {
        case 'pending':
            $order->status = 'diproses';
            break;

        case 'diproses':
            $order->status = 'dikirim';
            break;

        case 'dikirim':
            $order->status = 'selesai';
            break;

        default:
            return back()->with('success', 'Status sudah final.');
    }

    $order->save();

    return back()->with('success', 'Status berhasil diperbarui.');
}

}
