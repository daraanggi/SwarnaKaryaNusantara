@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<!-- <div id="headerProfil" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-base sm:text-lg transition-all duration-300 w-full">
    <div class="flex items-center space-x-2">
        <svg class="w-5 h-5 sm:w-6 sm:h-6 rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        </svg>
        <span>Edit Profil</span>
    </div>
    <img src="/images/logo.png" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white object-contain" />
</div> -->

<div id="mainContentWrapper" class="flex items-center justify-center min-h-screen w-full overflow-hidden">
    <div class="border rounded-lg p-4 sm:p-6 bg-white space-y-4 w-full max-w-md">

    <!-- Avatar -->
        <div class="flex justify-center">
            <div class="relative">
                <img src="/images/avatar.png" alt="User Avatar"
                    class="w-24 h-24 rounded-full border-4 border-[#69553E] object-cover shadow">
            </div>
        </div>

    <h2 class="text-base sm:text-lg font-semibold text-[#69553E] text-left">Informasi Pengguna</h2>

    <form id="formProfil" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input id="name" name="name" type="text" value="Dara Anggi Puspa"
                class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="dara@example.com"
                class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
        </div>

        <div>
            <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
            <input id="no_telepon" name="no_telepon" type="text" value="+62 85634879124"
                class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" value="******"
                class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <button type="button" id="btnBatal"
                class="hidden text-gray-600 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 text-sm">Batal</button>
            <button type="button" id="btnEdit"
                class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">Edit</button>
        </div>
    </form>
</div>

    </div>
</div>

<script>
    const btnEdit = document.getElementById('btnEdit');
    const btnBatal = document.getElementById('btnBatal');
    const form = document.getElementById('formProfil');
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const header = document.getElementById('headerProfil');
        const mainWrapper = document.getElementById('mainContentWrapper');
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        function updateLayout() {
            const collapsed = document.body.classList.contains('sidebar-collapsed');
            if (collapsed) {
                sidebar?.classList.remove('w-64');
                sidebar?.classList.add('w-16');
                header.style.marginLeft = '4rem';
                header.style.width = 'calc(100% - 4rem)';
                mainWrapper.style.marginLeft = '4rem';
            } else {
                sidebar?.classList.remove('w-16');
                sidebar?.classList.add('w-64');
                header.style.marginLeft = 'rem';
                header.style.width = 'calc(100% - 4rem)';
                mainWrapper.style.marginLeft = '4rem';
            }
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                document.body.classList.toggle('sidebar-collapsed');
                setTimeout(updateLayout, 100);
            });
        }

        updateLayout();
    });
</script>
@endsection
