<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class TransaksiController extends Controller
{
    // Tampilkan semua transaksi ke halaman transactionDetail
    public function showTransactionDetail()
    {
        $dataTransaksi = Transaksi::with(['detailTransaksi.produk'])->get();

        return view('penjualView.transactionDetail', compact('dataTransaksi'));
    }

    // Tampilkan detail transaksi berdasarkan ID (misal /transaksi/1)
    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksi.produk'])->findOrFail($id);

        return view('penjualView.orderDetail', compact('transaksi'));
    }
}
