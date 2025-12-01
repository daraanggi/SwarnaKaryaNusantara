<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\User;
use App\Models\Pesanan;
use Carbon\Carbon;

class AdminController extends Controller
{
    // DASHBOARD
    public function index()
    {
       // ambil semua user yang rolenya penjual (toko)
        $stores = User::where('role', 'penjual')->get();

        // ambil data pesanan per bulan dari tabel pesanan (SQLite)
        $monthly = Pesanan::selectRaw('strftime("%m", created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // siapkan label bulan & nilai total pesanan 1–12
        $labels = [];
        $values = [];

        for ($m = 1; $m <= 12; $m++) {
            $labels[] = Carbon::create()->month($m)->format('M'); // Jan, Feb, dst
            $row = $monthly->firstWhere('month', sprintf('%02d', $m));
            $values[] = $row ? $row->total : 0;
        }

        // kirim ke view
        return view('adminView.admindashboard', compact('stores', 'labels', 'values'));
}



    // Halaman approval produk
    public function approval()
    {
        $produkDisetujui = Produk::where('status', 'disetujui')->count();

        // Belum disetujui
        $produkBelum = Produk::whereNull('status')
            ->orWhere('status', 'pending')
            ->count();

        // total akun penjual
        $totalAkun = User::where('role', 'penjual')->count();

        // Tampilkan daftar produk yang BELUM disetujui atau yang masih berstatus pending
        $produkList = Produk::whereNull('status')
            ->orWhere('status', 'pending')
            ->get();

        return view('adminView.adminapproval', compact(
            'produkList',
            'produkDisetujui',
            'produkBelum',
            'totalAkun'
        ));
    }


    // DETAIL PRODUK APPROVAL
    // Sebelumnya kamu pakai filter status → bisa bikin 404
    public function showApprovalDetail($id)
    {
        $produk = Produk::findOrFail($id); // ambil produk berdasarkan ID tanpa filter status
        return view('adminView.admindetail', compact('produk'));
    }



    // Detail produk (tampil setelah diklik dari halaman approval)
    public function showPesanan($id)
    {
        $produk = Produk::findOrFail($id);
        return view('adminView.admindetail', compact('produk'));
    }

    // SETUJU
    public function approve(Request $request, $id)
    {

        $produk = Produk::where('id_produk', $id)->firstOrFail();

        // simpan pesan ke tabel pesan_penjual
        DB::table('pesan_penjual')->insert([
            'produk_id'  => $produk->id_produk,
            'penjual_id' => $produk->user_id ?? 0,
            'status'     => 'disetujui',
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         // update status produk
        $produk->update([
            'status' => 'disetujui',
        ]);

        return redirect()->route('admin.approval')
            ->with('success', 'Produk telah DISETUJUI dan pesan terkirim ke penjual.');
    }

    // TOLAK
    public function reject(Request $request, $id)
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();

        DB::table('pesan_penjual')->insert([
            'produk_id'  => $produk->id_produk,
            'penjual_id' => $produk->user_id ?? 0,
            'status'     => 'ditolak',
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produk->update([
        'status' => 'ditolak',
        ]);

        return redirect()->route('admin.approval')
            ->with('rejected', 'Produk DITOLAK dan pesan terkirim.');
    }

    // HALAMAN LAPORAN TRANSAKSI (LIST TOKO)
    public function transaksi()
    {
        return $this->index();
        // 1. Daftar toko (akun penjual) untuk list di bawah grafik
        // $stores = User::where('role', 'penjual')->get();

        // // 2. Data grafik: jumlah pesanan per bulan di tahun berjalan
        // $monthly = Pesanan::selectRaw('strftime("%m", created_at) as bulan, SUM(jumlah) as total')
        //     ->whereYear('created_at', now()->year)   // Laravel akan sesuaikan ke SQLite
        //     ->groupBy('bulan')
        //     ->orderBy('bulan')
        //     ->get();

        // // Label bulan (Jan, Feb, dst) dan data total pesanan
        // $chartLabels = $monthly->map(function ($row) {
        //     // '01' -> 1, lalu jadi "Januari" (pakai locale default)
        //     $monthNumber = (int) $row->bulan;
        //     return Carbon::create(null, $monthNumber, 1)->translatedFormat('F');
        // });

        // $chartData = $monthly->pluck('total');

        // return view('adminView.admindashboard', compact(
        //     'stores',
        //     'chartLabels',
        //     'chartData'
        // ));
    }

    // PERIKSA LAPORAN
    public function periksa()
    {
        // misal: hanya produk yang status-nya 'disetujui'
        $transaksi = Produk::where('status', 'disetujui')->get();

        // kirim ke adminperiksa.blade.php
        return view('adminView.adminperiksa', compact('transaksi'));
    }

    // DETAIL LAPORAN 
    public function pesanan($id)
    {
        // ambil produk berdasarkan id_produk
        $produk = Produk::where('id_produk', $id)->firstOrFail();

        // ambil semua pesanan untuk produk ini
        $orders = Pesanan::where('produk_id', $id)->orderBy('created_at', 'desc')->get();

        return view('adminView.adminpesanan', compact('produk', 'orders'));
    }
    
    // DETAIL PESANAN
    public function pesananDetail($produkId, $orderId)
    {
        // Ambil produk (pakai id_produk karena di tabel kamu pakainya itu)
        $produk = Produk::where('id_produk', $produkId)->firstOrFail();

        // Ambil pesanan yang sesuai produk
        $pesanan = Pesanan::where('id', $orderId)
            ->where('produk_id', $produkId)
            ->firstOrFail();

        return view('adminView.adminpesanandetail', compact('produk', 'pesanan'));
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

