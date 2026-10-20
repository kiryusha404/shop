<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCartData(int $userId): array
    {
        $carts = Cart::select(
            'products.id as id',
            'products.price as price',
            'products.name as name',
            'products.img as img',
            'cart.quantity as quantity'
        )
            ->where('id_user', $userId)
            ->join('products', 'cart.id_product', '=', 'products.id')
            ->get();

        $count = Cart::where('id_user', $userId)->count();

        $total_price = Cart::where('id_user', $userId)
            ->join('products', 'cart.id_product', '=', 'products.id')
            ->sum(DB::raw('price * cart.quantity'));

        return compact('carts', 'count', 'total_price');
    }

    public function addToCart(int $userId, int $productId): void
    {
        $product = Product::select('id', 'quantity')
            ->where('quantity', '>', 0)
            ->findOrFail($productId);

        $cart = Cart::rule($productId)->first();

        if ($cart) {
            if ($cart->quantity < $product->quantity) {
                Cart::rule($productId)->increment('quantity');
            }
        } else {
            Cart::create([
                'id_user' => $userId,
                'id_product' => $product->id,
                'quantity' => 1,
            ]);
        }
    }

    public function incrementQuantity(int $userId, int $productId): void
    {
        $product = Product::select('id', 'quantity')->findOrFail($productId);

        // Явно передаем id_user в скоуп или используем where, чтобы не было сбоев с сессией
        $cart = Cart::where('id_user', $userId)->where('id_product', $productId)->first();

        if ($cart && $cart->quantity < $product->quantity) {
            Cart::where('id_user', $userId)->where('id_product', $productId)->increment('quantity');
        }
    }

    public function decrementQuantity(int $userId, int $productId): void
    {
        $cart = Cart::where('id_user', $userId)->where('id_product', $productId)->first();

        if ($cart) {
            if ($cart->quantity > 1) {
                Cart::where('id_user', $userId)->where('id_product', $productId)->decrement('quantity');
            } else {
                Cart::where('id_user', $userId)->where('id_product', $productId)->delete();
            }
        }
    }
}
