<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_penerima',
        'no_hp',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'is_utama',
    ];

    protected $casts = [
        'is_utama' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}