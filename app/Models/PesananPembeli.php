<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'nama', 'img', 'harga', 'jumlah', 'total', 'status_pengiriman', 'status_pembayaran'
    ];
}
