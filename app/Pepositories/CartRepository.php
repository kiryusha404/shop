<?php

namespace App\Pepositories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartRepositoryInterface
{
    public function getCartItems() : Collection
    {
        return Cart::select(
        'products.id as id',
        'products.price as price',
        'products.name as name',
        'products.img as img',
        'cart.quantity as quantity'
        )
        ->where('id_user', Auth::id())
        ->join('products', 'cart.id_product', '=', 'products.id')
        ->get();
    }

    public function getCartCount(): int
    {
        return Cart::where('id_user', Auth::id())->count();
    }

    public function getTotalPrice(): float
    {
        return Cart::where('id_user', Auth::id())
            ->join('products', 'cart.id_product', '=', 'products.id')
            ->sum(DB::raw('price * cart.quantity'));
    }

    public function create(int $id): Cart
    {
        return Cart::create([
            'id_user' => Auth::id(),
            'id_product' => $id,
            'quantity' => 1,
        ]);
    }
    public function incrementQuantity(int $id_product): int
    {
        return Cart::rule($id_product)->increment('quantity');
    }
    public function decrementQuantity(int $id_product): int
    {
        return Cart::rule($id_product)->decrement('quantity');
    }
    public function delete(int $id_product): int
    {
        return Cart::rule($id_product)->delete();
    }
    public function findFirst(int $id_product): ?Cart
    {
        return Cart::rule($id_product)->first();
    }
}
