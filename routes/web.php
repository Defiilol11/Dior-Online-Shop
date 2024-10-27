<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GetCategories;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/fashion', [GetCategories::class, 'fashion'])->name('fashion');
Route::get('/beauty', [GetCategories::class, 'beauty'])->name('beauty');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});

Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/{itemId}/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/{itemId}/update', [CartController::class, 'updateQuantity'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout/store', [CheckoutController::class, 'storeCheckout'])->name('checkout.store');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
