<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    // Nama tabel jika tidak sama dengan plural model (optional kalau pakai nama `ulasan`)
    protected $table = 'ulasan';

    // Field yang boleh diisi massal
    protected $fillable = [
        'id_produk',
        'id_user',
        'komentar',
        'rating',
        'tanggal_ulasan',
    ];

    // Aktifkan timestamp otomatis (created_at & updated_at)
    public $timestamps = true;

    // (Optional) Format tanggal jika kamu ingin khusus
    protected $casts = [
        'tanggal_ulasan' => 'date',
    ];
}
