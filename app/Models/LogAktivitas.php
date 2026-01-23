<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'log_aktivitas';

    // Primary key
    protected $primaryKey = 'id_log';

    public $incrementing = true;
    protected $keyType = 'int';

    // Karena hanya ada created_at (tanpa updated_at)
    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_user',
        'aktivitas',
        'ip_address',
        'created_at',
    ];

    /**
     * Relasi ke User
     * Banyak log dimiliki satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
