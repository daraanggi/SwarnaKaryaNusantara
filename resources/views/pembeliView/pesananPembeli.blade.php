@extends('layouts.app')

@section('title', 'Pesanan')

@section('content')
<div class="mt-10 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="flex items-center space-x-2 mb-4">
            <div class="bg-[#82634B] text-white rounded-full p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 3h18v2H3V3zm0 4h18v13H3V7zm4 2h10v2H7V9z" />
                </svg>
            </div>
            <h2 class="text-lg font-bold text-[#82634B]">Pesanan</h2>
        </div>

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

                <div class="bg-[#82634B] text-white p-4 rounded-lg shadow mt-4 max-w-3xl mx-auto">
                    <div class="flex space-x-4">
                        <img src="{{ asset($gambar) }}"
                             class="w-20 h-20 object-cover rounded border"
                             alt="Foto Produk"
                             onerror="this.onerror=null; this.src='{{ asset('images/produk.jpg') }}';" />

                        <div>
                            <p class="font-semibold">
                                {{ $detail->produk->nama ?? 'Tidak ada nama' }}
                            </p>
                            <p>Total {{ $detail->jumlah ?? 1 }} produk:
                                Rp 
                                {{ number_format(($detail->produk->harga ?? 0) * ($detail->jumlah ?? 1), 0, ',', '.') }}
                            </p>

                            <div class="flex gap-2 mt-1 flex-wrap">
                                <span class="bg-white text-[#82634B] px-2 py-0.5 rounded font-semibold">
                                    Status: {{ $pesanan->status_pengiriman ?? 'Menunggu' }}
                                </span>
                                <span class="bg-white text-[#82634B] px-2 py-0.5 rounded font-semibold">
                                    Pembayaran: {{ $pesanan->status_pembayaran ?? 'Belum dibayar' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            <p class="text-center text-gray-500 mt-8">Belum ada pesanan.</p>
        @endforelse
    </div>
</div>
@endsection
