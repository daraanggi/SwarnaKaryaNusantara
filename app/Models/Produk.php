<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';            // Nama tabel
    protected $primaryKey = 'id_produk';    // Nama kolom primary key kamu
    public $incrementing = true;            // Kalau id_produk-nya auto increment
    protected $keyType = 'int';             // Tipe data dari primary key

    protected $fillable = ['nama', 'deskripsi', 'stok', 'harga', 'foto', 'kategori'];

    // Jika pakai created_at & updated_at
    public $timestamps = true;

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_produk', 'id_produk');
    }
}
