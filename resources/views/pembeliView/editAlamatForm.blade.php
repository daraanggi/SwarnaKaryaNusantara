@extends('layouts.app')

@section('content')
<div id="headerEditAlamat" 
    class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 
           bg-white text-primary-brown font-extrabold text-xl border-b shadow-sm">
    <h1 class="font-bold text-xl">Edit Alamat</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>

<div class="bg-gradient-to-br from-[#F3ECE6] to-[#E8DCCF] min-h-screen pt-32 p-6">
<div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl p-8 border border-[#eadfd4]">

    {{-- Title --}}
    <h2 class="text-2xl font-extrabold text-[#6B4F3B] mb-6 border-b pb-3">
        Edit Alamat Pengiriman
    </h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('alamat.update', $alamat->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nama Penerima --}}
        <div>
            <label class="block text-sm font-medium text-[#6B4F3B] mb-1">Nama Penerima</label>
            <input type="text" name="nama_penerima" value="{{ $alamat->nama_penerima }}"
                class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]">
        </div>

        {{-- Nomor HP --}}
        <div>
            <label class="block text-sm font-medium text-[#6B4F3B] mb-1">Nomor HP</label>
            <input type="text" name="no_hp" value="{{ $alamat->no_hp }}"
                class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]">
        </div>

        {{-- Alamat --}}
        <div>
            <label class="block text-sm font-medium text-[#6B4F3B] mb-1">Alamat Lengkap</label>
            <textarea name="alamat" rows="3"
                class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]">{{ $alamat->alamat }}</textarea>
        </div>

        {{-- Kota & Provinsi --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#6B4F3B] mb-1">Kota</label>
                <input type="text" name="kota" value="{{ $alamat->kota }}"
                    class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#6B4F3B] mb-1">Provinsi</label>
                <input type="text" name="provinsi" value="{{ $alamat->provinsi }}"
                    class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]">
            </div>
        </div>

        {{-- Kode Pos --}}
        <div>
            <label class="block text-sm font-medium text-[#6B4F3B] mb-1">Kode Pos</label>
            <input type="text" name="kode_pos" value="{{ $alamat->kode_pos }}"
                class="w-full p-3 border border-[#eadfd4] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#6B4F3B]">
        </div>

        {{-- Buttons --}}
        <div class="flex justify-between items-center mt-4">
            <button type="button" onclick="history.back()"
                class="px-5 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">
                Kembali
            </button>
            <button type="submit"
                class="px-6 py-3 bg-[#6B4F3B] text-white rounded-xl shadow hover:bg-[#5a3f32] transition">
                Simpan Alamat
            </button>
        </div>

    </form>
</div>
</div>
@endsection
