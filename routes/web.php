<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
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

    // Route produk ke keranjang
    Route::post('cart/add/{stocks_id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('cart/view', [CartController::class, 'viewCart'])->name('layouts.navigationuser');
    Route::get('cart/show', [CartController::class, 'showCount'])->name('layouts.navigationuser');
    Route::patch('cart/decrease/{stocks_id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
    Route::patch('cart/increase/{stocks_id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
  
    Route::post('/user/order', [OrderController::class, 'showOrderDetails'])->name('order');
    Route::post('/user/process', [OrderController::class, 'processOrder'])->name('order.process');
    Route::get('/user/order_details', [OrderController::class, 'orderDetails'])->name('order.details');
    Route::delete('/user/order_details/delete/{orderdetails_id}', [OrderController::class, 'deleteOrder'])->name('order.delete');

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
    Route::delete('/admin/stock/{stocks_id}', [StockController::class, 'destroy'])->name('admin.stock.delete');

    // Approval Admin
    Route::get('/admin/approval', function () {
        return view('admin.approval.index');
    })->name('admin.approval');
});

require __DIR__ . '/auth.php';
