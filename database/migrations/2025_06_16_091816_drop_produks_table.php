<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProduksTable extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('produks');
    }

    public function down(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori')->nullable();
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
        });
    }
}

return new DropProduksTable;
