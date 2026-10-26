<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

class CartService
{
    protected CartRepositoryInterface $cartRepository;
    protected ProductRepositoryInterface $productRepository;
    public function __construct(CartRepositoryInterface $cartRepository, ProductRepositoryInterface $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }
    public function getCartData(): array
    {
        $carts = $this->cartRepository->getCartItems();
        $count = $this->cartRepository->getCartCount();
        $total_price = $this->cartRepository->getTotalPrice();

        return compact('carts', 'count', 'total_price');
    }

    public function addToCart(int $productId): void
    {
        $product = $this->productRepository->findNotNull($productId);

        $cart = $this->cartRepository->findFirst($productId);

        if ($cart) {
            if ($cart->quantity < $product->quantity) {
                $this->cartRepository->incrementQuantity($productId);
            }
        } else {
            $this->cartRepository->create($product->id);
        }
    }

    public function incrementQuantity(int $productId): void
    {
        $product = $this->productRepository->findQuantity($productId);

        $cart = $this->cartRepository->findFirst($productId);

        if ($cart && $cart->quantity < $product->quantity) {
            $this->cartRepository->incrementQuantity($productId);
        }
    }

    public function decrementQuantity(int $productId): void
    {
        $cart = $this->cartRepository->findFirst($productId);

        if ($cart) {
            if ($cart->quantity > 1) {
                $this->cartRepository->decrementQuantity($productId);
            } else {
                $this->cartRepository->delete($productId);
            }
        }
    }
}
