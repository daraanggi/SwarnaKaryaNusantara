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
        <button class="bg-[#69553E] text-white px-4 py-2 rounded flex items-center gap-2"><i class="bi bi-filter"></i> Filter</button>
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
                @for ($i = 0; $i < 5; $i++)
                    @php
                        $invoice = 'INV00' . ($i + 1);
                    @endphp
                    <tr 
                        class="{{ $i % 2 == 0 ? 'bg-[#D2C1AE]' : 'bg-[#A38B74]' }} text-white cursor-pointer hover:bg-opacity-80"
                        onclick="window.location.href='{{ route('orderDetail', ['invoice' => $invoice]) }}'">
                        <td class="px-4 py-2">{{ $invoice }}</td>
                        <td class="px-4 py-2">2024-06-{{ 10 + $i }}</td>
                        <td class="px-4 py-2">Produk {{ $i + 1 }}</td>
                        <td class="px-4 py-2">Transfer Bank</td>
                        <td class="px-4 py-2">Selesai</td>
                        <td class="px-4 py-2">Rp {{ number_format(100000 * ($i + 1), 0, ',', '.') }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
