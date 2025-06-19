<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function homepagePenjual()
    {
        $produk = Produk::all(); // atau sesuaikan jika nama modessl kamu bukan 'Produk'
        return view('penjualView.homePagePenjual', compact('produk'));
    }

    public function index()
    {
        //
    }
    
    public function create()
    {
        return view('penjualView.createProduct');
    
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10000',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk/gambar', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('produk/video', 'public');
        }

        Produk::create($validated);

        return redirect()->route('manageProduct')->with('success', 'Produk berhasil ditambahkan');
    }

    public function tambahStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->stok += $request->jumlah;
        $produk->save();

        return redirect()->route('manageProduct')->with('success', 'Stok berhasil ditambahkan.');
    }

    public function manageProduct()
    {
        $produk = Produk::all();
        return view('penjualView.manageProduct', compact('produk'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('penjualView.detailProduct', compact('produk'));

    }
    
    public function edit(Produk $produk)
    {
        //
    }
    
    public function update(Request $request, Produk $produk)
    {
        //
    }
    
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('manageProduct')->with('success', 'Produk berhasil dihapus.');
    }

}
