<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $products = Product::orderBy('name', 'asc')->get();

        return view('admin', compact('categories', 'products'));
    }
}
