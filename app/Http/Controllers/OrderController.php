<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class OrderController extends Controller
{
    public function showDetail($id)
    {
        $transaksi = Transaksi::with(['detailTransaksi.produk'])->findOrFail($id);

        return view('penjualView.orderDetail', compact('transaksi'));
    }
}
