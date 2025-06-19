<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('transaksi');
    }

    public function down(): void
    {
        // Jika ingin mengembalikan tabel, bisa ditambahkan kembali struktur tabelnya di sini.
    }
};
