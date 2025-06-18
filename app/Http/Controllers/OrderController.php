<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showDetail($invoice)
    {
        // Ambil data order berdasarkan invoice
        $order = DB::table('orders')->where('invoice', $invoice)->first();

        if (!$order) {
            abort(404, 'Order tidak ditemukan.');
        }

        // Ambil detail produk dari order tersebut
        $details = DB::table('order_detail')
            ->join('produks', 'order_detail.id_produk', '=', 'produks.id_produk')
            ->where('order_detail.id_order', $order->id_order)
            ->select(
                'produks.nama_produk',
                'produks.foto',
                'order_detail.jumlah',
                'order_detail.sub_total'
            )
            ->get();

        // Kirim data ke view orderDetail.blade.php
        return view('penjualView.orderDetail', compact('order', 'details'));
    }
}

