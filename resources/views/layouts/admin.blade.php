<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f8f5f1] text-[#3a2c1b] flex">

    {{-- ========== SIDEBAR ========== --}}
    <aside class="w-64 bg-[#6b543f] text-white flex flex-col items-center py-6 shadow-2xl">

        {{-- Logo --}}
        <div class="mb-10 flex flex-col items-center">
            <div class="w-28 h-28 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-3">
                <img src="{{ asset('images/logo.png') }}"
                     class="w-full h-full object-contain rounded-full">
            </div>
            <h1 class="text-base font-semibold text-center">Swarna Karya Nusantara</h1>
        </div>

        {{-- Menu --}}
        <nav class="w-full mt-4 space-y-4 px-3">

            {{-- Persetujuan Produk --}}
            <a href="{{ route('admin.approval') }}"
               class="flex items-center gap-3 py-3 px-4 rounded-r-full 
               {{ request()->routeIs('admin.approval') ? 'bg-black' : 'bg-[#8B6F55]' }}
               text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition">

                <span class="text-lg">✔</span>
                <span>Persetujuan Produk</span>
            </a>

            {{-- Laporan Transaksi --}}
            <a href="{{ route('admin.transaksi') }}"
               class="flex items-center gap-3 py-3 px-4 rounded-r-full 
               {{ request()->routeIs('admin.transaksi') ? 'bg-black' : 'bg-[#8B6F55]' }}
               text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition">

                <span class="text-lg">📊</span>
                <span>Laporan Transaksi</span>
            </a>

            {{-- Konfirmasi Pembayaran (LIST, bukan detail!) --}}
            <a href="{{ route('admin.transaksi.konfirmasiList') }}"
            class="flex items-center gap-3 py-3 px-4 rounded-r-full 
            {{ request()->routeIs('admin.transaksi.konfirmasiList') ? 'bg-black' : 'bg-[#8B6F55]' }}
            text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition">

                <span class="text-lg">💰</span>
                <span>Konfirmasi Pembayaran</span>
            </a>


        </nav>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-auto px-3 w-full">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#8B6F55] 
                       text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition w-full">

                <span>⇦</span>
                <span>Logout</span>
            </button>
        </form>

    </aside>

    {{-- ========== MAIN CONTENT ========== --}}
    <main class="flex-1 py-10 px-8 overflow-auto">
        @yield('content')
    </main>

</body>
</html>
