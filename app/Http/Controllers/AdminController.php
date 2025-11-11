<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Order; // Contoh impor Model jika diperlukan

class AdminController extends Controller
{
    // Dashboard utama (laporan transaksi)
    public function index()
    {
        // Bisa diisi data transaksi nanti, sekarang view dulu
        return view('adminView.admindashboard');
    }


    // Halaman approval produk
    public function approval()
    {
        // Data dummy sementara
        $produkDisetujui = 377;
        $produkBelum = 1;
        $totalAkun = 83;

        // Contoh produk untuk daftar
        $produkList = [
            [
                'id' => 1,
                'nama' => 'Gelas Bambu',
                'gambar' => 'images/gelas-bambu.png',
                'status' => 'Belum Disetujui',
                'deskripsi' => 'Gelas ramah lingkungan terbuat dari bambu alami, cocok untuk minuman panas maupun dingin.',
                'harga' => 'Rp 25.000',
                'penjual' => 'Swarna Karya',
            ],
            [
                'id' => 2,
                'nama' => 'Anyaman Rotan',
                'gambar' => 'images/anyaman-rotan.png',
                'status' => 'Disetujui',
                'deskripsi' => 'Kerajinan rotan berkualitas tinggi, dibuat oleh pengrajin lokal Indonesia.',
                'harga' => 'Rp 150.000',
                'penjual' => 'Nusantara Craft',
            ],
        ];

        return view('adminView.adminapproval', compact('produkDisetujui', 'produkBelum', 'totalAkun', 'produkList'));
    }

       // Detail produk (tampil setelah diklik dari halaman approval)
    public function showApprovalDetail($id)
    {
    // Data dummy produk
    $produkList = [
        [
            'id' => 1,
            'nama' => 'Gelas Bambu',
            'gambar' => 'images/gelas-bambu.png',
            'deskripsi' => 'Gelas ramah lingkungan yang dibuat dari bambu alami.',
            'harga' => 'Rp25.000',
            'penjual' => 'Toko Alam Nusantara',
        ],
        [
            'id' => 2,
            'nama' => 'Anyaman Rotan',
            'gambar' => 'images/anyaman-rotan.png',
            'deskripsi' => 'Kerajinan tangan dari rotan asli dengan desain klasik.',
            'harga' => 'Rp85.000',
            'penjual' => 'Toko Rotan Indah',
        ],
    ];

        // Cari produk berdasarkan ID
    $produk = collect($produkList)->firstWhere('id', $id);

    if (!$produk) {
        abort(404);
    }

    return view('adminView.admindetail', compact('produk'));
}


    // Detail produk (tampil setelah diklik dari halaman approval)
    public function showPesanan($id)
    {
    // data dummy sementara
    $detail = [
        'Nama Toko' => 'Tekomoro',
        'Nomor Resi' => 'SRN0953R71H253L8',
        'Nama Produk' => 'Tas Rotan',
        'Status' => 'Pesanan Dalam Pengantaran',
        'Waktu Pesanan' => ['17 Agustus 2024', '15 : 04'],
        'Jumlah Pesanan' => 2,
        'Total Pesanan' => 'Rp 411.000',
    ];

    return view('adminView.admindetail', compact('detail', 'id'));
}

    public function approve($id)
{
    // Misal sementara kita cari produk di dummy list seperti biasa
    $produkList = [
        ['id' => 1, 'nama' => 'Gelas Bambu', 'status' => 'Belum Disetujui'],
        ['id' => 2, 'nama' => 'Anyaman Rotan', 'status' => 'Disetujui'],
    ];

    $produk = collect($produkList)->firstWhere('id', $id);

    if (!$produk) {
        abort(404);
    }

    // Simulasi: ubah status jadi disetujui
    $produk['status'] = 'Disetujui';

    return redirect()->route('admin.approval')
        ->with('success', 'Produk "' . $produk['nama'] . '" berhasil diapprove!');
}

    // Halaman laporan transaksi (sementara sama dengan dashboard)
    public function transaksi()
    {
        return view('adminView.admindashboard');
        return view('adminView.adminapproval');
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
        
        return view('adminView.admindetaillaporan', [
            'orderId' => $id // Melewatkan ID pesanan ke view (opsional)
            // 'order' => $order, // Kirim data order yang sebenarnya
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // atau '/'
    }

}
