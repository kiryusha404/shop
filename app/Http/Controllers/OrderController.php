<?php

namespace App\Http\Controllers;

use App\Services\OrderServices;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;

class OrderController extends Controller
{
    public function create_order(OrderStoreRequest $request, OrderServices $orderServices){

        return redirect()->back();
    }
}
