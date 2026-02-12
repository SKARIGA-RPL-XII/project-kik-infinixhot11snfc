<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'kategori';

    // Primary Key custom
    protected $primaryKey = 'id_kategori';

    // PK auto increment
    public $incrementing = true;

    // Tipe PK
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_usaha',
        'nama_kategori',
        'deskripsi',
        'status',
    ];

    /**
     * Relasi: Kategori dimiliki oleh Usaha
     */
    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi: Kategori memiliki banyak Produk
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Scope: hanya kategori aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Helper: cek apakah kategori makanan
     */
    public function isMakanan(): bool
    {
        return $this->nama_kategori === 'makanan';
    }

    /**
     * Helper: cek apakah kategori barang
     */
    public function isBarang(): bool
    {
        return $this->nama_kategori === 'barang';
    }
}
