<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usaha', function (Blueprint $table) {
            $table->bigIncrements('id_usaha'); // PK AI

            $table->unsignedBigInteger('id_user'); // FK ke users

            $table->string('nama_usaha', 200);
            $table->string('logo', 255)->nullable();
            $table->text('alamat');
            $table->string('kota', 100); // 👉 untuk filter kota
            $table->string('no_telepon', 20);
            $table->string('email_usaha', 150)->nullable();
            $table->enum('status', ['aktif', 'tutup'])->default('aktif');

            $table->timestamps();

            // Relasi ke tabel users
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usaha');
    }
};
