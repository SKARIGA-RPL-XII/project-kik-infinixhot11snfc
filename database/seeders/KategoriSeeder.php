<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua usaha
        $usahaList = DB::table('usaha')->get();

        foreach ($usahaList as $usaha) {
            DB::table('kategori')->insert([
                [
                    'id_usaha'      => $usaha->id_usaha,
                    'nama_kategori' => 'makanan',
                    'deskripsi'     => 'Kategori untuk produk makanan',
                    'status'        => 'aktif',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
                [
                    'id_usaha'      => $usaha->id_usaha,
                    'nama_kategori' => 'barang',
                    'deskripsi'     => 'Kategori untuk produk non makanan',
                    'status'        => 'aktif',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
            ]);
        }
    }
}
