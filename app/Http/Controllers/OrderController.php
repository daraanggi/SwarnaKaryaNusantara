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
    public function pesananDikirim($id)
{
    $transaksi = Transaksi::findOrFail($id);

    $transaksi->update([
        'status_pesanan' => 'Dikirim',
    ]);

    return back()->with('success', 'Pesanan sudah ditandai sebagai Dikirim.');
}

public function pesananSelesai($id)
{
    $transaksi = Transaksi::findOrFail($id);

    $transaksi->update([
        'status_pesanan' => 'Selesai',
    ]);

    return back()->with('success', 'Pesanan telah Selesai.');
}

}
