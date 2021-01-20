<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request){
        $this->orderService->save($request);
        return redirect()->route('home')->with('message', 'Order has been placed');
    }
}
