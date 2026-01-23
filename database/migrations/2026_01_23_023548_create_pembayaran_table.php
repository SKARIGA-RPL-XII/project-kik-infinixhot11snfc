<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran'); // PK AI

            $table->unsignedBigInteger('id_transaksi'); // FK ke transaksi

            $table->enum('metode', ['cash', 'transfer', 'qris']);
            $table->decimal('jumlah', 12, 2);
            $table->string('bukti', 255)->nullable();

            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])
                  ->default('menunggu');

            $table->dateTime('tanggal_bayar');

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
        Schema::dropIfExists('pembayaran');
    }
};
