@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center mb-6">
        {{-- Kembali ke LIST konfirmasi --}}
        <a href="{{ route('admin.transaksi.konfirmasiList') }}" class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-8 w-8 text-[#6b543f] hover:text-[#4b3928] transition"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h2 class="text-3xl font-bold text-[#6b543f]">Konfirmasi Pembayaran</h2>
    </div>

    {{-- CARD UTAMA --}}
    <section class="bg-[#6b543f] text-white rounded-[24px] shadow-2xl p-6 space-y-5">

        <div class="space-y-2">
            <p class="text-sm text-white/80">ID Transaksi</p>
            <p class="text-2xl font-bold">#{{ $transaksi->id }}</p>

            <p class="text-sm text-white/80 mt-3">Total Bayar</p>
            <p class="text-xl font-semibold">
                Rp {{ number_format($transaksi->total_harga ?? 0, 0, ',', '.') }}
            </p>

            <p class="text-sm text-white/80 mt-3">Status Saat Ini</p>
            <p class="inline-block px-3 py-1 rounded-full bg-white/20 font-semibold">
                {{ $transaksi->status_pesanan }}
            </p>
        </div>

        {{-- FORM KONFIRMASI --}}
        @if (strtolower($transaksi->status_pesanan) === 'menunggu pembayaran')
            <form action="{{ route('admin.transaksi.konfirmasi.submit', $transaksi->id_transaksi) }}" method="POST">
                @csrf

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold shadow mt-4">
                    ✔ Konfirmasi Pembayaran Diterima
                </button>
            </form>
        @else
            <div class="mt-4 bg-white text-[#165534] rounded-xl p-3 text-center font-semibold">
                Pembayaran sudah dikonfirmasi (status: {{ $transaksi->status_pesanan }}).
            </div>
        @endif

    </section>

</div>

@endsection
