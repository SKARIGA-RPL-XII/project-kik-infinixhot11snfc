<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
        
            $table->unsignedBigInteger('id_usaha');
            $table->unsignedBigInteger('id_user');
        
            $table->string('kode_transaksi', 50)->unique();
            $table->dateTime('tanggal');
        
            $table->decimal('total', 12, 2);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('pajak', 12, 2)->default(0);
            $table->decimal('ongkir', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2);
        
            $table->enum('status', [
                'pending',
                'diproses',
                'dikirim',
                'selesai',
                'batal'
            ])->default('pending');
        
            $table->timestamps();
        
            $table->foreign('id_usaha')
                  ->references('id_usaha')
                  ->on('usaha')
                  ->onDelete('cascade');
        
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
