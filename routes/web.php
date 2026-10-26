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
Route::post('/cart/add', [App\Http\Controllers\LkController::class, 'add_cart'])->name('add.cart');
Route::patch('/cart/plus', [App\Http\Controllers\LkController::class, 'plus_cart'])->name('plus.cart');
Route::patch('/cart/minus', [App\Http\Controllers\LkController::class, 'minus_cart'])->name('minus.cart');

//заказы
Route::post('/order/create', [App\Http\Controllers\OrderController::class, 'create_order'])->name('order.create');

//админка
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/admin/product/update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.product.update');
Route::post('/admin/product/create', [App\Http\Controllers\AdminController::class, 'product_create'])->name('product.create');
Route::delete('/admin/product/delete', [App\Http\Controllers\AdminController::class, 'product_delete'])->name('product.delete');
Route::put('/admin/product/update/{id}', [App\Http\Controllers\AdminController::class, 'product_update'])->name('product.update');
