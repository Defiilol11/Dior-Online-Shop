<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GetCategories;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/fashion', [GetCategories::class, 'fashion'])->name('fashion');
Route::get('/beauty', [GetCategories::class, 'beauty'])->name('beauty');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

use App\Http\Controllers\CartController;

Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::middleware('auth')->get('/cart', [CartController::class, 'show'])->name('cart.show');

Route::post('/cart/{itemId}/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/{itemId}/update', [CartController::class, 'updateQuantity'])->name('cart.update');

use App\Http\Controllers\CheckoutController;

Route::post('/checkout/store', [CheckoutController::class, 'storeCheckout'])->name('checkout.store');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

use App\Http\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); #arreglarlo luego para ver todo el historial de ordenes

use App\Http\Controllers\ContactController;

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware('auth')->post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

