<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pembayaran';

    // Primary key custom
    protected $primaryKey = 'id_pembayaran';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_transaksi',
        'metode',
        'jumlah',
        'bukti',
        'status',
        'tanggal_bayar',
    ];

    /**
     * Relasi ke Transaksi
     * Satu pembayaran milik satu transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
