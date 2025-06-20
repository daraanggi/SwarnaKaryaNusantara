<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|json',
            'total' => 'required|numeric|min:0',
        ]);

        $items = json_decode($request->items, true);

        // Simpan transaksi utama
        $transaksi = Transaksi::create([
            'id_user' => Auth::id() ?? 1,
            'tanggal_pesan' => Carbon::now()->toDateString(),
            'status_pesanan' => 'Menunggu Pembayaran',
            'total_harga' => $request->total,
        ]);

        // Simpan semua detail produk
        foreach ($items as $item) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $item['id'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['harga'] * $item['jumlah'],
            ]);
        }

        // Redirect langsung ke homePembeli + flash pesan
        return redirect()->route('home')->with('pesanan_berhasil', true);
    }

    public function showTransactionDetail()
    {
        $dataTransaksi = Transaksi::with(['detailTransaksi.produk'])->get();
        return view('penjualView.transactionDetail', compact('dataTransaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksi.produk'])->findOrFail($id);
        return view('penjualView.orderDetail', compact('transaksi'));
    }
}