<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PROCESS CHECKOUT (BUAT TRANSAKSI)
    |--------------------------------------------------------------------------
    */
    public function process(Request $request)
    {
        $user = Auth::user();
    
        // Ambil cart user
        $cartItems = Cart::with('produk')
            ->where('id_user', $user->id_user)
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }
    
        $total = 0;

foreach ($cartItems as $item) {
    $total += $item->quantity * $item->produk->harga_jual;
}
dd($total);

    
        DB::beginTransaction();
    
        try {
    
            // 1️⃣ Buat transaksi
            $transaksi = Transaksi::create([
                'id_usaha' => 1,
                'id_user' => $user->id_user,
                'id_pelanggan' => $user->id_user,
                'kode_transaksi' => 'TRX-' . strtoupper(Str::random(8)),
                'tanggal' => now(),
                'total' => $total,
                'diskon' => 0,
                'pajak' => 0,
                'ongkir' => 0,
                'grand_total' => $total,
                'status' => 'pending',
            ]);
    
            // 2️⃣ Simpan detail transaksi
            foreach ($cartItems as $item) {
                TransaksiDetail::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $item->id_produk,
                    'qty' => $item->quantity,
                    'harga' => $item->produk->harga_jual,
                    'subtotal' => $item->quantity * $item->produk->harga_jual,
                ]);
            }
    
            DB::commit();
    
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    
        /*
        |--------------------------------------------------------------------------
        | MIDTRANS
        |--------------------------------------------------------------------------
        */
    
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    
        $params = [
            'transaction_details' => [
                'order_id' => $transaksi->kode_transaksi,
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
            'callbacks' => [
                'finish' => route('checkout.success') // lebih baik pakai route() daripada url()
            ]
        ];        
        
        dd($total);

        $snapToken = Snap::getSnapToken($params);
    
        return view('checkout.payment', compact('snapToken', 'transaksi'));
    }    
    
    public function index()
{
    $user = auth()->user();

    $cartItems = Cart::with('produk')
        ->where('id_user', $user->id_user)
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang kosong');
    }

    // Hitung total
    $total = 0;

foreach ($cartItems as $item) {
    $total += $item->quantity * $item->produk->harga_jual;
}

    /*
    |--------------------------------------------------------------------------
    | BUAT TRANSAKSI (WAJIB SESUAI STRUKTUR DB)
    |--------------------------------------------------------------------------
    */

    $transaksi = Transaksi::create([
    'id_usaha' => 1,
    'id_user' => auth()->user()->id_user,
    'kode_transaksi' => 'TRX-' . strtoupper(uniqid()),
    'tanggal' => now(),
    'total' => $total,
    'diskon' => 0,
    'pajak' => 0,
    'ongkir' => 0,
    'grand_total' => $total,
    'status' => 'pending'
]);


    /*
    |--------------------------------------------------------------------------
    | MIDTRANS
    |--------------------------------------------------------------------------
    */

    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $transaksi->kode_transaksi,
            'gross_amount' => (int) $total,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email'      => $user->email,
        ],
        'callbacks' => [
            'finish' => route('checkout.success') // lebih baik pakai route() daripada url()
        ]
    ];    

    $snapToken = Snap::getSnapToken($params);

    return view('checkout.index', compact('cartItems', 'transaksi', 'snapToken'));
}
public function success(Request $request)
{
    $user = auth()->user();

    // Update status transaksi menjadi 'selesai' atau 'paid'
    // Kita bisa ambil order_id dari query string Midtrans
    $orderId = $request->order_id;

    $transaksi = Transaksi::where('kode_transaksi', $orderId)
    ->where('id_user', $user->id_user)
    ->first();

    if ($transaksi) {
        $transaksi->status = 'selesai'; // atau 'paid'
        $transaksi->save();
    }

    // Hapus cart user karena sudah selesai checkout
    Cart::where('id_user', $user->id_user)->delete();

    // Redirect ke halaman pelanggan home
    return redirect()->route('pelanggan.home')->with('success', 'Pembayaran berhasil! Terima kasih.');
}


}
