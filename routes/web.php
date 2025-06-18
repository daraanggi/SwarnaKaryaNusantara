<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/cek', function () {
    return view('/pembeliView/ulasan');
});

Route::get('/detail', function () {
    return view('/pembeliView/detailBarang');
});
Route::get('/homePage', [ProdukController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('produk', ProdukController::class);
});

Route::get('/users', function () {
    $users = User::all();
    return $users;
});

Route::get('/keranjang', function () {
    return view('pembeliView.keranjang');
})->name('keranjang');

Route::get('/editProfile', function () {
    return view('pembeliView.editProfile');
})->name('editProfile');

Route::get('/editAlamat', function () {
    return view('pembeliView.editAlamat');
})->name('editAlamat');

Route::get('/checkout', function () {
    return view('pembeliView.checkout');
})->name('checkout');

Route::get('/profilePembeli', function () {
    return view('pembeliView.profilePembeli');
})->name('profilePembeli');

Route::get('/homepage', function () {
    return view('page.homepage');
})->name('homepage');

Route::get('/manageProduct', [ProdukController::class, 'manageProduct'])->name('manageProduct');

Route::get('/homePagePenjual', function () {
    return view('penjualView.homePagePenjual');
})->name('homePagePenjual');

Route::get('/transactionDetail', function () {
    return view('penjualView.transactionDetail');
})->name('transactionDetail');

Route::get('/detail-produk/{id}', [ProdukController::class, 'show'])->name('barang.detail');

Route::get('/orderDetail/{invoice}', function ($invoice) {
    $data = [
        'invoice' => $invoice,
        'produk'  => 'Tas Rotan',
        'status'  => 'Pesanan Dalam Pengantaran',
        'waktu'   => '17 Agustus 2024 15:04',
        'jumlah'  => 2,
        'total'   => 'Rp. 411.000',
    ];
    return view('penjualView.orderDetail', compact('data'));
})->name('orderDetail');

Route::get('/penjual/create', [ProdukController::class, 'create'])->name('penjual.create');
Route::get('/penjual/stok', [ProdukController::class, 'stok'])->name('penjual.stok');
Route::get('/penjual/delete', [ProdukController::class, 'delete'])->name('penjual.delete');
Route::post('/produk/{id}/tambah-stok', [ProdukController::class, 'tambahStok'])->name('produk.tambahStok');

require __DIR__.'/auth.php';
