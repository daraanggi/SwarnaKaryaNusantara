<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $alamats = AlamatUser::where('user_id', $userId)->get();

        return view('pembeliView.editAlamat', compact('alamats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
        ]);

        AlamatUser::create([
            'user_id' => auth()->id(),
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
        ]);

        return redirect()->route('alamat.edit')->with('success', 'Alamat berhasil ditambahkan');
        //return redirect()->back()->with('success', 'Alamat berhasil ditambahkan');
    }

    // ⬇⬇⬇ Ini yang kamu tambahkan
    public function editAlamat()
    {
        $userId = auth()->id();
        $alamats = \App\Models\AlamatUser::where('user_id', $userId)->get();
        return view('pembeliView.editAlamat', compact('alamats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
        ]);

        $alamat = AlamatUser::findOrFail($id);

        // Pastikan hanya alamat milik user yang sedang login yang bisa diedit
        if ($alamat->user_id !== auth()->id()) {
            abort(403);
        }

        $alamat->update([
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
        ]);

        return redirect()->route('alamat.edit')->with('success', 'Alamat berhasil diperbarui.');
    }

}
}

