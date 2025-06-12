@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<!-- Header -->
<div id="headerKeranjang" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-lg transition-all duration-300" style="margin-left: 16rem; width: calc(100% - 16rem);">
    <div class="flex items-center space-x-2">
        <svg class="w-6 h-6 rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"></svg>
        <span>Detail Barang</span>
    </div>
    <img src="/images/logo.png" class="w-10 h-10 rounded-full bg-white object-contain" />
</div>

<!-- Konten Utama -->
<div id="mainContentWrapper" class="transition-all duration-300" style="margin-left: 16rem;">
    <div class="px-8 pt-20 pb-20">
        <div class="bg-white shadow rounded-xl flex gap-8 p-6">
            <!-- Gambar Produk -->
            <div class="flex-1">
                <img src="/images/nene.png" class="rounded-xl object-cover w-full max-h-[500px]" alt="Batik Tenun">
                <p class="text-sm text-gray-500 font-semibold mt-2">10RB+ Terjual</p>
            </div>

            <!-- Detail Produk -->
            <div class="flex-1 space-y-4">
                <h1 class="text-2xl font-bold text-gray-900">Batik Tenun</h1>
                <p class="text-sm text-gray-700">
                    Nikmati keindahan budaya dalam setiap helai kain tenun kami yang elegan, berkualitas,
                    dan dibuat dengan penuh cinta oleh tangan-tangan terampil nusantara.
                </p>
                <p class="text-xl font-bold text-[#6B4F3B]">Rp 299.000</p>

                <div class="space-y-1">
                    <p class="font-semibold text-lg">Pengiriman</p>
                    <p class="text-sm text-gray-600">Tiba Pada 31 Mei - 2 Juni 2025</p>
                </div>

                <div class="flex items-center mt-4 gap-2">
                    <span class="font-medium text-lg">Jumlah</span>
                    <div class="flex border rounded">
                        <button id="minus" class="bg-[#6B4F3B] text-white w-8 h-8">−</button>
                        <input type="text" id="jumlah" value="1" readonly class="w-10 text-center border-x bg-white">
                        <button id="plus" class="bg-[#6B4F3B] text-white w-8 h-8">+</button>
                    </div>
                </div>

                <div class="flex gap-4 mt-6">
                    <button class="flex items-center gap-2 px-4 py-2 bg-[#6B4F3B] text-white font-semibold rounded shadow">
                        Masukan Keranjang
                        <i class="bi bi-cart-plus"></i>
                    </button>
                    <button class="px-4 py-2 bg-[#6B4F3B] text-white font-semibold rounded shadow">
                        Beli Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const qtyInput = document.getElementById('jumlah');
        document.getElementById('plus').onclick = () => qtyInput.value = parseInt(qtyInput.value) + 1;
        document.getElementById('minus').onclick = () => {
            if (parseInt(qtyInput.value) > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
        };

        const toggleBtn = document.getElementById('toggleSidebar');
        const header = document.getElementById('headerKeranjang');
        const mainWrapper = document.getElementById('mainContentWrapper');

        function updateLayout() {
            const collapsed = document.body.classList.contains('sidebar-collapsed');

            if (collapsed) {
                header.style.marginLeft = '4rem';
                header.style.width = 'calc(100% - 4rem)';
                mainWrapper.style.marginLeft = '4rem';
            } else {
                header.style.marginLeft = '16rem';
                header.style.width = 'calc(100% - 16rem)';
                mainWrapper.style.marginLeft = '16rem';
            }
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                document.body.classList.toggle('sidebar-collapsed');
                setTimeout(updateLayout, 50);
            });
        }

        updateLayout(); // initial setup
    });
</script>
@endsection
