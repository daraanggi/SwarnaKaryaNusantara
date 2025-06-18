@extends('layouts.app')

@section('title', 'Ulasan')

@section('content')
<div id="headerUlasan" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-base sm:text-lg transition-all duration-300 w-full">
    <div class="flex items-center space-x-2">
        <a href="{{ url()->previous() }}">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            </svg>
        </a>
        <span>Ulasan</span>
    </div>
    <img src="/images/logo.png" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white object-contain" />
</div>

<div id="mainContentWrapper" class="transition-all duration-300 w-full pt-20">
    <div class="bg-[#A98966] rounded-lg max-w-md mx-auto p-4 sm:p-6 text-white shadow-md">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-semibold">Toko Tekomoro</h2>
            <span class="text-sm opacity-90">Pesanan telah diterima</span>
        </div>

        <div class="flex items-start gap-4 bg-white text-black p-3 rounded-md">
            <img src="/images/produk.jpg" alt="Tas Rotan" class="w-20 h-20 object-cover rounded-md border">
            <div>
                <h3 class="font-semibold text-sm sm:text-base">Tas Rotan</h3>
                <p class="text-sm text-gray-600 mt-1">Total 2 produk : Rp 299.000</p>

                <div class="mt-3">
                    <label for="komentar" class="text-sm font-medium text-[#69553E]">Tulis Ulasan :</label>
                    <textarea id="komentar" name="komentar" rows="3"
                        class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E] resize-none"
                        placeholder="Berikan ulasanmu di sini..."></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <button class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">
                Kirim Ulasan
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const header = document.getElementById('headerUlasan');
        const mainWrapper = document.getElementById('mainContentWrapper');
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        function updateLayout() {
            const collapsed = document.body.classList.contains('sidebar-collapsed');
            if (collapsed) {
                sidebar?.classList.remove('w-64');
                sidebar?.classList.add('w-16');
                header.style.marginLeft = '4rem';
                header.style.width = 'calc(100% - 4rem)';
                mainWrapper.style.marginLeft = '4rem';
            } else {
                sidebar?.classList.remove('w-16');
                sidebar?.classList.add('w-64');
                header.style.marginLeft = '16rem';
                header.style.width = 'calc(100% - 16rem)';
                mainWrapper.style.marginLeft = '16rem';
            }
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                document.body.classList.toggle('sidebar-collapsed');
                setTimeout(updateLayout, 100);
            });
        }

        updateLayout();
    });
</script>
@endsection
