<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // nama tabel di SQLite
    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    // kalau pakai created_at & updated_at
    public $timestamps = true;

    // kolom yang boleh diisi mass assignment
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
}