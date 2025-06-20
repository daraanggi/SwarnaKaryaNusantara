<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // pakai model Produk, karena tabelnya itu
use App\Models\Transaksi;

class PesananController extends Controller
    {
    public function index()
    {
    $pesanans = Transaksi::with('detailTransaksi.produk')
        ->where('id_user', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pembeliView.pesananPembeli', compact('pesanans'));
}

}

}

