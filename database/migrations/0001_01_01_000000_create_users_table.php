<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->integer('no_telepon');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['user', 'pengrajin'])->default('user'); // tambahan: untuk membedakan tipe user
            $table->string('alamat')->nullable();                        // tambahan: alamat user
            $table->string('no_hp')->nullable();                         // tambahan: nomor HP
            $table->rememberToken();
            $table->timestamps();
        });}
    public function down(): void
    {
        Schema::dropIfExists('users');}
};

