<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->bigIncrements('id_pengiriman'); // PK AI

            $table->unsignedBigInteger('id_transaksi'); // FK ke transaksi

            $table->string('kurir', 100);      // JNE, J&T, dll
            $table->string('layanan', 100);    // REG, YES
            $table->string('resi', 100)->nullable();

            $table->text('alamat_kirim');

            $table->decimal('biaya_kirim', 12, 2);

            $table->enum('status', ['dikemas', 'dikirim', 'diterima'])
                  ->default('dikemas');

            $table->dateTime('tanggal_kirim')->nullable();
            $table->dateTime('tanggal_terima')->nullable();

            $table->timestamps();

            // Relasi ke tabel transaksi
            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transaksi')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
