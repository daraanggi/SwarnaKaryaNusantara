<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function homepagePenjual()
    {
        $produk = Produk::all(); // atau sesuaikan jika nama modessl kamu bukan 'Produk'
        return view('penjualView.homePagePenjual', compact('produk'));
    }

    public function index(Request $request)
    {
        $query = Produk::query();

        // Filter berdasarkan keyword pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan urutan harga
        if ($request->sort === 'asc') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('harga', 'desc');
        }

        $produk = $query->get();

        return view('pembeliView.homePembeli', compact('produk'));
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
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk/foto', 'public');
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

    // Untuk penjual
    public function showPenjual($id)
    {
        $produk = Produk::findOrFail($id);
        return view('penjualView.detailProduct', compact('produk'));
    }

    // Untuk pembeli
    public function showPembeli($id)
    {   
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        return view('pembeliView.detailBarang', compact('produk'));
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
    $produk = Produk::where('id_produk', $id)->firstOrFail();
    $produk->delete();

    return redirect()->route('manageProduct')->with('success', 'Produk berhasil dihapus.');
}

}
