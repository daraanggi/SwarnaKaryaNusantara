@extends('layouts.penjual')
@section('title', 'Edit Profil')

@section('content')

<div id="mainContentWrapper" class="flex items-center justify-center min-h-screen w-full overflow-hidden">
    <div class="border rounded-lg p-4 sm:p-6 bg-white space-y-4 w-full max-w-md">

    <!-- Avatar -->
        <div class="flex justify-center">
            <div class="relative">
                <img src="/images/avatar.png" alt="User Avatar"
                    class="w-24 h-24 rounded-full border-4 border-[#69553E] object-cover shadow">
            </div>
        </div>
        
        <h2 class="text-xl font-semibold text-[#69553E] text-center">Informasi Akun Penjual</h2>

        <!-- Form -->
        <form id="formPenjual" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ auth()->user()->name }}"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]"
                    disabled>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ auth()->user()->email }}"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]"
                    disabled>
            </div>

            <div>
                <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input id="no_telepon" name="no_telepon" type="text" value="{{ auth()->user()->no_telepon }}"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]"
                    disabled>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" value="******"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]"
                    disabled>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 pt-4 items-center">
            <!-- Tombol Batal -->
            <button type="button" id="btnBatal"
                class="hidden text-gray-600 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 text-sm">
                Batal
            </button>

            <!-- Tombol Edit -->
            <button type="button" id="btnEdit"
                class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">
            Edit
            </button>
        </form>
        
        <!-- Tombol Logout (form sendiri, tapi tetap di dalam flex container) -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-[#B08B5E] hover:bg-[#a07b4c] text-white text-sm px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </div>
</div>

<!-- Script -->
<script>
    const btnEdit = document.getElementById('btnEdit');
    const btnBatal = document.getElementById('btnBatal');
    const form = document.getElementById('formPenjual');
    const inputs = form.querySelectorAll('input');

    let originalValues = {};

    btnEdit.addEventListener('click', () => {
        const isEditing = btnEdit.textContent === 'Simpan';

        if (!isEditing) {
            inputs.forEach(input => {
                originalValues[input.id] = input.value;
                input.disabled = false;
                input.classList.remove('bg-gray-100');
                input.classList.add('bg-white');
            });
            btnEdit.textContent = 'Simpan';
            btnBatal.classList.remove('hidden');
        } else {
            alert('Data berhasil disimpan!');
            inputs.forEach(input => {
                input.disabled = true;
                input.classList.remove('bg-white');
                input.classList.add('bg-gray-100');
            });
            btnEdit.textContent = 'Edit';
            btnBatal.classList.add('hidden');
        }
    });

    btnBatal.addEventListener('click', () => {
        inputs.forEach(input => {
            input.value = originalValues[input.id] || '';
            input.disabled = true;
            input.classList.remove('bg-white');
            input.classList.add('bg-gray-100');
        });
        btnEdit.textContent = 'Edit';
        btnBatal.classList.add('hidden');
    });
</script>
@endsection

