@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div id="headerCheckout" 
    class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 
           bg-white text-primary-brown font-extrabold text-xl border-b shadow-sm">
    <h1 class="font-bold text-xl">Checkout</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>

@php
    $items = json_decode(request('items'), true) ?? [];
    $totalBarang = 0;

    $alamatUtama = \App\Models\AlamatUser::where('is_utama', true)->first();
    $alamatDipakai = session('alamat_checkout')
        ? \App\Models\AlamatUser::find(session('alamat_checkout'))
        : $alamatUtama;

    $defaultLat = -7.706113;
    $defaultLng = 110.606742;

    $lat = $alamatDipakai->latitude ?? $defaultLat;
    $lng = $alamatDipakai->longitude ?? $defaultLng;
@endphp

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
    .brown-primary { color: #6B4F3B; }
    .brown-bg { background-color: #F7F3EF; }
    .brown-border { border-color: #D8C7B6; }
    .section-card {
        background: white;
        border: 1px solid #E6DCD2;
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
    }

    /* FIX UTAMA: wrapper map tidak nabrak */
    #mapWrapper {
        width: 100%;
        height: 260px;
        margin-top: 12px;
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        z-index: 1;
    }

    #map {
        height: 100%;
        width: 100%;
        z-index: 1;
    }
</style>

<div class="pt-24 pb-10 brown-bg min-h-screen px-5 space-y-5">

    {{-- ALAMAT --}}
    <div class="section-card">
        <div class="flex justify-between items-center pb-2 border-b brown-border">
            <h3 class="font-semibold text-sm brown-primary">Alamat Pengiriman</h3>
            <a href="{{ route('alamat.index') }}" class="text-xs text-blue-600 hover:underline">Ubah Alamat</a>
        </div>

        @if($alamatDipakai)
            <div class="mt-3 text-sm text-gray-700">
                <p class="font-semibold">{{ $alamatDipakai->nama_penerima }} (+62 {{ $alamatDipakai->no_hp }})</p>
                <p class="text-gray-600 leading-relaxed">
                    {{ $alamatDipakai->alamat }}, {{ $alamatDipakai->kota }}, {{ $alamatDipakai->provinsi }}
                </p>
                <p class="text-gray-500 text-xs">ID {{ $alamatDipakai->kode_pos }}</p>
            </div>
        @else
            <p class="text-gray-500 text-sm italic mt-3">Belum ada alamat yang dipilih.</p>
        @endif

        {{-- MAP WRAPPER FIX --}}
        <div id="mapWrapper">
            <div id="map"></div>
        </div>
    </div>

    {{-- OPSI --}}
    <div class="section-card space-y-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-700">Opsi Pengiriman</label>
                <select class="w-full border-gray-300 rounded-lg py-2 mt-1 shadow-sm text-sm focus:ring-brown-primary">
                    <option>Hemat Cargo - Est. 2–5 Juni 2025</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Metode Pembayaran</label>
                <select class="w-full border-gray-300 rounded-lg py-2 mt-1 shadow-sm text-sm focus:ring-brown-primary">
                    <option>Transfer Bank</option>
                </select>
            </div>
        </div>
    </div>

    {{-- PRODUK --}}
    <div class="section-card">
        <h3 class="font-semibold text-sm brown-primary border-b brown-border pb-2 mb-3">Produk Dipesan</h3>

        @foreach($items as $item)
            @php
                $subtotal = $item['harga'] * $item['jumlah'];
                $totalBarang += $subtotal;
            @endphp

            <div class="flex items-start gap-4 py-3 border-b last:border-b-0 brown-border">
                <img src="{{ $item['img'] }}" class="w-16 h-16 object-cover rounded border" />
                <div class="flex-1">
                    <p class="font-medium text-sm text-gray-900">{{ $item['nama'] }}</p>
                    <p class="text-xs text-gray-500">x{{ $item['jumlah'] }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Rp {{ number_format($item['harga'],0,',','.') }}</p>
                    <p class="font-bold text-sm brown-primary">Rp {{ number_format($subtotal,0,',','.') }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- TOTAL --}}
    <div class="section-card">
        <h3 class="font-semibold text-sm brown-primary border-b brown-border pb-2 mb-3">Rincian Pembelian</h3>

        <div class="text-sm text-gray-700 space-y-2">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span>Rp {{ number_format($totalBarang,0,',','.') }}</span>
            </div>

            <div class="flex justify-between">
                <span>Ongkir</span>
                <span>Rp 16.000</span>
            </div>

            <div class="flex justify-between font-bold text-md brown-primary border-t pt-3 mt-3">
                <span>Total Bayar</span>
                <span>Rp {{ number_format($totalBarang + 16000,0,',','.') }}</span>
            </div>
        </div>
    </div>

    {{-- BUTTON --}}
    <form id="checkoutForm">
        @csrf
        <input type="hidden" name="items" value='@json($items)'>
        <input type="hidden" name="total" value="{{ $totalBarang + 16000 }}">
        <button type="submit" class="w-full bg-[#6B4F3B] hover:bg-[#5A4230] text-white py-3 rounded-lg font-semibold shadow-md">
            Buat Pesanan
        </button>
    </form>
</div>

{{-- MAP SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([@json($lat), @json($lng)], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    L.marker([@json($lat), @json($lng)])
        .addTo(map)
        .bindPopup("Lokasi Pengiriman")
        .openPopup();

    setTimeout(() => map.invalidateSize(), 500);
});
</script>

@endsection
