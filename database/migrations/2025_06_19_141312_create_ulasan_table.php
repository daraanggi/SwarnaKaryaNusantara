<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_user');
            $table->tinyInteger('rating'); // Skala 1–5
            $table->text('komentar')->nullable();
            $table->date('tanggal_ulasan');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');

            // GANTI sesuai tabel user-mu:
            // Jika pakai tabel `users` (default Laravel):
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            // Jika kamu pakai tabel `pembeli`, ganti baris atas dengan ini:
            // $table->foreign('id_user')->references('id')->on('pembeli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
