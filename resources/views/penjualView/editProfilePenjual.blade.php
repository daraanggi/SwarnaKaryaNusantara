@extends('layouts.penjual')
@section('title', 'Edit Profil')

@section('content')
<div id="mainContentWrapper" class="flex items-center justify-center min-h-screen w-full overflow-hidden bg-gray-50">
    <div class="border rounded-lg p-6 bg-white space-y-4 w-full max-w-md shadow">
        <!-- Avatar -->
        <div class="flex justify-center">
            <div class="relative">
                <img src="/images/avatar.png" alt="User Avatar"
                    class="w-24 h-24 rounded-full border-4 border-[#69553E] object-cover shadow">
            </div>
        </div>

        <h2 class="text-xl font-semibold text-[#69553E] text-center">Informasi Akun Penjual</h2>

        @if (session('status') === 'profile-updated')
            <div class="text-green-600 text-sm font-semibold text-center">Profil berhasil diperbarui.</div>
        @endif

        <!-- Form Edit Profil -->
        <form id="formProfil" method="POST" action="{{ route('penjual.profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ auth()->user()->name }}"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ auth()->user()->email }}"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
            </div>

            <div>
                <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input id="no_telepon" name="no_telepon" type="text" value="{{ auth()->user()->no_telepon }}"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" placeholder="Biarkan kosong jika tidak diubah"
                    class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
            </div>

             <!-- Bagian tombol edit/save/batal -->
    <div class="flex justify-end gap-3 pt-4">
        <button type="button" id="btnBatal" class="hidden text-gray-600 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 text-sm">Batal</button>
        <button type="button" id="btnEdit" class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">Edit</button>
        <button type="submit" id="btnSubmit" class="hidden bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">Simpan</button>
    </div>
</form>

<!-- Form logout dipisahkan di luar form edit -->
<div class="flex justify-end pt-2">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="bg-[#B08B5E] hover:bg-[#a07b4c] text-white text-sm px-4 py-2 rounded">Logout</button>
    </form>
</div>

<!-- Script -->
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
