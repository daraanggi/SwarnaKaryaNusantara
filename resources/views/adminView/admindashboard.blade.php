<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Swarna Karya Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard - Laporan Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <style>
        .bg-primary-brown { background-color: #6B4E37; } /* warna utama sidebar */
        .bg-list-item { background-color: #7E6554; }     /* warna item */
        .text-primary-brown { color: #6B4E37; }
    </style>
</head>
<body class="bg-[#f3f3f3] font-sans">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-primary-brown text-white flex flex-col items-center py-6 shadow-2xl">
            <div class="mb-10 flex flex-col items-center">
                <div class="w-32 h-32 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-4">
                    <img src="{{ asset('images/logo-swarna.png') }}" alt="Logo Swarna" class="w-full h-full object-contain rounded-full">
                </div>
                <h1 class="text-lg font-semibold text-center">Swarna Karya Nusantara</h1>
            </div>

            <nav class="w-full mt-6 space-y-4 px-3">
                <!-- Link ke halaman Approval -->
                <a href="{{ route('admin.approval') }}" 
                   class="flex items-center gap-3 py-3 px-4 rounded-lg bg-gray-200 text-primary-brown font-semibold shadow-lg hover:bg-gray-300 transition">
                    <span class="p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <span>Approval Product</span>
                </a>

                <!-- Link ke halaman Transaksi -->
                <a href="{{ route('admin.transaksi') }}" 
                   class="flex items-center gap-3 py-3 px-4 rounded-lg bg-[#2b2b2b] text-white font-semibold shadow-xl">
                    <span class="p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span>Laporan Transaksi</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-10 bg-[#f3f3f3] overflow-auto">
            <div class="max-w-4xl mx-auto">
                <div class="bg-primary-brown text-white rounded-3xl shadow-xl p-8">

                    <div class="flex flex-col items-center mb-8">
                        <div class="w-20 h-20 bg-white flex items-center justify-center rounded-full mb-3 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="#6B4E37" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 10h18M9 21h6M4 10l1 11h14l1-11M5 10V6a7 7 0 0114 0v4" />
                            </svg>

                    
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-16 h-16 bg-white flex items-center justify-center rounded-full mb-3 shadow-lg">
                            <div class="h-10 w-10 text-white"></div>
                        </div>
                        <h2 class="text-3xl font-bold">Dashboard Admin</h2>
                        <p class="text-gray-200 text-sm mt-1">Kelola Approval dan Transaksi Penjual</p>
                    </div>

                    <!-- Statistik singkat -->
                    <div class="grid grid-cols-3 gap-6 mb-10">
                        <div class="bg-[#8B6F55] rounded-xl p-4 text-center shadow-md">
                            <p class="text-sm mb-1 font-medium">Produk Disetujui</p>
                            <div class="flex justify-center items-center gap-2">
                                <div class="bg-green-600 w-5 h-5 rounded"></div>
                                <span class="text-xl font-bold">{{ $produkDisetujui ?? 10 }}</span>
                            </div>
                        </div>
                        <div class="bg-[#8B6F55] rounded-xl p-4 text-center shadow-md">
                            <p class="text-sm mb-1 font-medium">Menunggu Approval</p>
                            <div class="flex justify-center items-center gap-2">
                                <div class="bg-yellow-500 w-5 h-5 rounded"></div>
                                <span class="text-xl font-bold">{{ $produkMenunggu ?? 3 }}</span>
                            </div>
                        </div>
                        <div class="bg-[#8B6F55] rounded-xl p-4 text-center shadow-md">
                            <p class="text-sm mb-1 font-medium">Total Penjual</p>
                            <div class="flex justify-center items-center gap-2">
                                <div class="bg-blue-500 w-5 h-5 rounded"></div>
                                <span class="text-xl font-bold">{{ $totalPenjual ?? 7 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol navigasi cepat -->
                    <div class="flex justify-center gap-6">
                        <a href="{{ route('admin.approval') }}"
                           class="bg-white text-primary-brown px-6 py-3 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
                            Kelola Approval
                        </a>

                        <a href="{{ route('admin.transaksi') }}"
                           class="bg-white text-primary-brown px-6 py-3 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
                            Lihat Transaksi
                        </a>
                    <div class="space-y-4 pt-4">
                        @php
                            $stores = ['Toko A', 'Toko B', 'Toko C', 'Toko D', 'Toko E', 'Toko F', 'Toko G'];
                        @endphp
                        
                        @foreach ($stores as $toko) 
                            <div class="flex items-center justify-between bg-list-item p-4 rounded-xl shadow-md"> 
                                <span class="text-lg font-medium">{{ $toko }}</span> 
                                <a href="{{ route('admin.periksa') }}" 
                                    class="bg-white text-primary-brown w-28 text-center px-4 py-2 rounded-full text-base font-semibold hover:bg-gray-100 transition shadow-inner"> 
                                        Periksa 
                                    </a>
                                
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </main>

    </div>
</body>
</html>
