<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cart', function (Blueprint $table) {
        $table->bigIncrements('id_cart');
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_produk');
        $table->integer('quantity')->default(1);
        $table->timestamps();
    
        $table->foreign('id_user')
              ->references('id_user')
              ->on('users')
              ->onDelete('cascade');
    
        $table->foreign('id_produk')
              ->references('id_produk')
              ->on('produk')
              ->onDelete('cascade');
    });    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
