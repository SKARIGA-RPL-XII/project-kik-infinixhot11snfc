<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenjualController extends Controller
{
    // 1️⃣ Dashboard penjual
    public function dashboard()
    {
        $userId = Auth::user()->id_user;

        // Ambil usaha milik penjual
        $usaha = DB::table('usaha')
            ->where('id_user', $userId)
            ->first();

        // Jika belum punya usaha
        if (!$usaha) {
            return view('penjual.dashboard', [
                'usaha' => null,
                'totalProduk' => 0,
                'produkAktif' => 0,
                'totalPesanan' => 0,
                'pendapatan' => 0,
            ]);
        }

        // Total produk
        $totalProduk = DB::table('produk')
            ->where('id_usaha', $usaha->id_usaha)
            ->count();

        // Produk aktif (stok > 0)
        $produkAktif = DB::table('produk')
            ->where('id_usaha', $usaha->id_usaha)
            ->where('stok', '>', 0)
            ->count();

        // Total pesanan
        $totalPesanan = DB::table('transaksi')
            ->where('id_usaha', $usaha->id_usaha)
            ->count();

        // Total pendapatan (status selesai)
        $pendapatan = DB::table('transaksi')
            ->where('id_usaha', $usaha->id_usaha)
            ->where('status', 'selesai')
            ->sum('total');

        return view('penjual.dashboard', compact(
            'usaha',
            'totalProduk',
            'produkAktif',
            'totalPesanan',
            'pendapatan'
        ));
    }

    // 2️⃣ Tampilkan profil penjual
    public function profil()
    {
        $penjual = Auth::user();
        return view('penjual.profil.index', compact('penjual'));
    }

    // 3️⃣ Form edit profil
    public function editProfil()
    {
        $penjual = Auth::user();
        return view('penjual.profil.edit', compact('penjual'));
    }

    // 4️⃣ Update profil penjual
    public function updateProfil(Request $request)
    {
        $userId = Auth::user()->id_user;

        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $userId . ',id_user',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')
            ->where('id_user', $userId)
            ->update($data);

        return redirect()
            ->route('penjual.profil')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
