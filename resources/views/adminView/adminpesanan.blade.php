<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary-brown { background-color: #6B4E37; }
        .text-primary-brown { color: #6B4E37; }
        /* Gaya untuk teks yang dapat diklik */
        .order-link { color: #6B4E37; transition: color 0.2s; }
        .order-link:hover { color: #4b3621; text-decoration: underline; }
    </style>
</head>
<body class="bg-[#f3f3f3] font-sans">

<div class="flex h-screen">
    <aside class="w-64 bg-primary-brown text-white flex flex-col items-center py-6 shadow-2xl">
        <div class="mb-10 flex flex-col items-center">
            <div class="w-28 h-28 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-4">
                <img src="{{ asset('images\logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
            </div>
            <h1 class="text-center font-semibold text-lg">Swarna Karya Nusantara</h1>
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

    <main class="flex-1 p-10 bg-[#f3f3f3] overflow-auto">
        <div class="max-w-3xl mx-auto">

        <div class="flex items-center mb-6">
            <!-- KEMBALI KE HALAMAN PERIKSA -->
            <a href="{{ route('admin.periksa') }}" class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-8 w-8 text-primary-brown hover:text-[#4b3621] transition"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <h2 class="text-2xl font-bold text-primary-brown">Laporan Transaksi</h2>
        </div>

            <div class="bg-primary-brown text-white rounded-3xl shadow-xl p-6">
                <h3 class="text-xl font-semibold mb-4">{{ $produk->nama }}</h3>

                <div class="space-y-3 mb-5">
                    <div class="flex justify-between bg-white text-black rounded-full py-2 px-4">
                        <span>Jumlah Stok</span>
                        <span class="font-semibold">{{ $produk->stok }}</span>
                    </div>
                    <div class="flex justify-between bg-white text-black rounded-full py-2 px-4">
                        <span>Jumlah Terjual</span>
                        <span class="font-semibold">{{ $orders->sum('jumlah') }}</span>
                    </div>
                </div>

                <div class="bg-white text-black rounded-2xl p-4">
                    <div class="flex justify-between font-semibold mb-2 border-b border-gray-300 pb-2">
                        <span>Pesanan</span>
                        <span>No. Telp</span>
                    </div>

                    <div class="space-y-1">
                        @if ($orders->isEmpty())
                            <div class="py-2 text-center text-gray-500">
                                Belum ada pesanan untuk produk ini.
                            </div>
                        @else
                            @foreach ($orders as $order)
                                <div class="flex justify-between">
                                    {{-- Link ke halaman DETAIL pesanan --}}
                                    <a href="{{ route('admin.pesanan.detail', [$produk->id_produk, $order->id]) }}" class="order-link">
                                        Pesanan {{ $loop->iteration }}
                                    </a>
                                    <span>{{ $order->no_telp }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>