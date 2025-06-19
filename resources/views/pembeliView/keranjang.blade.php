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
<div id="cart" class="ml-64 px-6 py-6 pt-24 pb-36 transition-all duration-300 space-y-6 bg-[#fdfbf8] min-h-screen">
    <!-- Diisi oleh JavaScript -->
</div>

<!-- Bottom Bar -->
<div id="footerKeranjang" class="ml-64 fixed bottom-0 right-0 w-[calc(100%-16rem)] z-50 bg-white shadow border-t flex justify-between items-center px-6 py-4 transition-all duration-300">
    <label class="inline-flex items-center space-x-2">
        <input type="checkbox" id="selectAll" class="form-checkbox w-5 h-5 accent-[#6B4F3B]">
        <span class="font-semibold text-gray-700">Pilih Semua</span>
    </label>

    <button
        id="checkoutBtn"
        class="bg-[#826141] hover:bg-[#6B4F3B] text-white font-semibold py-2 px-6 rounded shadow transition-all">
        Checkout
    </button>
</div>

<!-- Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const cartContainer = document.getElementById('cart');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const selectAll = document.getElementById('selectAll');
    const header = document.getElementById('headerKeranjang');
    const footer = document.getElementById('footerKeranjang');

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
                <input type="checkbox" class="item-checkbox accent-[#6B4F3B] w-5 h-5 self-center">
                <img src="${item.img}" alt="${item.nama}" class="w-24 h-24 object-cover rounded border border-gray-300">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800 text-lg">${item.nama}</h3>
                    <p class="text-[#6B4F3B] font-bold text-md mt-1">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                    <div class="flex items-center mt-3 gap-2">
                        <button class="decrement w-8 h-8 border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 text-lg">−</button>
                        <input type="text" value="${item.qty}" class="qty w-10 h-8 border rounded text-center text-sm bg-white" readonly>
                        <button class="increment w-8 h-8 border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 text-lg">+</button>
                        <button class="ml-auto text-gray-500 hover:text-red-600 remove-item transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H4m16 0H4"/>
                            </svg>
                        </button>
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
        const selected = document.querySelector('.item-checkbox:checked');
        if (!selected) {
            alert('Pilih produk untuk checkout!');
            return;
        }

        const item = selected.closest('.item');
        document.getElementById('checkoutIdProduk').value = item.dataset.id;
        document.getElementById('checkoutNama').value = item.querySelector('h3').textContent;
        document.getElementById('checkoutImg').value = item.querySelector('img').src;
        document.getElementById('checkoutHarga').value = item.dataset.price;
        document.getElementById('checkoutJumlah').value = item.querySelector('.qty').value;

        document.getElementById('checkoutForm').submit();
    });

    selectAll.addEventListener('change', function () {
        document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = this.checked);
    });

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

        [header, footer, cartContainer].forEach(el => {
            el.classList.remove('ml-64', 'ml-16', 'w-[calc(100%-16rem)]', 'w-[calc(100%-4rem)]');
            el.classList.add(margin, width);
        });
    }

    const toggleBtn = document.getElementById('toggleSidebar');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('sidebar-collapsed');
            setTimeout(updateLayout, 50);
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

    });
    updateLayout();
    renderCart();
});
</script>
@endsection 