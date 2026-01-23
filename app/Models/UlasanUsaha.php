<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanUsaha extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'ulasan_usaha';

    // Primary key
    protected $primaryKey = 'id_ulasan_usaha';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_usaha',
        'id_pelanggan',
        'rating',
        'komentar',
        'status',
    ];

    /**
     * Relasi ke Usaha
     * Banyak ulasan dimiliki satu usaha
     */
    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'id_usaha', 'id_usaha');
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
