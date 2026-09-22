<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // каталог
    public function index()
    {
        return view('products');
    }
    // страница продукта
    public function product()
    {
        return view('product');
    }
}
