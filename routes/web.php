<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// User Dashboard
Route::middleware(['auth'])->group(function () {
    // Routes for regular users
    Route::middleware(['can:user'])->group(function () {
        Route::get('/user/dashboard', [ProductController::class, 'index'])->name('user.dashboard');
        
        // Cart Routes
        Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
        Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
        
        // Checkout Routes
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    });

    // Routes for admin users
    Route::middleware(['can:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [ProductController::class, 'adminIndex'])->name('dashboard');
        Route::resource('products', ProductController::class)->except(['show']);
    });
});

// Public Routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/produk', function () {
    return view('products');
});