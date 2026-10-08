<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateProduct;
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

    public function product_create(CreateProduct $request)
    {

        //$request = $request->validated();

        $products = new Product();

        if($request->hasFile('img')){
            $file = $request->file('img');

            $name_img = time() . '_' . uniqid() . $file->getClientOriginalName();

            $file->move(public_path('assets/img') ,  $name_img);
            $products->img = $name_img;
        }

        $products->name = $request->input('name');
        $products->price = $request->input('price');
        $products->country = $request->input('country');
        $products->year = $request->input('year');
        $products->model = $request->input('model');
        if(!empty($request->input('quantity'))) {
            $products->quantity = $request->input('quantity');
        }
        $products->id_category = $request->input('id_category');

        $products->save();

        return redirect()->back();
    }
}
