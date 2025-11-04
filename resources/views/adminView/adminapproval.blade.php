<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Approval Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen font-sans text-white flex">

    <!-- ======= SIDEBAR ======= -->
    <aside class="w-64 bg-[url('{{ asset('images/motif-batik.png') }}')] bg-cover bg-center flex flex-col items-center py-6 shadow-2xl">
        <div class="mb-10 flex flex-col items-center">
            <div class="w-28 h-28 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-3">
                <img src="{{ asset('images/logo-swarna.png') }}" alt="Logo Swarna" class="w-full h-full object-contain rounded-full">
            </div>
            <h1 class="text-base font-semibold text-center text-white">Swarna Karya Nusantara</h1>
        </div>

        <nav class="w-full mt-8 space-y-4 px-3">
            <a href="{{ route('admin.approval') }}"
               class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#2b2b2b] text-white font-semibold shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>Approval Product</span>
            </a>

            <a href="{{ route('admin.transaksi') }}"
               class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#7E6554] text-white font-semibold shadow-lg hover:bg-[#8B6F55] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Laporan Transaksi</span>
            </a>
        </nav>
    </aside>

    <!-- ======= MAIN CONTENT ======= -->
    <main class="flex-1 flex flex-col items-center justify-start py-10 overflow-auto transition-colors duration-700 
        {{ session('success') ? 'bg-[#d9cfc5] text-[#3a2c1b]' : 'bg-[#3a2c1b] text-white' }}">

        <div class="w-full max-w-5xl 
            {{ session('success') ? 'bg-white/70 text-[#3a2c1b]' : 'bg-[#7a5a3a]/70 text-white' }} 
            backdrop-blur-md rounded-3xl shadow-2xl p-10 transition-all duration-700">

            <!-- Judul -->
            <h2 class="text-3xl font-bold mb-10 text-left 
                {{ session('success') ? 'text-[#3a2c1b]' : 'text-[#f5f3ef]' }}">
                Approval Product
            </h2>

            <!-- ✅ Pesan Sukses -->
            @if (session('success'))
                <div class="flex justify-center mb-8">
                    <div class="bg-white/80 backdrop-blur-md text-[#3a2c1b] p-5 rounded-2xl shadow-md flex items-center gap-3 border border-[#e0d9d3]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="font-semibold text-lg">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                <div class="backdrop-blur-md {{ session('success') ? 'bg-white/60 text-[#3a2c1b]' : 'bg-white/20 text-white' }} rounded-xl p-5 text-center shadow-lg border border-white/30">
                    <p class="text-sm font-medium mb-2">Produk Diapprove</p>
                    <div class="flex justify-center items-center gap-2">
                        <div class="bg-green-500 w-6 h-6 rounded"></div>
                        <span class="text-2xl font-bold">{{ $produkDisetujui ?? 0 }}</span>
                    </div>
                </div>

                <div class="backdrop-blur-md {{ session('success') ? 'bg-white/60 text-[#3a2c1b]' : 'bg-white/20 text-white' }} rounded-xl p-5 text-center shadow-lg border border-white/30">
                    <p class="text-sm font-medium mb-2">Produk Belum Diapprove</p>
                    <div class="flex justify-center items-center gap-2">
                        <div class="bg-red-500 w-6 h-6 rounded"></div>
                        <span class="text-2xl font-bold">{{ $produkBelum ?? 0 }}</span>
                    </div>
                </div>

                <div class="backdrop-blur-md {{ session('success') ? 'bg-white/60 text-[#3a2c1b]' : 'bg-white/20 text-white' }} rounded-xl p-5 text-center shadow-lg border border-white/30">
                    <p class="text-sm font-medium mb-2">Total Akun Penjual</p>
                    <div class="flex justify-center items-center gap-2">
                        <div class="bg-yellow-500 w-6 h-6 rounded"></div>
                        <span class="text-2xl font-bold">{{ $totalAkun ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Daftar Produk -->
            <div class="space-y-4">
                @if(isset($produkList) && count($produkList) > 0)
                    @foreach ($produkList as $produk)
                        <div class="backdrop-blur-md {{ session('success') ? 'bg-white/70 text-[#3a2c1b]' : 'bg-white/10 text-white' }} 
                            rounded-2xl px-6 py-4 flex items-center justify-between shadow-md hover:bg-white/20 transition border border-white/20">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset($produk['gambar']) }}" alt="{{ $produk['nama'] }}"
                                     class="w-16 h-16 rounded-lg object-cover bg-white/40 p-1">
                                <div>
                                    <p class="text-lg font-semibold">{{ $produk['nama'] }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.detail', ['id' => $produk['id']]) }}"
                               class="{{ session('success') ? 'text-[#3a2c1b] hover:text-[#6b4c35]' : 'text-white hover:text-gray-300' }} text-base font-medium underline transition">
                                Detail
                            </a>
                        </div>
                    @endforeach
                @else
                    <p class="text-center {{ session('success') ? 'text-[#3a2c1b]' : 'text-gray-300' }} italic">
                        Belum ada produk untuk di-approve.
                    </p>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
