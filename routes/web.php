<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PembeliProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AlamatUserController;
use App\Http\Controllers\PenjualProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\Penjual\MessageController;
use App\Http\Controllers\RiwayatPencarianController;
use Illuminate\Support\Facades\Route;

// ------------------------
// Route utama / Login
// ------------------------
Route::get('/', fn() => view('auth.login'));

// Form daftar penjual
Route::get('/register/penjual', [RegisteredUserController::class, 'createPenjual'])->name('register.penjual');
Route::post('/register/penjual', [RegisteredUserController::class, 'storePenjual'])->name('register.penjual.store');

// ------------------------
// Group middleware auth
// ------------------------
Route::middleware('auth')->group(function () {

    // ---------------- Admin ----------------
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/approval', [AdminController::class, 'approval'])->name('admin.approval');
        Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');
        Route::get('/approval/{id}', [AdminController::class, 'showApprovalDetail'])->name('admin.detail');
        Route::post('/approval/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
        Route::get('/periksa', [AdminController::class, 'periksa'])->name('admin.periksa');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/pesanan/{id}', [AdminController::class, 'showPesanan'])->name('admin.detailPesanan');
    });

    // ---------------- Alamat Pengguna ----------------
    Route::prefix('alamat')->group(function () {
        Route::get('/', [AlamatUserController::class, 'index'])->name('alamat.index');
        Route::post('/', [AlamatUserController::class, 'store'])->name('alamat.store');
        Route::get('{id}/edit', [AlamatUserController::class, 'edit'])->name('alamat.edit');
        Route::put('{id}', [AlamatUserController::class, 'update'])->name('alamat.update');
        Route::delete('{id}', [AlamatUserController::class, 'destroy'])->name('alamat.destroy');
        Route::post('set-utama/{id}', [AlamatUserController::class, 'setUtama'])->name('alamat.setUtama');
        Route::post('pilih/{id}', [AlamatUserController::class, 'pilih'])->name('alamat.pilih');
    });

    // ---------------- Pesanan Pembeli ----------------
    Route::get('/pesananPembeli', [PesananController::class, 'index'])->name('pesananPembeli');

    // ---------------- Detail Transaksi ----------------
    Route::get('/detail-transaksi', [DetailTransaksiController::class, 'index'])->name('detailTransaksi.index');
    Route::get('/detail-transaksi/{id}', [DetailTransaksiController::class, 'show'])->name('detailTransaksi.show');
    Route::get('/transaksi/detail', [DetailTransaksiController::class, 'showTransactionDetail'])->name('showTransactionDetail');

    // ---------------- Ulasan ----------------
    Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

    // ---------------- Pembeli Pages ----------------
    Route::get('/keranjang', fn() => view('pembeliView.keranjang'))->name('keranjang');
    Route::get('/editProfile', fn() => view('pembeliView.editProfile'))->name('editProfile');
    Route::get('/profilePembeli', fn() => view('pembeliView.profilePembeli'))->name('profilePembeli');

    // ---------------- Detail produk ----------------
    Route::get('/produk/detail/{id}', [ProdukController::class, 'showPembeli'])->name('barang.detail');

    // ---------------- Checkout ----------------
    Route::get('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/store', [TransaksiController::class, 'store'])->name('transaksi.store');

    // ---------------- Update profile pembeli ----------------
    Route::patch('/pembeli/profile', [PembeliProfileController::class, 'update'])->name('pembeli.profile.update');
    Route::get('/profile', [PembeliProfileController::class, 'show'])->name('pembeli.profile');

    // ---------------- Update profile penjual ----------------
    Route::get('/penjual/profile', [PenjualProfileController::class, 'edit'])->name('penjual.profile.edit');
    Route::patch('/penjual/profile/update', [PenjualProfileController::class, 'update'])->name('penjual.profile.update');

    // ---------------- Management product penjual ----------------
    Route::get('/manageProduct', [ProdukController::class, 'manageProduct'])->name('manageProduct');
    Route::get('/homePagePenjual', [ProdukController::class, 'homePagePenjual'])->name('homePagePenjual');
    Route::get('/penjual/produk/{id}', [ProdukController::class, 'showPenjual'])->name('penjual.produk.detail');
    Route::get('/penjual/create', [ProdukController::class, 'create'])->name('penjual.create');
    Route::get('/penjual/stok', [ProdukController::class, 'stok'])->name('penjual.stok');
    Route::post('/produk/{id}/tambah-stok', [ProdukController::class, 'tambahStok'])->name('produk.tambahStok');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // ---------------- Pesan penjual ----------------
    Route::prefix('penjual')->name('penjual.')->group(function () {
        Route::get('/messages/{id}/thread', [MessageController::class, 'thread'])->name('messages.thread');
        Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');
        Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    });

    // ---------------- Riwayat Pencarian ----------------
    Route::get('/search/history', [RiwayatPencarianController::class, 'index'])->name('search.history');
    Route::post('/search/store', [RiwayatPencarianController::class, 'store'])->name('search.store');
    Route::delete('/search/history/{id}', [RiwayatPencarianController::class, 'destroy'])->name('search.destroy');

});

require __DIR__.'/auth.php';
