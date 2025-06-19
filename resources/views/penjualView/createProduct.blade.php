@extends('layouts.penjual')

@section('content')
<div class="max-w-5xl mx-auto bg-[#6B4C2C] p-8 rounded shadow text-white">
    <h2 class="text-2xl font-bold mb-6 text-center">Lampiran Informasi Produk</h2>

    <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-6">
            <!-- Nama Produk -->
            <div>
                <label for="nama" class="block font-medium mb-1">Nama Produk:</label>
                <input type="text" name="nama" id="nama" class="w-full rounded px-3 py-2 text-black" required>
            </div>

            <!-- Kategori -->
             <div class="mb-4">
                <label for="kategori" class="block text-white font-medium mb-1">Kategori</label>
                <select name="kategori" id="kategori" class="w-full px-3 py-2 rounded text-black" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Batik">Batik</option>
                    <option value="Tenun">Tenun</option>
                    <option value="Bambu">Bambu</option>
                    <option value="Rotan">Rotan</option>
                </select>
            </div>

            <!-- Harga Produk -->
            <div>
                <label for="harga" class="block font-medium mb-1">Harga Produk:</label>
                <input type="number" name="harga" id="harga" class="w-full rounded px-3 py-2 text-black" required>
            </div>

            <!-- Stok Produk -->
            <div>
                <label for="stok" class="block font-medium mb-1">Stok Produk:</label>
                <input type="number" name="stok" id="stok" class="w-full rounded px-3 py-2 text-black" required>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mt-6">
            <label for="deskripsi" class="block font-medium mb-1">Deskripsi Produk:</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full rounded px-3 py-2 text-black" required></textarea>
        </div>

        <!-- Lampiran -->
        <div class="mt-6 flex gap-6">
            <div>
                <label for="foto" class="block font-medium mb-1">Lampirkan Gambar:</label>
                <input type="file" name="foto" id="foto" accept="image/*" class="text-black">
            </div>
        </div>

        <!-- Tombol -->
        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('manageProduct') }}" class="bg-white text-[#6B4C2C] font-semibold px-6 py-2 rounded hover:bg-gray-200">Batal</a>
            <button type="submit" class="bg-white text-[#6B4C2C] font-semibold px-6 py-2 rounded hover:bg-gray-200">Verifikasi</button>
        </div>
    </form>
</div>
@endsection
