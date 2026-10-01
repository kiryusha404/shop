<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
//главная
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main');

//товары
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'product'])->name('product');

//лк
Route::get('/cart', [App\Http\Controllers\LkController::class, 'index'])->name('cart');

//админка
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::post('/admin/product/create', [App\Http\Controllers\AdminController::class, 'product_create'])->name('product.create');
