@extends('layouts.app')

@section('title', 'Keranjang Saya')

@section('content')
<!-- Header -->
<div id="headerKeranjang" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-lg transition-all duration-300 ml-64 w-[calc(100%-16rem)]">
    <div class="flex items-center space-x-2">
        <svg class="w-6 h-6 rotate-180" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
        </svg>
        <span>Keranjang Saya</span>
    </div>
    <img src="/images/logo.png" class="w-10 h-10 rounded-full bg-white object-contain"/>
</div>

<!-- Cart Items -->
<div class="ml-64 px-4 py-4 space-y-4 pt-20 pb-36 transition-all duration-300" id="cart">
    @php
        $items = [
            ['id' => 1, 'name' => 'Kipas Anyaman Bambu', 'price' => 10000, 'qty' => 1, 'img' => 'kipas.png'],
            ['id' => 2, 'name' => 'Ukiran Jepara', 'price' => 835000, 'qty' => 1, 'img' => 'patung.png'],
            ['id' => 3, 'name' => 'Tas Rotan', 'price' => 205000, 'qty' => 1, 'img' => 'tas.png'],
            ['id' => 4, 'name' => 'Batik Tenun', 'price' => 299000, 'qty' => 1, 'img' => 'kain.png'],
        ];
    @endphp

    @foreach ($items as $item)
        <div class="relative bg-[#f3f3f3] rounded-xl p-4 shadow-sm flex gap-4 item transition-all duration-300"
             data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}">
            <input type="checkbox" class="item-checkbox absolute top-3 left-3 accent-[#69553E] w-5 h-5">

            <img src="/images/{{ $item['img'] }}" alt="{{ $item['name'] }}"
                 class="w-20 h-20 rounded object-cover ml-7">

            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <p class="font-medium text-base text-gray-800">{{ $item['name'] }}</p>
                    <a href="#" class="text-sm text-gray-500">Ubah</a>
                </div>
                <p class="text-[#6B4F3B] font-semibold mt-1">
                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                </p>

                <div class="flex items-center mt-3 space-x-2">
                    <button class="decrement w-6 h-6 border rounded text-gray-600 hover:bg-gray-200">−</button>
                    <input type="text" value="{{ $item['qty'] }}"
                           class="qty w-10 h-6 border rounded text-center text-sm bg-white" readonly>
                    <button class="increment w-6 h-6 border rounded text-gray-600 hover:bg-gray-200">+</button>

                    <button class="ml-auto text-gray-500 hover:text-red-600 remove-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H4m16 0H4"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Bottom Bar -->
<div id="footerKeranjang" class="ml-64 fixed bottom-0 right-0 w-[calc(100%-16rem)] z-50 bg-white shadow border-t flex justify-between items-center px-6 py-4 transition-all duration-300">
    <label class="inline-flex items-center space-x-2">
        <input type="checkbox" id="selectAll" class="form-checkbox w-5 h-5 accent-[#6B4F3B]">
        <span class="font-semibold text-gray-700">Pilih Semua</span>
    </label>

<form id="checkoutForm" method="GET" action="{{ route('checkout') }}">
    <input type="hidden" name="nama" id="checkoutNama">
    <input type="hidden" name="img" id="checkoutImg">
    <input type="hidden" name="harga" id="checkoutHarga">
    <input type="hidden" name="jumlah" id="checkoutJumlah">

    <button
        type="submit"
        id="checkoutBtn"
        class="bg-[#826141] hover:bg-[#6B4F3B] text-white font-semibold py-2 px-6 rounded shadow transition-all">
        Checkout
    </button>
</form>

</div>

<!-- Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectAll = document.getElementById('selectAll');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const header = document.getElementById('headerKeranjang');
        const footer = document.getElementById('footerKeranjang');
        const cart = document.getElementById('cart');

        function updateLayout() {
            const collapsed = document.body.classList.contains('sidebar-collapsed');
            const margin = collapsed ? 'ml-16' : 'ml-64';
            const width = collapsed ? 'w-[calc(100%-4rem)]' : 'w-[calc(100%-16rem)]';

            [header, footer, cart].forEach(el => {
                el.classList.remove('ml-64', 'ml-16', 'w-[calc(100%-16rem)]', 'w-[calc(100%-4rem)]');
                el.classList.add(margin, width);
            });
        }

        // Checkbox semua
        selectAll.addEventListener('change', function () {
            document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = this.checked);
        });

        // Tambah, kurang, hapus
        document.querySelectorAll('.item').forEach(item => {
            const qtyInput = item.querySelector('.qty');

            item.querySelector('.increment').addEventListener('click', () => {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });

            item.querySelector('.decrement').addEventListener('click', () => {
                const qty = parseInt(qtyInput.value);
                if (qty > 1) qtyInput.value = qty - 1;
            });

            item.querySelector('.remove-item').addEventListener('click', () => {
                item.remove();
            });
        });

        // Checkout button
        checkoutBtn.addEventListener('click', function (e) {
    e.preventDefault();

    const selectedItem = document.querySelector('.item-checkbox:checked');

    if (!selectedItem) {
        alert('Silakan pilih item terlebih dahulu');
        return;
    }

    const item = selectedItem.closest('.item');
    const nama = item.querySelector('p.font-medium').textContent;
    const imgSrc = item.querySelector('img').getAttribute('src');
    const harga = item.dataset.price;
    const qty = item.querySelector('.qty').value;

    document.getElementById('checkoutNama').value = nama;
    document.getElementById('checkoutImg').value = imgSrc;
    document.getElementById('checkoutHarga').value = harga;
    document.getElementById('checkoutJumlah').value = qty;

    document.getElementById('checkoutForm').submit();
});

        checkoutBtn.addEventListener('click', () => {
            let total = 0;
            let count = 0;
            document.querySelectorAll('.item').forEach(item => {
                if (item.querySelector('.item-checkbox').checked) {
                    const qty = parseInt(item.querySelector('.qty').value);
                    const price = parseInt(item.dataset.price);
                    total += qty * price;
                    count += qty;
                }
            });

            if (count > 0) {
                alert(`Checkout ${count} item, Total: Rp ` + total.toLocaleString('id-ID'));
            } else {
                alert('Silakan pilih item terlebih dahulu');
            }
        });

        // Update layout saat sidebar toggle (delay agar animasi sidebar selesai)
        const toggleBtn = document.getElementById('toggleSidebar');
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
