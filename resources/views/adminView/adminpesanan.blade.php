@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.periksa') }}" class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" 
                class="h-8 w-8 text-[#6b543f] hover:text-[#4b3928] transition"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
        </a>

        <h2 class="text-3xl font-bold text-[#6b543f]">Laporan Transaksi</h2>
    </div>

    {{-- Card utama --}}
    <section class="bg-[#6b543f] text-white rounded-[24px] shadow-2xl p-6">

        {{-- Nama Produk --}}
        <h3 class="text-xl font-semibold mb-5">{{ $produk->nama }}</h3>

        {{-- Info Stok & Terjual --}}
        <div class="space-y-3 mb-6">

            <div class="flex justify-between bg-white text-[#3a2c1b] rounded-full py-2 px-4">
                <span>Jumlah Stok</span>
                <span class="font-semibold">{{ $produk->stok }}</span>
            </div>

            <div class="flex justify-between bg-white text-[#3a2c1b] rounded-full py-2 px-4">
                <span>Jumlah Terjual</span>
                <span class="font-semibold">{{ $orders->sum('jumlah') }}</span>
            </div>

        </div>

        {{-- Daftar Pesanan --}}
        <div class="bg-white text-[#3a2c1b] rounded-2xl p-5">

            <div class="flex justify-between font-semibold mb-3 border-b border-gray-300 pb-2">
                <span>Pesanan</span>
                <span>No. Telp</span>
            </div>

            <div class="space-y-2">

                @if ($orders->isEmpty())
                    <div class="py-2 text-center text-gray-500">
                        Belum ada pesanan untuk produk ini.
                    </div>
                @else
                    @foreach ($orders as $order)
                        <div class="flex justify-between">

                            {{-- Link detail pesanan --}}
                            <a href="{{ route('admin.pesanan.detail', [$produk->id_produk, $order->id]) }}"
                               class="text-[#6b543f] font-medium hover:underline">
                                Pesanan {{ $loop->iteration }}
                            </a>

                            <span>{{ $order->no_telp }}</span>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>

    </section>

</div>

@endsection
