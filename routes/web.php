<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main_page');
});
Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');

Route::get('/about-us', function () {
    return view('aboutUs');
})->name('about-us');

Route::get('/profile', function () {
    return view('myProfile');
})->name('profile');

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

Route::get('/product-desc', function () {
    return view('product-desc');
})->name('product-desc');

Route::get('/test', function () {
    return view('test');
})->name('test');