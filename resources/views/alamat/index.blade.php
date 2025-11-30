@extends('layouts.app')

@section('content')
<div class="container py-6">
    <h2 class="text-2xl font-bold mb-4 text-[#6B4C3B]">Daftar Alamat</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Daftar alamat --}}
    @if($alamats->isEmpty())
        <p class="text-gray-500 mb-4">Belum ada alamat yang disimpan.</p>
    @else
        @foreach ($alamats as $a)
            <div class="border border-gray-300 p-4 mb-3 rounded-lg">
                <b>{{ $a->nama_penerima }}</b><br>
                {{ $a->no_hp }}<br>
                {{ $a->alamat }}, {{ $a->kota }}, {{ $a->provinsi }} - {{ $a->kode_pos }}
            </div>
        @endforeach
    @endif

    {{-- Form tambah alamat --}}
    <h4 class="text-xl font-semibold mt-6 mb-3 text-[#6B4C3B]">Tambah Alamat Baru</h4>
    <form method="POST" action="{{ route('alamat.store') }}" class="space-y-3">
        @csrf
        <div>
            <input type="text" name="nama_penerima" placeholder="Nama Penerima" class="w-full p-2 border rounded-lg" required>
        </div>
        <div>
            <input type="text" name="no_hp" placeholder="No HP" class="w-full p-2 border rounded-lg" required>
        </div>
        <div>
            <textarea name="alamat" placeholder="Alamat Lengkap" class="w-full p-2 border rounded-lg" required></textarea>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <input type="text" name="kota" placeholder="Kota" class="w-full p-2 border rounded-lg" required>
            <input type="text" name="provinsi" placeholder="Provinsi" class="w-full p-2 border rounded-lg" required>
        </div>
        <div>
            <input type="text" name="kode_pos" placeholder="Kode Pos" class="w-full p-2 border rounded-lg" required>
        </div>
        <button type="submit" class="bg-[#6B4C3B] text-white px-4 py-2 rounded-lg hover:bg-[#5a3f32]">
            Tambah Alamat
        </button>
    </form>
</div>
@endsection
