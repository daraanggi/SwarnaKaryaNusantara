@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
@php
    use Illuminate\Support\Str;

    $imagePath = Str::startsWith($produk->foto, 'produk/')
        ? asset('storage/' . $produk->foto)
        : asset('images/' . $produk->foto);
@endphp

<div id="headerDetail" class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 bg-[#FFFFFF] text-primary-brown font-extrabold text-xl transition-all duration-300 border-b border-gray-100 shadow-md">
    <h1 class="font-bold text-xl">Detail Barang</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>

<div class="px-8 pt-20 pb-20 bg-gradient-to-b from-[#F7F3EF] to-[#FFF9F0] min-h-screen">
    <div class="bg-white shadow-2xl rounded-3xl flex flex-col md:flex-row gap-10 p-8 hover:shadow-3xl transition-shadow duration-300">

        <!-- Gambar Produk -->
        <div class="flex-1 flex justify-center items-center relative group overflow-hidden rounded-3xl">
            <img src="{{ $imagePath }}" alt="{{ $produk->nama }}"
                 class="rounded-3xl object-cover w-full max-h-[500px] transform transition-transform duration-300 group-hover:scale-105 shadow-lg">
            <span class="absolute top-4 left-4 bg-[#6B4F3B] text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">10RB+ Terjual</span>
        </div>

        <!-- Detail Produk -->
        <div class="flex-1 flex flex-col justify-between space-y-6">
            <div class="space-y-3">
                <h1 class="text-3xl font-bold text-[#6B4F3B]">{{ $produk->nama }}</h1>
                <p class="text-gray-700 text-sm leading-relaxed">{{ $produk->deskripsi }}</p>
                <p class="text-3xl font-extrabold text-[#8B5E3C] bg-clip-text text-transparent bg-gradient-to-r from-[#6B4F3B] to-[#A67C52]">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </p>

                <div class="space-y-1">
                    <p class="font-semibold text-lg">Pengiriman</p>
                    <p class="text-sm text-gray-600">Tiba Pada 31 Mei - 2 Juni 2025</p>
                </div>
            </div>

            <div class="flex flex-col gap-5 mt-4">

                <!-- Jumlah Produk -->
                <div class="flex items-center gap-4">
                    <span class="font-medium text-lg">Jumlah</span>
                    <div class="flex border rounded-full overflow-hidden shadow-sm">
                        <button id="minus"
                                class="bg-[#6B4F3B] text-white w-12 h-12 flex items-center justify-center text-lg hover:bg-[#5A4230] transition-transform duration-200 hover:scale-110">
                            −
                        </button>
                        <input type="text" id="jumlah" value="1" readonly
                               class="w-16 text-center bg-white font-semibold text-gray-700">
                        <button id="plus"
                                class="bg-[#6B4F3B] text-white w-12 h-12 flex items-center justify-center text-lg hover:bg-[#5A4230] transition-transform duration-200 hover:scale-110">
                            +
                        </button>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex gap-4 flex-wrap">

                    <!-- Tambah ke Keranjang -->
                    <button id="addToCart"
                            class="flex items-center gap-2 px-6 py-3 bg-[#6B4F3B] text-white font-semibold rounded-2xl shadow-md hover:shadow-lg hover:translate-y-[-2px] transition-all duration-300">
                        Masukan Keranjang
                        <i class="bi bi-cart-plus"></i>
                    </button>

                    <!-- BELI SEKARANG -->
                    <form id="beliSekarangForm" method="POST" action="{{ route('checkout.start') }}">
                        @csrf
                        @php
                            $produkItem = [
                                'id' => $produk->id_produk,
                                'nama' => $produk->nama,
                                'img' => $imagePath,
                                'harga' => $produk->harga,
                                'jumlah' => 1
                            ];
                        @endphp

                        <input type="hidden" id="itemsInput" name="items" value='@json([$produkItem])'>

                        <button type="submit"
                                class="px-6 py-3 bg-[#6B4F3B] text-white font-semibold rounded-2xl shadow-md hover:shadow-lg hover:translate-y-[-2px] transition-all duration-300">
                            Beli Sekarang
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const qtyInput = document.getElementById('jumlah');
    const qtyHiddenInput = document.getElementById('itemsInput');

    // Update Qty
    document.getElementById('plus').onclick = () => updateQty(1);
    document.getElementById('minus').onclick = () => updateQty(-1);

    function updateQty(change) {
        let qty = parseInt(qtyInput.value);
        qty = Math.max(1, qty + change);
        qtyInput.value = qty;

        qtyHiddenInput.value = JSON.stringify([{
            id: "{{ $produk->id_produk }}",
            nama: "{{ $produk->nama }}",
            img: "{{ $imagePath }}",
            harga: {{ $produk->harga }},
            jumlah: qty
        }]);
    }

    // Tambah ke Keranjang
    document.getElementById("addToCart").addEventListener("click", () => {
        const idProduk = "{{ $produk->id_produk }}";
        const nama = "{{ $produk->nama }}";
        const harga = "{{ $produk->harga }}";
        const img = "{{ $imagePath }}";
        const qty = parseInt(qtyInput.value);

        let cart = JSON.parse(localStorage.getItem('cartItems')) || [];
        const existing = cart.find(item => item.id === idProduk);

        if (existing) {
            existing.qty += qty;
        } else {
            cart.push({ id: idProduk, nama, harga, img, qty });
        }
        localStorage.setItem('cartItems', JSON.stringify(cart));

        alert('Produk berhasil ditambahkan ke keranjang!');
    });
});
</script>

@endsection
