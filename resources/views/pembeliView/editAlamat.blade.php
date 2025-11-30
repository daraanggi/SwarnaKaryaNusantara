@extends('layouts.app')

@section('content')

<div id="headerAlamat" 
    class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 
           bg-white text-primary-brown font-extrabold text-xl border-b shadow-sm">
    <h1 class="font-bold text-xl">Alamat</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>

<div class="p-6 pt-32 bg-gradient-to-br from-[#F3ECE6] to-[#E8DCCF] min-h-screen">

<div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl p-8 border border-[#eadfd4]">

    <h2 class="text-2xl font-extrabold text-[#6B4F3B] mb-6">Daftar Alamat</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- LIST ALAMAT --}}
    @if($alamats->isEmpty())
        <p class="text-gray-500 mb-4">Belum ada alamat yang disimpan.</p>
    @else
        <div class="space-y-5 mb-6">
            @foreach($alamats as $alamat)
                <div class="border border-[#eadfd4] p-5 rounded-2xl shadow-sm hover:shadow-md transition bg-[#fff8f2]">

                    {{-- HEADER ALAMAT --}}
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <p class="font-semibold text-lg text-[#6B4F3B]">
                                {{ $alamat->nama_penerima }}
                            </p>
                            <p class="text-gray-600 text-sm">{{ $alamat->no_hp }}</p>
                        </div>
                        @if($alamat->is_utama)
                            <span class="bg-[#DFF6E3] text-green-700 text-xs px-3 py-1 rounded-full font-semibold">
                                Alamat Utama
                            </span>
                        @endif
                    </div>

                    {{-- DETAIL --}}
                    <p class="text-gray-700 text-sm mb-4">
                        {{ $alamat->alamat }}, {{ $alamat->kota }}, {{ $alamat->provinsi }} - {{ $alamat->kode_pos }}
                    </p>

                    {{-- TOMBOL --}}
                    <div class="flex flex-wrap gap-3 mt-2">

                        {{-- PAKAI ALAMAT --}}
                        <form action="{{ route('alamat.pilih', $alamat->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-2 bg-[#6B4F3B] text-white rounded-lg hover:bg-[#5a3f32] transition">
                                Pakai Alamat Ini
                            </button>
                        </form>

                        {{-- SET UTAMA --}}
                        @if(!$alamat->is_utama)
                            <form action="{{ route('alamat.setUtama', $alamat->id) }}" method="POST">
                                @csrf
                                <button class="px-4 py-2 bg-[#F3E8DE] text-[#6B4F3B] rounded-lg hover:bg-[#e2d3c2] transition">
                                    Jadikan Utama
                                </button>
                            </form>
                        @endif

                        {{-- EDIT --}}
                        <a href="{{ route('alamat.edit', $alamat->id) }}"
                           class="px-4 py-2 bg-[#D1BFA7] text-[#6B4F3B] rounded-lg hover:bg-[#bfa18b] transition">
                            Edit
                        </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('alamat.destroy', $alamat->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus alamat ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>

                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- FORM TAMBAH --}}
    <h3 class="text-xl font-semibold text-[#6B4F3B] mb-4">Tambah Alamat Baru</h3>

    <form action="{{ route('alamat.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="text-sm font-medium text-[#6B4F3B]">Nama Penerima</label>
            <input type="text" name="nama_penerima" class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]" required>
        </div>

        <div>
            <label class="text-sm font-medium text-[#6B4F3B]">Nomor HP</label>
            <input type="text" name="no_hp" class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]" required>
        </div>

        <div>
            <label class="text-sm font-medium text-[#6B4F3B]">Alamat Lengkap</label>
            <textarea name="alamat" rows="3" class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]" required></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium text-[#6B4F3B]">Kota</label>
                <input type="text" name="kota" class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]" required>
            </div>
            <div>
                <label class="text-sm font-medium text-[#6B4F3B]">Provinsi</label>
                <input type="text" name="provinsi" class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]" required>
            </div>
        </div>

        <div>
            <label class="text-sm font-medium text-[#6B4F3B]">Kode Pos</label>
            <input type="text" name="kode_pos" class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]" required>
        </div>

        <button class="mt-3 w-full py-3 rounded-xl bg-[#6B4F3B] text-white font-semibold hover:bg-[#5a3f32] transition">
            Simpan Alamat
        </button>

    </form>
</div>

</div>
@endsection
