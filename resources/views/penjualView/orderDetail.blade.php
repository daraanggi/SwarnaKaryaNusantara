@extends('layouts.penjual')

@section('title', 'Order Detail')

@section('content')
    <div class="bg-[#705740] text-white rounded-xl p-8 w-full">
        <h2 class="text-2xl font-bold mb-6">Order Detail</h2>

        <div class="grid gap-4">
            <div class="flex justify-between border-b pb-2">
                <span>Nomor Resi</span>
                <span>{{ $transaksi->id_transaksi }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span>Nama Produk</span>
                <span>
                    @foreach ($transaksi->detailTransaksi as $detail)
                        {{ optional($detail->produk)->nama ?? '-' }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span>Status</span>
                <span>{{ $transaksi->status_pesanan }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span>Waktu Pesanan</span>
                <span>{{ $transaksi->tanggal_pesan }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span>Jumlah Pesanan</span>
                <span>{{ $transaksi->detailTransaksi->sum('jumlah') }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span>Total Pesanan</span>
                <span>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('transaction.detail') }}">
                <button class="bg-white text-[#705740] px-6 py-2 rounded-full font-semibold">
                    Kembali
                </button>
            </a>
        </div>
    </div>
@endsection
