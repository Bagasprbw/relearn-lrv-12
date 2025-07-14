<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

// Route::get('/', function () {
//     return view('welcome');
// });


//produk
Route::get('/', [ProdukController::class, 'index'])->name('products.index');
Route::resource('products', controller: \App\Http\Controllers\ProdukController::class);
// atau
// Route::get('/products/tambah', [ProdukController::class, 'create'])->name('products.tambah');


// kategori
Route::get('/categories', [KategoriController::class, 'index']);
Route::resource('categories', controller: \App\Http\Controllers\KategoriController::class);

