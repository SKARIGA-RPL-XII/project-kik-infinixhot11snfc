<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'transaksi_detail';

    // Primary key custom
    protected $primaryKey = 'id_detail';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'qty',
        'harga',
        'subtotal',
    ];

    /**
     * Relasi ke Transaksi
     * Detail milik satu transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    /**
     * Relasi ke Produk
     * Detail milik satu produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
    
}
