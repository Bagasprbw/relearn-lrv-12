<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Models\Produk;

Route::get('/', function () {
    $products = Produk::all();
    return view('index', compact('products'));
});

//Authentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


//khusus untuk admin dan super admin
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:admin,admin_super'])->group(function () {
    Route::get('/', [dashboardController::class, 'index'])->name('index'); //menjadi dashboard.index
    Route::resource('products', ProdukController::class); //mendfinisakan semua routes di-> dashboard.products/
    Route::resource('categories', KategoriController::class);
});



//khusus untuk admin_super => untuk mengakses halaman manage data admin
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:admin_super'])->group(callback: function () {
    // Route::get('/data_admins', [dashboardController::class, 'admins']);
    // Route::get('/admin_insert', [dashboardController::class, 'adminCreate']);
    // Route::post('/admin_store', [dashboardController::class, 'adminStore']);
    // Route::delete('/admin_delete/{id}', [dashboardController::class, 'adminDestroy']);

    //praktisnya
    Route::resource('admins', AdminController::class);
});

//khusus untuk role user biasa
Route::middleware(['auth', 'role:user'])->group(callback: function () {
    // Route::resource('profile', ProfileController::class);
    Route::get('user/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('user/profile/change_password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
});
