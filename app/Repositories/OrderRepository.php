<?php

namespace App\Repositories;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{

    public function getCartItems(): Collection
    {
        return Cart::join('products', 'cart.id_product', 'products.id')
            ->where('cart.id_user', Auth::id())
            ->select(
                'cart.id_product',
                'cart.quantity as cart_quantity',
                'products.quantity as product_quantity',
                'products.price',
                'products.name'
            )->get();
    }

    public function createOrder(float $totalPrice) : int
    {
        $order = Order::create([
            'id_user' => Auth::id(),
            'id_status' => 1,
            'total_price' => $totalPrice,
        ]);

        return $order->id;
    }

    public function addOrderItem(int $orderId, int $productId, float $price, int $quantity): bool
    {
        return OrderItem::insert([
            'id_order' => $orderId,
            'id_product' => $productId,
            'price' => $price,
            'quantity' => $quantity,
        ]);
    }

    public function decrimentProductQuantity(int $productId, int $quantity): int
    {
        return Product::where('id', $productId)->decrement('quantity', $quantity);
    }
    public function clearCart(): int
    {
        return Cart::where('id_user', Auth::id())->delete();
    }
}
