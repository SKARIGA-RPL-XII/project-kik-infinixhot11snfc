<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'transaksi';

    // Primary key custom
    protected $primaryKey = 'id_transaksi';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_usaha',
        'id_user',
        'id_pelanggan',
        'kode_transaksi',
        'tanggal',
        'total',
        'diskon',
        'pajak',
        'ongkir',
        'grand_total',
        'status',
    ];

    /**
     * Relasi ke Usaha
     * Transaksi milik satu usaha
     */
    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi ke User (kasir / admin)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke Pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
