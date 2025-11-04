<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Produk - {{ $produk['nama'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#3a2c1b] font-sans text-white min-h-screen bg-[url('/images/motif-batik.png')] bg-cover bg-center bg-fixed">

    <!-- Tombol kembali -->
    <div class="flex items-center p-6">
        <a href="{{ route('admin.approval') }}" class="text-white text-lg font-semibold flex items-center">
            <span class="text-2xl mr-2">←</span> Approve Produk
        </a>
    </div>

    <!-- Konten utama -->
    <div class="flex flex-col items-center px-6">
        <div class="bg-[#7a5a3a]/90 p-8 rounded-3xl shadow-lg max-w-4xl w-full text-white backdrop-blur-sm">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Gambar produk -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset($produk['gambar']) }}" alt="{{ $produk['nama'] }}" class="w-36 h-36 object-cover rounded-xl mb-3 bg-white p-1 shadow-md">
                    <div class="flex gap-3">
                        <button class="bg-[#d4c3ac] text-[#4a3a2a] font-semibold text-sm px-4 py-1 rounded-full">Gambar Produk</button>
                        <button class="bg-[#d4c3ac] text-[#4a3a2a] font-semibold text-sm px-4 py-1 rounded-full">Video Produk</button>
                    </div>
                </div>

                <!-- Informasi produk -->
                <div class="flex-1">
                    <div class="mb-2">
                        <p><strong>Kategori</strong><br>Alat Makan/Minum</p>
                    </div>
                    <div class="mb-2">
                        <p><strong>Stok produk</strong><br>14</p>
                    </div>

                    <h2 class="text-2xl font-bold mt-4">{{ $produk['nama'] }}</h2>
                    <p class="text-lg font-semibold text-[#ffefcc]">{{ $produk['harga'] }}</p>

                    <p class="mt-3 text-sm leading-relaxed">
                        {{ $produk['deskripsi'] }}
                    </p>

                    <div class="flex mt-6 gap-4 items-start">
                        <textarea placeholder="Keterangan" name="keterangan" class="w-1/2 h-24 text-gray-800 rounded-lg p-2"></textarea>
                        
                        <div class="flex gap-3 mt-auto">
                            <!-- Form Approve -->
                            <form action="{{ route('admin.approve', $produk['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-white text-[#4a3a2a] font-bold py-2 px-6 rounded-full shadow-md hover:scale-105 transition">
                                    Approve
                                </button>
                            </form>

                            <!-- Tombol tolak (belum pakai route, nanti bisa ditambah) -->
                            <button class="bg-white text-[#4a3a2a] font-bold py-2 px-6 rounded-full shadow-md hover:scale-105 transition">
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
