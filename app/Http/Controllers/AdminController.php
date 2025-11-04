<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Order; // Contoh impor Model jika diperlukan

class AdminController extends Controller
{
    // Dashboard utama
    public function index()
    {
        return view('adminView.admindashboard');
    }

    // Halaman approval produk
    public function approval()
    {
        return view('adminView.adminApproval');
    }

    // Halaman laporan transaksi (Daftar Toko)
    public function transaksi()
    {
        return view('adminView.adminTransaksi');
    }
    
    // Method untuk halaman periksa/detail produk per toko (sebelum klik pesanan)
    public function periksa()
    {
        // Dalam implementasi nyata, di sini akan dilewatkan data produk yang diperiksa
        return view('adminView.adminperiksa');
    }
    
    // =======================================================
    // PERBAIKAN: Mengganti method 'show' dengan 'detailTransaksi($id)' 
    //            dan memastikan parameter $id diterima.
    // =======================================================
    /**
     * Menampilkan halaman detail laporan transaksi produk (admindetail).
     *
     * @param int $id ID Pesanan yang akan dilihat detailnya dari URL.
     * @return \Illuminate\View\View
     */
    public function detailTransaksi($id)
    {
        // Dalam implementasi nyata:
        // 1. Ambil data pesanan (Order) berdasarkan $id.
        // 2. Kirim data tersebut ke view.

        // Contoh: $order = Order::with('product')->findOrFail($id);
        
        return view('adminView.admindetail', [
            'orderId' => $id // Melewatkan ID pesanan ke view (opsional)
            // 'order' => $order, // Kirim data order yang sebenarnya
        ]);
    }
}
