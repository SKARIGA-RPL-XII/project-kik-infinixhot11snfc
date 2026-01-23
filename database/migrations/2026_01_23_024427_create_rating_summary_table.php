<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rating_summary', function (Blueprint $table) {
            $table->bigIncrements('id_rating');

            $table->enum('tipe', ['usaha', 'produk']);

            // id_usaha atau id_produk tergantung tipe
            $table->unsignedBigInteger('id_referensi');

            $table->integer('total_ulasan')->default(0);

            // contoh: 4.75
            $table->decimal('rating_rata', 3, 2)->default(0);

            $table->timestamps();

            // Index untuk mempercepat pencarian
            $table->index(['tipe', 'id_referensi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rating_summary');
    }
};
