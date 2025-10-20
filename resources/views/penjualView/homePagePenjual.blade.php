@extends('layouts.penjual')

@section('title', 'Home Page Penjual')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-[#69553E]">Product Management</h1>

    <!-- Form Search -->
    <form action="{{ route('homePagePenjual') }}" method="GET" class="flex justify-between items-center mb-6">
        <input 
            type="text" 
            name="search"
            placeholder="Search product..." 
            class="border rounded-full px-4 py-2 w-1/2 text-black" 
            value="{{ request('search') }}"
        />
        <div class="flex items-center gap-2">
            <button type="submit" class="bg-brown-700 text-white px-4 py-2 rounded-full">Search</button>
        </div>
    </form>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($produk as $item)
            @php
                $isFromStorage = \Illuminate\Support\Str::startsWith($item->foto, 'produk/');
                $imagePath = $isFromStorage 
                    ? asset('storage/' . $item->foto) 
                    : asset('images/' . $item->foto);
            @endphp

            <div class="bg-white border border-brown-200 rounded-lg shadow overflow-hidden relative hover:shadow-lg transition">
                <a href="{{ route('penjual.produk.detail', $item->id_produk) }}">
                    <img 
                        src="{{ $imagePath }}" 
                        alt="{{ $item->nama }}" 
                        class="w-full h-40 object-cover"
                        onerror="this.src='{{ asset('images/default.png') }}'"
                    >
                    <div class="p-4">
                        <h3 class="font-semibold text-brown-800">{{ $item->nama }}</h3>
                        <p class="text-brown-600">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
