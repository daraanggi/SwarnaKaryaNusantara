@extends('layouts.penjual')

@section('title', 'Transaction Detail')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-[#69553E]">Transaction Report</h1>

    <div class="flex flex-wrap items-center gap-4 mb-6">
        <select class="bg-[#A38B74] text-white px-4 py-2 rounded">
            <option>Bulan</option>
            <option>Januari</option>
            <option>Februari</option>
            <option>Maret</option>
            <!-- Tambahkan opsi lainnya -->
        </select>
        <select class="bg-[#A38B74] text-white px-4 py-2 rounded">
            <option>Tahun</option>
            <option>2023</option>
            <option>2024</option>
        </select>
        <button class="bg-[#69553E] text-white px-4 py-2 rounded">Apply</button>
        <button class="bg-[#69553E] text-white px-4 py-2 rounded flex items-center gap-2"><i class="bi bi-download"></i> Download</button>
        <!--<button class="bg-[#69553E] text-white px-4 py-2 rounded flex items-center gap-2"><i class="bi bi-filter"></i> Filter</button>-->
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-[#A38B74] text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Nomor Invoice</th>
                    <th class="px-4 py-2 text-left">Waktu Pemesanan</th>
                    <th class="px-4 py-2 text-left">Pemesanan</th>
                    <th class="px-4 py-2 text-left">Metode Pembayaran</th>
                    <th class="px-4 py-2 text-left">Status Pesanan</th>
                    <th class="px-4 py-2 text-left">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTransaksi as $i => $transaksi)
                    <tr 
                        class="{{ $i % 2 == 0 ? 'bg-[#D2C1AE]' : 'bg-[#A38B74]' }} text-white cursor-pointer hover:bg-opacity-80"
                        onclick="window.location.href='{{ route('orderDetail', ['id' => $transaksi->id_transaksi]) }}'">
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
