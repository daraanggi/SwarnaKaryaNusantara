<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // nama tabel
    protected $table = 'pesanan';

    // kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'produk_id',
        'no_telp',
        'jumlah',
    ];

    // pakai timestamps (created_at, updated_at)
    public $timestamps = true;

    // relasi ke produk
    public function produk()
    {
        // foreignKey = produk_id, ownerKey = id_produk di tabel produk
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }
}