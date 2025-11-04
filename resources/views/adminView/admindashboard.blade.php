<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard – Laporan Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary-brown { background-color: #6B4E37; }
        .bg-list-item     { background-color: #7E6554; }
        .text-primary-brown { color:#6B4E37; }
    </style>
</head>
<body class="bg-[#f3f3f3] font-sans">

<div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-primary-brown text-white flex flex-col items-center py-6 shadow-2xl">
        <div class="mb-8 flex flex-col items-center">
            <div class="w-32 h-32 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-4">
                <img src="{{ asset('images/logo-swarna.png') }}" alt="Logo Swarna" class="w-full h-full object-contain rounded-full">
            </div>
            <h1 class="text-lg font-semibold text-center">Swarna Karya Nusantara</h1>
        </div>

        <nav class="w-full mt-2 space-y-3 px-3">
            <!-- Approval -->
            <a href="{{ route('admin.approval') }}"
               class="flex items-center gap-3 py-3 px-4 rounded-lg bg-gray-200 text-primary-brown font-semibold shadow hover:bg-gray-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>Approval Product</span>
            </a>

            <!-- Transaksi (active) -->
            <a href="{{ route('admin.transaksi') }}"
               class="flex items-center gap-3 py-3 px-4 rounded-lg bg-[#2b2b2b] text-white font-semibold shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Laporan Transaksi</span>
            </a>
        </nav>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto px-3 w-full">
    @csrf
            <button type="submit"
                class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold shadow hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8 md:p-10 overflow-auto">
        <div class="max-w-5xl mx-auto">

            <!-- LIST TOKO -->
            <section class="mt-8">
                <h3 class="text-lg font-semibold mb-4 text-[#333]">Daftar Toko</h3>

                <div class="space-y-4">
                    @php
                        $stores = ['Toko A', 'Toko B', 'Toko C', 'Toko D', 'Toko E', 'Toko F', 'Toko G'];
                    @endphp

                    @foreach ($stores as $toko)
                        <div class="flex items-center justify-between bg-list-item p-4 rounded-xl shadow-md">
                            <span class="text-white text-lg font-medium">{{ $toko }}</span>
                            <a href="{{ route('admin.periksa') }}"
                               class="bg-white text-primary-brown w-28 text-center px-4 py-2 rounded-full text-base font-semibold hover:bg-gray-100 transition shadow-inner">
                                Periksa
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
</div>

</body>
</html>
