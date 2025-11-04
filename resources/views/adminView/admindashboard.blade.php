<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Laporan Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <style>
        /* Definisi warna kustom untuk konsistensi */
        .bg-primary-brown { background-color: #6B4E37; } /* Cokelat Gelap Sidebar & Kontainer Utama */
        .bg-list-item { background-color: #7E6554; }    /* Cokelat Item Daftar */
        .text-primary-brown { color: #6B4E37; }
    </style>
</head>
<body class="bg-[#f3f3f3] font-sans">

    <div class="flex h-screen">

        <aside class="w-64 bg-primary-brown text-white flex flex-col items-center py-6 shadow-2xl">
            <div class="mb-10 flex flex-col items-center">
                <div class="w-32 h-32 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-4">
                    <img src="placeholder-logo.png" alt="Logo Swarna" class="w-full h-full object-contain rounded-full">
                </div>
            </div>

            <nav class="w-full mt-6 space-y-4 px-3">
                
                <a href="#approval" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-gray-200 text-primary-brown font-semibold shadow-lg hover:bg-gray-300 transition">
                    <span class="p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <span>Approval Product</span>
                </a>

                <a href="#transaksi" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-[#2b2b2b] text-white font-semibold shadow-xl">
                    <span class="p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span>Laporan Transaksi</span>
                </a>
                
            </nav>
        </aside>

        <main class="flex-1 p-10 bg-[#f3f3f3] overflow-auto">
            <div class="max-w-3xl mx-auto">
                
                <div class="bg-primary-brown text-white rounded-3xl shadow-xl p-8">
                    
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-16 h-16 bg-white flex items-center justify-center rounded-full mb-3 shadow-lg">
                            <div class="h-10 w-10 text-white"></div>
                        </div>
                        <h2 class="text-3xl font-bold">Laporan Transaksi</h2>
                    </div>

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