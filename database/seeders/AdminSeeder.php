<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name'       => 'Admin Utama',
            'email'      => 'admin@usahakita.com',
            'password'   => Hash::make('admin123'),
            'role'       => 'admin',
            'status'     => 'aktif',
            'last_login' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
