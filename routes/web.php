<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\StockController;

Route::get('/', function () {
    return view('home');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/order', function () {
    return view('order');
});

// Route untuk halaman dashboard User
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/user/order', function () {
        return view('user.order');
    })->name('user.order');

    // Route untuk menambah produk ke keranjang
    Route::get('/user/dashboard/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::get('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');

    Route::get('/user/dashboard', [StockController::class, 'dashboard'])->name('user.dashboard');
    
    // Route untuk Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk Admin Dashboard dan Stock Management
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin/stock', [HomeController::class, 'index'])->name('admin.stock');

    // Stock Management
    Route::get('/admin/stock', [StockController::class, 'index'])->name('admin.stock');
    Route::post('/admin/stock', [StockController::class, 'store'])->name('admin.stock.store');
    Route::delete('/admin/stock/{id}', [StockController::class, 'destroy'])->name('admin.stock.delete');

    // Approval Admin
    Route::get('/admin/approval', function () {
        return view('admin.approval.index');
    })->name('admin.approval');
});

require __DIR__ . '/auth.php';
