<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AlamatUser;

class AlamatUserController extends Controller
{
    // Tampilkan daftar alamat user
    public function index()
    {
        $alamats = AlamatUser::where('user_id', Auth::id())->get();
        return view('pembeliView.editAlamat', compact('alamats'));
    }

    // Form edit alamat
    public function edit($id)
    {
        $alamat = AlamatUser::where('user_id', Auth::id())->findOrFail($id);
        return view('pembeliView.editAlamatForm', compact('alamat'));
    }

    // Simpan alamat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
        ]);

        AlamatUser::create([
            'user_id' => Auth::id(),
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'is_utama' => AlamatUser::where('user_id', Auth::id())->doesntExist(),
        ]);

        return redirect()->route('alamat.index')->with('success', 'Alamat baru berhasil ditambahkan.');
    }

    // Update alamat
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
        ]);

        $alamat = AlamatUser::where('user_id', Auth::id())->findOrFail($id);

        $alamat->update($request->only([
            'nama_penerima', 'no_hp', 'alamat', 'kota', 'provinsi', 'kode_pos'
        ]));

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    // Hapus alamat
    public function destroy($id)
    {
        $alamat = AlamatUser::where('user_id', Auth::id())->findOrFail($id);
        $alamat->delete();

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil dihapus.');
    }

    // Set alamat utama
    public function setUtama($id)
    {
        $userId = Auth::id();

        AlamatUser::where('user_id', $userId)->update(['is_utama' => false]);

        $alamat = AlamatUser::where('user_id', $userId)->findOrFail($id);
        $alamat->update(['is_utama' => true]);

        return redirect()->route('alamat.index')->with('success', 'Alamat utama berhasil diubah.');
    }

    // Pilih alamat untuk checkout
    public function pilih($id)
    {
        $alamat = AlamatUser::where('user_id', Auth::id())->findOrFail($id);
        session(['alamat_checkout' => $alamat->id]);
        return redirect()->route('checkout.show')->with('success', 'Alamat pengiriman telah dipilih.');
    }
    
}
