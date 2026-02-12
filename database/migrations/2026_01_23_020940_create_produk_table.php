<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id_produk'); // PK AI

            $table->unsignedBigInteger('id_usaha');    // FK ke usaha
            $table->unsignedBigInteger('id_kategori'); // FK ke kategori

            $table->string('kode_produk', 50)->unique();
            $table->string('nama_produk', 200);

            $table->decimal('harga_beli', 12, 2);
            $table->decimal('harga_jual', 12, 2);

            $table->decimal('berat', 8, 2)->comment('kg');
            $table->integer('stok');
            $table->integer('stok_minimum')->default(0);

            $table->string('satuan', 50);
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();

            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');

            $table->timestamps();

            // Relasi ke tabel usaha
            $table->foreign('id_usaha')
                  ->references('id_usaha')
                  ->on('usaha')
                  ->onDelete('cascade');

            // Relasi ke tabel kategori
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategori')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
