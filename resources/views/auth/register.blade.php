@extends('layouts.guest')

@section('content')
<h2>Register UsahaKita</h2>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nama Lengkap" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br><br>

    <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="penjual">Penjual</option>
        <option value="pembeli">Pembeli</option>
    </select><br><br>

    <button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="/login">Login</a></p>
@endsection
