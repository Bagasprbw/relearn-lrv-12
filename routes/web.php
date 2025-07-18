<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
});

//Authentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


//khusus untuk admin dan super admin
Route::middleware(['auth', 'role:admin,admin_super'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/products', [ProdukController::class, 'index'])->name('products.index');
    Route::resource('products', ProdukController::class);
    Route::resource('categories', KategoriController::class);
});

//khusus untuk admin_super => untuk mengakses halaman manage data admin
Route::middleware(['auth', 'role:admin_super'])->group(callback: function () {
    Route::get('/data_admins', [dashboardController::class, 'admins']);
    Route::get('/admin_insert', [dashboardController::class, 'adminCreate']);
    Route::post('/admin_store', [dashboardController::class, 'adminStore']);
    Route::delete('/admin_delete/{id}', [dashboardController::class, 'adminDestroy']);
    //Route::resource('admins', dashboardController::class); // iki gak kanggo, soale dak tabrakan method e (index, create, dll)
});

//khusus untuk role user biasa
Route::middleware(['auth', 'role:user'])->group(callback: function () {
    // Route::resource('profile', ProfileController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});
