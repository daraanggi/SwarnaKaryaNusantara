<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Persetujuan Produk – {{ $produk->nama ?? 'Produk' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen font-sans text-white bg-[#3a2c1b]">

  {{-- Strip batik kiri --}}
  <div class="fixed left-0 top-0 h-screen w-[140px] bg-no-repeat bg-cover bg-center"
       style="background-image:url('{{ asset('images/background.jpg') }}')"></div>

  {{-- Konten digeser karena strip batik --}}
  <div class="relative ml-[140px]">

    {{-- Tombol back ke daftar approval --}}
    <div class="px-6 pt-6">
      <a href="{{ route('admin.approval') }}"
         class="inline-flex items-center gap-2 text-white/90 hover:text-white text-[18px] font-semibold">
        <span class="text-2xl leading-none">←</span>
        Kembali ke Daftar Produk
      </a>
    </div>

    {{-- Card utama --}}
    <main class="flex justify-center px-4 pb-10">
      <section class="w-full max-w-[880px] bg-[#6b543f] rounded-[24px] shadow-2xl mt-6 p-6">

        {{-- Judul --}}
        <h1 class="text-[20px] font-semibold mb-5">Persetujuan Produk</h1>

        {{-- Gambar + meta --}}
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-6">

          {{-- Gambar produk --}}
          <div>
            @php
              $foto = $produk->foto ?? 'gelas.png';  // fallback aman
            @endphp

            <img
              src="{{ asset('images/' . $foto) }}"
              onerror="this.onerror=null;this.src='{{ asset('images/gelas.png') }}';"
              alt="{{ $produk->nama ?? 'Produk' }}"
              class="w-[170px] h-[170px] object-cover rounded-[12px] bg-white p-2 shadow mb-3"/>

          </div>

          {{-- Informasi kategori & stok --}}
          <div class="space-y-3">
            <div>
              <p class="text-[15px] font-semibold">Kategori</p>
              <p class="text-[15px]">{{ $produk->kategori ?? 'Alat Makan/Minum' }}</p>
            </div>
            <div>
              <p class="text-[15px] font-semibold">Stok Produk</p>
              <p class="text-[15px]">{{ $produk->stok ?? 0 }}</p>
            </div>
          </div>
        </div>

        {{-- Nama + harga --}}
        <div class="mt-6">
          <h2 class="text-[22px] font-bold">{{ $produk->nama ?? 'Nama Produk' }}</h2>
          @php
            $harga = isset($produk->harga) && (int)$produk->harga > 0
              ? (int)$produk->harga
              : 20000; // fallback 20k
          @endphp
          <p class="text-[18px] font-semibold text-[#ffefcc]">
            Rp {{ number_format($harga, 0, ',', '.') }}
          </p>
        </div>

        {{-- Deskripsi + textarea keterangan --}}
        <div class="mt-4 grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-6 items-start">
          <p class="text-[15px] leading-relaxed">
            {{ $produk->deskripsi ?? 'Gelas bambu adalah wadah minum yang terbuat dari bambu alami. Ramah lingkungan dan estetis.' }}
          </p>

          <textarea
            id="keterangan-admin"
            placeholder="Keterangan (opsional)"
            class="w-full h-[110px] rounded-[10px] bg-white/90 text-[#333] p-3 outline-none focus:ring-2 focus:ring-[#d4c3ac]"></textarea>
        </div>

        {{-- Tombol Setuju / Tolak --}}
        <div class="mt-6 flex gap-3 justify-end">

          {{-- Form SETUJU --}}
          <form
            action="{{ route('admin.approve', $produk->id_produk) }}"
            method="POST"
            onsubmit="salinKeterangan(this)">
            @csrf
            {{-- hidden yang diisi dari textarea --}}
            <input type="hidden" name="keterangan" value="">

            <button
              type="submit"
              class="px-7 py-2.5 rounded-[12px] bg-white text-[#3f2f1f] font-bold shadow hover:brightness-95">
              Setuju
            </button>
          </form>

          {{-- Form TOLAK --}}
          <form
            action="{{ route('admin.reject', $produk->id_produk) }}"
            method="POST"
            onsubmit="salinKeterangan(this)">
            @csrf
            <input type="hidden" name="keterangan" value="">

            <button
              type="submit"
              class="px-7 py-2.5 rounded-[12px] bg-[#ef7d7a] text-white font-bold shadow hover:bg-[#dc5f5c]">
              Tolak
            </button>
          </form>
        </div>

      </section>
    </main>
  </div>

  {{-- JS: salin isi textarea ke hidden input sebelum submit --}}
  <script>
    function salinKeterangan(form) {
      const teks   = document.getElementById('keterangan-admin').value;
      const hidden = form.querySelector('input[name="keterangan"]');
      if (hidden) {
        hidden.value = teks;
      }
    }
  </script>

</body>
</html>