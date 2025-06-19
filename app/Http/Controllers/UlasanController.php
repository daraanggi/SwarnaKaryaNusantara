<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanController extends Controller
{
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
