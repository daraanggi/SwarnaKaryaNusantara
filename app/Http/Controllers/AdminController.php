<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Carbon\Carbon;

class AdminController extends Controller
{
    // DASHBOARD
    public function index()
    {
        $stores = User::where('role', 'penjual')->get();

        $monthly = Pesanan::selectRaw('strftime("%m", created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $values = [];

        for ($m = 1; $m <= 12; $m++) {
            $labels[] = Carbon::create()->month($m)->format('M');
            $row = $monthly->firstWhere('month', sprintf('%02d', $m));
            $values[] = $row ? $row->total : 0;
        }

        return view('adminView.admindashboard', compact('stores', 'labels', 'values'));
    }

    // HALAMAN APPROVAL
    public function approval()
    {
        $produkDisetujui = Produk::where('status', 'disetujui')->count();
        $produkBelum = Produk::whereNull('status')->orWhere('status', 'pending')->count();
        $totalAkun = User::where('role', 'penjual')->count();

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

    public function showApprovalDetail($id)
    {
        $produk = Produk::findOrFail($id);
        return view('adminView.admindetail', compact('produk'));
    }

    public function showPesanan($id)
    {
        $produk = Produk::findOrFail($id);
        return view('adminView.admindetail', compact('produk'));
    }

    public function approve(Request $request, $id)
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();

        DB::table('pesan_penjual')->insert([
            'produk_id'  => $produk->id_produk,
            'penjual_id' => $produk->user_id ?? 0,
            'status'     => 'disetujui',
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $produk->update(['status' => 'disetujui']);

        return redirect()->route('admin.approval')
            ->with('success', 'Produk telah DISETUJUI dan pesan terkirim ke penjual.');
    }

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

        $produk->update(['status' => 'ditolak']);

        return redirect()->route('admin.approval')
            ->with('rejected', 'Produk DITOLAK dan pesan terkirim.');
    }

    // HALAMAN TRANSAKSI
    public function transaksi()
    {
        return $this->index();
    }

    public function periksa()
    {
        $transaksi = Produk::where('status', 'disetujui')->get();
        return view('adminView.adminperiksa', compact('transaksi'));
    }

    public function pesanan($id)
    {
        $produk = Produk::where('id_produk', $id)->firstOrFail();
        $orders = Pesanan::where('produk_id', $id)->orderBy('created_at', 'desc')->get();

        return view('adminView.adminpesanan', compact('produk', 'orders'));
    }

    public function pesananDetail($produkId, $orderId)
    {
        $produk = Produk::where('id_produk', $produkId)->firstOrFail();

        $pesanan = Pesanan::where('id', $orderId)
            ->where('produk_id', $produkId)
            ->firstOrFail();

        return view('adminView.adminpesanandetail', compact('produk', 'pesanan'));
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


// HALAMAN LIST KONFIRMASI PEMBAYARAN
public function konfirmasiList()
{
    $pesananPending = Transaksi::where('status_pesanan', 'Menunggu Pembayaran')->get();

    return view('adminView.konfirmasiList', compact('pesananPending'));
}

// HALAMAN DETAIL KONFIRMASI PEMBAYARAN
public function showKonfirmasi($id)
{
    $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

    return view('adminView.konfirmasiPembayaran', compact('transaksi'));
}

// TOMBOL KONFIRMASI
public function konfirmasiPembayaran($id)
{
    // Ambil data transaksi berdasarkan id_transaksi
    $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

    // Update status pesanan
    $transaksi->update([
        'status_pesanan' => 'dibayar',
    ]);

    return redirect()
        ->route('admin.transaksi.konfirmasiList')
        ->with('success', 'Pembayaran telah dikonfirmasi!');
}



}

