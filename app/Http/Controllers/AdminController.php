<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard utama (laporan transaksi)
    public function index()
    {
        // Bisa diisi data transaksi nanti, sekarang view dulu
        return view('adminview.admindashboard');
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

        return view('adminview.adminapproval', compact('produkDisetujui', 'produkBelum', 'totalAkun', 'produkList'));
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

    return view('adminview.admindetail', compact('produk'));
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
        return view('adminview.admindashboard');
    }
}
