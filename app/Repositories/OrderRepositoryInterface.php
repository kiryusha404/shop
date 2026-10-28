<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function getCartItems(): Collection;
    public function createOrder(float $totalPrice): int;
    public function addOrderItem(int $orderId, int $productId, float $price, int $quantity): bool;
    public function decrimentProductQuantity(int $productId, int $quantity): int;
    public function clearCart(): int;
}
