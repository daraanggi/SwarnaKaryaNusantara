@extends('layouts.app')

@section('content')
<!-- Tambahkan di paling atas kontainer utama, di bawah header -->
@if (session('status') === 'profile-updated')
    <div id="notifSuccess" 
         class="fixed top-20 left-1/2 -translate-x-1 bg-green-100 text-green-700 
                font-semibold px-6 py-3 rounded-xl shadow-md z-50 transition-all duration-300">
        Profil berhasil diperbarui.
    </div>

    <script>
        // Fade out otomatis setelah 3 detik
        setTimeout(() => {
            const notif = document.getElementById('notifSuccess');
            if(notif){
                notif.style.opacity = '0';
                notif.style.transform = 'translate(-50%, -20px)';
            }
        }, 3000);
    </script>
@endif

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
<div class="flex justify-center pt-32 pb-20 px-4 bg-gradient-to-br from-[#F3ECE6] to-[#E8DCCF] min-h-screen">

    <div class="w-full max-w-3xl bg-white rounded-3xl shadow-xl p-10 border border-[#eadfd4]">

        <!-- Foto Profil -->
        <div class="flex justify-center mb-6">
            <div class="rounded-full bg-gradient-to-b from-[#FFFFF] to-[#FFFFF] 
                        p-1 shadow-xl w-32 h-32 flex items-center justify-center">
                <div class="bg-white rounded-full w-full h-full overflow-hidden flex items-center justify-center">
                    <img src="{{ asset('images/profill.jpg') }}"
                         alt="Foto Profil"
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('images/default-profile.png') }}'">
                </div>
            </div>
        </div>

        <!-- Nama & Edit -->
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-[#6B4F3B] tracking-wide">
                {{ auth()->user()->name }}
            </h2>
            <a href="{{ route('editProfile') }}"
               class="text-sm text-[#8B5E3C] underline hover:text-[#6B4F3B] transition">
                Edit Profil
            </a>
        </div>

        <!-- Divider -->
        <div class="w-full h-[1px] bg-[#E4D7CA] my-8"></div>

        <!-- Menu Navigasi -->
        <div class="grid grid-cols-2 gap-5">

            <!-- Pesanan -->
            <a href="{{ route('pesananPembeli') }}"
               class="text-center bg-[#F8F1E8] hover:bg-[#F2E7D8] transition-all duration-200 
                      rounded-2xl p-6 shadow-md hover:shadow-xl border border-[#eadfd4]">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-12 w-12 mx-auto text-[#6B4F3B]" 
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M20 6H4V4h16v2zM4 8h16v12H4V8zm4 2h8v2H8v-2z"/>
                </svg>
                <p class="mt-3 font-semibold text-[#6B4F3B] text-lg">Pesanan</p>
            </a>

            <!-- Ulasan -->
            <a href="{{ route('ulasan.store') }}"
               class="text-center bg-[#F8F1E8] hover:bg-[#F2E7D8] transition-all duration-200 
                      rounded-2xl p-6 shadow-md hover:shadow-xl border border-[#eadfd4]">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-12 w-12 mx-auto text-[#6B4F3B]" 
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M21 11.5a8.3 8.3 0 01-2 .5 4.2 4.2 0 001.8-2.3 
                             8.4 8.4 0 01-2.6 1 4.2 4.2 0 00-7.1 3.8A11.8 11.8 
                             0 013 6s-4 9 5 13a11.6 11.6 0 01-7 2c9 5 20 0 20-11.5z"/>
                </svg>
                <p class="mt-3 font-semibold text-[#6B4F3B] text-lg">Ulasan</p>
            </a>

        </div>

        <!-- Divider -->
        <div class="w-full h-[1px] bg-[#E4D7CA] my-8"></div>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST" class="text-center">
            @csrf
            <button class="bg-[#8B5E3C] hover:bg-[#6B4F3B] 
                           text-white px-8 py-3 rounded-2xl shadow-md hover:shadow-xl text-lg transition">
                Logout
            </button>
        </form>

    </div>
</div>

@endsection
