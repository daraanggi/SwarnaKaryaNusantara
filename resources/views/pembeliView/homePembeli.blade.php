@extends('layouts.app')

@section('content')
<div class="px-4 py-6 bg-[#fdfbf8] min-h-screen">

  <!-- Search & Filter -->
  <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">

    <!-- Search -->
    <form method="GET" action="{{ route('home') }}" class="flex-1 w-full">
      <div class="flex items-center bg-[412E17]/10 hover:bg-[412E17]/20 text-[#4B3621] rounded-full px-6 py-3 transition-all duration-200 shadow-sm">
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
    <div class="relative">
      <button id="filterBtn" class="flex items-center gap-1 bg-white border border-gray-300 rounded-full px-4 py-2 text-sm shadow hover:shadow-md transition">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
          <path d="M3 4a1 1 0 000 2h1.382l.723 1.447A1 1 0 006 8h8a1 1 0 00.895-.553L16.618 6H18a1 1 0 100-2H3zM5 10a1 1 0 000 2h10a1 1 0 100-2H5zM7 14a1 1 0 000 2h6a1 1 0 100-2H7z" />
        </svg>
        Filter
      </button>

      <div id="filterDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
        <ul class="text-sm text-gray-700">
          <li>
            <a href="{{ route('home', ['search' => request('search'), 'sort' => 'asc']) }}"
              class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition">
              Harga Terendah
            </a>

            <a href="{{ route('home', ['search' => request('search'), 'sort' => 'desc']) }}"
              class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition">
              Harga Tertinggi
            </a>
          </li>
        </ul>
      </div>
    </div>

  </div>

  <!-- Riwayat Pencarian -->
  @if(!empty($histories) && count($histories) > 0)
    <div class="mt-4 mb-4">
      <h2 class="text-md font-semibold text-[#4B3621] mb-2">Riwayat Pencarian Terakhir</h2>
      <div class="flex flex-wrap gap-2">
        @foreach($histories->unique('keyword') as $history)
          <a href="{{ route('home', ['search' => $history->keyword]) }}"
            class="bg-[#6B4F3B]/10 text-[#4B3621] px-3 py-1 rounded-full text-sm hover:bg-[#6B4F3B]/20 transition">
              {{ $history->keyword }}
          </a>
        @endforeach
      </div>
    </div>
  @endif


  <!-- Carousel -->
  <div class="w-full overflow-hidden rounded-3xl mb-6 shadow-md">
    <div class="flex gap-2 transition-transform duration-300 ease-in-out" id="carousel">
      <img src="/images/tenun.png" alt="Tenun" class="w-full h-56 md:h-64 object-cover rounded-3xl shadow-lg">
      <img src="/images/nene.png" alt="Nene" class="w-full h-56 md:h-64 object-cover rounded-3xl shadow-lg">
    </div>
  </div>

  <div class="w-full h-6 bg-[#fdfbf8] shadow-[0_-18px_30px_-8px_rgba(107,79,59,0.35)] rounded-t-3xl mt-8 mb-4"></div>


  <!-- Produk -->
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-4">
    @foreach($produk as $item)
      @php
        $isFromStorage = \Illuminate\Support\Str::startsWith($item->foto, 'produk/');
        $imagePath = $isFromStorage ? asset('storage/' . $item->foto) : asset('images/' . $item->foto);
      @endphp

      <div class="bg-white border border-gray-200 rounded-xl shadow-md p-3 flex flex-col hover:shadow-xl transition duration-300">
        <div class="flex-1 flex flex-col">
          <img src="{{ $imagePath }}" alt="{{ $item->nama }}" class="rounded-lg object-cover h-40 w-full mb-2 shadow-sm" onerror="this.src='{{ asset('images/default.png') }}'">
          <h3 class="text-sm font-semibold text-gray-800 truncate">{{ $item->nama }}</h3>
          <p class="text-sm text-[#6B4F3B] font-bold mt-1">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
        </div>

        <a href="{{ route('barang.detail', ['id' => $item->id_produk]) }}" class="mt-3">
          <button class="bg-[#6B4F3B] text-white text-xs w-full py-2 rounded-full font-semibold hover:bg-[#826141] transition">
            Lihat Detail
          </button>
        </a>
      </div>
    @endforeach
  </div>

</div>


<!-- Script Filter -->
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


<!-- Clear Search Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearSearch');

    function toggleClearButton() {
      if (searchInput.value.trim() !== '') {
        clearBtn.classList.remove('hidden');
      } else {
        clearBtn.classList.add('hidden');
      }
    }

    searchInput.addEventListener('input', toggleClearButton);

    clearBtn.addEventListener('click', function () {
      searchInput.value = '';
      toggleClearButton();
      searchInput.focus();
    });

    toggleClearButton();
  });
</script>


@if(session('pesanan_berhasil'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'success',
        title: 'Pesanan Berhasil!',
        text: 'Terima kasih, pesanan kamu telah dikonfirmasi!',
        confirmButtonColor: '#6B4F3B',
        confirmButtonText: 'Kembali ke Beranda'
    }).then(() => {
        window.location.href = "{{ route('home') }}";
    });
});
</script>
@endif

@endsection
