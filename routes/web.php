<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
//главная
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main');

//товары
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'product'])->name('product');

