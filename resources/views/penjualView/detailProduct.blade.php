@extends('layouts.penjual')

@section('title', 'Detail Produk')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-brown-800 mb-4">{{ $produk->nama }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            @php
                $isFromStorage = \Illuminate\Support\Str::startsWith($produk->foto, 'produk/');
                $imagePath = $isFromStorage 
                    ? asset('storage/' . $produk->foto)
                    : asset('images/' . $produk->foto);
            @endphp

            <img 
                src="{{ $imagePath }}" 
                alt="{{ $produk->nama }}" 
                class="w-full max-h-96 object-contain rounded-lg"
                onerror="this.src='{{ asset('images/default.png') }}'">
            
            <!--<img 
                src="{{ asset('images/foto/' . basename($produk->foto)) }}" 
                alt="{{ $produk->nama }}" 
                class="w-full h-64 object-cover rounded"
                onerror="this.src='{{ asset('images/default.png') }}'">-->
            
            <!--<p class="text-sm text-gray-500">Path asli: {{ $produk->foto }}</p>
            <p class="text-sm text-gray-500">Nama file: {{ basename($produk->foto) }}</p>-->

        </div>

        <div>
            <p class="text-gray-700 mb-2"><strong>Kategori:</strong> {{ $produk->kategori ?? '-' }}</p>
            <p class="text-gray-700 mb-2"><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <p class="text-gray-700 mb-2"><strong>Stok:</strong> {{ $produk->stok }}</p>
            <p class="text-gray-700 mb-4"><strong>Deskripsi:</strong><br>{{ $produk->deskripsi }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('homePagePenjual') }}" class="text-brown-700 hover:underline">&larr; Kembali ke Daftar Produk</a>
    </div>
</div>
@endsection