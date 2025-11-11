<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Transaksi Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary-brown { background-color: #6B4E37; }
        .text-primary-brown { color: #6B4E37; }
        /* Gaya untuk tombol Kembali */
        .btn-kembali { background-color: white; color: #6B4E37; }
        .btn-kembali:hover { background-color: #f3f3f3; }
        /* Gaya untuk sidebar item aktif/tidak aktif */
        .sidebar-active { background-color: #2b2b2b; color: white; }
        .sidebar-inactive { background-color: #e5e7eb; color: #6B4E37; }
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
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg sidebar-inactive font-semibold shadow-lg hover:bg-gray-300 transition">
                <span>Approval Product</span>
            </a>
            <a href="{{ route('admin.pesanan') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg sidebar-active font-semibold shadow-xl">
                <span>Laporan Transaksi</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-10 bg-[#f3f3f3] overflow-auto flex items-start justify-center">
        <div class="max-w-xl w-full"> 

            <div class="bg-primary-brown text-white rounded-3xl shadow-xl p-8">
                
                <h2 class="text-3xl font-bold mb-8">Detail Laporan Transaksi Produk</h2>

                @php
                    // Data dummy, dalam aplikasi nyata, data ini diisi dari Controller
                    $detail = [
                        'Nama Toko' => 'Tekomoro',
                        'Nomor Resi' => 'SRN0953R71H253L8',
                        'Nama Produk' => 'Tas Rotan',
                        'Status' => 'Pesanan Dalam Pengantaran',
                        'Waktu Pesanan' => ['17 Agustus 2024', '15 : 04'],
                        'Jumlah Pesanan' => 2,
                        'Total Pesanan' => 'Rp 411.000',
                    ];
                @endphp

                <div class="space-y-4">
                    @foreach ($detail as $label => $value)
                        @if ($label === 'Waktu Pesanan')
                            <div class="border-b border-white/50 pb-2 flex justify-between">
                                <span class="font-medium">{{ $label }}</span>
                                <div class="text-right">
                                    <span class="block text-sm">{{ $value[0] }}</span>
                                    <span class="block text-xs">{{ $value[1] }}</span>
                                </div>
                            </div>
                        @else
                            <div class="border-b border-white/50 pb-2 flex justify-between items-end">
                                <span class="font-medium">{{ $label }}</span>
                                <span class="text-right font-light">{{ is_array($value) ? implode(' ', $value) : $value }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <div class="mt-10 text-center">
                    <a href="{{ route('admin.pesanan') }}" class="btn-kembali px-8 py-3 rounded-xl text-lg font-bold shadow-lg transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>