<?php

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->middleware('auth:api');
        $this->customerService = $customerService;
    }

    public function makeFavorite($product_id){
        $this->customerService->addFavorite($product_id, auth('api')->user()->customer->id);
        return response()->json([
            'message' => 'success',
            'data' => []
        ]);
    }

    public function removeFavorite($product_id){
        $this->customerService->removeFavorite($product_id, auth('api')->user()->customer->id);
        return response()->json([
            'message' => 'success',
            'data' => []
        ]);
    }

    public function favoriteProducts(){
        return response()->json([
            'message' => 'success',
            'data' => $this->customerService->favoriteProducts(auth('api')->user()->customer->id)
        ]);
    }
}
