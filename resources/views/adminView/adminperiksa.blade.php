@extends('layouts.admin')

@section('content')

<div class="w-full flex justify-center px-4">

    <div class="w-full max-w-4xl">

        {{-- HEADER --}}
        <div class="flex items-center mb-8 mt-4">
            <a href="{{ route('admin.transaksi') }}" class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-9 w-9 text-[#6b543f] hover:opacity-75 transition"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <h2 class="text-3xl font-bold text-[#6b543f] tracking-wide">
                Laporan Transaksi
            </h2>
        </div>

        {{-- CARD UTAMA --}}
        <section class="bg-[#6b543f] text-white rounded-[24px] shadow-2xl p-6">

            @if($transaksi->isEmpty())
                <p class="py-6 text-center text-white/80 text-lg italic">
                    Belum ada produk / transaksi.
                </p>
            @else

                <div class="divide-y divide-white/20">

                    @foreach ($transaksi as $produk)

                        <div class="flex justify-between items-center py-4">

                            <div class="flex items-center gap-3">

                                {{-- FOTO PRODUK --}}
                                <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : asset('images/produk.jpg') }}"
                                     class="w-14 h-14 object-cover rounded-lg bg-white p-1 shadow"
                                     alt="Foto Produk">

                                {{-- Nama Produk --}}
                                <p class="text-lg font-semibold">
                                    {{ $produk->nama }}
                                </p>
                            </div>

                            <a href="{{ route('admin.pesanan', $produk->id_produk) }}"
                               class="px-6 py-2 bg-white text-[#6b543f] font-semibold rounded-full 
                                      shadow hover:bg-gray-100 transition">
                                Detail
                            </a>
                        </div>

                    @endforeach

                </div>

            @endif

        </section>

    </div>

</div>

@endsection
