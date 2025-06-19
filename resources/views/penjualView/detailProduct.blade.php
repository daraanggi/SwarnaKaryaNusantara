@extends('layouts.penjual')

@section('title', 'Detail Produk')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-brown-800 mb-4">{{ $produk->nama }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <img src="{{ asset('images/' . $produk->foto) }}" alt="{{ $produk->nama }}" class="w-full h-64 object-cover rounded">
        </div>
        <div>
            <p class="text-gray-700 mb-2"><strong>Kategori:</strong> {{ $produk->kategori ?? '-' }}</p>
            <p class="text-gray-700 mb-2"><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <p class="text-gray-700 mb-2"><strong>Stok:</strong> {{ $produk->stok }}</p>
            <p class="text-gray-700 mb-4"><strong>Deskripsi:</strong><br>{{ $produk->deskripsi }}</p>

            @if ($produk->video)
                <div class="mt-4">
                    <video controls class="w-full rounded">
                        <source src="{{ asset('videos/' . $produk->video) }}" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('penjual.home') }}" class="text-brown-700 hover:underline">&larr; Kembali ke Daftar Produk</a>
    </div>
</div>
@endsection
