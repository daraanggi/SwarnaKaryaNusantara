<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    // Ambil semua produk dari transaksi milik user
    $transaksiUser = \App\Models\Transaksi::with('detailTransaksi.produk')
        ->where('id_user', $userId)
        ->latest()
        ->get();

    // Ambil semua produk dari detail transaksi
    $produkList = [];
    foreach ($transaksiUser as $transaksi) {
    foreach ($transaksi->detailTransaksi as $detail) {

        $produk = $detail->produk;

        // Jika produk null, skip supaya tidak error
        if (!$produk) {
            continue;
        }

        // Cek apakah sudah diulas oleh user
        $produk->sudah_diulas = \App\Models\Ulasan::where('id_produk', $produk->id_produk)
            ->where('id_user', $userId)
            ->exists();

        $produkList[] = $produk;
    }
}

    return view('pembeliView.ulasan', compact('produkList'));
}

    public function store(Request $request)
    {
        // Cek user login
        if (!auth()->check()) {
            return redirect()->back()->withErrors(['Silakan login untuk memberikan ulasan.']);
        }

        // Validasi data input
        $request->validate([
            'id_produk' => 'required|numeric', // sementara tidak pakai exists dulu
            'komentar' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Simpan manual
        $ulasan = new Ulasan();
        $ulasan->id_produk = $request->id_produk;
        $ulasan->id_user = auth()->user()->id;
        $ulasan->komentar = $request->komentar;
        $ulasan->rating = $request->rating ?? null;
        $ulasan->tanggal_ulasan = Carbon::now()->toDateString();
        $ulasan->save();

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }
}
