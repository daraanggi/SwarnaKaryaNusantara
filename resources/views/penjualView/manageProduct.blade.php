@extends('layouts.penjual')

@section('content')
<div class="max-w-4xl mx-auto bg-[#6B4C2C] p-6 rounded shadow text-white">
    <h2 class="text-2xl font-bold mb-6 text-center">Kelola Produk</h2>

    {{-- Tabel produk --}}
    <table class="w-full mb-6 table-auto bg-white text-black rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Stok</th>
                <th class="px-4 py-2">Tambah Stok</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">{{ $item->stok }}</td>

                    {{-- Form tambah stok --}}
                    <td class="border px-4 py-2">
                        <form method="POST" action="{{ route('produk.tambahStok', $item->id) }}">
                            @csrf
                            <input type="number" name="jumlah" min="1" class="w-20 px-2 py-1 rounded text-black" required>
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                        </form>
                    </td>

                    {{-- Hapus produk --}}
                    <td class="border px-4 py-2">
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        <a href="{{ route('produk.create') }}" class="bg-white text-[#6B4C2C] px-4 py-2 rounded">+ Tambah Produk Baru</a>
    </div>
</div>
@endsection
