<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pesan_penjual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');   // produk yang dicek
            $table->unsignedBigInteger('penjual_id');  // pemilik produk
            $table->enum('status', ['disetujui', 'ditolak']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('produk_id')->references('id_produk')->on('produk');
            $table->foreign('penjual_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_penjual');
    }
};