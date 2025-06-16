@extends('layouts.penjual')

@section('title', 'Home Page Penjual')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-brown-800">Product Management</h1>

        <div class="flex justify-between items-center mb-6">
            <input type="text" placeholder="Search product..." class="border rounded-full px-4 py-2 w-1/2 text-black" />
            <div class="flex items-center gap-2">
                <button class="bg-white border border-brown-800 text-brown-800 px-4 py-2 rounded-full"><i class="bi bi-globe"></i></button>
                <button class="bg-white border border-brown-800 text-brown-800 px-4 py-2 rounded-full"><i class="bi bi-bell"></i></button>
                <button class="bg-white border border-brown-800 text-brown-800 px-4 py-2 rounded-full"><i class="bi bi-person-circle"></i></button>
                <button class="bg-brown-700 text-white px-4 py-2 rounded-full">Filter</button>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
                $products = [
                    ['name' => 'Batik Tenun', 'price' => 'Rp 299.000', 'image' => asset('images/kain.png')],
                    ['name' => 'Tas Rotan', 'price' => 'Rp 205.000', 'image' => asset('images/tas.png')],
                    ['name' => 'Ukiran Jepara', 'price' => 'Rp 835.000', 'image' => asset('images/patung.png')],
                    ['name' => 'Mangkuk Batok', 'price' => 'Rp 15.000', 'image' => asset('images/tempurung.png')],
                    ['name' => 'Gelas Bambu', 'price' => 'Rp 20.000', 'image' => asset('images/gelas.png')],
                    ['name' => 'Keranjang Rotan', 'price' => 'Rp 50.000', 'image' => asset('images/keranjang.jpg')],
                ];
            @endphp

            @foreach ($products as $product)
                <div class="bg-white border border-brown-200 rounded-lg shadow overflow-hidden relative hover:shadow-lg transition">
                    <div class="absolute top-2 right-2 text-xl text-gray-500 cursor-pointer">•••</div>
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-brown-800">{{ $product['name'] }}</h3>
                        <p class="text-brown-600">{{ $product['price'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
