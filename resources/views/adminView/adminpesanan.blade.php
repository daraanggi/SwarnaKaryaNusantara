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
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
            </div>
            <h1 class="text-center font-semibold text-lg">Swarna Karya Nusantara</h1>
        </div>

        <nav class="w-full mt-6 space-y-4 px-3">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-gray-200 text-primary-brown font-semibold shadow-lg hover:bg-gray-300 transition">
                <span>Approval Product</span>
            </a>
            <a href="{{ route('admin.pesanan') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-[#2b2b2b] text-white font-semibold shadow-xl">
                <span>Laporan Transaksi</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-10 bg-[#f3f3f3] overflow-auto">
        <div class="max-w-3xl mx-auto">

            <div class="flex items-center mb-6">
                <a href="{{ route('admin.pesanan') }}" class="mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-brown hover:text-[#4b3621] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-primary-brown">Laporan Transaksi</h2>
            </div>

            <div class="bg-primary-brown text-white rounded-3xl shadow-xl p-6">
                <h3 class="text-xl font-semibold mb-4">Kendi Tanah Liat</h3>

                <div class="space-y-3 mb-5">
                    <div class="flex justify-between bg-white text-black rounded-full py-2 px-4">
                        <span>Jumlah Stok</span>
                        <span class="font-semibold">150</span>
                    </div>
                    <div class="flex justify-between bg-white text-black rounded-full py-2 px-4">
                        <span>Jumlah Terjual</span>
                        <span class="font-semibold">35</span>
                    </div>
                </div>

                <div class="bg-white text-black rounded-2xl p-4">
                    <div class="flex justify-between font-semibold mb-2 border-b border-gray-300 pb-2">
                        <span>Pesanan</span>
                        <span>No. Telp</span>
                    </div>

                    <div class="space-y-1">
                        @php
                            // Dalam aplikasi nyata, variabel $orders ini harus dilewatkan dari controller
                            // Contoh data dummy untuk simulasi loop
                            $orders = [
                                ['id' => 101, 'telp' => '0987654321'],
                                ['id' => 102, 'telp' => '0987654321'],
                                ['id' => 103, 'telp' => '0987654321'],
                                // Jika ada pesanan baru, tinggal tambahkan data di sini.
                            ];
                        @endphp
                        
                        @foreach ($orders as $order)
                            <div class="flex justify-between">
                                <a href="{{ route('detailTransaksi.show', $order['id']) }}" class="order-link">
                                    Pesanan {{ $loop->iteration }} 
                                </a>
                                <span>{{ $order['telp'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>