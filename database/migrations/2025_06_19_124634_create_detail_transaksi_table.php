<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail');

            // Foreign key ke transaksi (custom PK)
            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');

            // Foreign key ke produk (pakai id_produk)
            $table->foreignId('id_produk')->constrained('produk', 'id_produk')->onDelete('cascade');

            $table->integer('jumlah');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
