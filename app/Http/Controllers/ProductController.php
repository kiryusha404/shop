<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    // каталог
    public function index(Request $request, ProductServices $productServices)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $products = $productServices->filter($request)->sort($request)->paginate(12);

        return view('products', compact('categories', 'products'));
    }
    // страница продукта
    public function product($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product', compact('product'));
    }

}
