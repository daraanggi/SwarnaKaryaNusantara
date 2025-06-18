@extends('layouts.app')

@section('content')
<div class="flex mt-10">
    <div class="flex-1 p-6">
        <!-- Header -->
        <div class="flex items-center space-x-4">
            <div class="bg-[#82634B] text-white rounded-full p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 3h18v2H3V3zm0 4h18v13H3V7zm4 2h10v2H7V9z" />
                </svg>
            </div>
            <h2 class="text-xl font-bold text-[#82634B]">Pesanan</h2>
        </div>

        <!-- Card Pesanan -->
        <div class="mt-6 space-y-4">
            <div class="bg-[#82634B] text-white p-4 rounded-lg shadow">
                <p class="font-bold">Toko Tempura</p>
                <div class="flex space-x-4 mt-2">
                    <img src="{{ asset('images/mangkuk.png') }}" class="w-24 h-24 object-cover rounded" alt="Mangkuk Batok">
                    <div>
                        <p class="font-semibold">Mangkuk Batok</p>
                        <p>Total 2 produk : Rp 30.000</p>
                        <p class="mt-2 inline-block px-3 py-1 rounded bg-white text-[#82634B] font-semibold">
                            Estimasi Tiba : 1 Mei – 3 Mei 2024
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-[#82634B] text-white p-4 rounded-lg shadow">
                <p class="font-bold">Toko Tekomoro</p>
                <div class="flex space-x-4 mt-2">
                    <img src="{{ asset('images/tasrotan.png') }}" class="w-24 h-24 object-cover rounded" alt="Tas Rotan">
                    <div>
                        <p class="font-semibold">Tas Rotan</p>
                        <p>Total 2 produk : Rp 299.000</p>
                        <p class="mt-2 inline-block px-3 py-1 rounded bg-white text-[#82634B] font-semibold">
                            Pesanan dalam proses pengantaran
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
