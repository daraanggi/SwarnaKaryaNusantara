@extends('layouts.app')

@section('content')
<div class="flex mt-10">
    <div class="flex-1 p-6">
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
        @foreach ($pesanans as $pesanan)
            <div class="bg-[#82634B] text-white p-4 rounded-lg shadow mt-4">
                <div class="flex space-x-4">
                    <img src="{{ asset($pesanan->img) }}" class="w-20 h-20 object-cover rounded" alt="">
                    <div>
                        <p class="font-semibold">{{ $pesanan->nama }}</p>
                        <p>Total {{ $pesanan->jumlah }} produk: Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                        <div class="flex gap-2 mt-1 flex-wrap">
                            <span class="bg-white text-[#82634B] px-2 py-0.5 rounded font-semibold">
                                Status: {{ $pesanan->status_pengiriman }}
                            </span>
                            <span class="bg-white text-[#82634B] px-2 py-0.5 rounded font-semibold">
                                Pembayaran: {{ $pesanan->status_pembayaran }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
