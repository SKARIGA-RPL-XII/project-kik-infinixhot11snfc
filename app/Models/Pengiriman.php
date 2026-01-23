<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pengiriman';

    // Primary key custom
    protected $primaryKey = 'id_pengiriman';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_transaksi',
        'kurir',
        'layanan',
        'resi',
        'alamat_kirim',
        'biaya_kirim',
        'status',
        'tanggal_kirim',
        'tanggal_terima',
    ];

    /**
     * Relasi ke Transaksi
     * Satu pengiriman milik satu transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
