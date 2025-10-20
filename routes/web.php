<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use App\Http\Controllers\UlasanController;

// Route utama login
Route::get('/', function () {
    return view('auth.login');
});

// Halaman detail barang pembeli
Route::get('/detail', function () {
    return view('/pembeliView/detailBarang');
});

// Halaman homepage pembeli
Route::get('/homePage', [ProdukController::class, 'index'])->name('home');

// Group middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('produk', ProdukController::class);
});

// // Halaman ulasan
// Route::get('/ulasan', function () {
//     $produk = Produk::first();
//     return view('pembeliView.ulasan', ['produk' => $produk]);
// })->name('ulasan.form');

Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');

// Halaman pembeli lainnya
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

// Route::get('/produk/detail', function () {
//     return view('page.detailBarang');
// })->name('barang.detail');

Route::get('/produk/detail/{id}', [ProdukController::class, 'showPembeli'])->name('barang.detail');


require __DIR__.'/auth.php';

// Duplicate checkout view
Route::get('/checkout', function () {
    return view('pembeliView.checkout');
})->name('checkout');

// Homepage umum
Route::get('/homepage', function () {
    return view('page.homepage');
})->name('homepage');

// Management product penjual
Route::get('/manageProduct', [ProdukController::class, 'manageProduct'])->name('manageProduct');

// Halaman utama penjual
Route::get('/homePagePenjual', [ProdukController::class, 'homePagePenjual'])->name('homePagePenjual');

// Transaksi
Route::get('/transactionDetail', [TransaksiController::class, 'showTransactionDetail'])->name('showTransactionDetail');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transactionDetail');
Route::post('/checkout/store', [TransaksiController::class, 'store'])->name('transaksi.store');

// Detail produk
Route::get('/detail-produk/{id}', [ProdukController::class, 'showPembeli'])->name('barang.detail');

// Detail order
Route::get('/orderDetail/{id}', [OrderController::class, 'showDetail'])->name('orderDetail');

// Detail produk penjual (beberapa alias route yang sama)
Route::get('/penjual/produk/{id}', [ProdukController::class, 'showPenjual'])->name('penjual.produk.detail');

// Manajemen produk penjual
Route::get('/penjual/create', [ProdukController::class, 'create'])->name('penjual.create');
Route::get('/penjual/stok', [ProdukController::class, 'stok'])->name('penjual.stok');
Route::get('/penjual/delete', [ProdukController::class, 'delete'])->name('penjual.delete');
Route::post('/produk/{id}/tambah-stok', [ProdukController::class, 'tambahStok'])->name('produk.tambahStok');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

require __DIR__.'/auth.php';

// Halaman pesanan pembeli
use App\Http\Controllers\PesananController;

Route::get('/pesananPembeli', [PesananController::class, 'pesananPembeli'])->middleware('auth');

// Edit profile penjual
Route::get('/editProfilePenjual', function () {
    return view('penjualView.editProfilePenjual');
});

// Checkout store
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');

//Route::post('/checkout', [PesananController::class, 'store'])->name('transaksi.store');
Route::get('/pesananPembeli', [PesananController::class, 'index'])->name('pesananPembeli');