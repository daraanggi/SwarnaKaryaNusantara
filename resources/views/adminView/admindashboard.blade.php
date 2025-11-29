<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard – Laporan Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-white text-[#3a2c1b] flex">

  {{-- ============== SIDEBAR ============== --}}
  <aside class="w-64 bg-[#6b543f] text-white flex flex-col items-center py-8 shadow-2xl">
    {{-- Logo --}}
    <div class="mb-10 flex flex-col items-center">
      <div class="w-28 h-28 bg-white rounded-full p-2 flex items-center justify-center shadow-xl mb-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
      </div>
      <h1 class="text-base font-semibold text-center">Swarna Karya Nusantara</h1>
    </div>

    {{-- Menu --}}
    <nav class="w-full mt-4 space-y-4 px-3">
      {{-- Persetujuan Produk (non-aktif) --}}
      <a href="{{ route('admin.approval') }}"
         class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#8B6F55] text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition">
        {{-- ikon centang --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-2.59a.75.75 0 10-1.22-.86l-3.54 5.02-2.07-2.07a.75.75 0 10-1.06 1.06l2.75 2.75c.3.3.78.27 1.05-.06l3.99-5.84z" clip-rule="evenodd"/>
        </svg>
        <span>Persetujuan Produk</span>
      </a>

      {{-- Laporan Transaksi (aktif) --}}
      <div class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-black text-white font-semibold shadow-lg">
        {{-- ikon user --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
          <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
          <path d="M4.5 20.25a7.5 7.5 0 1 1 15 0v.75H4.5v-.75Z"/>
        </svg>
        <span>Laporan Transaksi</span>
      </div>
    </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-auto px-3 w-full">
            @csrf
            <button type="submit"
                    class="flex items-center gap-3 py-3 px-4 rounded-r-full bg-[#8B6F55] text-white font-semibold shadow-lg hover:bg-[#9a7b5e] transition w-full">
                {{-- Icon logout --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
  </aside>

  {{-- ============== MAIN ============== --}}
  <main class="flex-1 flex flex-col items-center py-10 px-6">
  {{-- Kartu utama --}}
  <section class="w-full max-w-5xl bg-[#6b543f] text-white rounded-[24px] shadow-2xl pb-8">

    {{-- Header (ikon user di atas judul) --}}
    <div class="relative">
      <div class="h-10"></div>
      <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-xl ring-4 ring-[#6b543f]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#6b543f]" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2.25a4.5 4.5 0 100 9 4.5 4.5 0 000-9ZM4.5 20.25a7.5 7.5 0 1115 0v.75h-15v-.75Z"/>
        </svg>
      </div>
      <h2 class="text-center text-2xl font-bold pt-14 pb-6">Laporan Transaksi</h2>
    </div>

    {{-- AREA GRAFIK --}}
    <div class="px-6 pb-8">
        <h3 class="text-white text-lg font-semibold mb-3">Grafik Penjualan</h3>

        <div class="bg-[#5b4634] rounded-2xl p-4 shadow-inner">
            <canvas id="salesChart" class="w-full h-64"></canvas>
        </div>
    </div>

      {{-- Daftar Toko --}}
      <div class="px-6">
        <div class="overflow-hidden rounded-2xl">
          <div class="h-[1px] bg-white/20"></div>

          @if($stores->isEmpty())
            <div class="px-5 py-6 text-center text-white/80">
              Belum ada toko / akun penjual terdaftar.
            </div>
          @else
            @foreach ($stores as $toko)
              <div class="flex items-center justify-between bg-[#6b543f] px-5 py-4 border-b border-white/20">
                <span class="text-lg font-medium">
                  {{ $toko->store_name ?? $toko->name }}
                </span>

                {{-- sementara semua tombol Periksa ke halaman yang sama --}}
                <a href="{{ route('admin.periksa') }}"
                  class="bg-white text-[#6b543f] hover:bg-gray-100 px-6 py-2 rounded-full text-base font-semibold shadow">
                  Periksa
                </a>
              </div>
            @endforeach
          @endif
        </div>
      </div>

    </section>
  </main>

  {{-- Chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      const labels   = @json($labels);
      const dataRaw  = @json($values);

      const ctx = document.getElementById('salesChart').getContext('2d');

      // Gradient coklat–cream biar nyatu sama tema
      const gradient = ctx.createLinearGradient(0, 0, 0, 400);
      gradient.addColorStop(0, 'rgba(250, 250, 250, 0.9)');
      gradient.addColorStop(1, 'rgba(250, 250, 250, 0.05)');

      const maxValue = Math.max(...dataRaw, 1); // minimal 1 biar sumbu kelihatan

      new Chart(ctx, {
          type: 'line',
          data: {
              labels: labels,
              datasets: [{
                  label: 'Total Penjualan',
                  data: dataRaw,
                  fill: true,
                  backgroundColor: gradient,
                  borderColor: '#FDE68A',      // kuning krem
                  borderWidth: 3,
                  tension: 0.4,                // garis agak melengkung
                  pointBackgroundColor: '#ffffff',
                  pointBorderColor: '#FDE68A',
                  pointBorderWidth: 2,
                  pointRadius: 4,
                  pointHoverRadius: 6,
                  pointHitRadius: 10,
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false
                  },
                  tooltip: {
                      backgroundColor: '#111827',
                      titleColor: '#F9FAFB',
                      bodyColor: '#E5E7EB',
                      padding: 10,
                      displayColors: false,
                      callbacks: {
                          label: function(context) {
                              return ' Total: ' + context.parsed.y;
                          }
                      }
                  }
              },
              scales: {
                  x: {
                      grid: {
                          display: false
                      },
                      ticks: {
                          color: '#E5E7EB',
                          font: {
                              size: 12
                          }
                      }
                  },
                  y: {
                      beginAtZero: true,
                      suggestedMax: maxValue + 1,
                      grid: {
                          color: 'rgba(249, 250, 251, 0.1)'
                      },
                      ticks: {
                          stepSize: 1,
                          color: '#E5E7EB',
                          font: {
                              size: 12
                          }
                      }
                  }
              }
          }
      });
  </script>

</body>
</html>
