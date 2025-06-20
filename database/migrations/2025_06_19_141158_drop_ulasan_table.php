<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('ulasan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Opsional: kalau kamu mau buat ulang tabel ulasan di rollback
        Schema::create('ulasan', function ($table) {
            $table->id('id_ulasan');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_user');
            $table->tinyInteger('rating');
            $table->text('komentar')->nullable();
            $table->date('tanggal_ulasan');
            $table->timestamps();
        });
    }
};
