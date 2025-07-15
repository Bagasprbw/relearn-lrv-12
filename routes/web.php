<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('index');
});

//Authentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin,admin_super'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/products', [ProdukController::class, 'index'])->name('products.index');
    Route::resource('products', ProdukController::class);
    Route::resource('categories', KategoriController::class);
});
