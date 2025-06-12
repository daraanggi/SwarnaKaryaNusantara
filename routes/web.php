<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;  // <-- Tambahkan ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/cek', function () {
    return view('/pembeliView/pesanan');
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
    return view('/pembeliView/homePembeli');
    
});