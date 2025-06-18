<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;  // <-- Tambahkan ini
//use App\Http\Controllers\OrderController;
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

    Route::get('/dashboard-pembeli', function () {
        return view('pembeliView.homePembeli');
    })->name('pembeli.dashboard');

    Route::get('/dashboard-penjual', function () {
        return view('penjualView.homePagePenjual');
    })->name('penjual.dashboard');
});
require __DIR__.'/auth.php';


// Route::get('/users', function () {
//     $users = User::all();
//     return $users;
// });


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

Route::get('/profilePembeli', function () {
    return view('pembeliView.profilePembeli');
})->name('profilePembeli');

Route::get('/produk/detail', function () {
    return view('page.detailBarang');
})->name('barang.detail');

Route::get('/homepage', function () {
    return view('page.homepage');
})->name('homepage');

Route::get('/manageProduct', [ProdukController::class, 'manageProduct'])->name('manageProduct');

//penjualhomepage
Route::get('/homePagePenjual', function () {
    return view('penjualView.homePagePenjual');
})->name('homePagePenjual');

//penjualtransaksidetail
Route::get('/transactionDetail', function () {
    return view('penjualView.transactionDetail');
})->name('transactionDetail');

//penjualorderdetail
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

//Route::get('/orderDetail/{invoice}', [OrderController::class, 'showDetail'])->name('orderDetail');


Route::get('/penjual/create', [ProdukController::class, 'create'])->name('penjual.create');
Route::get('/penjual/stok', [ProdukController::class, 'stok'])->name('penjual.stok');
Route::get('/penjual/delete', [ProdukController::class, 'delete'])->name('penjual.delete');

Route::post('/produk/{id}/tambah-stok', [ProdukController::class, 'tambahStok'])->name('produk.tambahStok');

// Route untuk halaman pesanan
Route::get('/pesananPembeli', function () {

    return view('pembeliView.pesananPembeli');

})->name('pesananPembeli');

// Route untuk halaman ulasan
Route::get('/ulasanPembeli', function () {

    return view('pembeliView.ulasanPembeli');

})->name('ulasanPembeli');

Route::get('/editProfilePenjual', function () {
    return view('penjualView.editProfilePenjual');
});

