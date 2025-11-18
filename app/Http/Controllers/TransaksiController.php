<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\AlamatUser;

class TransaksiController extends Controller
{
    /**
     * Tampilkan halaman checkout. (Memperbaiki "View not found")
     */
    public function checkout(Request $request)
    {
        // 1. Ambil items dari request
        $items = json_decode($request->query('items'), true) ?? [];
        
        // 2. Ambil alamat utama user
        $alamatUtama = AlamatUser::where('id_user', Auth::id())
                             ->where('is_utama', true)
                             ->first();

        // 3. Tentukan alamat yang dipakai (Prioritas: session, lalu utama)
        $alamatDipakai = session('alamat_checkout')
            ? AlamatUser::find(session('alamat_checkout'))
            : $alamatUtama;
        
        // PENTING: Memanggil view dengan path yang benar
        return view('pembeliView.checkout', compact('items', 'alamatUtama', 'alamatDipakai'));
    }
    
    /**
     * Simpan transaksi ketika user melakukan checkout.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'total' => 'required|numeric|min:0',
        ]);

        $items = json_decode($request->items, true);

        // Ambil alamat yang dipakai (Logika prioritas session/utama)
        $alamatDipakai = session('alamat_checkout') 
            ? AlamatUser::where('id_user', Auth::id())->where('id', session('alamat_checkout'))->first()
            : AlamatUser::where('id_user', Auth::id())->where('is_utama', true)->first();
        
        if (!$alamatDipakai) {
            return redirect()->back()->with('error', 'Anda belum memiliki alamat pengiriman.');
        }

        // Simpan Transaksi
        $transaksi = Transaksi::create([
            'id_user'        => Auth::id(),
            'tanggal_pesan'  => now()->toDateString(),
            'status_pesanan' => 'Menunggu Pembayaran',
            'total_harga'    => $request->total,
            'id_alamat'      => $alamatDipakai->id,
        ]);

        // Simpan Detail Transaksi
        foreach ($items as $item) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk'    => $item['id'],
                'jumlah'       => $item['jumlah'],
                'subtotal'     => $item['harga'] * $item['jumlah'],
            ]);
        }

        session()->forget('alamat_checkout');

        // Redirect ke home dengan notifikasi sukses
        return redirect()
        ->route('home')
        ->with('success', true); 
    }
}