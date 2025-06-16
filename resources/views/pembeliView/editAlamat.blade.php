@extends('layouts.app')

@section('title', 'Edit Alamat Pengiriman')
<style>
    .alamat-box.ring-2 {
        box-shadow: 0 0 0 2px #69553E;
    }
    .alamat-box:hover {
        background-color: #f9f4f0;
    }
</style>

@section('content')
<!-- Header -->
<div id="headerAlamat" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-lg transition-all duration-300" style="margin-left: 16rem; width: calc(100% - 16rem);">
    <div class="flex items-center space-x-2">
        <svg class="w-6 h-6 rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"></svg>
        <span>Edit Alamat</span>
    </div>
    <img src="/images/logo.png" class="w-10 h-10 rounded-full bg-white object-contain" />
</div>

<!-- Konten -->
<div id="mainContentWrapper" class="transition-all duration-300 w-full max-w-none" style="margin-left: 16rem;">
    <div class="pt-20 px-6 pb-10 bg-gray-50 space-y-6">

        <!-- Tombol Tambah Alamat -->
        <div class="text-end">
            <button onclick="showFormTambahAlamat()" class="bg-[#69553E] hover:bg-[#69553E] text-white px-4 py-2 rounded-full text-sm shadow">+ Tambah Alamat</button>
        </div>

        <!-- Daftar Alamat -->
        <div class="space-y-4" id="daftarAlamat">
            <!-- Alamat Contoh -->
            <div class="border rounded-lg p-4 bg-white alamat-box relative cursor-pointer" onclick="jadikanUtama(this)">
                <div class="flex justify-between items-center mb-1 pointer-events-none">
                    <div class="text-sm font-semibold text-[#69553E]">Alamat #1</div>
                    <button onclick="editAlamat(event, this)" class="text-xs text-blue-600 hover:underline pointer-events-auto">Edit</button>
                </div>
                <div class="alamat-display text-sm text-gray-800 leading-relaxed pointer-events-none">
                    Dara Anggi Puspa <br>
                    +62 85634879124 <br>
                    Jebugan 002/003, Jebugan, Klaten Utara, Klaten, Jawa Tengah <br>
                    KAB. KLATEN - KLATEN UTARA, JAWA TENGAH, ID 57433
                </div>
                <span class="label-utama absolute top-2 right-2 text-xs bg-[#69553E] text-white px-2 py-1 rounded hidden">Alamat Utama</span>
            </div>
        </div>

        <!-- Form Tambah/Edit -->
        <div id="formAlamatContainer" class="border rounded-lg p-4 bg-[#F5F5F5] hidden">
            <div class="text-sm font-semibold text-[#69553E] mb-3" id="formMode">Form Alamat</div>
            <form id="alamatForm" onsubmit="simpanAlamat(event)">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-700">Nama Penerima</label>
                        <input type="text" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" id="nama" required>
                    </div>
                    <div>
                        <label class="text-sm text-gray-700">Nomor Telepon</label>
                        <input type="text" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" id="telepon" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-700">Alamat Lengkap</label>
                        <textarea id="alamat" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" rows="3" required></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-700">Wilayah</label>
                        <input type="text" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" id="wilayah" required>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="batalEdit()" class="px-4 py-2 text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-full">Batal</button>
                    <button type="submit" class="px-6 py-2 text-sm bg-[#69553E] hover:bg-[#4d3f2c] text-white rounded-full">Simpan</button>
                </div>
            </form>
        </div>

        <div class="text-end mt-6">
            <a href="{{ route('checkout') }}" class="inline-block bg-[#69553E] hover:bg-[#4d3f2c] text-white text-sm px-5 py-2 rounded-full shadow-md">
                ← Kembali ke Checkout
            </a>
        </div>
    </div>
</div>

