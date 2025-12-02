@extends('layouts.app')

@section('title', 'Ulasan')

@section('content')

{{-- ================= HEADER ================= --}}
<div id="headerUlasan" 
    class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 
           bg-white text-primary-brown font-extrabold text-xl border-b shadow-sm">
    <h1 class="font-bold text-xl">Ulasan</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>

<div class="pt-24 px-4 max-w-2xl mx-auto">

    {{-- ================= FLASH MESSAGE ================= --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= LIST PRODUK YANG BISA DIULAS ================= --}}
    @forelse($produkList as $produk)
        @php
            $isFromStorage = \Illuminate\Support\Str::startsWith($produk->foto, 'produk/');
            $gambar = $isFromStorage 
                ? 'storage/' . $produk->foto 
                : 'images/' . $produk->foto;
        @endphp

        <div class="bg-white text-black p-4 rounded-lg shadow mb-6">

            {{-- Header Produk --}}
            <div class="flex justify-between items-center border-b pb-2 mb-3">
                <h2 class="text-[#69553E] font-bold text-sm">
                    Produk: {{ $produk->nama }}
                </h2>

                {{-- TANDA SUDAH DIULAS --}}
                @if($produk->sudah_diulas)
                    <span class="text-green-600 text-xs font-semibold">
                        ✔ Sudah diulas
                    </span>
                @endif
            </div>

            <div class="flex gap-4">

                {{-- FOTO PRODUK --}}
                <img src="{{ asset($gambar) }}"
                     class="w-20 h-20 object-cover rounded border"
                     alt="Produk"
                     onerror="this.src='{{ asset('images/produk.jpg') }}';">

                {{-- FORM ULASAN --}}
                <div class="flex-1">
                    @if(!$produk->sudah_diulas)
                        <form action="{{ route('ulasan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                            {{-- Komentar --}}
                            <label class="text-sm font-semibold text-[#69553E]">
                                Tulis Ulasan:
                            </label>
                            <textarea name="komentar" rows="3"
                                class="w-full mt-1 text-sm bg-gray-100 border border-gray-300 rounded px-3 py-2
                                       focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]"
                                required></textarea>

                            {{-- Rating --}}
                            <div class="mt-3">
                                <label class="text-sm font-semibold text-[#69553E]">
                                    Rating (1–5):
                                </label>
                                <input type="number" name="rating" min="1" max="5"
                                    class="w-full mt-1 text-sm bg-gray-100 border border-gray-300 rounded px-3 py-2
                                           focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]"
                                    required>
                            </div>

                            {{-- Submit --}}
                            <div class="flex justify-end mt-3">
                                <button type="submit"
                                    class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded text-sm">
                                    Kirim Ulasan
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="text-sm text-gray-600 italic mt-2">
                            Kamu sudah memberi ulasan untuk produk ini.
                        </p>
                    @endif
                </div>

            </div>
        </div>

    @empty
        <div class="bg-yellow-100 text-yellow-800 p-3 rounded text-sm text-center">
            Belum ada produk yang bisa diulas.
        </div>
    @endforelse

</div>
@endsection
