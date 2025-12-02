@extends('layouts.app')

@section('title', 'Pesanan')

@section('content')
<div class="mt-10 px-4">
    <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div id="headerPesanan"
            class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4
                   bg-white text-primary-brown font-extrabold text-xl border-b shadow-sm">
            <h1 class="font-bold text-xl">Pesanan</h1>
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
                <img src="/images/logo.png"
                     class="w-8 h-8 rounded-full object-contain"
                     alt="Logo" />
            </div>
        </div>

        <div class="h-20"></div>

        <!-- Daftar Pesanan -->
        @forelse ($pesanans as $pesanan)
            <div class="bg-[#82634B] text-white p-5 rounded-xl shadow-md mt-5">

                <!-- Info Transaksi -->
                <div class="flex justify-between items-center mb-3">
                    <p class="font-semibold text-lg">Invoice: {{ $pesanan->id_transaksi }}</p>
                    <p class="text-sm">
                        Tanggal: {{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y') }}
                    </p>
                </div>

                <!-- Daftar Produk -->
                @foreach ($pesanan->detailTransaksi as $detail)
                    @php
                        $foto = $detail->produk->foto ?? null;
                        $isFromStorage = \Illuminate\Support\Str::startsWith($foto, 'produk/');
                        $gambar = $isFromStorage
                            ? 'storage/' . $foto
                            : ($foto ? 'images/' . $foto : 'images/produk.jpg');
                    @endphp

                    <div class="flex items-center gap-4 bg-white text-black rounded-lg p-3 mb-3 shadow">
                        <img src="{{ asset($gambar) }}"
                             class="w-20 h-20 object-cover rounded-lg border border-gray-300"
                             alt="Foto Produk"
                             onerror="this.onerror=null; this.src='{{ asset('images/produk.jpg') }}';" />

                        <div class="flex-1">
                            <p class="font-semibold">{{ $detail->produk->nama ?? 'Produk tidak ada' }}</p>
                            <p class="text-sm">Jumlah: {{ $detail->jumlah }}</p>
                            <p class="text-sm font-semibold">
                                Subtotal: Rp {{ number_format(
                                    $detail->subtotal ?? ($detail->produk->harga * $detail->jumlah),
                                    0, ',', '.'
                                ) }}
                            </p>
                        </div>
                    </div>
                @endforeach

                @php
    // SAMAKAN TEKS STATUS SESUAI DATABASE
    $dbStatus = $pesanan->status_pesanan;

    // STATUS PESANAN UNTUK DITAMPILKAN
    $statusPesanan = match($dbStatus) {
        'Menunggu Pembayaran' => 'Menunggu Pembayaran',
        'dibayar'             => 'Pesanan Diproses',
        'Dikirim'             => 'Pesanan Dikirim',
        'Selesai'             => 'Pesanan Selesai',
        default               => 'Menunggu Pembayaran'
    };

    // STATUS PEMBAYARAN
    $statusPembayaran = match($dbStatus) {
        'dibayar', 'Dikirim', 'Selesai' => 'Sudah dibayar',
        default => 'Belum dibayar'
    };
@endphp


                <!-- Total & Status -->
                <div class="flex justify-between items-center mt-3">
                    <p class="font-semibold text-lg">
                        Total: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </p>

                    <div class="flex gap-2">
                        <span class="bg-white text-[#82634B] px-3 py-1 rounded-lg text-sm font-semibold shadow">
                            Status: {{ $statusPesanan }}
                        </span>
                        <span class="bg-white text-[#82634B] px-3 py-1 rounded-lg text-sm font-semibold shadow">
                            Pembayaran: {{ $statusPembayaran }}
                        </span>
                    </div>
                </div>

            </div>
        @empty
            <p class="text-center text-gray-500 mt-10 text-lg">Belum ada pesanan.</p>
        @endforelse

    </div>
</div>
@endsection
