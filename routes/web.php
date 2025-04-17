<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product-desc');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

