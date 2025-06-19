@extends('layouts.app')

@section('title', 'Ulasan')

@section('content')
<div id="headerUlasan" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-base sm:text-lg transition-all duration-300 w-full">
    <div class="flex items-center space-x-2">
        <a href="{{ url()->previous() }}">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <span>Ulasan</span>
    </div>
    <img src="/images/logo.png" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white object-contain" />
</div>

<div id="mainContentWrapper" class="transition-all duration-300 w-full pt-20">
    <div class="bg-[#A98966] rounded-lg max-w-md mx-auto p-4 sm:p-6 text-white shadow-md">

        {{-- ✅ Tampilkan pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ❌ Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex items-center justify-between mb-3">
            <span class="text-sm opacity-90">Pesanan telah diterima</span>
        </div>

        {{-- ✅ Form ulasan --}}
        <form action="{{ route('ulasan.store') }}" method="POST">
            @csrf

            {{-- ✅ Pastikan produk ada --}}
            @if(isset($produk))
                <input type="hidden" name="id_produk" value="{{ $produk->id }}">
            @else
                <div class="bg-red-200 text-red-800 p-2 mb-3 rounded text-sm">
                    Produk tidak ditemukan!
                </div>
            @endif

            <div class="flex items-start gap-4 bg-white text-black p-3 rounded-md">
                <img src="/images/produk.jpg" alt="Produk" class="w-20 h-20 object-cover rounded-md border">
                <div class="w-full">
                    <h3 class="font-semibold text-sm sm:text-base">{{ $produk->nama ?? 'Nama Produk' }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Total 2 produk : Rp 299.000</p>

                    <div class="mt-3">
                        <label for="komentar" class="text-sm font-medium text-[#69553E]">Tulis Ulasan :</label>
                        <textarea id="komentar" name="komentar" rows="3"
                            class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E] resize-none"
                            placeholder="Berikan ulasanmu di sini...">{{ old('komentar') }}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="rating" class="text-sm font-medium text-[#69553E]">Rating (1–5)</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" value="{{ old('rating') }}"
                            class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]">
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">
                    Kirim Ulasan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
