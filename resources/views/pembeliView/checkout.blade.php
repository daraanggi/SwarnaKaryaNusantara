@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
@php
    $items = json_decode(request('items'), true) ?? [];
    $totalBarang = 0;
@endphp

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Header -->
<div id="headerCheckout" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-lg transition-all duration-300 ml-64 w-[calc(100%-16rem)]">
    <span>Checkout</span>
    <img src="/images/logo.png" class="w-10 h-10 rounded-full bg-white object-contain"/>
</div>

<!-- Main Content -->
<div class="ml-64 transition-all duration-300 pt-20 px-6 pb-10 bg-gray-50 space-y-6">

    <!-- Alamat Pengiriman -->
    <div class="border rounded-lg p-4 bg-[#F5F5F5]">
        <div class="flex justify-between items-center">
            <div class="text-sm font-medium text-gray-700">Alamat Pengiriman</div>
            <a href="{{ route('editAlamat') }}" class="text-xs text-blue-600 hover:underline">Ubah</a>
        </div>
        <div class="mt-2 text-sm text-gray-800 leading-relaxed">
            Dara Anggi Puspa <br>
            +62 85634879124 <br>
            Jebugan, Klaten Utara, Jawa Tengah <br>
            ID 57433
        </div>
    </div>

    <!-- Pilihan Pengiriman & Pembayaran -->
    <div class="flex flex-col md:flex-row gap-4">
        <div class="w-full md:w-1/2">
            <label class="text-sm font-medium text-gray-700">Opsi Pengiriman</label>
            <select class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#69553E] focus:border-[#69553E]">
                <option>Hemat Cargo - Estimasi 2-5 Juni 2025</option>
                <option>JNE - Estimasi 2-5 Juni 2025</option>
                <option>Gosend - Estimasi 2-5 Juni 2025</option>
            </select>
        </div>
        <div class="w-full md:w-1/2">
            <label class="text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#69553E] focus:border-[#69553E]">
                <option>Transfer Bank</option>
                <option>OVO</option>
                <option>Dana</option>
            </select>
        </div>
    </div>

    <!-- Produk Dipesan -->
    <div class="border rounded-lg p-4 bg-white">
        <div class="text-sm font-semibold text-[#69553E] mb-3">Produk Dipesan</div>
        @forelse ($items as $item)
            @php
                $subtotal = $item['harga'] * $item['jumlah'];
                $totalBarang += $subtotal;
            @endphp
            <div class="flex items-center gap-4 mb-4">
                <img src="{{ $item['img'] }}" alt="{{ $item['nama'] }}" class="w-20 h-20 rounded object-cover">
                <div class="flex-1">
                    <div class="text-sm font-medium text-gray-800">{{ $item['nama'] }}</div>
                    <div class="text-xs text-gray-500">Toko Tekomoro</div>
                </div>
                <div class="text-right text-sm text-gray-700">
                    <div>Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                    <div class="text-xs">x{{ $item['jumlah'] }}</div>
                    <div class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Tidak ada produk yang dipilih</p>
        @endforelse
    </div>

    <!-- Rincian Pembayaran -->
    <div class="bg-[#F5F5F5] p-4 rounded-lg">
        <div class="text-sm font-semibold text-[#69553E] mb-2">Rincian Pembelian</div>
        <div class="text-sm text-gray-800 space-y-1">
            <div class="flex justify-between">
                <span>Subtotal Pesanan</span>
                <span>Rp {{ number_format($totalBarang, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Ongkir</span>
                <span>Rp 16.000</span>
            </div>
            <div class="flex justify-between font-bold text-[#69553E] border-t pt-2">
                <span>Total Bayar</span>
                <span>Rp {{ number_format($totalBarang + 16000, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Form Buat Pesanan -->
    <form action="{{ route('transaksi.store') }}" method="POST" class="text-end mt-4">
        @csrf
        <input type="hidden" name="items" value='@json($items)'>
        <input type="hidden" name="total" value="{{ $totalBarang + 16000 }}">
        <button type="submit" class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-6 py-2 rounded-full shadow-md text-sm font-semibold">
            Buat Pesanan
        </button>
    </form>
</div>

<!-- SweetAlert pop-up -->
@if(session('pesanan_berhasil'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Pesanan Berhasil!',
            text: 'Pesanan kamu sudah kami terima. Silakan lanjutkan pembayaran.',
            showConfirmButton: true,
            confirmButtonColor: '#6B4F3B',
            confirmButtonText: 'Oke, Terima Kasih!'
        });
    });
</script>
@endif

@endsection
