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
            @foreach ($alamats as $index => $alamat)
                <div class="border rounded-lg p-4 bg-white alamat-box relative cursor-pointer" data-id="{{ $alamat->id }}" onclick="jadikanUtama(this)">
                    <div class="flex justify-between items-center mb-1 pointer-events-none">
                        <div class="text-sm font-semibold text-[#69553E]">Alamat #{{ $index + 1 }}</div>
                        <button onclick="editAlamat(event, this)" class="text-xs text-blue-600 hover:underline pointer-events-auto">Edit</button>
                    </div>
                    <div class="alamat-display text-sm text-gray-800 leading-relaxed pointer-events-none">
                        {{ $alamat->nama_penerima }} <br>
                        {{ $alamat->no_hp }} <br>
                        {{ $alamat->alamat }} <br>
                        KAB. {{ strtoupper($alamat->kota) }} – {{ strtoupper($alamat->kota) }}, {{ strtoupper($alamat->provinsi) }}, ID {{ $alamat->kode_pos }}
                    </div>
                    <span class="label-utama absolute top-2 right-2 text-xs bg-[#69553E] text-white px-2 py-1 rounded hidden">Alamat Utama</span>
                </div>
            @endforeach
        </div>

        <!-- Form Tambah/Edit -->
        <div id="formAlamatContainer" class="border rounded-lg p-4 bg-[#F5F5F5] hidden">
            <div class="text-sm font-semibold text-[#69553E] mb-3" id="formMode">Form Alamat</div>
            <form id="alamatForm" method="POST" action="{{ route('alamat.store') }}">
                @csrf
                <input type="hidden" name="id" id="alamat_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-700">Nama Penerima</label>
                        <input type="text" name="nama_penerima" id="nama" required class="w-full">
                    </div>
                    <div>
                        <label class="text-sm text-gray-700">Nomor Telepon</label>
                        <input type="text" name="no_hp" id="telepon" required class="w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" required class="w-full"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-700">Kota</label>
                        <input type="text" name="kota" id="kota" required class="w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-700">Provinsi</label>
                        <input type="text" name="provinsi" id="provinsi" required class="w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-700">Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" required class="w-full">
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

        const id = currentEditBox.dataset.id;
        document.getElementById('alamat_id').value = id;
        document.getElementById('nama').value = data[0].trim();
        document.getElementById('telepon').value = data[1].trim();
        document.getElementById('alamat').value = data[2].trim();

        // Potong bagian wilayah
        const wilayah = data[3].trim(); // contoh: "KAB. KLATEN – KLATEN, JAWA TENGAH, ID 57433"
        const regex = /KAB\. ([A-Z\s]+) – [A-Z\s]+, ([A-Z\s]+), ID (\d+)/;
        const match = wilayah.match(regex);

        if (match) {
            document.getElementById('kota').value = match[1].trim();
            document.getElementById('provinsi').value = match[2].trim();
            document.getElementById('kode_pos').value = match[3].trim();
        }

        document.getElementById('formMode').innerText = 'Edit Alamat';
        document.getElementById('formAlamatContainer').classList.remove('hidden');

        document.getElementById('alamatForm').action = `/alamat/update/${id}`;
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
        document.getElementById('alamat_id').value = '';
        document.getElementById('nama').value = '';
        document.getElementById('telepon').value = '';
        document.getElementById('alamat').value = '';
        document.getElementById('kota').value = '';
        document.getElementById('provinsi').value = '';
        document.getElementById('kode_pos').value = '';
        document.getElementById('alamatForm').action = `{{ route('alamat.store') }}`;
        document.getElementById('formAlamatContainer').classList.remove('hidden');
    }

    function batalEdit() {
        document.getElementById('formAlamatContainer').classList.add('hidden');
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

        const id = box.dataset.id;

        // Kirim ke backend lewat fetch
        fetch(`/alamat/set-sebagai-utama/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({})
        }).then(() => {
            console.log('Alamat utama diset sementara.');
        });
    }


</script>
@endsection
