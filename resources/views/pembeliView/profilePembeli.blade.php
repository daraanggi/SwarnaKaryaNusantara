@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-2xl bg-[#7A5C3C] rounded-lg shadow-md p-6 text-white relative">
        <!-- Icon Lokasi - Buka Form Alamat -->
        <div class="absolute top-4 right-4 cursor-pointer" onclick="toggleAlamatForm()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
            </svg>
        </div>

        <!-- Profile Icon -->
        <div class="flex justify-center -mt-16">
            <div class="bg-[#7A5C3C] border-4 border-white rounded-full p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M12 12c2.67 0 8 1.34 8 4v2H4v-2c0-2.66 5.33-4 8-4z"/>
                </svg>
            </div>
        </div>

        <!-- Nama dan Edit -->
        <div class="text-center mt-4">
            <h2 class="text-xl font-bold">{{ auth()->user()->name }}</h2>
            <a href="{{ route('editProfile') }}" class="text-sm underline text-gray-200 hover:text-white">Edit</a>      
        </div>

        <!-- Edit Form -->
        <form id="editForm" class="mt-4 hidden text-black" onsubmit="event.preventDefault(); alert('Profil diubah!')">
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full rounded p-2 mb-2">
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full rounded p-2 mb-2">
            <button class="bg-[#B08B5E] hover:bg-[#a67c52] text-white py-2 px-4 rounded w-full">Simpan</button>
        </form>

        <!-- Form Ubah Alamat -->
        <form id="alamatForm" class="mt-4 hidden text-black" onsubmit="event.preventDefault(); alert('Alamat diperbarui!')">
            <textarea placeholder="Alamat baru..." class="w-full rounded p-2 mb-2"></textarea>
            <button class="bg-[#B08B5E] hover:bg-[#a67c52] text-white py-2 px-4 rounded w-full">Simpan Alamat</button>
        </form>

        <!-- Fitur Pesanan & Ulasan -->
        <div class="flex justify-around mt-6 text-white">
            <!-- Fitur Pesanan -->
             <a href="{{ route('pesananPembeli') }}" class="text-center hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M20 6H4V4h16v2zM4 8h16v12H4V8zm4 2h8v2H8v-2z"/>
                </svg>
                <p class="mt-1">Pesanan</p>
            </a>

            <!-- Fitur Ulasan -->
             <a href="{{ route('ulasanPembeli') }}" class="text-center hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M21 11.5a8.38 8.38 0 01-1.9.5 4.19 4.19 0 001.8-2.3 8.38 8.38 0 01-2.6 1 4.19 4.19 0 00-7.1 3.8A11.87 11.87 0 013 6s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.4 4.4 0 00-.1-.9A6.3 6.3 0 0021 11.5z"/>
                </svg>
                <p class="mt-1">Ulasan</p>
            </a>
        </div>

        <!-- Konten Pesanan -->
        <div id="pesananContent" class="mt-6 bg-[#82634B] p-4 rounded-lg text-sm hidden">
            <h3 class="font-semibold mb-2">Daftar Pesanan</h3>
            <p class="text-gray-200 italic">Belum ada pesanan.</p>
        </div>

        <!-- Konten Ulasan -->
        <div id="ulasanContent" class="mt-6 bg-[#82634B] p-4 rounded-lg text-sm hidden">
            <h3 class="font-semibold mb-2">Ulasan Produk</h3>
            <p class="text-gray-200 italic">Belum ada ulasan.</p>
        </div>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST" class="mt-6 text-center">
            @csrf
            <button class="bg-[#B08B5E] hover:bg-[#a07b4c] text-white text-sm px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </div>
</div>

<!-- Script Interaksi -->
<script>
    function toggleEditForm() {
        document.getElementById('editForm').classList.toggle('hidden');
    }
    function toggleAlamatForm() {
        document.getElementById('alamatForm').classList.toggle('hidden');
    }
    function togglePesanan() {
        document.getElementById('pesananContent').classList.toggle('hidden');
    }
    function toggleUlasan() {
        document.getElementById('ulasanContent').classList.toggle('hidden');
    }
</script>
@endsection
