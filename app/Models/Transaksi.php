<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';
    
    // 👇 tambahkan ini
    protected $table = 'transaksi';

    protected $fillable = [
        'id_user',
        'tanggal_pesan',
        'tanggal_pembayaran',
        'status_pesanan',
        'total_harga',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}
