<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPencarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPencarianController extends Controller
{
    // Simpan riwayat setiap kali user mencari
    public function store(Request $request)
    {
        if (Auth::check()) {
            RiwayatPencarian::create([
                'user_id' => Auth::id(),
                'keyword' => $request->query,
            ]);
        }
    }

    // Tampilkan riwayat pencarian user
    public function index()
    {
        $histories = RiwayatPencarian::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        return view('search.history', compact('histories'));
    }

    // Hapus riwayat
    public function destroy($id)
    {
        RiwayatPencarian::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back();
    }
}