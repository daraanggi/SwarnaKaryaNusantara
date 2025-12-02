@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto">

    <h2 class="text-3xl font-bold text-[#6b543f] mb-6">Konfirmasi Pembayaran</h2>

    <section class="bg-[#6b543f] text-white rounded-[24px] shadow-xl p-6">

        @if($pesananPending->isEmpty())
            <p class="text-center text-white/80">Tidak ada pesanan menunggu pembayaran.</p>
        @else
            @foreach($pesananPending as $pesanan)
                <div class="flex justify-between items-center border-b border-white/20 py-3">

                    <div>
                        <p class="text-lg font-semibold">ID Transaksi: {{ $pesanan->id_transaksi }}</p>
                        <p class="text-sm text-white/80">Total: Rp {{ number_format($pesanan->total_harga,0,',','.') }}</p>
                    </div>

                    <a href="{{ route('admin.transaksi.konfirmasi.show', $pesanan->id_transaksi) }}"
                       class="bg-white text-[#6b543f] px-4 py-2 rounded-full font-semibold hover:bg-gray-100">
                        Periksa
                    </a>

                </div>
            @endforeach
        @endif

    </section>

</div>

@endsection
