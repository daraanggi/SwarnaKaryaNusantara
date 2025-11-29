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
     * Metode baru: Menerima data items dari keranjang dan menyimpannya ke session.
     * Kemudian mengarahkan ke halaman checkout.
     */
    public function startCheckout(Request $request)
    {
        $request->validate([
            'items' => 'required|json', // Pastikan items dikirim dalam format JSON
        ]);

        $items = json_decode($request->items, true);

        // Simpan data produk yang akan dicheckout ke dalam Session
        session(['checkout_items' => $items]);

        // Redirect ke halaman checkout yang sebenarnya (tanpa query parameter)
        // Pastikan route 'checkout.show' sudah didefinisikan di web.php
        return redirect()->route('checkout.show');
    }

    /**
     * Tampilkan halaman checkout. (Mengambil data dari Session)
     */
    public function showCheckout(Request $request)
    {
        // GANTI: Ambil items dari session, bukan dari request query
        $items = session('checkout_items', []); 
        
        if (empty($items)) {
            // Jika session items kosong, arahkan kembali ke keranjang
            return redirect()->route('keranjang')->with('error', 'Silakan pilih produk untuk checkout.');
        }

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
     * (Tidak ada perubahan signifikan, hanya penyesuaian nama metode jika diperlukan)
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'total' => 'required|numeric|min:0',
        ]);

        $items = json_decode($request->items, true);

        // ... Sisa kode store tidak perlu diubah ...

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

        // Setelah transaksi berhasil, hapus item checkout dari session
        session()->forget('checkout_items'); 
        session()->forget('alamat_checkout');

        // Redirect ke home dengan notifikasi sukses
        return redirect()->route('home')->with('checkout_success', true);
    }

    public function download() { /* ... kode download tidak berubah ... */ }
}