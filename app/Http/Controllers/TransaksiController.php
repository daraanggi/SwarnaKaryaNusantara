<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $transaksi = Transaksi::create([
            'id_user' => Auth::id(),
            'tanggal_pesan' => Carbon::now()->toDateString(),
            'status_pesanan' => 'Menunggu Pembayaran',
            'total_harga' => $request->total,
        ]);

        DetailTransaksi::create([
            'id_transaksi' => $transaksi->id_transaksi,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'subtotal' => $request->harga * $request->jumlah,
        ]);

        return redirect()->route('checkout', [
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'nama' => Produk::find($request->id_produk)->nama ?? 'Produk',
            'img' => Produk::find($request->id_produk)->gambar ?? '/images/default.png'
        ])->with('success', 'Transaksi berhasil dibuat.');
    }

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
