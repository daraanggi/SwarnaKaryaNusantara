let currentEditBox = null;

function editAlamat(event, button) {
    event.stopPropagation();
    currentEditBox = button.closest('.alamat-box');
    const data = currentEditBox.querySelector('.alamat-display').innerHTML.trim().split('<br>');

    const id = currentEditBox.dataset.id;
    document.getElementById('alamat_id').value = id;
    document.getElementById('nama').value = data[0].trim();
    document.getElementById('telepon').value = data[1].trim();
    document.getElementById('alamat').value = data[2].trim();

    const wilayah = data[3].trim();
    const regex = /KAB\. ([A-Z\s]+) – [A-Z\s]+, ([A-Z\s]+), ID (\d+)/;
    const match = wilayah.match(regex);

    if (match) {
        document.getElementById('kota').value = match[1].trim();
        document.getElementById('provinsi').value = match[2].trim();
        document.getElementById('kode_pos').value = match[3].trim();
    }

    document.getElementById('formMode').innerText = 'Edit Alamat';
    document.getElementById('formAlamatContainer').classList.remove('hidden');
    document.getElementById('alamatForm').action = /alamat/update/${id};
}


function jadikanUtama(box) {
    if (event.target.tagName === "BUTTON") return;

    document.querySelectorAll('.alamat-box').forEach(item => {
        item.classList.remove('ring-2', 'ring-[#69553E]');
        const label = item.querySelector('.label-utama');
        if (label) label.classList.add('hidden');
    });

    box.classList.add('ring-2', 'ring-[#69553E]');
    const label = box.querySelector('.label-utama');
    if (label) label.classList.remove('hidden');

    const id = box.dataset.id;

    fetch(/alamat/set-sebagai-utama/${id}, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({})
    }).then(() => {
        console.log('Alamat utama diset sementara.');
    });
}

function showFormTambahAlamat() {
    currentEditBox = null;
    document.getElementById('formMode').innerText = 'Tambah Alamat';
    document.getElementById('alamat_id').value = '';
    document.getElementById('nama').value = '';
    document.getElementById('telepon').value = '';
    document.getElementById('alamat').value = '';
    document.getElementById('kota').value = '';
    document.getElementById('provinsi').value = '';
    document.getElementById('kode_pos').value = '';
    document.getElementById('alamatForm').action = /alamat/store;
    document.getElementById('formAlamatContainer').classList.remove('hidden');
}

function batalEdit() {
    document.getElementById('formAlamatContainer').classList.add('hidden');
}