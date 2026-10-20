<?php

namespace App\Http\Controllers;

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
        $data = $cartService->getCartData(Auth::id());

        return view('cart', $data);
    }

    public function add_cart(Request $request, CartService $cartService)
    {
        $request->validate(['id_product' => 'required|exists:products,id']);

        $cartService->addToCart(Auth::id(), $request->id_product);

        return redirect()->route('cart');
    }

    public function minus_cart(Request $request, CartService $cartService)
    {
        $request->validate(['id_product' => 'required|exists:products,id']);

        $cartService->decrementQuantity(Auth::id(), $request->id_product);

        return redirect()->route('cart');
    }

    public function plus_cart(Request $request, CartService $cartService)
    {
        $request->validate(['id_product' => 'required|exists:products,id']);

        $cartService->incrementQuantity(Auth::id(), $request->id_product);

        return redirect()->route('cart');
    }
}
