<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingSummary extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'rating_summary';

    // Primary key
    protected $primaryKey = 'id_rating';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang bisa diisi
    protected $fillable = [
        'tipe',
        'id_referensi',
        'total_ulasan',
        'rating_rata',
    ];

    /**
     * Scope untuk rating usaha
     */
    public function scopeUsaha($query)
    {
        return $query->where('tipe', 'usaha');
    }

    /**
     * Scope untuk rating produk
     */
    public function scopeProduk($query)
    {
        return $query->where('tipe', 'produk');
    }

    /**
     * Relasi dinamis (opsional)
     * Digunakan sesuai tipe (usaha / produk)
     */
    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'id_referensi', 'id_usaha')
                    ->where('tipe', 'usaha');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_referensi', 'id_produk')
                    ->where('tipe', 'produk');
    }
}
