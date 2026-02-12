<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // halaman register
public function register()
{
    return view('auth.register');
}

// proses register
public function registerProcess(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:150',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|in:admin,penjual,pembeli'
    ]);

    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'status' => 'aktif',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
}

    // form login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
    public function loginProcess(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // ambil user
    $user = DB::table('users')
        ->where('email', $request->email)
        ->where('status', 'aktif')
        ->first();

    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan atau akun nonaktif');
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Password salah');
    }

    // ===== LOGIN PAKAI LARAVEL AUTH =====
    Auth::loginUsingId($user->id_user);

    // ===== UPDATE LAST LOGIN =====
    DB::table('users')
        ->where('id_user', $user->id_user)
        ->update(['last_login' => now()]);

    // ===== REDIRECT BERDASARKAN ROLE =====
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'penjual':
            return redirect()->route('penjual.dashboard');
        case 'pelanggan':
            return redirect()->route('pelanggan.home');
        default:
            return redirect()->route('pelanggan.home');
    }
}

    // logout
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
