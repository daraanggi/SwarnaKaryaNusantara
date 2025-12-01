<?php

namespace App\Http\Controllers;

use App\Models\Produk; // Pastikan diimport di atas
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
        $alamatUtama = AlamatUser::where('user_id', Auth::id()) // ganti id_user jadi user_id
                          ->where('is_utama', true)
                          ->first();

        // 3. Tentukan alamat yang dipakai (Prioritas: session, lalu utama)
        $alamatDipakai = session('alamat_checkout')
            ? AlamatUser::where('user_id', Auth::id())->find(session('alamat_checkout'))
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

        // Ambil alamat yang dipakai
        $alamatDipakai = session('alamat_checkout')
            ? AlamatUser::where('user_id', Auth::id())->where('id', session('alamat_checkout'))->first()
            : AlamatUser::where('user_id', Auth::id())->where('is_utama', true)->first();
            
        if (!$alamatDipakai) {
            return redirect()->back()->with('error', 'Anda belum memiliki alamat pengiriman.');
        }

        // Simpan Transaksi
        $transaksi = Transaksi::create([
            'id_user'        => Auth::id(),
            'tanggal_pesan'  => now(),
            'status_pesanan' => 'Menunggu Pembayaran',
            'total_harga'    => $request->total,
            'id_alamat'      => $alamatDipakai->id,
        ]);

        foreach ($items as $item) {

        // Ambil data produk dari database
        $produk = Produk::where('id_produk', $item['id'])->first();

        if (!$produk) continue; // kalau produk gak ditemukan, skip

        // Tentukan quantity yang ada di array
        $qty = $item['quantity'] ?? ($item['qty'] ?? ($item['jumlah'] ?? 1));

        // Buat detail transaksi
        DetailTransaksi::create([
            'id_transaksi' => $transaksi->id_transaksi,
            'id_produk'    => $produk->id_produk,
            'jumlah'       => $qty,
            'subtotal'     => $produk->harga * $qty, // ambil harga dari database!
        ]);

        // Update stok produk
        $produk->stok = max(0, $produk->stok - $qty);
        $produk->save();
    }


        session()->forget(['checkout_items', 'alamat_checkout']);

        return redirect()->route('home')->with('checkout_success', true);
    }


    public function download()
    {
        $dataTransaksi = Transaksi::with('detailTransaksi.produk')->get();

        $filename = "transaction_report_" . date('Y-m-d_H-i-s') . ".csv";
        $handle = fopen($filename, 'w+');

        // Header kolom CSV
        fputcsv($handle, [
            'Nomor Invoice', 
            'Waktu Pemesanan', 
            'Pemesanan', 
            'Metode Pembayaran', 
            'Status Pesanan', 
            'Sub Total'
        ]);

        foreach ($dataTransaksi as $transaksi) {
            $produkList = $transaksi->detailTransaksi->map(function($dt){
                return $dt->produk->nama ?? '-';
            })->implode(', ');

            fputcsv($handle, [
                $transaksi->id_transaksi,
                $transaksi->tanggal_pesan,
                $produkList,
                $transaksi->metode_pembayaran ?? '-',
                $transaksi->status_pesanan,
                $transaksi->total_harga
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    
    public function pesananUser()
    {
        $transaksi = Transaksi::where('id_user', Auth::id())
            ->with('detailTransaksi.produk')
            ->orderBy('id_transaksi', 'DESC')
            ->get();

        return view('pembeliView.pesananPembeli', compact('transaksi'));
    }
}