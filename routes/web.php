<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('main_page');
})->name('home');

Route::get('/main_page', function () {
    return view('main_page');
})->name('main_page'); 

Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');

Route::get('/about-us', function () {
    return view('aboutUs');
})->name('about-us');


Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('product/{id}', [ProductController::class, 'show'])->name('product-desc');

Route::get('/test', function () {
    return view('test');
})->name('test');


Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::post('/checkout/submit', [CheckoutController::class, 'store'])->name('checkout.submit');


Route::post('/checkout/confirm', [CheckoutController::class, 'confirmPayment'])->name('checkout.confirm');

Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
//Route::get('/profile', [CheckoutController::class, 'getOrderHistory'])->name('profile');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Add logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

