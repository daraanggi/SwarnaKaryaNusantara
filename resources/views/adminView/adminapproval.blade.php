<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - Persetujuan Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-white text-[#3a2c1b] flex">

  {{-- ============== SIDEBAR ============== --}}
  <aside class="w-64 bg-[#6b543f] text-white flex flex-col items-center py-6 shadow-2xl">
    {{-- Logo --}}
    <div class="mb-10 flex flex-col items-center">
      <div class="w-28 h-28 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
      </div>
      <h1 class="text-base font-semibold text-center">Swarna Karya Nusantara</h1>
    </div>

    {{-- Menu --}}
    <nav class="w-full mt-8 space-y-4 px-3">
      {{-- Active: Persetujuan Produk --}}
      <a href="{{ route('admin.approval') }}"
         class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-black text-white font-semibold shadow-lg">
        {{-- Ikon centang (SVG) --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75S21.75 6.615 21.75 12 17.385 21.75 12 21.75 2.25 17.385 2.25 12Zm13.36-2.59a.75.75 0 1 0-1.22-.86l-3.54 5.02-2.07-2.07a.75.75 0 1 0-1.06 1.06l2.75 2.75a.75.75 0 0 0 1.17-.12l3.97-5.78Z" clip-rule="evenodd"/>
        </svg>
        <span>Persetujuan Produk</span>
      </a>

      {{-- Laporan Transaksi --}}
      <a href="{{ route('admin.transaksi') }}"
         class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#8B6F55] text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition">
        {{-- Ikon user (SVG) --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
          <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
          <path d="M4.5 20.25a7.5 7.5 0 1 1 15 0v.75H4.5v-.75Z"/>
        </svg>
        <span>Laporan Transaksi</span>
      </a>
    </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-auto px-3 w-full">
            @csrf
            <button type="submit"
                    class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#8B6F55] text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition w-full">
                {{-- Icon logout --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
  </aside>

  {{-- ============== MAIN ============== --}}
  <main class="flex-1 flex flex-col items-center justify-start py-10 overflow-auto">
    <div class="w-full max-w-5xl bg-[#6b543f] text-white rounded-[24px] shadow-2xl p-10">
      {{-- Judul --}}
      <h2 class="text-3xl font-bold mb-10">Persetujuan Produk</h2>

      {{-- Statistik --}}
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        {{-- Disetujui --}}
        <div class="border border-white/40 rounded-xl p-5 text-white/95 backdrop-blur-md">
          <p class="text-sm font-medium mb-2">Produk Disetujui</p>
          <div class="flex items-center gap-3">
            {{-- ikon kotak hijau --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="#22c55e">
              <path d="M21 7.5V18a3 3 0 0 1-3 3H9.75v-12h8.25L21 7.5Z"/><path d="M9.75 3H6a3 3 0 0 0-3 3v9.75h6.75V3Z" fill="#16a34a"/>
            </svg>
            <span class="text-2xl font-bold">{{ $produkDisetujui ?? 0 }}</span>
          </div>
        </div>

        {{-- Belum disetujui --}}
        <div class="border border-white/40 rounded-xl p-5 text-white/95 backdrop-blur-md">
          <p class="text-sm font-medium mb-2">Produk Belum Disetujui</p>
          <div class="flex items-center gap-3">
            {{-- ikon kotak merah --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="#ef4444">
              <path d="M12 2l9 5-9 5-9-5 9-5Z"/><path d="M21 12l-9 5-9-5" fill="#dc2626"/>
            </svg>
            <span class="text-2xl font-bold">{{ $produkBelum ?? 0 }}</span>
          </div>
        </div>

        {{-- Total akun penjual --}}
        <div class="border border-white/40 rounded-xl p-5 text-white/95 backdrop-blur-md">
          <p class="text-sm font-medium mb-2">Total Akun Penjual</p>
          <div class="flex items-center gap-3">
            {{-- ikon users kuning --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="#facc15">
              <path d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/><path d="M4 20a8 8 0 1 1 16 0H4Z"/>
            </svg>
            <span class="text-2xl font-bold">{{ $totalAkun ?? 0 }}</span>
          </div>
        </div>
      </div>

      {{-- OVERLAY sukses/ditolak --}}
      @if(session('success') || session('rejected'))
        <div id="overlay-approval"
            class="fixed inset-0 z-40 flex items-center justify-center 
                  bg-white/70 backdrop-blur-[1px]">
          <div class="bg-white rounded-2xl shadow-2xl px-6 py-4 flex items-center gap-3">

            @if(session('success'))
              <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-2.59a.75.75 0 10-1.22-.86l-3.54 5.02-2.07-2.07a.75.75 0 10-1.06 1.06l2.75 2.75c.3.3.78.27 1.05-.06l3.99-5.84z" clip-rule="evenodd"/>
              </svg>
              <p class="text-[16px] font-semibold text-[#1f2937]">
                {{ session('success') }}
              </p>
            @else
              <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25zm3.53 12.72a.75.75 0 11-1.06 1.06L12 13.06l-2.47 2.97a.75.75 0 01-1.06-1.06L10.94 12 8.47 9.53a.75.75 0 111.06-1.06L12 10.94l2.47-2.47a.75.75 0 111.06 1.06L13.06 12z" clip-rule="evenodd"/>
              </svg>
              <p class="text-[16px] font-semibold text-[#1f2937]">
                {{ session('rejected') }}
              </p>
            @endif

          </div>
        </div>

        {{-- Auto hide (optional) --}}
        <script>
          setTimeout(() => {
            const el = document.getElementById('overlay-approval');
            if (el) el.classList.add('hidden');
          }, 2500);
        </script>
      @endif
      
      {{-- ====== List Produk ====== --}}
      @unless(session()->has('success') || session()->has('rejected'))
        <div class="space-y-4">
          @if(isset($produkList) && count($produkList) > 0)
            @foreach ($produkList as $produk)
              <div class="bg-white/10 rounded-2xl px-6 py-4 flex items-center justify-between
                          shadow-md hover:bg-white/20 transition border border-white/20">
                <div class="flex items-center gap-4">
                  <img
                    src="{{ asset('images/' . ($produk['foto'] ?? '')) }}"
                    alt="{{ $produk['nama'] }}"
                    class="w-16 h-16 rounded-lg object-cover bg-white p-1 shadow"
                    onerror="this.onerror=null;this.src='{{ asset('images/gelas.png') }}';"
                  />
                  <p class="text-lg font-semibold text-white">{{ $produk['nama'] }}</p>
                </div>

                <a href="{{ route('admin.detail', ['id' => $produk['id'] ?? $produk['id_produk'] ?? null]) }}"
                  class="text-white underline hover:text-gray-200 text-base font-medium">
                  Detail
                </a>
              </div>
            @endforeach
          @else
            <p class="text-center text-white/80 italic">Belum ada produk untuk disetujui.</p>
          @endif
        </div>
      @endunless
      </div>

    </div>
  </main>
</body>
</html>
