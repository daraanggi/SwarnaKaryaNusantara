@extends('layouts.penjual')

@section('content')
<div class="max-w-4xl mx-auto bg-[#6B4C2C] p-6 rounded shadow text-white">
    <h2 class="text-2xl font-bold mb-6 text-center">Kelola Produk</h2>

   @if (session('success'))
    <div id="successAlert" class="mb-4 p-4 bg-green-500 text-white text-center rounded shadow">
        {{ session('success') }}
    </div>

    <script>
        // Setelah 2,5 detik, redirect otomatis ke halaman home penjual
        setTimeout(() => {
            window.location.href = "{{ route('homePagePenjual') }}";
        }, 2500);
    </script>
    @endif

    {{-- Tabel produk --}}
    <table class="w-full mb-6 table-auto bg-white text-black rounded shadow">
        <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Stok</th>
            <th>Tambah Stok</th>
            <th>Hapus Produk</th> <!-- Tambahan ini -->
        </tr>
        </thead>

        <tbody>
            @foreach ($produk as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">{{ $item->stok }}</td>
                    <td class="border px-4 py-2">
                        <form method="POST" action="{{ route('produk.tambahStok', ['id' => $item->id_produk]) }}">
                            @csrf
                            <input type="number" name="jumlah" min="1" class="w-20 px-2 py-1 rounded text-black" required>
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                        </form>
                    </td>
                    <!-- Hapus Produk -->
                    <td>
                        <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
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
