<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('keuangans', function (Blueprint $table) {
            $table->bigIncrements('id_keuangan');
        
            $table->unsignedBigInteger('id_usaha');
            $table->unsignedBigInteger('id_transaksi')->nullable();
        
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->enum('sumber', ['penjualan', 'pengiriman', 'manual']);
        
            $table->text('keterangan')->nullable();
            $table->decimal('jumlah', 12, 2);
            $table->date('tanggal');
        
            $table->timestamps();
        
            // FOREIGN KEY USAHA
            $table->foreign('id_usaha')
                  ->references('id_usaha')
                  ->on('usaha')
                  ->onDelete('cascade');
        
            // FOREIGN KEY TRANSAKSI (nullable)
            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transaksi')
                  ->onDelete('set null');
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
