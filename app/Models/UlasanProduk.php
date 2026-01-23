<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanProduk extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'ulasan_produk';

    // Primary key
    protected $primaryKey = 'id_ulasan_produk';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_produk',
        'id_pelanggan',
        'rating',
        'komentar',
        'status',
    ];

    /**
     * Relasi ke Produk
     * Banyak ulasan dimiliki satu produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    /**
     * Relasi ke Pelanggan
     * Banyak ulasan dimiliki satu pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
