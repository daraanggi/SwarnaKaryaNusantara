@extends('layouts.admin')

@section('content')

<div class="w-full flex justify-center">

    <div class="w-full max-w-4xl bg-[#6b543f] text-white rounded-[24px] shadow-2xl p-10 mt-6">

        {{-- Judul --}}
        <h2 class="text-3xl font-bold mb-10 text-center">Persetujuan Produk</h2>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">

            {{-- Disetujui --}}
            <div class="border border-white/40 rounded-xl p-5 backdrop-blur-md text-center">
                <p class="text-sm font-medium mb-2">Produk Disetujui</p>
                <div class="flex justify-center items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="#22c55e" viewBox="0 0 24 24">
                        <path d="M21 7.5V18a3 3 0 0 1-3 3H9.75v-12h8.25L21 7.5Z"/>
                        <path d="M9.75 3H6a3 3 0 0 0-3 3v9.75h6.75V3Z" fill="#16a34a"/>
                    </svg>
                    <span class="text-2xl font-bold">{{ $produkDisetujui ?? 0 }}</span>
                </div>
            </div>

            {{-- Belum disetujui --}}
            <div class="border border-white/40 rounded-xl p-5 backdrop-blur-md text-center">
                <p class="text-sm font-medium mb-2">Produk Belum Disetujui</p>
                <div class="flex justify-center items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="#ef4444" viewBox="0 0 24 24">
                        <path d="M12 2l9 5-9 5-9-5 9-5Z"/>
                        <path d="M21 12l-9 5-9-5" fill="#dc2626"/>
                    </svg>
                    <span class="text-2xl font-bold">{{ $produkBelum ?? 0 }}</span>
                </div>
            </div>

            {{-- Total akun penjual --}}
            <div class="border border-white/40 rounded-xl p-5 backdrop-blur-md text-center">
                <p class="text-sm font-medium mb-2">Total Akun Penjual</p>
                <div class="flex justify-center items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="#facc15" viewBox="0 0 24 24">
                        <path d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
                        <path d="M4 20a8 8 0 1 1 16 0H4Z"/>
                    </svg>
                    <span class="text-2xl font-bold">{{ $totalAkun ?? 0 }}</span>
                </div>
            </div>

        </div>

        {{-- Overlay --}}
        @if(session('success') || session('rejected'))
            <div id="overlay-approval"
                 class="fixed inset-0 z-40 flex items-center justify-center bg-white/70 backdrop-blur-[1px]">

                <div class="bg-white rounded-2xl shadow-2xl px-6 py-4 flex items-center gap-3">

                    @if(session('success'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-600" fill="currentColor">
                            <path d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zM15.61 9.41a.75.75 0 10-1.22-.86l-3.54 5.02L8.78 12.5a.75.75 0 10-1.06 1.06l2.75 2.75a.75.75 0 001.17-.12l3.97-5.78z"/>
                        </svg>
                        <p class="text-[16px] font-semibold text-[#1f2937]">{{ session('success') }}</p>

                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500" fill="currentColor">
                            <path d="M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25zm3.53 12.72a.75.75 0 11-1.06 1.06L12 13.06l-2.47 2.97a.75.75 0 01-1.06-1.06L10.94 12 8.47 9.53a.75.75 0 111.06-1.06L12 10.94l2.47-2.47a.75.75 0 111.06 1.06L13.06 12z"/>
                        </svg>
                        <p class="text-[16px] font-semibold text-[#1f2937]">{{ session('rejected') }}</p>
                    @endif

                </div>
            </div>

            <script>
                setTimeout(() => {
                    const el = document.getElementById('overlay-approval');
                    if (el) el.classList.add('hidden');
                }, 2500);
            </script>
        @endif

        {{-- List produk --}}
        <div class="space-y-4">

            @forelse ($produkList as $produk)
                <div class="bg-white/10 rounded-2xl px-6 py-4 flex items-center justify-between
                            shadow-md hover:bg-white/20 transition border border-white/20">

                    <div class="flex items-center gap-4">
                        <img src="{{ $produk->foto ? asset('storage/' . $produk->foto) : asset('images/gelas.png') }}"
                             class="w-16 h-16 rounded-lg object-cover bg-white p-1 shadow"/>

                        <p class="text-lg font-semibold">{{ $produk->nama }}</p>
                    </div>

                    <a href="{{ route('admin.detail', $produk->id_produk) }}"
                       class="text-white font-semibold hover:underline">
                        Detail
                    </a>
                </div>

            @empty
                <p class="text-center text-white/70 italic">Belum ada produk untuk disetujui.</p>
            @endforelse

        </div>

    </div>

</div>

@endsection
