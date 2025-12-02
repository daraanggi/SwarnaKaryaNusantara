@extends('layouts.admin')

@section('content')

<div class="flex justify-center w-full px-6">

<section class="w-full max-w-5xl bg-[#6b543f] text-white rounded-[24px] shadow-2xl pb-10 mt-6">

    {{-- HEADER CIRCLE ICON --}}
    <div class="relative">
        <div class="h-12"></div>

        <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-24 h-24 rounded-full bg-white 
                    flex items-center justify-center shadow-xl ring-4 ring-[#6b543f]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#6b543f]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2.25a4.5 4.5 0 100 9 4.5 4.5 0 000-9ZM4.5 20.25a7.5 7.5 0 1115 0v.75h-15v-.75Z"/>
            </svg>
        </div>

        <h2 class="text-center text-3xl font-bold pt-14 pb-6 tracking-wide">
            Laporan Transaksi
        </h2>
    </div>

    {{-- GRAFIK PENJUALAN --}}
    <div class="px-8 pb-10">
        <h3 class="text-white text-lg font-semibold mb-4">Grafik Penjualan</h3>

        <div class="bg-[#5b4634] rounded-2xl p-5 shadow-inner">
            <canvas id="salesChart" class="w-full h-72"></canvas>
        </div>
    </div>

    {{-- LIST TOKO --}}
    <div class="px-8">
        <div class="overflow-hidden rounded-2xl bg-[#5b4634]/40 shadow-inner">

            {{-- garis pemisah --}}
            <div class="h-[1px] bg-white/30"></div>

            @if($stores->isEmpty())
                <div class="px-5 py-6 text-center text-white/80 text-lg">
                    Belum ada toko / akun penjual terdaftar.
                </div>
            @else
                @foreach ($stores as $toko)
                    <div class="flex items-center justify-between px-6 py-4 
                                border-b border-white/20 bg-[#6b543f]/60">

                        <span class="text-lg font-medium">
                            {{ $toko->store_name ?? $toko->name }}
                        </span>

                        <a href="{{ route('admin.periksa') }}"
                           class="bg-white text-[#6b543f] hover:bg-gray-100 
                                  px-6 py-2 rounded-full text-sm font-semibold shadow-md transition">
                           Periksa
                        </a>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

</section>

</div>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($labels);
    const dataRaw = @json($values);

    const ctx = document.getElementById('salesChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(250, 250, 250, 0.9)');
    gradient.addColorStop(1, 'rgba(250, 250, 250, 0.05)');

    const maxValue = Math.max(...dataRaw, 1);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Penjualan',
                data: dataRaw,
                fill: true,
                backgroundColor: gradient,
                borderColor: '#FDE68A',
                borderWidth: 3,
                tension: 0.4,
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
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111827',
                    titleColor: '#F9FAFB',
                    bodyColor: '#E5E7EB',
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: (context) => ` Total: ${context.parsed.y}`
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#E5E7EB', font: { size: 12 } }
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: maxValue + 1,
                    grid: { color: 'rgba(249, 250, 251, 0.1)' },
                    ticks: { stepSize: 1, color: '#E5E7EB', font: { size: 12 } }
                }
            }
        }
    });
</script>

@endsection
