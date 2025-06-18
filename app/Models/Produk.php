<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk'; // ← WAJIB kalau bukan 'id'
    public $incrementing = true;         // true jika auto increment
    protected $keyType = 'int';          // atau 'string' kalau pakai UUID
}
