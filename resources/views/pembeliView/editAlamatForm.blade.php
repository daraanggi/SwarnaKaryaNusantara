@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl p-8">

        {{-- Title --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
            Edit Alamat Pengiriman
        </h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('alamat.update', $alamat->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Penerima --}}
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-1">Nama Penerima</label>
                <input type="text" name="nama_penerima" 
                    value="{{ $alamat->nama_penerima }}"
                    class="w-full px-4 py-3 border rounded-xl focus:ring focus:outline-none">
            </div>

            {{-- Nomor HP --}}
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-1">Nomor HP</label>
                <input type="text" name="no_hp" 
                    value="{{ $alamat->no_hp }}"
                    class="w-full px-4 py-3 border rounded-xl focus:ring focus:outline-none">
            </div>

            {{-- Alamat --}}
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3"
                    class="w-full px-4 py-3 border rounded-xl focus:ring focus:outline-none">{{ $alamat->alamat }}</textarea>
            </div>

            {{-- Kota & Provinsi --}}
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Kota</label>
                    <input type="text" name="kota"
                        value="{{ $alamat->kota }}"
                        class="w-full px-4 py-3 border rounded-xl focus:ring focus:outline-none">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Provinsi</label>
                    <input type="text" name="provinsi"
                        value="{{ $alamat->provinsi }}"
                        class="w-full px-4 py-3 border rounded-xl focus:ring focus:outline-none">
                </div>
            </div>

            {{-- Kode Pos --}}
            <div class="mb-8">
                <label class="block text-gray-700 font-semibold mb-1">Kode Pos</label>
                <input type="text" name="kode_pos"
                    value="{{ $alamat->kode_pos }}"
                    class="w-full px-4 py-3 border rounded-xl focus:ring focus:outline-none">
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center">
                
                {{-- Tombol Kembali --}}
                <button type="button"
                    onclick="history.back()"
                    class="px-5 py-3 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition">
                    Kembali
                </button>

                {{-- Tombol Simpan --}}
                <button type="submit" 
                    class="px-6 py-3 bg-[#6B4C3B] text-white rounded-xl shadow hover:bg-[#513628] transition">
                    Simpan Alamat
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
