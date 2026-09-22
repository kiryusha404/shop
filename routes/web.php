<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
//главная
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main');

//товары
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'product'])->name('product');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