<script>
    let currentEditBox = null;

    function editAlamat(event, button) {
        event.stopPropagation();
        currentEditBox = button.closest('.alamat-box');
        const data = currentEditBox.querySelector('.alamat-display').innerHTML.trim().split('<br>');

        document.getElementById('nama').value = data[0].trim();
        document.getElementById('telepon').value = data[1].trim();
        document.getElementById('alamat').value = data[2].trim();
        document.getElementById('wilayah').value = data[3].trim();
        document.getElementById('formMode').innerText = 'Edit Alamat';
        document.getElementById('formAlamatContainer').classList.remove('hidden');
    }

    function jadikanUtama(box) {
        if (event.target.tagName === "BUTTON") return;

        document.querySelectorAll('.alamat-box').forEach(item => {
            item.classList.remove('ring-2', 'ring-[#69553E]');
            const label = item.querySelector('.label-utama');
            if (label) label.classList.add('hidden');
        });

        box.classList.add('ring-2', 'ring-[#69553E]');
        const label = box.querySelector('.label-utama');
        if (label) label.classList.remove('hidden');
    }

    function showFormTambahAlamat() {
        currentEditBox = null;
        document.getElementById('formMode').innerText = 'Tambah Alamat';
        document.getElementById('nama').value = '';
        document.getElementById('telepon').value = '';
        document.getElementById('alamat').value = '';
        document.getElementById('wilayah').value = '';
        document.getElementById('formAlamatContainer').classList.remove('hidden');
    }

    function batalEdit() {
        document.getElementById('formAlamatContainer').classList.add('hidden');
    }

    function simpanAlamat(e) {
        e.preventDefault();
        const nama = document.getElementById('nama').value;
        const telepon = document.getElementById('telepon').value;
        const alamat = document.getElementById('alamat').value;
        const wilayah = document.getElementById('wilayah').value;

        const htmlIsi = `
            ${nama} <br>
            ${telepon} <br>
            ${alamat} <br>
            ${wilayah}
        `;

        if (currentEditBox) {
            currentEditBox.querySelector('.alamat-display').innerHTML = htmlIsi;
        } else {
            const wrapper = document.createElement('div');
            wrapper.className = 'border rounded-lg p-4 bg-white alamat-box relative cursor-pointer';
            wrapper.setAttribute('onclick', 'jadikanUtama(this)');
            wrapper.innerHTML = `
                <div class="flex justify-between items-center mb-1 pointer-events-none">
                    <div class="text-sm font-semibold text-[#69553E]">Alamat Baru</div>
                    <button onclick="editAlamat(event, this)" class="text-xs text-blue-600 hover:underline pointer-events-auto">Edit</button>
                </div>
                <div class="alamat-display text-sm text-gray-800 leading-relaxed pointer-events-none">
                    ${htmlIsi}
                </div>
                <span class="label-utama absolute top-2 right-2 text-xs bg-[#69553E] text-white px-2 py-1 rounded hidden">Alamat Utama</span>
            `;
            document.getElementById('daftarAlamat').appendChild(wrapper);
        }

        document.getElementById('formAlamatContainer').classList.add('hidden');
    }

    // Layout responsif sidebar
    document.addEventListener("DOMContentLoaded", () => {
        const header = document.getElementById('headerAlamat');
        const mainWrapper = document.getElementById('mainContentWrapper');
        const toggleBtn = document.getElementById('toggleSidebar');

        function updateLayout() {
            const collapsed = document.body.classList.contains('sidebar-collapsed');
            if (collapsed) {
                header.style.marginLeft = '4rem';
                header.style.width = 'calc(100% - 4rem)';
                mainWrapper.style.marginLeft = '4rem';
            } else {
                header.style.marginLeft = '16rem';
                header.style.width = 'calc(100% - 16rem)';
                mainWrapper.style.marginLeft = '16rem';
            }
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                document.body.classList.toggle('sidebar-collapsed');
                setTimeout(updateLayout, 50);
            });
        }

        updateLayout();
    });
</script>
@endsection
