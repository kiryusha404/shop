<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    // каталог
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $query = Product::select('id', 'name', 'price', 'img', 'id_category' , 'quantity')->where('quantity', '>', 0);

        if($request->filled('category') && $request->category != 0) {
            $query->where('id_category', $request->category);
        }

        switch ($request->input('sort')) {
            case '2':
                $query->orderBy('price', 'desc');
                break;
            case '3':
                $query->orderBy('price', 'asc');
                break;
            case '4':
                $query->orderBy('quantity', 'desc');
                break;
            case '5':
                $query->orderBy('quantity', 'asc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        $products = $query->paginate(12);

        return view('products', compact('categories', 'products'));
    }
    // страница продукта
    public function product($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product', compact('product'));
    }

}
