<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    // каталог
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $products = Product::select('id', 'name', 'price', 'img')->where('quantity', '>', 0)->orderBy('id', 'desc')->paginate(5);
        return view('products', compact('categories', 'products'));
    }
    // страница продукта
    public function product($id)
    {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }
}
