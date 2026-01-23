<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel
    protected $table = 'users';

    // Primary Key custom
    protected $primaryKey = 'id_user';

    // PK auto increment
    public $incrementing = true;

    // Tipe PK
    protected $keyType = 'int';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'last_login',
    ];

    // Kolom yang disembunyikan saat serialize (JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting tipe data
    protected $casts = [
        'last_login' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: User (1) -> Usaha (N)
     */
    public function usaha()
    {
        return $this->hasMany(Usaha::class, 'id_user', 'id_user');
    }

    /**
     * Relasi: User (1) -> Transaksi (N)
     * (kasir / admin yang memproses transaksi)
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }

    /**
     * Relasi: User (1) -> Log Aktivitas (N)
     */
    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'id_user', 'id_user');
    }
}
