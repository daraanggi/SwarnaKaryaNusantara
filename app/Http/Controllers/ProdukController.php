<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // HomePage untuk pembeli
    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->sort === 'asc') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('harga', 'desc');
        }

        $produk = $query->get();

        return view('pembeliView.homePembeli', compact('produk'));
    }

    // HomePage untuk penjual (sudah ada search)
public function homepagePenjual(Request $request)
    {
        $query = Produk::query();

        // Kalau ada search input, filter
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Jika search kosong, otomatis query akan mengambil semua produk (karena tidak ada filter)

        $produk = $query->get();

        return view('penjualView.homePagePenjual', compact('produk'));
    }


    // Menampilkan form tambah produk
    public function create()
    {
        return view('penjualView.createProduct');
    }

    // Menyimpan produk baru
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

        return redirect()->route('manageProduct')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menambah stok produk
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

    // Menampilkan halaman manage product penjual
    public function manageProduct()
    {
        $produk = Produk::all();
        return view('penjualView.manageProduct', compact('produk'));
    }

    // Menampilkan detail produk versi penjual
    public function showPenjual($id)
    {
        $produk = Produk::findOrFail($id);
        return view('penjualView.detailProduct', compact('produk'));
    }

    // Menampilkan detail produk versi pembeli
    public function showPembeli($id)
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        return view('pembeliView.detailBarang', compact('produk'));
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        $produk->delete();

        return redirect()->route('manageProduct')->with('success', 'Produk berhasil dihapus.');
    }
}
