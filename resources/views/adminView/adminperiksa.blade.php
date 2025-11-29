{{-- resources/views/adminView/adminperiksa.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Transaksi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-primary { background:#6b543f; }      /* coklat utama sidebar & header */
    .bg-card     { background:#7e6554; }      /* coklat item list */
  </style>
</head>
<body class="min-h-screen flex bg-white text-[#3a2c1b]">

  {{-- ============== SIDEBAR ============== --}}
  <aside class="w-64 bg-primary text-white flex flex-col items-center py-6 shadow-2xl">
    {{-- Logo --}}
    <div class="mb-10 flex flex-col items-center">
      <div class="w-28 h-28 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-3">
        <img src="{{ asset('images/logo.png') }}" alt="Swarna Karya Nusantara"
             class="w-full h-full object-contain rounded-full">
      </div>
      <h1 class="text-base font-semibold text-center">Swarna Karya Nusantara</h1>
    </div>

 {{-- Menu --}}
    <nav class="w-full mt-4 space-y-4 px-3">
      {{-- Persetujuan Produk (non-aktif) --}}
      <a href="{{ route('admin.approval') }}"
         class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#8B6F55] text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition">
        {{-- ikon centang --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-2.59a.75.75 0 10-1.22-.86l-3.54 5.02-2.07-2.07a.75.75 0 10-1.06 1.06l2.75 2.75c.3.3.78.27 1.05-.06l3.99-5.84z" clip-rule="evenodd"/>
        </svg>
        <span>Persetujuan Produk</span>
      </a>

      {{-- Laporan Transaksi (aktif) --}}
      <div class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-black text-white font-semibold shadow-lg">
        {{-- ikon user --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
          <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
          <path d="M4.5 20.25a7.5 7.5 0 1 1 15 0v.75H4.5v-.75Z"/>
        </svg>
        <span>Laporan Transaksi</span>
      </div>
    </nav>
  </aside>

  {{-- ============== MAIN ============== --}}
  <main class="flex-1 p-10 overflow-auto">
    <div class="max-w-5xl mx-auto">

      {{-- Header dengan back --}}
      <div class="flex items-center mb-6">
        <a href="{{ route('admin.dashboard') }}" class="mr-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#6b543f] hover:opacity-80"
               fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
        </a>
        <h2 class="text-2xl font-bold text-[#6b543f]">Laporan Transaksi</h2>
      </div>

      {{-- Panel list (coklat besar + rounded) --}}
      <section class="bg-primary text-white rounded-[24px] shadow-2xl p-6">

        @if($transaksi->isEmpty())
            <div class="py-4 text-center text-white/80">
                Belum ada produk / transaksi.
            </div>
        @else
            @foreach ($transaksi as $produk)
                <div class="flex items-center justify-between border-b border-white/30 py-3">
                    {{-- nama produk dari tabel produk --}}
                    <span class="text-lg">{{ $produk->nama }}</span>

                    {{-- kirim id_produk ke halaman pesanan --}}
                    <a href="{{ route('admin.pesanan', $produk->id_produk) }}"
                      class="underline text-white font-semibold hover:text-gray-200 transition">
                        Detail
                    </a>
                </div>
            @endforeach
        @endif

      </section>

    </div>
  </main>
</body>
</html>
