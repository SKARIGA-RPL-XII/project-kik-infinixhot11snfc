<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ulasan_usaha', function (Blueprint $table) {
            $table->bigIncrements('id_ulasan_usaha');

            $table->unsignedBigInteger('id_usaha');
            $table->unsignedBigInteger('id_pelanggan');

            $table->tinyInteger('rating'); // 1 - 5
            $table->text('komentar')->nullable();

            $table->enum('status', ['tampil', 'disembunyikan'])
                  ->default('tampil');

            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_usaha')
                  ->references('id_usaha')
                  ->on('usaha')
                  ->onDelete('cascade');

            $table->foreign('id_pelanggan')
                  ->references('id_pelanggan')
                  ->on('pelanggan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan_usaha');
    }
};
