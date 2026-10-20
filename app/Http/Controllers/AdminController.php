<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateProduct;
use App\Models\Category;
use App\Services\AdminServices;
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

    public function product_create(CreateProduct $request, AdminServices $createProduct)
    {
        $createProduct->newProduct()->createImg($request)->createOrUpdate($request)->save();
        return redirect()->back();
    }

    public function product_delete(Request $request, AdminServices $deleteProduct)
    {
        $deleteProduct->findProduct($request->id)->deleteImg($request)->delete();
        return redirect()->back();
    }

    public function update($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin_product_update', compact('product', 'categories'));

    }

    public function product_update($id, CreateProduct $request, AdminServices $updateProduct)
    {
        $updateProduct->findProduct($id)->deleteImg($request)->createImg($request)->createOrUpdate($request)->save();
        return redirect()->back();
    }
}
