@extends('layouts.app')

@section('title', 'Ulasan')

@section('content')
<div id="headerUlasan" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-base sm:text-lg w-full">
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

<div class="pt-24 px-4 max-w-2xl mx-auto">

    {{-- ✅ Flash message sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ❌ Error validasi --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ Loop produk yang bisa diulas --}}
    @forelse($produkList as $produk)
        @php
            $isFromStorage = \Illuminate\Support\Str::startsWith($produk->foto, 'produk/');
            $gambar = $isFromStorage 
                ? 'storage/' . $produk->foto 
                : 'images/' . $produk->foto;
        @endphp

        <div class="bg-white text-black p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-[#69553E] font-bold text-sm mb-3 border-b pb-2 flex justify-between">
                <span>Produk: {{ $produk->nama }}</span>
                @if($produk->sudah_diulas)
                    <span class="text-green-600 text-xs">✅ Sudah diulas</span>
                @endif
            </h2>

            <div class="flex gap-4">
                <img src="{{ asset($gambar) }}" class="w-20 h-20 object-cover rounded border" alt="Produk" onerror="this.src='{{ asset('images/produk.jpg') }}'">

                {{-- Form hanya jika belum diulas --}}
                @if(!$produk->sudah_diulas)
                    <form action="{{ route('ulasan.store') }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                        <div class="mb-3">
                            <label for="komentar_{{ $produk->id_produk }}" class="text-sm font-semibold text-[#69553E]">Tulis Ulasan:</label>
                            <textarea id="komentar_{{ $produk->id_produk }}" name="komentar" rows="3"
                                      class="w-full mt-1 text-sm bg-gray-100 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]"
                                      placeholder="Berikan ulasanmu di sini...">{{ old('komentar') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="rating_{{ $produk->id_produk }}" class="text-sm font-semibold text-[#69553E]">Rating (1–5):</label>
                            <input type="number" id="rating_{{ $produk->id_produk }}" name="rating" min="1" max="5"
                                   value="{{ old('rating') }}"
                                   class="w-full mt-1 text-sm bg-gray-100 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded text-sm">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="bg-yellow-100 text-yellow-800 p-3 rounded text-sm text-center">
            Belum ada produk yang bisa diulas.
        </div>
    @endforelse

</div>
@endsection
