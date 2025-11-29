@extends('layouts.app')

@section('title', 'Keranjang Saya')

@section('content')

<div id="headerKeranjang" class="fixed top-0 left-64 right-0 z-50 flex justify-between items-center px-6 py-4 bg-[#FFFFFF] text-primary-brown font-extrabold text-xl transition-all duration-300 border-b border-gray-100 shadow-md">
    <h1 class="font-bold text-xl">Keranjang</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm font-semibold text-gray-700">Swarna Karya Nusantara</span>
        <img src="/images/logo.png" class="w-8 h-8 rounded-full object-contain" alt="Logo"/>
    </div>
</div>

<div id="cart" class="px-4 pt-[7rem] pb-36 space-y-4 bg-[#fdfbf8] min-h-screen"> 
    </div>

<div id="footerKeranjang" class="fixed bottom-0 right-0 w-[calc(100%-16rem)] z-50 bg-white shadow-xl border-t border-gray-200 flex flex-col px-4 py-4 space-y-3 ml-64">
    
    <div class="flex justify-between items-center">
        
        <label class="inline-flex items-center space-x-2">
            <input type="checkbox" id="selectAll" class="w-5 h-5 accent-[#6B4F3B] focus:ring-[#6B4F3B]">
            <span class="font-semibold text-gray-700">Pilih Semua</span>
        </label>

        <div class="flex items-center gap-6">
            <div class="text-right">
                <span class="text-sm text-gray-600 block">Total Pembayaran:</span>
                <span id="totalDisplay" class="font-bold text-xl text-[#6B4F3B]">Rp 0</span>
            </div>

            <form id="checkoutForm" method="POST" action="{{ route('checkout.start') }}">
                @csrf
                <input type="hidden" name="items" id="checkoutItems">
                <button type="submit" id="checkoutBtn" class="bg-[#6B4F3B] hover:bg-[#826141] text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-200 disabled:opacity-50" disabled>
                    Checkout
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartContainer = document.getElementById('cart');
    const selectAll = document.getElementById('selectAll');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const checkoutItemsInput = document.getElementById('checkoutItems');
    const totalDisplay = document.getElementById('totalDisplay');
    const form = document.getElementById('checkoutForm');

    let cart = JSON.parse(localStorage.getItem('cartItems')) || [];

    // --- Core Rendering & Data Management ---

    function updateSummary() {
        const selectedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
        let total = 0;

        selectedCheckboxes.forEach(cb => {
            const itemDiv = cb.closest('.item');
            const price = parseFloat(itemDiv.dataset.price);
            const qty = parseInt(itemDiv.querySelector('.qty').value);
            total += price * qty;
        });

        totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        checkoutBtn.disabled = selectedCheckboxes.length === 0;
    }

    function renderCart() {
        cartContainer.innerHTML = '';
        if (cart.length === 0) {
            cartContainer.innerHTML = '<div class="pt-10 text-center"><p class="text-gray-500 font-medium">Keranjang Anda masih kosong. Yuk, cari produk menarik!</p></div>';
            selectAll.checked = false;
            selectAll.disabled = true;
            updateSummary();
            return;
        }
        
        selectAll.disabled = false;

        cart.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'w-full bg-white rounded-xl p-5 shadow-lg border border-gray-100 flex items-start gap-6 item transition hover:shadow-xl';
            itemDiv.dataset.id = item.id;
            itemDiv.dataset.price = item.harga;

            itemDiv.innerHTML = `
                <input type="checkbox" class="item-checkbox w-6 h-6 accent-[#6B4F3B] focus:ring-[#6B4F3B] mt-1">
                
                <img src="${item.img || 'https://via.placeholder.com/100'}" alt="${item.nama}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                
                <div class="flex-1 min-w-0 flex items-start">
                    
                    <div class="flex-1 pt-1 space-y-1">
                        <h3 class="font-bold text-gray-900 text-xl truncate">${item.nama}</h3>
                        <p class="text-[#826141] font-extrabold text-lg">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                    </div>

                    <div class="flex flex-col items-end pt-1 gap-3 ml-auto"> 
                        
                        <div class="flex items-center space-x-0 border border-gray-300 rounded-full overflow-hidden">
                            <button class="decrement w-8 h-8 bg-gray-100 text-lg text-gray-600 hover:bg-gray-200 transition duration-150 flex items-center justify-center border-r border-gray-300">−</button>
                            <input type="text" value="${item.qty}" class="qty w-10 h-8 text-center bg-white font-semibold text-gray-700 focus:outline-none" readonly>
                            <button class="increment w-8 h-8 bg-gray-100 text-lg text-gray-600 hover:bg-gray-200 transition duration-150 flex items-center justify-center border-l border-gray-300">+</button>
                        </div>
                        
                        <button class="text-red-600 font-semibold hover:text-red-800 transition remove-item text-sm">Hapus</button>
                    </div>
                </div>
            `;
            cartContainer.appendChild(itemDiv);
        });

        attachEvents();
        updateSummary();
    }

    function saveCart() {
        localStorage.setItem('cartItems', JSON.stringify(cart));
        updateSummary();
    }

    function attachEvents() {
        // Event listeners untuk Qty dan Hapus
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
                Swal.fire({
                    title: 'Yakin hapus?',
                    text: `Anda akan menghapus ${item.querySelector('h3').textContent} dari keranjang.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6B4F3B',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cart = cart.filter(p => p.id !== id);
                        saveCart();
                        renderCart();
                        Swal.fire('Dihapus!', 'Produk berhasil dihapus dari keranjang.', 'success');
                    }
                });
            });
            
            // Event listener untuk checkbox item individual
            item.querySelector('.item-checkbox').addEventListener('change', function() {
                const allSelected = document.querySelectorAll('.item-checkbox').length === document.querySelectorAll('.item-checkbox:checked').length;
                selectAll.checked = allSelected;
                updateSummary();
            });
        });
    }

    // --- Footer Events ---

    // Checkout
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
                harga: parseFloat(item.dataset.price),
                jumlah: parseInt(item.querySelector('.qty').value),
            };
        });

        // 1. Set input items dengan data produk yang dipilih (dalam format JSON string)
        checkoutItemsInput.value = JSON.stringify(selectedItems);
        
        // 2. Submit form ke route checkout.start (POST)
        form.submit();
        
    });

    // Checkbox "Pilih Semua"
    selectAll.addEventListener('change', function () {
        document.querySelectorAll('.item-checkbox').forEach(cb => {
             cb.checked = this.checked;
        });
        updateSummary();
    });
    
    // Inisiasi
    renderCart();
});
</script>

@endsection 