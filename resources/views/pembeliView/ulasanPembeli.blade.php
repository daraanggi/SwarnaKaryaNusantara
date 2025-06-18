@extends('layouts.app')

@section('content')
<div class="flex mt-10">
    <div class="flex-1 p-6">
        <!-- Header -->
        <div class="flex items-center space-x-4">
            <div class="bg-[#82634B] text-white rounded-full p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M7 8h10M7 12h6m-1 8v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2h12zM17 4a4 4 0 110 8 4 4 0 010-8z" />
                </svg>
            </div>
            <h2 class="text-xl font-bold text-[#82634B]">Ulasan</h2>
        </div>

        <!-- Card Ulasan -->
        <div class="mt-6 bg-[#82634B] text-white p-4 rounded-lg shadow">
            <p class="font-bold">Toko Tekomoro</p>
            <div class="flex space-x-4 mt-2">
                <img src="{{ asset('images/tasrotan.png') }}" class="w-24 h-24 object-cover rounded" alt="Tas Rotan">
                <div>
                    <p class="font-semibold">Tas Rotan</p>
                    <p>Total 2 produk : Rp 299.000</p>
                    <p class="text-sm">Pesanan telah diterima</p>
                    <input type="text" class="mt-2 p-2 rounded w-full text-black" placeholder="Tulis Ulasan...">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
