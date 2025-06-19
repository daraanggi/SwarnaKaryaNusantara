@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
@php
    use Illuminate\Support\Str;

    $imagePath = Str::startsWith($produk->foto, 'produk/')
        ? asset('storage/' . $produk->foto)
        : asset('images/' . $produk->foto);
@endphp

<!-- Header -->
<div id="headerKeranjang" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-lg transition-all duration-300" style="margin-left: 16rem; width: calc(100% - 16rem);">
    <div class="flex items-center space-x-2">
        <a href="{{ url()->previous() }}" class="rotate-180">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <span>Detail Barang</span>
    </div>
    <img src="/images/logo.png" class="w-10 h-10 rounded-full bg-white object-contain" />
</div>

<!-- Konten Utama -->
<div id="mainContentWrapper" class="transition-all duration-300" style="margin-left: 16rem;">
    <div class="px-8 pt-20 pb-20">
        <div class="bg-white shadow rounded-xl flex flex-col md:flex-row gap-8 p-6">
            <!-- Gambar Produk -->
            <div class="flex-1">
                <img src="{{ $imagePath }}" class="rounded-xl object-cover w-full max-h-[500px]" alt="{{ $produk->nama }}">
                <p class="text-sm text-gray-500 font-semibold mt-2">10RB+ Terjual</p>
            </div>

            <!-- Detail Produk -->
            <div class="flex-1 space-y-4">
                <h1 class="text-2xl font-bold text-gray-900">{{ $produk->nama }}</h1>
                <p class="text-sm text-gray-700">{{ $produk->deskripsi }}</p>
                <p class="text-xl font-bold text-[#6B4F3B]">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

                <div class="space-y-1">
                    <p class="font-semibold text-lg">Pengiriman</p>
                    <p class="text-sm text-gray-600">Tiba Pada 31 Mei - 2 Juni 2025</p>
                </div>

                <div class="flex items-center mt-4 gap-2">
                    <span class="font-medium text-lg">Jumlah</span>
                    <div class="flex border rounded">
                        <button id="minus" class="bg-[#6B4F3B] text-white w-8 h-8">−</button>
                        <input type="text" id="jumlah" name="jumlah" value="1" readonly class="w-10 text-center border-x bg-white">
                        <button id="plus" class="bg-[#6B4F3B] text-white w-8 h-8">+</button>
                    </div>
                </div>

                <div class="flex gap-4 mt-6">
                    <button id="addToCart" class="flex items-center gap-2 px-4 py-2 bg-[#6B4F3B] text-white font-semibold rounded shadow">
                        Masukan Keranjang
                        <i class="bi bi-cart-plus"></i>
                    </button>

                    <form method="GET" action="{{ route('checkout') }}">
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                        <input type="hidden" name="img" value="{{ $imagePath }}">
                        <input type="hidden" name="nama" value="{{ $produk->nama }}">
                        <input type="hidden" name="harga" value="{{ $produk->harga }}">
                        <input type="hidden" name="jumlah" id="jumlahHidden" value="1">
                        <button type="submit" class="px-4 py-2 bg-[#6B4F3B] text-white font-semibold rounded shadow">
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
        const qtyHidden = document.getElementById('jumlahHidden');

        document.getElementById('plus').onclick = () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
            qtyHidden.value = qtyInput.value;
        };

        document.getElementById('minus').onclick = () => {
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
                qtyHidden.value = qtyInput.value;
            }
        };

        const addToCartBtn = document.getElementById("addToCart");

        if (addToCartBtn) {
            addToCartBtn.addEventListener("click", () => {
                const idProduk = "{{ $produk->id_produk }}";
                const nama = "{{ $produk->nama }}";
                const harga = "{{ $produk->harga }}";
                const img = "{{ $imagePath }}";
                const qty = parseInt(document.getElementById("jumlah").value);

                let cart = JSON.parse(localStorage.getItem('cartItems')) || [];

                const existing = cart.find(item => item.id === idProduk);
                if (existing) {
                    existing.qty += qty;
                } else {
                    cart.push({
                        id: idProduk,
                        nama,
                        harga,
                        img,
                        qty
                    });
                }

                localStorage.setItem('cartItems', JSON.stringify(cart));
                alert('Produk berhasil ditambahkan ke keranjang!');
            });
        }
    });
</script>
@endsection
