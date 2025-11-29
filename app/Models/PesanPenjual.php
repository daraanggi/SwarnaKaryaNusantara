<?php

// app/Models/PesanPenjual.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanPenjual extends Model
{
    protected $table = 'pesan_penjual';

    protected $fillable = [
        'produk_id',
        'penjual_id',
        'status',
        'keterangan',
    ];
}

