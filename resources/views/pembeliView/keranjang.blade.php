@extends('layouts.app')

@section('title', 'Keranjang Saya')

@section('content')
<!-- Header -->
<div id="headerKeranjang" class="fixed top-0 right-0 z-50 flex justify-between items-center px-4 py-3 bg-[#69553E] text-white font-bold text-lg ml-64 w-[calc(100%-16rem)]">
    <span>Keranjang Saya</span>
    <img src="/images/logo.png" class="w-10 h-10 rounded-full bg-white object-contain"/>
</div>

<!-- Cart Items -->
<div id="cart" class="ml-64 px-6 pt-24 pb-36 space-y-6 bg-[#fdfbf8] min-h-screen">
    <!-- Diisi oleh JavaScript -->
</div>

<!-- Bottom Bar -->
<div id="footerKeranjang" class="ml-64 fixed bottom-0 right-0 w-[calc(100%-16rem)] z-50 bg-white shadow border-t flex justify-between items-center px-6 py-4">
    <label class="inline-flex items-center space-x-2">
        <input type="checkbox" id="selectAll" class="w-5 h-5 accent-[#6B4F3B]">
        <span class="font-semibold text-gray-700">Pilih Semua</span>
    </label>

    <form id="checkoutForm" method="GET" action="{{ route('checkout') }}">
        <input type="hidden" name="items" id="checkoutItems">
        <button type="submit" id="checkoutBtn" class="bg-[#826141] hover:bg-[#6B4F3B] text-white font-semibold py-2 px-6 rounded shadow">
            Checkout
        </button>
    </form>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartContainer = document.getElementById('cart');
    const selectAll = document.getElementById('selectAll');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const checkoutItemsInput = document.getElementById('checkoutItems');
    const form = document.getElementById('checkoutForm');

    let cart = JSON.parse(localStorage.getItem('cartItems')) || [];

    function renderCart() {
        cartContainer.innerHTML = '';
        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="text-center text-gray-500">Keranjang kosong</p>';
            return;
        }

        cart.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'bg-white rounded-xl p-4 shadow flex items-center gap-4 item';
            itemDiv.dataset.id = item.id;
            itemDiv.dataset.price = item.harga;

            itemDiv.innerHTML = `
                <input type="checkbox" class="item-checkbox w-5 h-5 accent-[#6B4F3B] self-start mt-4">
                <img src="${item.img}" alt="${item.nama}" class="w-24 h-24 object-cover rounded border border-gray-300">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800 text-lg">${item.nama}</h3>
                    <p class="text-[#6B4F3B] font-bold text-md mt-1">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                    <div class="flex items-center mt-3 gap-2">
                        <button class="decrement w-8 h-8 border border-gray-300 rounded-full">−</button>
                        <input type="text" value="${item.qty}" class="qty w-10 h-8 border rounded text-center bg-white" readonly>
                        <button class="increment w-8 h-8 border border-gray-300 rounded-full">+</button>
                        <button class="ml-auto text-red-600 remove-item">Hapus</button>
                    </div>
                </div>
            `;
            cartContainer.appendChild(itemDiv);
        });

        attachEvents();
    }

    function attachEvents() {
        document.querySelectorAll('.item').forEach(item => {
            const id = item.dataset.id;
            const qtyInput = item.querySelector('.qty');

            item.querySelector('.increment').addEventListener('click', () => {
                const product = cart.find(p => p.id === id);
                product.qty++;
                qtyInput.value = product.qty;
                saveCart();
            });

            item.querySelector('.decrement').addEventListener('click', () => {
                const product = cart.find(p => p.id === id);
                if (product.qty > 1) {
                    product.qty--;
                    qtyInput.value = product.qty;
                    saveCart();
                }
            });

            item.querySelector('.remove-item').addEventListener('click', () => {
                cart = cart.filter(p => p.id !== id);
                saveCart();
                renderCart();
            });
        });
    }

    function saveCart() {
        localStorage.setItem('cartItems', JSON.stringify(cart));
    }

    checkoutBtn.addEventListener('click', function (e) {
        e.preventDefault();

        const selectedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
        if (selectedCheckboxes.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Pilih produk terlebih dahulu sebelum checkout!',
                confirmButtonColor: '#6B4F3B'
            });
            return;
        }

        const selectedItems = Array.from(selectedCheckboxes).map(cb => {
            const item = cb.closest('.item');
            return {
                id: item.dataset.id,
                nama: item.querySelector('h3').textContent,
                img: item.querySelector('img').src,
                harga: parseInt(item.dataset.price),
                jumlah: parseInt(item.querySelector('.qty').value),
            };
        });

        // Hapus item yang di-checkout dari localStorage
        cart = cart.filter(item => {
            return !selectedItems.some(selected => selected.id === item.id);
        });
        localStorage.setItem('cartItems', JSON.stringify(cart));

        checkoutItemsInput.value = JSON.stringify(selectedItems);
        form.submit();
    });

    // Checkbox "Pilih Semua"
    selectAll.addEventListener('change', function () {
        document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = this.checked);
    });

    renderCart();
});
</script>

@endsection
