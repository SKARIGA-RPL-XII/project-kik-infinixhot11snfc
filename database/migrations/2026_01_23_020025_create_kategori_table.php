<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->bigIncrements('id_kategori'); // PK AI

            $table->unsignedBigInteger('id_usaha'); // FK ke usaha

            // 👉 hanya 2 pilihan kategori
            $table->enum('nama_kategori', ['makanan', 'barang']);

            $table->text('deskripsi')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            // Relasi ke tabel usaha
            $table->foreign('id_usaha')
                  ->references('id_usaha')
                  ->on('usaha')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
