<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('index');
});


//Auth
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


//produk
Route::get('/products', [ProdukController::class, 'index'])->name('products.index');
Route::resource('products', controller: \App\Http\Controllers\ProdukController::class);
// atau
// Route::get('/products/tambah', [ProdukController::class, 'create'])->name('products.tambah');


// kategori
Route::get('/categories', [KategoriController::class, 'index']);
Route::resource('categories', controller: \App\Http\Controllers\KategoriController::class);

