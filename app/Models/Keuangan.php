<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'keuangans';

    // Primary key custom
    protected $primaryKey = 'id_keuangan';

    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_usaha',
        'id_transaksi',
        'jenis',
        'sumber',
        'keterangan',
        'jumlah',
        'tanggal',
    ];

    /**
     * Relasi ke Usaha
     * Banyak keuangan milik satu usaha
     */
    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'id_usaha', 'id_usaha');
    }

    /**
     * Relasi ke Transaksi (nullable)
     * Satu data keuangan bisa terkait satu transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
