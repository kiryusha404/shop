<?php

namespace App\Services;
use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OrderServices
{
    protected OrderRepositoryInterface $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    public function createOrder($password)
    {
        if(!Hash::check($password, Auth::user()->password)){
            throw new \Exception('Пароль неверный');
        }

        $cartItem = $this->orderRepository->getCartItems();

        if($cartItem->isEmpty()){
            throw new \Exception('Корзина пустая');
        }

        foreach($cartItem as $item){
            if($item->cart_quantity > $item->product_quantity){
                throw new \Exception('Товар ' . $item->name .  ' доступен в количестве' . $item->product_quantity);
            }
        }

        return DB::transaction(function () use ($cartItem){

            $totalPrice = 0;
            foreach($cartItem as $item){
                $totalPrice += $item->price * $item->cart_quantity;
            }

            $orderId = $this->orderRepository->createOrder($totalPrice);

            foreach ($cartItem as $item){
                $this->orderRepository->addOrderItem($orderId, $item->id_product, $item->price, $item->cart_quantity);
                $this->orderRepository->decrimentProductQuantity($item->id_product, $item->cart_quantity);
            }

            $this->orderRepository->clearCart();

            return $orderId;
        });
    }
}
