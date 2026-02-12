<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';

    protected $fillable = [
        'id_user',
        'id_produk',
        'quantity'
    ];
    public function produk()
{
    return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
}

}

