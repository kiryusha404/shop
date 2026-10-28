<?php

namespace App\Http\Controllers;

use App\Services\OrderServices;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Database\QueryException;

class OrderController extends Controller
{
    public function create_order(OrderStoreRequest $request, OrderServices $orderServices){

        try{
            $orderServices->createOrder($request->input('password'));
            return redirect()->back();
        }
        catch (QueryException $e) {
            return redirect()->back()->withErrors('Не получилось оформить заказ');
        }
        catch (\Exception $exception){
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }

    }
}
