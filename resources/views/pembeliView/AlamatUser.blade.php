@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-full mx-auto bg-white p-6 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold text-[#6B4C3B] mb-4">Daftar Alamat</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- LIST ALAMAT --}}
        @if($alamats->isEmpty())
            <p class="text-gray-500 mb-4">Belum ada alamat yang disimpan.</p>
        @else
            <div class="space-y-4 mb-6">
                @foreach($alamats as $alamat)
                    <div class="border border-gray-200 p-4 rounded-xl shadow-sm hover:shadow-md transition">

                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <p class="font-semibold text-lg text-[#6B4C3B]">
                                    {{ $alamat->nama_penerima }}
                                </p>
                                <p class="text-gray-600 text-sm">{{ $alamat->no_hp }}</p>
                            </div>

                            @if($alamat->is_utama)
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                    Alamat Utama
                                </span>
                            @endif
                        </div>

                        <p class="text-gray-700 text-sm mb-3">
                            {{ $alamat->alamat }}, {{ $alamat->kota }}, {{ $alamat->provinsi }} - {{ $alamat->kode_pos }}
                        </p>

                        {{-- TOMBOL-ACTION --}}
                        <div class="flex flex-wrap gap-3 mt-3">

                            {{-- PAKAI ALAMAT --}} 
                            <form action="{{ route('alamat.pilih', $alamat->id) }}" method="POST">
                                @csrf
                                <button class="px-4 py-2 bg-[#6B4C3B] text-white rounded-lg hover:bg-[#5a3f32]">
                                    Pakai Alamat Ini
                                </button>
                            </form>

                            {{-- SET UTAMA --}}
                            @if(!$alamat->is_utama)
                                <form action="{{ route('alamat.setUtama', $alamat->id) }}" method="POST">
                                    @csrf
                                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                        Jadikan Utama
                                    </button>
                                </form>
                            @endif

                            {{-- EDIT --}}
                            <a href="{{ route('alamat.edit', $alamat->id) }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Edit
                            </a>

                            {{-- HAPUS --}}
                            <form action="{{ route('alamat.destroy', $alamat->id) }}" method="POST" onsubmit="return confirm('Hapus alamat?');">
                                @csrf
                                @method('DELETE')
                                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif


        {{-- FORM TAMBAH ALAMAT --}}
        <h3 class="text-xl font-semibold text-[#6B4C3B] mb-3">Tambah Alamat Baru</h3>

        <form action="{{ route('alamat.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium">Nama Penerima</label>
                <input type="text" name="nama_penerima" class="w-full p-2 border rounded-lg" required>
            </div>

            <div>
                <label class="text-sm font-medium">Nomor HP</label>
                <input type="text" name="no_hp" class="w-full p-2 border rounded-lg" required>
            </div>

            <div>
                <label class="text-sm font-medium">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="w-full p-2 border rounded-lg" required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium">Kota</label>
                    <input type="text" name="kota" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="text-sm font-medium">Provinsi</label>
                    <input type="text" name="provinsi" class="w-full p-2 border rounded-lg" required>
                </div>
            </div>

            <div>
                <label class="text-sm font-medium">Kode Pos</label>
                <input type="text" name="kode_pos" class="w-full p-2 border rounded-lg" required>
            </div>

            <button class="mt-3 w-full py-2 rounded-lg bg-[#6B4C3B] text-white hover:bg-[#5a3f32]">
                Simpan Alamat
            </button>

        </form>
    </div>
</div>
@endsection
