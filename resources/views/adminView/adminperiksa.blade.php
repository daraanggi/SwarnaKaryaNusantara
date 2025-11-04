<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Periksa Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary-brown { background-color: #6B4E37; } /* Cokelat utama */
        .text-primary-brown { color: #6B4E37; }
        .bg-list-item { background-color: #7E6554; } /* Cokelat item */
    </style>
</head>
<body class="bg-[#f3f3f3] font-sans">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-primary-brown text-white flex flex-col items-center py-6 shadow-2xl">
            <div class="mb-10 flex flex-col items-center">
                <div class="w-28 h-28 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Swarna" class="w-full h-full object-contain rounded-full">
                </div>
                <h1 class="text-center font-semibold text-lg">Swarna Karya Nusantara</h1>
            </div>

            <nav class="w-full mt-6 space-y-4 px-3">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-gray-200 text-primary-brown font-semibold shadow-lg hover:bg-gray-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Approval Product</span>
                </a>

                <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-[#2b2b2b] text-white font-semibold shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Laporan Transaksi</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-[#f3f3f3] overflow-auto">
            <div class="max-w-3xl mx-auto">

                <!-- Header -->
                <div class="flex items-center mb-6">
                    <a href="{{ url('/admin/dashboard') }}" class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-brown hover:text-[#4b3621] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-primary-brown">Laporan Transaksi</h2>
                </div>

                <!-- Daftar Transaksi -->
                <div class="bg-primary-brown text-white rounded-3xl shadow-xl p-6 space-y-3">
                    @php
                        $transaksi = ['Kendi Tanah Liat', 'Batik Tenun', 'Angklung', 'Tas Rotan', 'Gelas Bambu', 'Ukiran Jepara', 'Kipas Anyaman'];
                    @endphp

                    @foreach ($transaksi as $index => $item)
                        <div class="flex justify-between items-center border-b border-white/30 py-2">
                            <span class="text-lg">{{ $item }}</span>
                            <a href="{{ route('admin.pesanan', $index + 1) }}" 
                            class="text-white font-semibold underline hover:text-gray-200 transition">
                            Detail
                            </a>
                        </div>
                    @endforeach

                </div>

            </div>
        </main>
    </div>

</body>
</html>
