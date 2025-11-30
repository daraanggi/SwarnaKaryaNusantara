@extends('layouts.app')

@section('title', 'Edit Profil')


@section('content')
<div id="mainContentWrapper" 
    class="min-h-screen flex justify-center items-start pt-32 pb-20 px-6 bg-gradient-to-br from-[#F3ECE6] to-[#E8DCCF] transition-all duration-300">

    <div class="w-full max-w-3xl bg-white rounded-3xl shadow-xl p-10 border border-[#E4D7CA]">


         <!-- Header -->
<div id="headerEditProfil" 
    class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 
           bg-white text-primary-brown font-extrabold text-xl border-b shadow-sm">
    <h1 class="font-bold text-xl"> Edit Profil</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>
        <div class="text-center mb-10">
            <div class="rounded-full bg-gradient-to-b from-[#FFFFF] to-[#FFFFF] p-1 shadow-xl w-32 h-32 mx-auto flex items-center justify-center">
                <div class="bg-white rounded-full overflow-hidden w-full h-full">
                    <img src="/images/profill.jpg"
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('images/default-profile.png') }}'">
                </div>
            </div>

            <h2 class="text-3xl font-extrabold text-[#6B4F3B] mt-6 tracking-wide">
                Edit Profil
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi akun anda
            </p>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="text-green-600 text-sm font-semibold text-center mb-6">
                Profil berhasil diperbarui.
            </div>
        @endif

        <!-- FORM -->
        <form id="formProfil" method="POST" action="{{ route('pembeli.profile.update') }}" class="space-y-8">
            @csrf
            @method('PATCH')

            @php
                $classInput = "w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-3 text-gray-700
                               shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-[#8B5E3C]
                               transition-all duration-200 focus:bg-white";
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">Nama Lengkap</label>
                    <input id="name" name="name" type="text"
                        value="{{ auth()->user()->name }}" class="{{ $classInput }}" disabled>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">Email</label>
                    <input id="email" name="email" type="email"
                        value="{{ auth()->user()->email }}" class="{{ $classInput }}" disabled>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">No. Telepon</label>
                    <input id="no_telepon" name="no_telepon" type="text"
                        value="{{ auth()->user()->no_telepon }}" class="{{ $classInput }}" disabled>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-1 block">Password</label>
                    <input id="password" name="password" type="password"
                        placeholder="Biarkan kosong jika tidak diubah" class="{{ $classInput }}" disabled>
                </div>
            </div>

            <!-- BUTTONS -->
            <div class="flex justify-end gap-4 pt-6">
                
                <button type="button" id="btnBatal"
                    class="hidden px-6 py-2.5 rounded-xl border border-gray-300 text-gray-600
                           hover:bg-gray-100 transition duration-200 text-sm font-medium">
                    Batal
                </button>
                
                <button type="button" id="btnEdit"
                    class="px-6 py-2.5 rounded-xl bg-[#8B5E3C] text-white text-sm font-semibold
                           hover:bg-[#6B4F3B] shadow-md transition duration-200">
                    Edit Profil
                </button>

                <button type="submit" id="btnSubmit"
                    class="hidden px-6 py-2.5 rounded-xl bg-[#8B5E3C] text-white text-sm font-semibold
                           hover:bg-[#6B4F3B] shadow-md transition duration-200">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>
</div>

<!-- SCRIPT EDIT / BATAL -->
<script>
    const btnEdit = document.getElementById('btnEdit');
    const btnBatal = document.getElementById('btnBatal');
    const btnSubmit = document.getElementById('btnSubmit');
    const form = document.getElementById('formProfil');
    const inputs = form.querySelectorAll('input');

    let originalValues = {};

    btnEdit.addEventListener('click', () => {
        inputs.forEach(input => {
            originalValues[input.id] = input.value;
            input.disabled = false;
            input.classList.remove('bg-gray-100');
            input.classList.add('bg-white');
        });

        btnEdit.classList.add('hidden');
        btnSubmit.classList.remove('hidden');
        btnBatal.classList.remove('hidden');
    });

    btnBatal.addEventListener('click', () => {
        inputs.forEach(input => {
            input.value = originalValues[input.id] || '';
            input.disabled = true;
            input.classList.remove('bg-white');
            input.classList.add('bg-gray-100');
        });

        btnEdit.classList.remove('hidden');
        btnSubmit.classList.add('hidden');
        btnBatal.classList.add('hidden');
    });
</script>
@endsection
