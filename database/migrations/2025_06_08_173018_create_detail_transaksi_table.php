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
            Schema::dropIfExists('detail_transaksi');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::create('detail_transaksi', function (Blueprint $table) {
        $table->id('id_detail');
        $table->foreignId('id_transaksi')->constrained('transaksi')->onDelete('cascade');
        $table->foreignId('id_produk')->constrained('produk', 'id_produk')->onDelete('cascade');
        $table->integer('jumlah');
        $table->decimal('subtotal', 10, 2);
        $table->timestamps();
    });    }
};
