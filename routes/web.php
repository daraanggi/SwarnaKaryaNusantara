<?php

use App\Http\Controllers\PembeliProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AlamatUserController;
use App\Http\Controllers\PenjualProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use App\Http\Controllers\DetailTransaksiController;

// ------------------------
// Route utama / Login
// ------------------------
Route::get('/', fn() => view('auth.login'));

// ------------------------
// Halaman detail barang pembeli
// ------------------------
Route::get('/detail', fn() => view('pembeliView.detailBarang'));

// ------------------------
// Homepage pembeli
// ------------------------
Route::get('/homePage', [ProdukController::class, 'index'])->name('home');

// ------------------------
// Group middleware auth
// ------------------------
Route::middleware('auth')->group(function () {

    // Resource produk
    Route::resource('produk', ProdukController::class);


    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/approval', [AdminController::class, 'approval'])->name('admin.approval');
    Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');

    // Halaman pesanan pembeli
    Route::get('/pesananPembeli', [PesananController::class, 'index'])->name('pesananPembeli');
});
// // Halaman ulasan
// Route::get('/ulasan', function () {
//     $produk = Produk::first();
//     return view('pembeliView.ulasan', ['produk' => $produk]);

// })->name('ulasan.form');


// Route baru khusus DetailTransaksi
Route::get('/detail-transaksi', [DetailTransaksiController::class, 'index'])->name('detailTransaksi.index');
Route::get('/detail-transaksi/{id}', [DetailTransaksiController::class, 'show'])->name('detailTransaksi.show');

Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store')

// ------------------------
// Ulasan
// ------------------------
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

// ------------------------
// Halaman pembeli lainnya
// ------------------------
Route::get('/keranjang', fn() => view('pembeliView.keranjang'))->name('keranjang');
Route::get('/editProfile', fn() => view('pembeliView.editProfile'))->name('editProfile');
Route::get('/editAlamat', fn() => view('pembeliView.editAlamat'))->name('editAlamat');
Route::get('/checkout', fn() => view('pembeliView.checkout'))->name('checkout');
Route::get('/profilePembeli', fn() => view('pembeliView.profilePembeli'))->name('profilePembeli');

// ------------------------
// Detail produk
// ------------------------
Route::get('/keranjang', function () {
    return view('pembeliView.keranjang');
})->name('keranjang');

Route::get('/editProfile', function () {
    return view('pembeliView.editProfile');
})->name('editProfile');

//Route::get('/editAlamat', function () {
  //  return view('pembeliView.editAlamat');
//})->name('editAlamat');

Route::get('/checkout', function () {
    return view('pembeliView.checkout');
})->name('checkout');

Route::get('/profilePembeli', function () {
    return view('pembeliView.profilePembeli');
})->name('profilePembeli');

// Route::get('/produk/detail', function () {
//     return view('page.detailBarang');
// })->name('barang.detail');

Route::get('/produk/detail/{id}', [ProdukController::class, 'showPembeli'])->name('barang.detail');

// Homepage umum
Route::get('/homepage', fn() => view('page.homepage'))->name('homepage');

// ------------------------
// Management product penjual
// ------------------------
Route::get('/manageProduct', [ProdukController::class, 'manageProduct'])->name('manageProduct');
Route::get('/homePagePenjual', [ProdukController::class, 'homePagePenjual'])->name('homePagePenjual');

// Detail order
Route::get('/orderDetail/{id}', [OrderController::class, 'showDetail'])->name('orderDetail');

// Detail produk penjual
Route::get('/penjual/produk/{id}', [ProdukController::class, 'showPenjual'])->name('penjual.produk.detail');

// Manajemen produk penjual
Route::get('/penjual/create', [ProdukController::class, 'create'])->name('penjual.create');
Route::get('/penjual/stok', [ProdukController::class, 'stok'])->name('penjual.stok');
Route::get('/penjual/delete', [ProdukController::class, 'delete'])->name('penjual.delete');
Route::post('/produk/{id}/tambah-stok', [ProdukController::class, 'tambahStok'])->name('produk.tambahStok');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');


// ------------------------

require __DIR__.'/auth.php';

// Halaman pesanan pembeli
//Route::get('/pesananPembeli', function () {
   //return view('pembeliView.pesananPembeli');
//})->name('pesananPembeli');

Route::get('/pesananPembeli', [PesananController::class, 'pesananPembeli'])->middleware('auth');

Route::get('/pesananPembeli', [PesananController::class, 'index'])->name('pesananPembeli');

//alamatpembeli (user)
Route::get('/alamat', [AlamatUserController::class, 'index'])->name('alamat.index');
Route::post('/alamat', [AlamatUserController::class, 'store'])->name('alamat.store');
Route::get('/editAlamat', [AlamatUserController::class, 'index'])->name('editAlamat');
Route::post('/alamat/store', [AlamatUserController::class, 'store'])->name('alamat.store');
Route::get('/edit-alamat', [AlamatUserController::class, 'editAlamat'])->name('alamat.edit');
Route::post('/alamat/update/{id}', [AlamatUserController::class, 'update'])->name('alamat.update');

// Edit profile penjual
// ------------------------
Route::get('/editProfilePenjual', fn() => view('penjualView.editProfilePenjual'))->name('editProfilePenjual');

// ------------------------
// Checkout store
// ------------------------
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::post('/checkout/store', [TransaksiController::class, 'store'])->name('transaksi.store');

// ------------------------
// Update profile
// ------------------------
// Untuk pembeli
Route::patch('/pembeli/profile', [PembeliProfileController::class, 'update'])->name('pembeli.profile.update');
// Untuk penjual
Route::patch('/penjual/profile', [PenjualProfileController::class, 'update'])->name('penjual.profile.update');


require __DIR__.'/auth.php';

Route::get('/homePagePenjual', [ProdukController::class, 'homepagePenjual'])->name('homePagePenjual');
