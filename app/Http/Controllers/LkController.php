<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProduct;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CartService $cartService)
    {
        $data = $cartService->getCartData();

        return view('cart', $data);
    }

    public function add_cart(AddProduct $request, CartService $cartService)
    {
        $cartService->addToCart($request->id_product);

        return redirect()->route('cart');
    }

    public function minus_cart(AddProduct $request, CartService $cartService)
    {
        $cartService->decrementQuantity($request->id_product);

        return redirect()->route('cart');
    }

    public function plus_cart(AddProduct $request, CartService $cartService)
    {
        $cartService->incrementQuantity($request->id_product);

        return redirect()->route('cart');
    }
}
