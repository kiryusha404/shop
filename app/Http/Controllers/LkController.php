<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carts = Cart::select('products.id as id', 'products.price as price', 'products.name as name', 'products.img as img', 'cart.quantity as quantity')->where('id_user', Auth::id())->join('products', 'cart.id_product', 'products.id')->get();
        $count = Cart::where('id_user', Auth::id())->count();
        $total_price = Cart::where('id_user', Auth::id())->join('products', 'cart.id_product', 'products.id')->sum(DB::raw('price * cart.quantity'));
        return view('cart', compact('count', 'total_price', 'carts'));
    }
    public function add_cart(Request $request)
    {
            $product = Product::select('id', 'quantity')->where('quantity', '>', '0')->FindOrFail($request->id_product);



            try{
                $cart = new Cart;
                $cart->id_user = Auth::user()->id;
                $cart->id_product = $product->id;
                $cart->save();
            }
            catch (\Exception $exception){
                $cart = Cart::where('id_user', Auth::id())->where('id_product', $product->id)->first();
                if($cart->quantity < $product->quantity) {
                    Cart::where('id_user', Auth::id())->where('id_product', $product->id)->update(['quantity' => $cart->quantity + 1]);
                }
            }
            return redirect()->route('cart');
    }

    public function minus_cart(Request $request){
        $product = Product::select('id', 'quantity')->where('quantity', '>', '0')->FindOrFail($request->id_product);
        $cart = Cart::where('id_user', Auth::id())->where('id_product', $product->id)->first();
        try {
            Cart::where('id_user', Auth::id())->where('id_product', $product->id)->update(['quantity' => $cart->quantity - 1]);
        }
        catch (\Exception $exception){
            Cart::where('id_user', Auth::id())->where('id_product', $product->id)->delete();
        }
        return redirect()->route('cart');
    }
    public function plus_cart(Request $request){
        $product = Product::select('id', 'quantity')->where('quantity', '>', '0')->FindOrFail($request->id_product);
        $cart = Cart::where('id_user', Auth::id())->where('id_product', $product->id)->first();
        if($cart->quantity < $product->quantity) {
            Cart::where('id_user', Auth::id())->where('id_product', $product->id)->update(['quantity' => $cart->quantity + 1]);

        }
        return redirect()->route('cart');
    }
}
