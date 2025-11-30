<?php

namespace App\Http\Controllers;
use App\Models\RiwayatPencarian; // tambahkan di atas

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProdukController extends Controller
{
    // HomePage untuk pembeli
   public function index(Request $request)
    {
        $query = Produk::query();

        // Simpan pencarian ke history
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');

            if (Auth::check()) {
                RiwayatPencarian::create([
                    'keyword' => $request->search,
                    'user_id' => auth()->id(),
                ]);
            }
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->sort === 'asc') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('harga', 'desc');
        }

        // --- Ambil rekomendasi berdasarkan riwayat pencarian ---
        $recommendations = collect();

        if (Auth::check()) {
            $lastKeywords = RiwayatPencarian::where('user_id', Auth::id())
                ->latest()
                ->take(3)
                ->pluck('keyword')
                ->toArray();

            foreach ($lastKeywords as $keyword) {
                $recommendations = $recommendations->merge(
                    Produk::where('nama', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%")
                        ->take(5)
                        ->get()
                );
            }

            $recommendations = $recommendations->unique('id_produk');
        }

        // 🔥 Tentukan produk yang ditampilkan
        if ($request->filled('search') || $request->filled('kategori') || $request->filled('sort')) {
            $produk = $query->get();
        } else {
            $produk = $recommendations->isNotEmpty() ? $recommendations : Produk::all();
        }

        // Riwayat
        $histories = Auth::check()
            ? RiwayatPencarian::where('user_id', Auth::id())->latest()->take(5)->get()
            : collect();

        // ✅ Tambahan: ambil daftar kategori unik dari tabel produk
        $kategoriList = Produk::whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');

        // kirim ke view
        return view('pembeliView.homePembeli', compact(
            'produk',
            'histories',
            'recommendations',
            'kategoriList'   // <- jangan lupa ini
        ));
    }

    public function tokoPenjual(Request $request)
    {
        // Ambil user login
        $userId = Auth::id();

        // Query produk milik penjual tersebut
        $query = Produk::where('user_id', $userId);

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $produk = $query->get();

        return view('penjualView.homePagePenjual', compact('produk'));
    }


    // HomePage untuk penjual (sudah ada search)
    public function homepagePenjual(Request $request)
    {
        $query = Produk::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

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

        $validated['user_id'] = Auth::id();
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
        $produk = Produk::where('user_id', Auth::id())->get();
        return view('penjualView.manageProduct', compact('produk'));
    }

    // Menampilkan detail produk versi penjual
    public function showPenjual($id)
    {
        $produk = Produk::where('id_produk', $id)
            ->where('user_id', Auth::id())  // keamanan: hanya boleh lihat produk miliknya
            ->firstOrFail();

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


