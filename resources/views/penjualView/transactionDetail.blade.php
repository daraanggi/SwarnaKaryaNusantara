@extends('layouts.penjual')

@section('title', 'Transaction Detail')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-[#69553E]">Laporan Detail Transaksi</h1>

    <a href="{{ route('transaction.download') }}" 
        class="bg-[#69553E] text-white px-4 py-2 rounded inline-flex items-center gap-2 mb-4">
        <i class="bi bi-download"></i> Unduh Laporan
    </a>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-[#A38B74] text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Nomor Pemesanan</th>
                    <th class="px-4 py-2 text-left">Waktu Pemesanan</th>
                    <th class="px-4 py-2 text-left">Nama Barang</th>
                    <th class="px-4 py-2 text-left">Metode Pembayaran</th>
                    <th class="px-4 py-2 text-left">Status Pesanan</th>
                    <th class="px-4 py-2 text-left">Harga Barang</th>
                    <th class="px-4 py-2 text-left">Total</th> {{-- ✅ Kolom baru --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTransaksi as $i => $transaksi)
                    <tr 
                        class="{{ $i % 2 == 0 ? 'bg-[#D2C1AE]' : 'bg-[#A38B74]' }} text-white cursor-pointer hover:bg-opacity-80"
                        onclick="window.location.href='{{ route('detailTransaksi.show', ['id' => $transaksi->id_transaksi]) }}'">
                        <td class="px-4 py-2">{{ $transaksi->id_transaksi }}</td>
                        <td class="px-4 py-2">{{ $transaksi->tanggal_pesan }}</td>
                        
                        <td class="px-4 py-2">
                            @php
                                $produkList = $transaksi->detailTransaksi->map(function($dt) {
                                    return $dt->produk->nama ?? '-';
                                })->implode(', ');
                            @endphp
                            {{ $produkList }}
                        </td>

                        <td class="px-4 py-2">{{ $transaksi->metode_pembayaran ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $transaksi->status_pesanan }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td> {{-- ✅ Kolom total per transaksi --}}
                    </tr>
                @endforeach

                {{-- 🔽 Baris total keseluruhan --}}
                <tr class="bg-[#69553E] text-white font-bold">
                    <td colspan="6" class="px-4 py-2 text-right">Total Keseluruhan</td>
                    <td class="px-4 py-2">
                        Rp {{ number_format($dataTransaksi->sum('total_harga'), 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
