@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
@php
    $items = json_decode(request('items'), true) ?? [];
    $totalBarang = 0;
    $alamatUtama = \App\Models\AlamatUser::where('is_utama', true)->first();
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
    #map {
        height: 260px;
        border-radius: 12px;
        margin-top: 12px;
    }
</style>

<div class="pt-24 pb-10 brown-bg min-h-screen px-5 space-y-5">

    <!-- 🟫 Bagian Alamat -->
    <div class="section-card">
        <div class="flex justify-between items-center pb-2 border-b brown-border">
            <h3 class="font-semibold text-sm brown-primary">Alamat Pengiriman</h3>
            <a href="{{ route('alamat.index') }}" class="text-xs text-blue-600 hover:underline">Ubah Alamat</a>
        </div>

        @php
            $alamatDipakai = session('alamat_checkout')
                ? \App\Models\AlamatUser::find(session('alamat_checkout'))
                : $alamatUtama;
        @endphp

        @if($alamatDipakai)
            <div class="mt-3 text-sm text-gray-700">
                <p class="font-semibold text-gray-900">{{ $alamatDipakai->nama_penerima }} (+62 {{ $alamatDipakai->no_hp }})</p>
                <p class="text-gray-600 leading-relaxed">{{ $alamatDipakai->alamat }}, {{ $alamatDipakai->kota }}, {{ $alamatDipakai->provinsi }}</p>
                <p class="text-gray-500 text-xs">ID {{ $alamatDipakai->kode_pos }}</p>
            </div>
        @else
            <p class="text-gray-500 text-sm italic mt-3">Belum ada alamat yang dipilih.</p>
        @endif

        <div id="map"></div>
    </div>

    <!-- 🟫 Pengiriman & Pembayaran -->
    <div class="section-card space-y-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-700">Opsi Pengiriman</label>
                <select class="w-full border-gray-300 rounded-lg py-2 mt-1 shadow-sm text-sm focus:ring-brown-primary focus:border-brown-primary">
                    <option>Hemat Cargo - Est. 2-5 Juni 2025</option>
                    <option>JNE - Est. 2-5 Juni 2025</option>
                    <option>Gosend - Est. 2-5 Juni 2025</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Metode Pembayaran</label>
                <select class="w-full border-gray-300 rounded-lg py-2 mt-1 shadow-sm text-sm focus:ring-brown-primary focus:border-brown-primary">
                    <option>Transfer Bank</option>
                    <option>OVO</option>
                    <option>Dana</option>
                </select>
            </div>
        </div>
    </div>

    <!-- 🟫 Produk -->
    <div class="section-card">
        <h3 class="font-semibold text-sm brown-primary border-b brown-border pb-2 mb-3">Produk Dipesan</h3>

        @forelse ($items as $item)
            @php $subtotal = $item['harga'] * $item['jumlah']; $totalBarang += $subtotal; @endphp

            <div class="flex items-start gap-4 py-3 border-b last:border-b-0 brown-border">
                <img src="{{ $item['img'] }}" class="w-16 h-16 object-cover rounded border" />

                <div class="flex-1">
                    <p class="font-medium text-sm text-gray-900">{{ $item['nama'] }}</p>
                    <p class="text-xs text-gray-500">Toko Tekomoro</p>
                    <p class="text-xs text-gray-500 mt-1">x{{ $item['jumlah'] }}</p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-600">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                    <p class="font-bold text-sm brown-primary">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 py-4">Tidak ada produk yang dipilih</p>
        @endforelse
    </div>

    <!-- 🟫 Rincian Pembelian -->
    <div class="section-card">
        <h3 class="font-semibold text-sm brown-primary border-b brown-border pb-2 mb-3">Rincian Pembelian</h3>
        <div class="text-sm text-gray-700 space-y-2">
            <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($totalBarang, 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>Ongkir</span><span>Rp 16.000</span></div>
            <div class="flex justify-between font-bold text-md brown-primary border-t pt-3 mt-3"><span>Total Bayar</span><span>Rp {{ number_format($totalBarang + 16000, 0, ',', '.') }}</span></div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([-7.706113, 110.606742], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker([-7.706113, 110.606742]).addTo(map);
        setTimeout(() => map.invalidateSize(), 500);
    });
</script>

<form id="checkoutForm" class="text-end">
    @csrf
    <input type="hidden" name="items" value='@json($items)'>
    <input type="hidden" name="total" value="{{ $totalBarang + 16000 }}">
    <button type="submit" class="w-full bg-[#6B4F3B] hover:bg-[#5A4230] text-white py-3 rounded-lg font-semibold shadow-md transition">
        Buat Pesanan
    </button>
</form>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('checkoutForm').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);

    axios.post("{{ route('transaksi.store') }}", formData)
        .then(response => {
            Swal.fire({
                icon: 'success',
                title: 'Pesanan Berhasil!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                localStorage.removeItem('cartItems');
                localStorage.removeItem('checkoutItems');
                window.location.href = "{{ route('home') }}";
            });
        })
        .catch(error => {
            Swal.fire('Error', 'Terjadi kesalahan saat memproses pesanan', 'error');
        });
});
</script>


@endsection
