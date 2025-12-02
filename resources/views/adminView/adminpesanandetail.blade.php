@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.pesanan', $produk->id_produk) }}" class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-8 w-8 text-[#6b543f] hover:text-[#4b3928] transition"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
        </a>

        <h2 class="text-3xl font-bold text-[#6b543f]">Detail Pesanan</h2>
    </div>

    {{-- Card utama --}}
    <section class="bg-[#6b543f] text-white rounded-[24px] shadow-2xl p-6 space-y-5">

        {{-- Nama Produk --}}
        <h3 class="text-xl font-semibold">{{ $produk->nama }}</h3>

        {{-- Detail Pesanan --}}
        <div class="bg-white text-[#3a2c1b] rounded-2xl p-5 space-y-3">

            <div class="flex justify-between border-b border-gray-300 pb-2">
                <span>Nomor Telepon</span>
                <span class="font-semibold">{{ $pesanan->no_telp }}</span>
            </div>

            <div class="flex justify-between border-b border-gray-300 pb-2">
                <span>Jumlah Dipesan</span>
                <span class="font-semibold">{{ $pesanan->jumlah }}</span>
            </div>

            <div class="flex justify-between border-b border-gray-300 pb-2">
                <span>Tanggal Pesan</span>
                <span class="font-semibold">
                    {{ $pesanan->created_at->format('d M Y, H:i') }}
                </span>
            </div>

        </div>

    </section>

</div>

@endsection
