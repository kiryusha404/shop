<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'name', 'img')->orderBy('id', 'desc')->limit(5)->get();
        return view('main', compact('products'));
    }
}
