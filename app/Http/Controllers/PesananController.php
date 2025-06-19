<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // pakai model Produk, karena tabelnya itu

class PesananController extends Controller
{
    public function index()
    {
        // Misalnya hanya ambil produk yang sudah dibeli
        $pesanans = Produk::where('status', 'dibeli')->get();

        return view('pembeliView.pesananPembeli', compact('pesanans'));
    }
}
