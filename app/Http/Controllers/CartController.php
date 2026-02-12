<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        $cart = Cart::where('id_user', auth()->user()->id_user)
                    ->where('id_produk', $id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity');
            return back()->with('info', 'Jumlah produk ditambahkan');
        }

        Cart::create([
            'id_user'   => auth()->user()->id_user,
            'id_produk' => $id,
            'quantity'  => 1
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // 🔹 WAJIB ADA karena route cart.index dipanggil
    public function index()
    {
        $cartItems = Cart::where('id_user', auth()->user()->id_user)->get();

        return view('pelanggan.cart.index', compact('cartItems'));
    }
    public function destroy($id)
{
    Cart::where('id_cart', $id)
        ->where('id_user', auth()->user()->id_user)
        ->delete();

    return back()->with('success', 'Produk dihapus dari keranjang');
}
public function increase($id)
{
    $cart = Cart::findOrFail($id);
    $cart->quantity += 1;
    $cart->save();

    return back();
}

public function decrease($id)
{
    $cart = Cart::findOrFail($id);

    if ($cart->quantity > 1) {
        $cart->quantity -= 1;
        $cart->save();
    }

    return back();
}

 // 🔹 TAMPILKAN HALAMAN CHECKOUT
 public function checkout()
 {
     $cartItems = Cart::with('produk')
         ->where('id_user', auth()->user()->id_user)
         ->get();

     return view('pelanggan.checkout', compact('cartItems'));
 }


 // 🔹 PROSES CHECKOUT (INI YANG KAMU TANYA)
 public function processCheckout()
 {
     DB::beginTransaction();

     try {

         $cartItems = Cart::with('produk')
             ->where('id_user', auth()->user()->id_user)
             ->get();

         if ($cartItems->isEmpty()) {
             return back()->with('error', 'Keranjang kosong');
         }

         $total = 0;

         foreach ($cartItems as $item) {
             $total += $item->quantity * $item->produk->harga_jual;
         }

         $transaksi = Transaksi::create([
             'id_usaha'      => $cartItems->first()->produk->id_usaha,
             'id_user'       => auth()->user()->id_user,
             'id_pelanggan'  => null,
             'kode_transaksi'=> 'TRX-' . strtoupper(Str::random(8)),
             'tanggal'       => now(),
             'total'         => $total,
             'diskon'        => 0,
             'pajak'         => 0,
             'ongkir'        => 0,
             'grand_total'   => $total,
             'status'        => 'pending'
         ]);

         foreach ($cartItems as $item) {

             $subtotal = $item->quantity * $item->produk->harga_jual;

             TransaksiDetail::create([
                 'id_transaksi' => $transaksi->id_transaksi,
                 'id_produk'    => $item->id_produk,
                 'qty'          => $item->quantity,
                 'harga'        => $item->produk->harga_jual,
                 'subtotal'     => $subtotal,
             ]);

             // 🔥 Kurangi stok
             $item->produk->decrement('stok', $item->quantity);
         }

         // 🔥 Kosongkan cart
         Cart::where('id_user', auth()->user()->id_user)->delete();

         DB::commit();

         return redirect()->route('pelanggan.home')
             ->with('success', 'Checkout berhasil!');

     } catch (\Exception $e) {

         DB::rollBack();
         return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
     }
 }

}
