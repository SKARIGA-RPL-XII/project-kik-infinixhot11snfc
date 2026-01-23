<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ulasan_produk', function (Blueprint $table) {
            $table->bigIncrements('id_ulasan_produk');

            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_pelanggan');

            $table->tinyInteger('rating'); // 1 - 5
            $table->text('komentar')->nullable();

            $table->enum('status', ['tampil', 'disembunyikan'])
                  ->default('tampil');

            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('produk')
                  ->onDelete('cascade');

            $table->foreign('id_pelanggan')
                  ->references('id_pelanggan')
                  ->on('pelanggan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan_produk');
    }
};
