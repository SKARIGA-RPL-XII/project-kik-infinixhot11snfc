<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsahaController extends Controller
{
    /**
     * Form buat usaha
     */
    public function create()
    {
        $usaha = DB::table('usaha')
            ->where('id_user', Auth::id())
            ->first();

        if ($usaha) {
            return redirect()
                ->route('penjual.dashboard')
                ->with('info', 'Usaha sudah ada');
        }

        return view('penjual.usaha.create');
    }

    /**
     * Simpan usaha baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha'  => 'required|string|max:200',
            'alamat'      => 'required|string',
            'kota'        => 'required|string|max:100',
            'no_telepon'  => 'required|string|max:20',
            'email_usaha' => 'nullable|email|max:150',
        ]);

        $cekUsaha = DB::table('usaha')
            ->where('id_user', Auth::id())
            ->exists();

        if ($cekUsaha) {
            return redirect()
                ->route('penjual.dashboard')
                ->with('warning', 'Kamu sudah memiliki usaha');
        }

        DB::table('usaha')->insert([
            'id_user'      => Auth::id(),
            'nama_usaha'   => $request->nama_usaha,
            'alamat'       => $request->alamat,
            'kota'         => $request->kota,
            'no_telepon'   => $request->no_telepon,
            'email_usaha'  => $request->email_usaha,
            'status'       => 'aktif',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()
            ->route('penjual.dashboard')
            ->with('success', 'Usaha berhasil dibuat');
    }
}
