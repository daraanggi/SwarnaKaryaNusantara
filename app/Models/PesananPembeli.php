<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananPembeli extends Model
{
    protected $fillable = [
    'nama',
    'img',
    'harga',
    'jumlah',
    'total',
    'status_pengiriman',
    'status_pembayaran',
];
}
