<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPencarian extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pencarian'; // ⚠️ pastikan singular, sesuai nama tabel kamu
    protected $fillable = ['keyword', 'user_id'];
}

