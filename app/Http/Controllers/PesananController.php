<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Ulasan;

class PesananController extends Controller
{
    // ===========================
    // HALAMAN PESANAN PEMBELI
    // ===========================
    public function index()
    {
        $pesanans = Transaksi::where('id_user', auth()->id())
            ->where('status_pesanan', '!=', 'Selesai')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('pembeliView.pesananPembeli', compact('pesanans'));
    }

    // ===========================
    // HALAMAN ULASAN PEMBELI
    // ===========================
    public function ulasan()
    {
        // Ambil transaksi selesai milik user
        $transaksiSelesai = Transaksi::where('id_user', auth()->id())
            ->where('status_pesanan', 'Selesai')
            ->with('detailTransaksi.produk')
            ->get();

        // Kumpulkan produk unik
        $produkList = collect();

        foreach ($transaksiSelesai as $transaksi) {
            foreach ($transaksi->detailTransaksi as $detail) {

                if (!$detail->produk) continue; // jika produk sudah dihapus
                if ($produkList->where('id_produk', $detail->produk->id_produk)->isNotEmpty()) continue;

                $produkList->push((object)[
                    'id_produk'     => $detail->produk->id_produk,
                    'nama'          => $detail->produk->nama,
                    'foto'          => $detail->produk->foto,
                    'sudah_diulas'  => Ulasan::where('id_user', auth()->id())
                                            ->where('id_produk', $detail->produk->id_produk)
                                            ->exists()
                ]);
            }
        }

        return view('pembeliView.ulasan', compact('produkList'));
    }
}
