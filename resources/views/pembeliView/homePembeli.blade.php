@extends('layouts.app')

@section('content')
<div class="px-4 py-2 bg-white min-h-screen">
  <!-- Search & Filter -->
  <div class="flex justify-between items-center mt-4 mb-2">

<!-- Search -->
<form method="GET" action="{{ route('home') }}" class="w-full">
  <div class="flex items-center bg-[#6B4F3B]/10 hover:bg-[#6B4F3B]/20 text-[#4B3621] rounded-full px-6 py-3 transition-all duration-200">
    
    <svg class="w-5 h-5 text-[#4B3621] opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
    </svg>

    <input 
      type="text" 
      name="search" 
      value="{{ request('search') }}" 
      placeholder="Cari kerajinan unik..." 
      class="bg-transparent w-full px-4 text-sm md:text-base text-[#4B3621] placeholder-[#7B5F48] focus:outline-none" 
    />
  </div>
</form>


    <!-- Filter -->
    <div class="ml-4 relative">
      <button id="filterBtn" class="flex items-center gap-1 bg-white border border-gray-300 rounded-full px-4 py-2 text-sm">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
          <path d="M3 4a1 1 0 000 2h1.382l.723 1.447A1 1 0 006 8h8a1 1 0 00.895-.553L16.618 6H18a1 1 0 100-2H3zM5 10a1 1 0 000 2h10a1 1 0 100-2H5zM7 14a1 1 0 000 2h6a1 1 0 100-2H7z" />
        </svg>
        Filter
      </button>

      <!-- Dropdown -->
      <div id="filterDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
        <ul class="text-sm text-gray-700">
          <li>
          <a href="{{ route('home', ['search' => request('search'), 'sort' => 'asc', 'kategori' => request('kategori')]) }}"
            class="block w-full text-left px-4 py-2 hover:bg-gray-100">
            Harga Terendah
          </a>
          <a href="{{ route('home', ['search' => request('search'), 'sort' => 'desc', 'kategori' => request('kategori')]) }}"
            class="block w-full text-left px-4 py-2 hover:bg-gray-100">
            Harga Tertinggi
          </a>
          </li>          
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Carousel -->
  <div class="w-full overflow-hidden rounded-3xl mb-4">
    <div class="flex gap-2 transition-transform duration-300 ease-in-out" id="carousel">
      <img src="/images/tenun.png" alt="" class="w-full h-56 object-cover rounded-3xl">
      <img src="/images/nene.png" alt="" class="w-full h-56 object-cover rounded-3xl">
    </div>
  </div>

  <!-- Kategori -->
  <h2 class="text-lg font-semibold text-brown-700 mb-2">Kategori</h2>
  <div class="flex space-x-4 overflow-x-auto pb-2">
    <a 
      href="{{ route('home') }}" 
      class="bg-gray-300 text-black rounded-full px-5 py-2 text-sm font-medium hover:bg-gray-400 transition">
      Semua
    </a>
    @foreach (['Batik', 'Tenun', 'Bambu', 'Rotan'] as $kategori)
      <a 
        href="{{ route('home', ['kategori' => $kategori]) }}" 
        class="bg-[#5E472C] text-white rounded-full px-5 py-2 text-sm font-medium hover:bg-[#3e2f1d] transition">
        {{ $kategori }}
      </a>
    @endforeach
  </div>

  <!-- Produk -->
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6">
    @foreach($produk as $item)
      @php
        $isFromStorage = \Illuminate\Support\Str::startsWith($item->foto, 'produk/');
        $imagePath = $isFromStorage 
          ? asset('storage/' . $item->foto) 
          : asset('images/' . $item->foto);
      @endphp

      <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-2 flex flex-col">
        <div class="flex justify-between items-center mb-2">
          <div>
            <h3 class="text-sm font-medium">{{ $item->nama }}</h3>
            <p class="text-sm text-gray-700">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
          </div>
          <a href="{{ route('barang.detail', ['id' => $item->id_produk]) }}">
            <button class="bg-[#5E472C] text-white text-xs px-3 py-1 rounded-full hover:bg-[#463522]">Checkout</button>
          </a>
        </div>
        <img 
          src="{{ $imagePath }}" 
          alt="{{ $item->nama }}" 
          class="rounded-lg object-cover h-32 w-full"
          onerror="this.src='{{ asset('images/default.png') }}'"
        >
      </div>
    @endforeach
  </div>
</div>

<!-- Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('filterBtn');
    const dropdown = document.getElementById('filterDropdown');

    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function () {
      dropdown.classList.add('hidden');
    });
  });
</script>
@if(session('pesanan_berhasil'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Pesanan Berhasil!',
            text: 'Terima kasih, pesanan kamu telah dikonfirmasi. Lanjutkan ke pembayaran!',
            confirmButtonColor: '#6B4F3B',
            confirmButtonText: 'Oke'
        });
    });
</script>
@endif

@endsection
