<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;  // <-- Tambahkan ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/cek', function () {
    return view('/pembeliView/editProfile');
});
Route::get('/detail', function () {//ini buat cek detail barang view
    return view('/pembeliView/detailBarang');
});

Route::get('/homepage', function () {
    return view('page.homepage');
})->middleware(['auth', 'verified'])->name('page.homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('produk', ProdukController::class); // <-- Tambahkan route resource di sini agar dia ikut middleware auth
});

Route::get('/users', function () {
    $users = User::all();
    return $users;
});

require __DIR__.'/auth.php';



Route::get('/homePage', function () {
    return view('pembeliView.homePembeli');
})->name('home');
Route::get('/keranjang', function () {
    return view('pembeliView.keranjang');
})->name('keranjang');
Route::get('/editProfile', function () {
    return view('pembeliView.editProfile');
})->name('editProfile');

Route::get('/detailBarang', function () {
    return view('pembeliView.detailBarang');
})->name('detailBarang');//kalau mau untuk pakai detail barang tinggal di pakai ini aja, panggil name ini gampang cuy

Route::get('/editAlamat', function () {
    return view('pembeliView.editAlamat');
})->name('editAlamat');

Route::get('/checkout', function () {
    return view('pembeliView.checkout');
})->name('checkout');


Route::get('/manageProduct', [ProdukController::class, 'manageProduct'])->name('manageProduct');

Route::get('/transactionDetail', function () {
    return view('penjualView.transactionDetail');
})->name('transactionDetail');

Route::get('/penjual/create', [ProdukController::class, 'create'])->name('penjual.create');
Route::get('/penjual/stok', [ProdukController::class, 'stok'])->name('penjual.stok');
Route::get('/penjual/delete', [ProdukController::class, 'delete'])->name('penjual.delete');

Route::post('/produk/{id}/tambah-stok', [ProdukController::class, 'tambahStok'])->name('produk.tambahStok');

