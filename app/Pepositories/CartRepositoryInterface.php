<?php

namespace App\Pepositories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface CartRepositoryInterface
{
    public function getCartItems(): Collection;
    public function getCartCount(): int;
    public function getTotalPrice(): float;
    public function findFirst(int $id_product): ?Cart;
    public function create(int $id): Cart;
    public function incrementQuantity(int $id_product): int;
    public function decrementQuantity(int $id_product): int;
    public function delete(int $id_product): int;
}
