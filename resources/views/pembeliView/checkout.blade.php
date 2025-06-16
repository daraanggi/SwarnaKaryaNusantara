@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<!-- Header Checkout -->
<div id="headerKeranjang" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-lg transition-all duration-300" style="margin-left: 16rem; width: calc(100% - 16rem);">
    <div class="flex items-center space-x-2">
        <svg class="w-6 h-6 rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"></svg>
        <span>Checkout</span>
    </div>
    <img src="/images/logo.png" class="w-10 h-10 rounded-full bg-white object-contain"/>
</div>

<!-- Isi Konten -->
<div id="mainContentWrapper" class="transition-all duration-300 w-full max-w-none" style="margin-left: 16rem;">
    <div class="pt-20 px-6 pb-10 bg-gray-50 space-y-6">

        <!-- Alamat Pengiriman -->
        <div class="border rounded-lg p-4 bg-[#F5F5F5]">
            <div class="flex justify-between items-center">
                <div class="text-sm font-medium text-gray-700">Alamat Pengiriman</div>
               <a href="{{ route('editAlamat') }}" class="text-xs text-blue-600 hover:underline">Ubah</a>
            </div>
            <div class="mt-2 text-sm text-gray-800 leading-relaxed">
                Dara Anggi Puspa <br>
                +62 85634879124 <br>
                Jebugan 002/003, Jebugan, Klaten Utara, Klaten, Jawa Tengah <br>
                KAB. KLATEN - KLATEN UTARA, JAWA TENGAH, ID 57433
            </div>
        </div>

        <!-- Opsi Pengiriman dan Metode Pembayaran -->
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Opsi Pengiriman</label>
                <select class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#69553E] focus:border-[#69553E]">
                    <option>Hemat Cargo - Estimasi Sampai 2 - 5 Juni 2025</option>
                </select>
            </div>
            <div class="w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#69553E] focus:border-[#69553E]">
                    <option>Transfer Bank</option>
                </select>
            </div>
        </div>

        <!-- Produk Dipesan -->
        <div class="border rounded-lg p-4 bg-white">
            <div class="text-sm font-semibold text-[#69553E] mb-3">Produk Dipesan</div>
            <div class="flex items-center gap-4">
                <img src="{{ asset('/images/kain.png') }}" alt="Batik Tenun" class="w-20 h-20 rounded object-cover">
                <div class="flex-1">
                    <div class="text-sm font-medium text-gray-800">Batik Tenun</div>
                    <div class="text-xs text-gray-500">Toko Tekomoro</div>
                </div>
                <div class="text-right text-sm text-gray-700">
                    <div>Rp. 299.000</div>
                    <div class="text-xs">x1</div>
                    <div class="font-semibold">Rp. 299.000</div>
                </div>
            </div>
        </div>

        <!-- Rincian Pembelian -->
        <div class="bg-[#F5F5F5] p-4 rounded-lg">
            <div class="text-sm font-semibold text-[#69553E] mb-2">Rincian Pembelian</div>
            <div class="text-sm text-gray-800 space-y-1">
                <div class="flex justify-between">
                    <span>Metode Pembayaran</span>
                    <span>Transfer Bank</span>
                </div>
                <div class="flex justify-between">
                    <span>Subtotal Pesanan</span>
                    <span>Rp. 299.000</span>
                </div>
                <div class="flex justify-between">
                    <span>Subtotal Pengiriman</span>
                    <span>Rp. 16.000</span>
                </div>
                <div class="flex justify-between font-bold text-[#69553E] border-t pt-2">
                    <span>Total Pembayaran</span>
                    <span>Rp. 315.000</span>
                </div>
            </div>
        </div>

        <!-- Tombol Buat Pesanan -->
        <div class="text-end">
            <button class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-6 py-2 rounded-full shadow-md text-sm font-semibold">
                Buat Pesanan
            </button>
        </div>
    </div>
</div>

<!-- Script untuk menyesuaikan layout -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const header = document.getElementById('headerKeranjang');
        const mainWrapper = document.getElementById('mainContentWrapper');
        const toggleBtn = document.getElementById('toggleSidebar');

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

        updateLayout();
    });
</script>
@endsection
