<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Swarna Karya Nusantara</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f3f3f3] font-sans">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-[#6B4E37] text-white flex flex-col items-center py-6">
            <!-- Logo -->
            <div class="mb-6 flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Swarna" class="w-24 h-24 mb-2">
                <h1 class="text-center text-sm font-semibold">Swarna Karya Nusantara</h1>
            </div>

            <!-- Menu -->
            <nav class="w-full mt-6">
                <a href="{{ route('admin.approval') }}" class="flex items-center gap-3 py-2 px-6 hover:bg-[#8b6a52] transition">
                    <span class="bg-white text-[#6B4E37] p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <span>Approval Product</span>
                </a>

                <a href="{{ route('admin.transaksi') }}" class="flex items-center gap-3 py-2 px-6 hover:bg-[#8b6a52] transition">
                    <span class="bg-white text-[#6B4E37] p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                    <span>Laporan Transaksi</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-[#fff] rounded-tl-3xl shadow-inner overflow-auto">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col items-center mb-8">
                    <div class="w-14 h-14 bg-[#6B4E37] text-white flex items-center justify-center rounded-full mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1119 12m0 0l2 2m-2-2l-2 2" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#6B4E37]">Dashboard Admin</h2>
                </div>

                <!-- Tabel Transaksi Dummy -->
                <div class="bg-[#6B4E37] text-white rounded-2xl shadow-md p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-[#8b6a52]">
                                <th class="py-2 px-4">Nama Toko</th>
                                <th class="py-2 px-4">Produk</th>
                                <th class="py-2 px-4">Jumlah</th>
                                <th class="py-2 px-4">Total</th>
                                <th class="py-2 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ([
                                ['toko'=>'Toko A','produk'=>'Tas Daur Ulang','jumlah'=>2,'total'=>200000],
                                ['toko'=>'Toko B','produk'=>'Sabun Organik','jumlah'=>5,'total'=>250000],
                                ['toko'=>'Toko C','produk'=>'Sedotan Bambu','jumlah'=>3,'total'=>90000],
                            ] as $item)
                                <tr class="border-t border-[#8b6a52]">
                                    <td class="py-3 px-4">{{ $item['toko'] }}</td>
                                    <td class="py-3 px-4">{{ $item['produk'] }}</td>
                                    <td class="py-3 px-4">{{ $item['jumlah'] }}</td>
                                    <td class="py-3 px-4">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-right">
                                        <a href="#" class="bg-white text-[#6B4E37] px-4 py-1 rounded-full text-sm font-semibold hover:bg-[#e8e0d9] transition">Periksa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

    </div>

</body>
</html>
