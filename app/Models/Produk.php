<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes; // tambahkan SoftDeletes

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'deskripsi',
        'stok',
        'harga',
        'kategori',
        'foto',
        'status',
        'user_id',
    ];

    protected $dates = ['deleted_at']; // wajib untuk SoftDeletes
}
