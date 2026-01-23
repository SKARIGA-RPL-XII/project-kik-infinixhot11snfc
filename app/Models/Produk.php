<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'produk';

    // Primary Key custom
    protected $primaryKey = 'id_produk';

    // PK auto increment
    public $incrementing = true;

    // Tipe PK
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_usaha',
        'id_kategori',
        'kode_produk',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'berat',
        'stok',
        'stok_minimum',
        'satuan',
        'deskripsi',
        'gambar',
        'status',
    ];

    // Casting tipe data
    protected $casts = [
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'berat'      => 'decimal:2',
        'stok'       => 'integer',
        'stok_minimum' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: Produk milik Usaha
     */
    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi: Produk milik Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relasi: Produk punya banyak Detail Transaksi
     */
    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_produk', 'id_produk');
    }

    /**
     * Relasi: Produk punya banyak Ulasan
     */
    public function ulasan()
    {
        return $this->hasMany(UlasanProduk::class, 'id_produk', 'id_produk');
    }

    /**
     * Scope: hanya produk tersedia
     */
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    /**
     * Helper: cek stok menipis
     */
    public function stokMenipis(): bool
    {
        return $this->stok <= $this->stok_minimum;
    }

    /**
     * Helper: hitung keuntungan per item
     */
    public function labaPerItem(): float
    {
        return (float) ($this->harga_jual - $this->harga_beli);
    }
}
