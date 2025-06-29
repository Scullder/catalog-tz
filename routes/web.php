<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;

Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');

Route::middleware('guest')->group(function () {
    Route::get('register', action: [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->except(['edit', 'update', 'destroy', 'create']);
    Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
});

Route::group(['controller' => CartController::class, 'prefix' => 'cart'], function () {
    Route::get('/', 'index')->name('cart.index');
    Route::post('/update/{product}', 'update')->name('cart.update');
    Route::delete('/remove/{product}', 'remove')->name('cart.remove');
    Route::post('/checkout',  'checkout')->name('cart.checkout');
});

