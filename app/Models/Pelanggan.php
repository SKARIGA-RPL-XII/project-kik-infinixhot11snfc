<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Nama tabel (karena tidak jamak default Laravel)
    protected $table = 'pelanggan';

    // Primary Key custom
    protected $primaryKey = 'id_pelanggan';

    // PK auto increment
    public $incrementing = true;

    // Tipe PK
    protected $keyType = 'int';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_usaha',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'kota',
        'kode_pos',
    ];

    /**
     * Relasi ke tabel usaha
     * Pelanggan milik satu usaha
     */
    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'id_usaha', 'id_usaha');
    }
}
