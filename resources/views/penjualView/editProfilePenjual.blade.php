@extends('layouts.penjual')
@section('title', 'Edit Profil')

@section('content')
<div id="mainContentWrapper" class="flex items-center justify-center min-h-screen w-full overflow-hidden bg-gray-50">
    <div class="border rounded-lg p-6 bg-white space-y-6 w-full max-w-3xl shadow">
        <!-- Header / Profile top (avatar + store name) -->
        <div class="flex items-center gap-4">
            <div class="relative">
                <img src="/images/avatar.png" alt="User Avatar"
                    class="w-20 h-20 rounded-full border-4 border-[#69553E] object-cover shadow">
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-semibold text-[#69553E]">
                    {{ auth()->user()->store_name ?? auth()->user()->name ?? 'Nama Toko' }}
                </h1>
            </div>
        </div>


        <!-- Statistik / Cards: Pendapatan, Daftar Produk -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="border rounded-lg p-4 bg-white">
                <div class="text-sm text-gray-600 font-medium mb-2">Pendapatan</div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <div class="text-xs text-gray-500">/Bulan</div>
                        <div class="text-lg font-semibold text-[#69553E]">
                            Rp {{ number_format($monthly_income ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">/Tahun</div>
                        <div class="text-lg font-semibold text-[#69553E]">
                            Rp {{ number_format($yearly_income ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="border rounded-lg p-4 bg-white">
                <div class="text-sm text-gray-600 font-medium mb-2">Daftar Produk</div>
                <div class="grid grid-cols-3 text-center">
                    <div>
                        <div class="text-xs text-gray-500">Produk Terjual</div>
                        <div class="text-lg font-semibold text-[#69553E]">{{ $products_sold_count ?? 0 }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Produk Habis</div>
                        <div class="text-lg font-semibold text-[#69553E]">{{ $out_of_stock_count ?? 0 }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Pesanan Aktif</div>
                        <div class="text-lg font-semibold text-[#69553E]">{{ $active_orders_count ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content area: Form Edit Profil (tetap utuh) -->
        <div class="border rounded-lg p-6 bg-white">
            <div class="flex justify-center">
                <div class="relative">
                    <img src="/images/avatar.png" alt="User Avatar"
                        class="w-24 h-24 rounded-full border-4 border-[#69553E] object-cover shadow">
                </div>
            </div>

            <h2 class="text-xl font-semibold text-[#69553E] text-center">Informasi Akun Penjual</h2>

            @if (session('status') === 'profile-updated')
                <div class="text-green-600 text-sm font-semibold text-center">Profil berhasil diperbarui.</div>
            @endif

            <!-- Form Edit Profil -->
            <form id="formProfil" method="POST" action="{{ route('penjual.profile.update') }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ auth()->user()->name }}"
                        class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ auth()->user()->email }}"
                        class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
                </div>

                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input id="no_telepon" name="no_telepon" type="text" value="{{ auth()->user()->no_telepon }}"
                        class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" placeholder="Biarkan kosong jika tidak diubah"
                        class="mt-1 w-full text-sm bg-gray-100 border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-[#69553E] focus:border-[#69553E]" disabled>
                </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" id="btnBatal" class="hidden text-gray-600 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 text-sm">Batal</button>
                <button type="button" id="btnEdit" class="bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">Edit</button>
                <button type="submit" id="btnSubmit" class="hidden bg-[#69553E] hover:bg-[#4d3f2c] text-white px-4 py-2 rounded-md text-sm">Simpan</button>
            </div>
        </form>

        <div class="flex justify-end pt-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-[#B08B5E] hover:bg-[#a07b4c] text-white text-sm px-4 py-2 rounded">Logout</button>
            </form>
        </div>
        </div>

        <!-- Messages Section (lihat semua pesan + panel percakapan) -->
        <div class="border rounded-lg p-4 bg-white">
            <div class="flex items-center mb-4">
                <a href="#" class="mr-3 text-gray-500">◀</a>
                <h3 class="text-lg font-semibold text-[#69553E]">Pesan</h3>
            </div>

            <div class="md:flex md:gap-6">
                <!-- Left: list pesan (scrollable jika banyak) -->
                <div class="md:w-1/2">
                    <div id="messagesList" class="space-y-3 max-h-96 overflow-auto pr-2">
                        @php
                            $dummyMessages = [
                                (object)['id' => 1, 'sender_name' => 'Anomali', 'excerpt' => 'Apakah pesanan untuk luar kota aman? dan bagaimana packingnya? Saya ingin memastikan barang aman sampai.', 'time' => '18:37', 'avatar_url' => null],
                                (object)['id' => 2, 'sender_name' => 'Budi', 'excerpt' => 'Saya ingin menanyakan produk ukuran lebih besar tersedia atau tidak. Mohon info stok.', 'time' => '15:09', 'avatar_url' => null],
                                (object)['id' => null, 'sender_name' => 'Susi', 'excerpt' => 'halo, apakah saya bisa bertanya?', 'time' => '15:07', 'avatar_url' => null],
                            ];
                            $msgs = $messages ?? $dummyMessages;
                        @endphp

                        @foreach($msgs as $msg)
                        <div class="message-item" data-message-id="{{ $msg->id ?? '' }}" data-fulltext="{{ htmlspecialchars($msg->body ?? $msg->excerpt, ENT_QUOTES) }}">
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded-full bg-white border flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if(!empty($msg->avatar_url))
                                        <img src="{{ $msg->avatar_url }}" alt="avatar" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 14c1.657 0 3-1.343 3-3S17.657 8 16 8s-3 1.343-3 3 1.343 3 3 3zM6 20v-1a4 4 0 014-4h4a4 4 0 014 4v1" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div class="font-semibold text-[#69553E]">{{ $msg->sender_name ?? 'Pengguna' }}</div>
                                        <div class="text-xs text-gray-500">{{ $msg->time ?? '' }}</div>
                                    </div>
                                    <!-- full message (tidak truncate) -->
                                    <div class="text-sm text-gray-600 mt-1">{{ $msg->excerpt }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right: panel percakapan (awalnya kosong/hint) -->
                <div class="md:w-1/2 mt-4 md:mt-0">
                    <div id="threadPanel" class="border rounded-lg p-3 bg-white min-h-[200px] hidden">
                        <div id="threadHeader" class="flex items-center justify-between mb-3">
                            <div class="font-semibold text-[#69553E]" id="threadTitle">Percakapan</div>
                            <div><button id="closeThread" class="text-xs text-gray-500">Tutup</button></div>
                        </div>

                        <div id="threadMessages" class="space-y-3 max-h-64 overflow-auto mb-3">
                            <!-- messages akan diisi via JS -->
                        </div>

                        <!-<div id="replyBox" class="mt-2">
                            <textarea id="replyText" rows="4" class="w-full border rounded-md px-3 py-2 text-sm" placeholder="Tulis balasan..."></textarea>
                            <div class="flex justify-end gap-2 mt-2">
                                <button id="replyCancel" type="button" class="inline-block text-sm px-3 py-1 border rounded">Batal</button>
                                <button id="replySend" type="button" class="inline-block bg-[#69553E] text-white px-3 py-1 rounded text-sm">Kirim</button>
                            </div>
                            <div id="replyStatus" class="text-xs text-gray-500 mt-2 hidden"></div>
                        </div>
                    </div>

                    <div id="threadPlaceholder" class="border rounded-lg p-6 bg-[#FBFBFB] text-center text-sm text-gray-500">
                        Pilih pesan di kiri untuk melihat percakapan dan membalas.
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Script (profil script tetap utuh + messages logic) -->
<script>
    // --- Profil edit logic (tetap utuh) ---
    const btnEdit = document.getElementById('btnEdit');
    const btnBatal = document.getElementById('btnBatal');
    const btnSubmit = document.getElementById('btnSubmit');
    const form = document.getElementById('formProfil');
    const inputs = form.querySelectorAll('input');

    let originalValues = {};

    btnEdit.addEventListener('click', () => {
        inputs.forEach(input => {
            originalValues[input.id] = input.value;
            input.disabled = false;
            input.classList.remove('bg-gray-100');
            input.classList.add('bg-white');
        });
        btnEdit.classList.add('hidden');
        btnSubmit.classList.remove('hidden');
        btnBatal.classList.remove('hidden');
    });

    btnBatal.addEventListener('click', () => {
        inputs.forEach(input => {
            input.value = originalValues[input.id] || '';
            input.disabled = true;
            input.classList.remove('bg-white');
            input.classList.add('bg-gray-100');
        });
        btnEdit.classList.remove('hidden');
        btnSubmit.classList.add('hidden');
        btnBatal.classList.add('hidden');
    });

    // --- Messages & thread logic ---
    const messagesList = document.getElementById('messagesList');
    const threadPanel = document.getElementById('threadPanel');
    const threadPlaceholder = document.getElementById('threadPlaceholder');
    const threadMessages = document.getElementById('threadMessages');
    const threadTitle = document.getElementById('threadTitle');
    const closeThread = document.getElementById('closeThread');
    const replyText = document.getElementById('replyText');
    const replySend = document.getElementById('replySend');
    const replyCancel = document.getElementById('replyCancel');
    const replyStatus = document.getElementById('replyStatus');

    let activeMessageId = null;

    // utility: escape HTML for safe insertion
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>"']/g, function(m) { return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m]; });
    }

    // attach click to each message item
    document.querySelectorAll('.message-item').forEach(item => {
        item.addEventListener('click', async (e) => {
            // ignore if click inside thread panel controls (none here)
            const msgId = item.dataset.messageId || null;
            const fullText = item.dataset.fulltext || item.querySelector('.text-sm')?.innerText || '';

            activeMessageId = msgId;

            // show panel
            threadPlaceholder.classList.add('hidden');
            threadPanel.classList.remove('hidden');
            threadMessages.innerHTML = ''; // clear
            threadTitle.textContent = item.querySelector('.font-semibold')?.innerText || 'Percakapan';

            // show the buyer message as the first message
            const buyerMsgEl = document.createElement('div');
            buyerMsgEl.className = 'p-3 bg-[#F3F3F3] rounded text-sm text-gray-700';
            buyerMsgEl.innerHTML = `<div class="text-xs text-gray-500 mb-1">Dari: ${escapeHtml(item.querySelector('.font-semibold')?.innerText || 'Pengguna')}</div>
                                     <div>${escapeHtml(fullText)}</div>`;
            threadMessages.appendChild(buyerMsgEl);

            // If we have an id, try to fetch thread/replies from server
            if (msgId) {
                try {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                    // backend GET route example: penjual.messages.thread (should return JSON array of messages)
                    const url = "{{ route('penjual.messages.thread', ['id' => '__ID__']) }}".replace('__ID__', msgId);
                    const res = await fetch(url, {
                        headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
                    });
                    if (res.ok) {
                        const data = await res.json();
                        // data expected: { thread: [ { from: 'seller'|'buyer', text: '...', time: '...' }, ... ] }
                        if (Array.isArray(data.thread)) {
                            data.thread.forEach(m => {
                                // skip the first if it's duplicate of buyer root (we already added)
                                // render seller messages differently
                                const el = document.createElement('div');
                                el.className = m.from === 'seller' ? 'p-3 bg-[#69553E] text-white rounded text-sm' : 'p-3 bg-[#F3F3F3] rounded text-sm text-gray-700';
                                el.innerHTML = `<div class="text-xs text-gray-400 mb-1">${escapeHtml(m.time || '')}</div><div>${escapeHtml(m.text || '')}</div>`;
                                threadMessages.appendChild(el);
                            });
                            // scroll to bottom
                            threadMessages.scrollTop = threadMessages.scrollHeight;
                        }
                    } else {
                        // non-ok -> ignore silently, keep showing buyer message
                        console.warn('Tidak dapat mengambil thread (status not ok)');
                    }
                } catch (err) {
                    console.error('Gagal fetch thread:', err);
                }
            } else {
                // no id (dummy), still allow reply but server-side route likely won't work
            }
        });
    });

    closeThread?.addEventListener('click', () => {
        threadPanel.classList.add('hidden');
        threadPlaceholder.classList.remove('hidden');
        threadMessages.innerHTML = '';
        replyText.value = '';
        activeMessageId = null;
    });

    replyCancel?.addEventListener('click', () => {
        replyText.value = '';
        replyStatus.classList.add('hidden');
    });

    replySend?.addEventListener('click', async () => {
        const text = replyText.value.trim();
        if (!text) {
            replyStatus.textContent = 'Pesan kosong.';
            replyStatus.classList.remove('hidden');
            return;
        }
        if (!activeMessageId) {
            // dummy message: no id -> attempt but warn user
            replyStatus.textContent = 'Tidak dapat mengirim: pesan tidak terdaftar di server.';
            replyStatus.classList.remove('hidden');
            return;
        }

        replyStatus.textContent = 'Mengirim...';
        replyStatus.classList.remove('hidden');

        try {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
            const replyUrl = "{{ route('penjual.messages.reply', ['id' => '__ID__']) }}".replace('__ID__', activeMessageId);
            const res = await fetch(replyUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ reply: text })
            });
            if (!res.ok) throw new Error('response not ok');
            const data = await res.json();
            // tampilkan balasan pada panel
            const el = document.createElement('div');
            el.className = 'p-3 bg-[#69553E] text-white rounded text-sm';
            el.innerHTML = `<div class="text-xs text-gray-200 mb-1">${escapeHtml(data.time || 'Baru saja')}</div><div>${escapeHtml(text)}</div>`;
            threadMessages.appendChild(el);
            threadMessages.scrollTop = threadMessages.scrollHeight;
            replyText.value = '';
            replyStatus.textContent = data.message || 'Berhasil dikirim.';
            setTimeout(() => replyStatus.classList.add('hidden'), 2500);
        } catch (err) {
            console.error(err);
            replyStatus.textContent = 'Gagal mengirim. Coba lagi.';
            replyStatus.classList.remove('hidden');
        }
    });
</script>
@endsection
