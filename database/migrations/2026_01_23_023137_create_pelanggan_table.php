<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->bigIncrements('id_pelanggan'); // PK AI

            $table->unsignedBigInteger('id_usaha'); // FK ke usaha

            $table->string('nama', 150);
            $table->string('email', 150)->nullable();
            $table->string('no_hp', 20);
            $table->text('alamat')->nullable();
            $table->string('kota', 100);
            $table->string('kode_pos', 10)->nullable();

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
        Schema::dropIfExists('pelanggan');
    }
};
