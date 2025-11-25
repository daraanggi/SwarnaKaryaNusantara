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

        <!-- Spacer untuk menghindari header overlap -->
        <div class="h-20"></div>

        <!-- Daftar Pesanan -->
        @forelse ($pesanans as $pesanan)
            @foreach ($pesanan->detailTransaksi as $detail)

                @php
                    $foto = $detail->produk->foto ?? null;
                    $isFromStorage = \Illuminate\Support\Str::startsWith($foto, 'produk/');
                    $gambar = $isFromStorage
                        ? 'storage/' . $foto
                        : ($foto ? 'images/' . $foto : 'images/produk.jpg');
                @endphp

                <div class="bg-[#82634B] text-white p-5 rounded-xl shadow-md mt-5 max-w-3xl mx-auto">

                    <div class="flex items-start space-x-4">

                        <!-- Gambar -->
                        <img src="{{ asset($gambar) }}"
                             class="w-24 h-24 object-cover rounded-lg border border-white/40 shadow"
                             alt="Foto Produk"
                             onerror="this.onerror=null; this.src='{{ asset('images/produk.jpg') }}';" />

                        <div class="flex-1">

                            <!-- Nama Produk -->
                            <p class="font-semibold text-lg leading-tight">
                                {{ $detail->produk->nama ?? 'Tidak ada nama' }}
                            </p>

                            <!-- Jumlah & Total -->
                            <p class="text-sm mt-1">
                                Total {{ $detail->jumlah ?? 1 }} produk:
                                <span class="font-semibold">
                                    Rp {{ number_format(($detail->produk->harga ?? 0) * ($detail->jumlah ?? 1), 0, ',', '.') }}
                                </span>
                            </p>

                            <!-- Status -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="bg-white text-[#82634B] px-3 py-1 rounded-lg text-sm font-semibold shadow">
                                    Status: {{ $pesanan->status_pengiriman ?? 'Menunggu' }}
                                </span>

                                <span class="bg-white text-[#82634B] px-3 py-1 rounded-lg text-sm font-semibold shadow">
                                    Pembayaran: {{ $pesanan->status_pembayaran ?? 'Belum dibayar' }}
                                </span>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach

        @empty
            <p class="text-center text-gray-500 mt-10 text-lg">Belum ada pesanan.</p>
        @endforelse

    </div>
</div>
@endsection
