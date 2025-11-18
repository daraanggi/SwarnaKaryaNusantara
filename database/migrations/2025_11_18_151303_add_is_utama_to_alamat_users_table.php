<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('alamat_users', function (Blueprint $table) {
            $table->boolean('is_utama')->default(0);
        });
    }

    public function down()
    {
        Schema::table('alamat_users', function (Blueprint $table) {
            $table->dropColumn('is_utama');
        });
    }

};
