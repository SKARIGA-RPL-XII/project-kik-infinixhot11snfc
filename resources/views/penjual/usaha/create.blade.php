@extends('layouts.app')

@section('title', 'Buat Usaha')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">🏪 Buat Usaha Baru</h2>

        {{-- Alert --}}
        @if(session('warning'))
            <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
                {{ session('warning') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usaha.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block font-medium mb-1">Nama Usaha</label>
                <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Alamat</label>
                <textarea name="alamat" rows="3"
                          class="w-full border rounded px-3 py-2" required>{{ old('alamat') }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Kota</label>
                <input type="text" name="kota" value="{{ old('kota') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">No Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Email Usaha (Opsional)</label>
                <input type="email" name="email_usaha" value="{{ old('email_usaha') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('penjual.dashboard') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded">
                    Simpan Usaha
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
