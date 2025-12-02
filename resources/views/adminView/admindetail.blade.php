@extends('layouts.admin')

@section('content')

<section class="w-full max-w-[880px] mx-auto bg-[#6b543f] text-white rounded-[24px] shadow-2xl p-8">

    {{-- Tombol kembali --}}
    <a href="{{ route('admin.approval') }}"
       class="inline-flex items-center gap-2 text-white/90 hover:text-white text-lg font-semibold mb-6">
        ← Kembali ke Daftar Produk
    </a>

    {{-- Judul --}}
    <h1 class="text-2xl font-bold mb-6">Persetujuan Produk</h1>

    {{-- Produk Container --}}
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-6">

        {{-- Gambar --}}
        <div>
            <img
                src="{{ $produk->foto ? asset('storage/' . $produk->foto) : asset('images/gelas.png') }}"
                alt="{{ $produk->nama }}"
                class="w-[200px] h-[200px] object-cover rounded-xl bg-white p-2 shadow mb-3"
            />
        </div>

        {{-- Info Kategori & Stok --}}
        <div class="space-y-3">
            <div>
                <p class="text-sm font-semibold">Kategori:</p>
                <p class="text-base">{{ $produk->kategori ?? 'Alat Makan/Minum' }}</p>
            </div>

            <div>
                <p class="text-sm font-semibold">Stok Produk:</p>
                <p class="text-base">{{ $produk->stok ?? 0 }}</p>
            </div>
        </div>

    </div>

    {{-- Nama & Harga --}}
    <div class="mt-6">
        <h2 class="text-2xl font-bold">{{ $produk->nama }}</h2>

        <p class="text-xl font-semibold text-[#ffefcc]">
            Rp {{ number_format($produk->harga ?? 20000, 0, ',', '.') }}
        </p>
    </div>

    {{-- Deskripsi & Keterangan --}}
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-6">
        <p class="leading-relaxed text-white/90">
            {{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}
        </p>

        <textarea
            id="keterangan-admin"
            placeholder="Keterangan (opsional)"
            class="w-full h-[120px] rounded-xl bg-white/90 text-[#333] p-3 focus:ring-2 focus:ring-[#d4c3ac] outline-none"
        ></textarea>
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-8 flex gap-4 justify-end">

        {{-- Setuju --}}
        <form action="{{ route('admin.approve', $produk->id_produk) }}"
              method="POST" onsubmit="salinKeterangan(this)">
            @csrf
            <input type="hidden" name="keterangan">

            <button
                type="submit"
                class="px-7 py-2.5 rounded-xl bg-white text-[#3f2f1f] font-bold shadow hover:brightness-95">
                Setuju
            </button>
        </form>

        {{-- Tolak --}}
        <form action="{{ route('admin.reject', $produk->id_produk) }}"
              method="POST" onsubmit="salinKeterangan(this)">
            @csrf
            <input type="hidden" name="keterangan">

            <button
                type="submit"
                class="px-7 py-2.5 rounded-xl bg-[#ef7d7a] text-white font-bold shadow hover:bg-[#dc5f5c]">
                Tolak
            </button>
        </form>

    </div>

</section>

<script>
function salinKeterangan(form) {
    const text = document.getElementById('keterangan-admin').value;
    const hidden = form.querySelector('input[name="keterangan"]');
    hidden.value = text ?? '';
}
</script>

@endsection
