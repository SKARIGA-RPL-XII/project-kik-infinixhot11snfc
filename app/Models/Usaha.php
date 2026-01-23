<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usaha extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'usaha';

    // Primary Key custom
    protected $primaryKey = 'id_usaha';

    // PK auto increment
    public $incrementing = true;

    // Tipe PK
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_user',
        'nama_usaha',
        'logo',
        'alamat',
        'kota',
        'no_telepon',
        'email_usaha',
        'status',
    ];

    /**
     * Relasi: Usaha dimiliki oleh User
     * users (1) → usaha (N)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi: Usaha memiliki banyak Produk
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi: Usaha memiliki banyak Kategori
     */
    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi: Usaha memiliki banyak Pelanggan
     */
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi: Usaha memiliki banyak Transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi: Usaha memiliki banyak Keuangan
     */
    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi: Usaha memiliki banyak Ulasan
     */
    public function ulasan()
    {
        return $this->hasMany(UlasanUsaha::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Scope untuk filter berdasarkan kota
     */
    public function scopeKota($query, $kota)
    {
        return $query->where('kota', $kota);
    }
}
