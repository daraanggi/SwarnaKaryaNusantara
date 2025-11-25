@extends('layouts.app')

@section('content')
<!-- Header -->
<div id="headerProfil" 
    class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 
           bg-white text-primary-brown font-extrabold text-xl border-b shadow-sm">
    <h1 class="font-bold text-xl">Profil</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>

<!-- Main Container -->
<div class="flex justify-center pt-28 pb-20 px-4 bg-gradient-to-br from-[#F3ECE6] to-[#E8DCCF] min-h-screen">

    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl p-8 relative">

        <!-- Foto Profil -->
        <div class="flex justify-center mb-4">
            <div class="rounded-full bg-gradient-to-b from-[#8B5E3C] to-[#6B4F3B] 
                        p-1 shadow-lg w-28 h-28 flex items-center justify-center">
                <div class="bg-white rounded-full w-full h-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-16 w-16 text-[#6B4F3B]" 
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M12 12c2.7 0 8 1.4 8 4v2H4v-2c0-2.6 5.3-4 8-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Nama & Edit -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-[#6B4F3B]">
                {{ auth()->user()->name }}
            </h2>
            <a href="{{ route('editProfile') }}"
               class="text-sm text-[#8B5E3C] underline hover:text-[#6B4F3B]">
                Edit Profil
            </a>
        </div>

        <!-- Divider -->
        <div class="w-full h-[1px] bg-[#E4D7CA] my-6"></div>

        <!-- Menu Navigasi -->
        <div class="grid grid-cols-2 gap-4">

            <!-- Pesanan -->
            <a href="{{ route('pesananPembeli') }}"
               class="text-center bg-[#F7EFE6] hover:bg-[#F2E6D8] transition-all duration-200 
                      rounded-xl p-4 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-10 w-10 mx-auto text-[#6B4F3B]" 
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M20 6H4V4h16v2zM4 8h16v12H4V8zm4 2h8v2H8v-2z"/>
                </svg>
                <p class="mt-2 font-semibold text-[#6B4F3B]">Pesanan</p>
            </a>

            <!-- Ulasan -->
            <a href="{{ route('ulasan.store') }}"
               class="text-center bg-[#F7EFE6] hover:bg-[#F2E6D8] transition-all duration-200 
                      rounded-xl p-4 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-10 w-10 mx-auto text-[#6B4F3B]" 
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M21 11.5a8.3 8.3 0 01-2 .5 4.2 4.2 0 001.8-2.3 
                             8.4 8.4 0 01-2.6 1 4.2 4.2 0 00-7.1 3.8A11.8 11.8 
                             0 013 6s-4 9 5 13a11.6 11.6 0 01-7 2c9 5 20 0 20-11.5z"/>
                </svg>
                <p class="mt-2 font-semibold text-[#6B4F3B]">Ulasan</p>
            </a>

        </div>

        <!-- Divider -->
        <div class="w-full h-[1px] bg-[#E4D7CA] my-6"></div>

        <!-- Form Alamat (optional) -->
        <form id="alamatForm" class="hidden">
            <textarea class="w-full rounded-lg p-3 border border-gray-300 
                            focus:ring-[#8B5E3C] focus:border-[#8B5E3C]"
                      placeholder="Alamat baru..."></textarea>
            <button class="w-full mt-3 bg-[#8B5E3C] text-white py-2 rounded-lg hover:bg-[#6B4F3B]">
                Simpan Alamat
            </button>
        </form>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST" class="mt-8 text-center">
            @csrf
            <button class="bg-[#8B5E3C] hover:bg-[#6B4F3B] 
                           text-white px-6 py-2 rounded-xl shadow-md">
                Logout
            </button>
        </form>

    </div>
</div>

@endsection
