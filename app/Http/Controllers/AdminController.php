<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard utama
    public function index()
    {
        return view('adminView.admindashboard'); // <--- sesuai folder + nama file
    }

    // Halaman approval produk
    public function approval()
    {
        return view('adminView.adminApproval'); // nanti buat file adminApproval.blade.php
    }

    // Halaman laporan transaksi
    public function transaksi()
    {
        return view('adminView.adminTransaksi'); // nanti buat file adminTransaksi.blade.php
    }
}
