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

        <div class="mt-6 flex justify-between items-center">

            {{-- BUTTON KEMBALI --}}
            <a href="{{ route('showTransactionDetail') }}">
                <button class="bg-white text-[#705740] px-6 py-2 rounded-full font-semibold">
                    Kembali
                </button>
            </a>

            {{-- BUTTON AKSI --}}
            <div class="flex gap-3">

                {{-- PESANAN DIKIRIM --}}
                <form action="{{ route('penjual.pesanan.kirim', $transaksi->id_transaksi) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-blue-300 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-400">
                        Pesanan Dikirim
                    </button>
                </form>

                {{-- PESANAN SELESAI --}}
                <form action="{{ route('penjual.pesanan.selesai', $transaksi->id_transaksi) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-green-400 text-white px-6 py-2 rounded-full font-semibold hover:bg-green-500">
                        Pesanan Selesai
                    </button>
                </form>

            </div>
        </div>

    </div>
@endsection
