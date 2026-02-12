<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UsahaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController ;
use App\Http\Controllers\Penjual\PesananController;

Route::prefix('penjual')->name('penjual.')->middleware(['auth', 'role:penjual'])->group(function () {
    Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    // 🔥 TAMBAHKAN INI
    Route::get('pesanan/{id}/edit', [PesananController::class, 'edit'])
    ->name('pesanan.edit');

Route::put('pesanan/{id}', [PesananController::class, 'update'])
    ->name('pesanan.update');
    
    Route::put('pesanan/{id}/switch-status', [PesananController::class, 'switchStatus'])
    ->name('pesanan.switchStatus');

});

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');
});

Route::get('/checkout/pay/{id}', [CheckoutController::class, 'pay'])
    ->name('checkout.pay');

Route::post('/midtrans/callback', [CheckoutController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| CART (PELANGGAN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('pelanggan')
    ->name('pelanggan.')
    ->group(function () {

        // Home
        Route::get('/home', [PelangganController::class, 'home'])
            ->name('home');

        // Cart
        Route::get('/cart', [CartController::class, 'index'])
            ->name('cart.index');

        Route::post('/cart/add/{id}', [CartController::class, 'add'])
            ->name('cart.add');

        Route::delete('/cart/{id}', [CartController::class, 'destroy'])
            ->name('cart.delete');

        Route::post('/cart/increase/{id}', [CartController::class, 'increase'])
            ->name('cart.increase');

        Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])
            ->name('cart.decrease');

        // Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])
            ->name('checkout.index');

        Route::post('/checkout', [CheckoutController::class, 'store'])
            ->name('checkout.store');
});

// Route::get('/pelanggan/home', [PelangganController::class, 'home'])
//     ->name('pelanggan.home');

Route::middleware('auth')->group(function () {
    Route::prefix('usaha')->name('usaha.')->group(function () {
        Route::get('/create', [UsahaController::class, 'create'])->name('create');
        Route::post('/store', [UsahaController::class, 'store'])->name('store');
    });
});

Route::prefix('produk')->name('produk.')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('index');
    Route::get('/create', [ProdukController::class, 'create'])->name('create');
    Route::post('/store', [ProdukController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ProdukController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess']);

/*
|--------------------------------------------------------------------------
| LANDING & UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing.index');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD UMUM
|--------------------------------------------------------------------------
*/
// Route::middleware('auth')->get('/pelanggan/home', function () {
//     return view('pelanggan.home');
// })->name('home');

/*
|--------------------------------------------------------------------------
| PENJUAL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:penjual'])
    ->prefix('penjual')
    ->name('penjual.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [PenjualController::class, 'dashboard'])
            ->name('dashboard');

        // Produk
        Route::resource('produk', ProdukController::class);

        // Profil
        Route::get('/profil', [PenjualController::class, 'profil'])
            ->name('profil');
        Route::get('/profil/edit', [PenjualController::class, 'editProfil'])
            ->name('profil.edit');
        Route::post('/profil/update', [PenjualController::class, 'updateProfil'])
            ->name('profil.update');
    });

/*
|--------------------------------------------------------------------------
| PESANAN / TRANSAKSI
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
