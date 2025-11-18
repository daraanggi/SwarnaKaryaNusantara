<!-- File telah diperbaiki dan distyling dengan tema coklat elegan -->
@extends('layouts.app')

@section('content')
<div class="bg-[#F7F4EF] min-h-screen py-10">

    <div class="max-w-4xl mx-auto bg-white px-10 py-10 rounded-2xl shadow-xl border border-[#D6C7B3]">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-extrabold text-[#6B4C3B] tracking-wide">Daftar Alamat Saya</h2>
            <div class="w-12 h-1 bg-[#C2A48A] rounded-full"></div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- LIST ALAMAT --}}
        @if($alamats->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                Belum ada alamat. Silakan tambahkan alamat pertama Anda.
            </div>
        @else
            <div class="space-y-8 mb-12">

                @foreach($alamats as $alamat)

                <div class="p-6 rounded-xl bg-[#FFFDFB] border border-[#E8DED3] shadow-lg hover:shadow-xl transition duration-300">

                    {{-- NAMA & DETAIL --}}
                    <div class="mb-4">
                        <h4 class="text-xl font-bold text-[#4B382A]">{{ $alamat->nama_penerima }}</h4>
                        <p class="text-sm text-gray-500">{{ $alamat->no_hp }}</p>
                        <p class="mt-1 text-gray-700 leading-relaxed">
                            {{ $alamat->alamat }}, {{ $alamat->kota }}, {{ $alamat->provinsi }} - {{ $alamat->kode_pos }}
                        </p>
                    </div>

                    {{-- FOOTER BUTTONS --}}
                    <div class="flex justify-between items-center border-t pt-4">

                        {{-- STATUS / JADIKAN UTAMA --}}
                        @if($alamat->is_utama)
                            <span class="px-4 py-1.5 text-xs font-semibold bg-[#6B4C3B] text-white rounded-full shadow-md">
                                ALAMAT UTAMA
                            </span>
                        @else
                            <form action="{{ route('alamat.setUtama', $alamat->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-sm text-[#6B4C3B] hover:underline font-medium">
                                    Jadikan Utama
                                </button>
                            </form>
                        @endif

                        {{-- BUTTON KANAN --}}
                        <div class="flex items-center space-x-4">

                            {{-- Pakai Alamat --}}
                            <form action="{{ route('alamat.pilih', $alamat->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-[#6B4C3B] text-white px-4 py-1.5 rounded-lg shadow hover:bg-[#513628] transition">
                                    Pakai
                                </button>
                            </form>

                            {{-- EDIT --}} 
                            <button onclick="toggleEditForm({{ $alamat->id }})"
                                class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                Edit
                            </button>
                        </div>

                    </div>

                    {{-- FORM EDIT --}}
                    <div id="edit-form-{{ $alamat->id }}"
                        class="mt-4 p-4 bg-[#F2E9E2] border border-[#D8CBC0] rounded-lg hidden">

                        <h5 class="text-lg font-semibold text-[#6B4C3B] mb-3">Edit Alamat</h5>

                        <form action="{{ route('alamat.update', $alamat->id) }}" method="POST" class="space-y-4">
                            @csrf @method('PUT')

                            {{-- Nama & HP --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-semibold text-[#5C4535]">Nama Penerima</label>
                                    <input type="text" name="nama_penerima" value="{{ $alamat->nama_penerima }}"
                                        class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-[#5C4535]">Nomor HP</label>
                                    <input type="text" name="no_hp" value="{{ $alamat->no_hp }}"
                                        class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div>
                                <label class="text-sm font-semibold text-[#5C4535]">Alamat Lengkap</label>
                                <textarea name="alamat" rows="3" class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">{{ $alamat->alamat }}</textarea>
                            </div>

                            {{-- Kota, Provinsi, Kode Pos --}}
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="text-sm font-semibold text-[#5C4535]">Kota</label>
                                    <input type="text" name="kota" value="{{ $alamat->kota }}"
                                        class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-[#5C4535]">Provinsi</label>
                                    <input type="text" name="provinsi" value="{{ $alamat->provinsi }}"
                                        class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-[#5C4535]">Kode Pos</label>
                                    <input type="text" name="kode_pos" value="{{ $alamat->kode_pos }}"
                                        class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                                </div>
                            </div>

                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                                Simpan
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach

            </div>
        @endif

        {{-- FORM TAMBAH ALAMAT --}} 
        <h3 class="text-2xl font-bold text-[#6B4C3B] mb-4 pt-6 border-t border-[#E2D6C9]">Tambah Alamat Baru</h3>

        <form action="{{ route('alamat.store') }}" method="POST"
            class="space-y-4 p-6 bg-[#FAF7F3] border border-[#D6C7B3] rounded-xl shadow-md">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-[#5C4535]">Nama Penerima</label>
                    <input type="text" name="nama_penerima" class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                </div>
                <div>
                    <label class="text-sm font-semibold text-[#5C4535]">Nomor HP</label>
                    <input type="text" name="no_hp" class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-[#5C4535]">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]"></textarea>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-semibold text-[#5C4535]">Kota</label>
                    <input type="text" name="kota" class="w-full p-2 border rounded-lg bg-white border-[#CABBAA]">
                </div>
                <div>
                    <label class="text-sm font-semibold text-[#5C453