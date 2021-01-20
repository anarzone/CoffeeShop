<?php

namespace App\Http\Controllers\Products\Carts;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(){
        return response()->json([
            'message' => 'success',
            'data' => $this->cartService->items(session()->has('guest_id') ? session()->get('guest_id') : null),
        ]);
    }

    public function storeItem(Request $request){
        $validated = Validator::make($request->all(),[
            'product_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validated->fails()){
            return response([
                'message' => 'error',
                'data' => [
                    'errors' => $validated->getMessageBag()
                ]
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $this->cartService->saveItem($request),
        ], Response::HTTP_CREATED);
    }


    public function deleteItem($itemId){
        $this->cartService->deleteItem($itemId);

        return response()->json([
            'message' => 'success',
            'data' => []
        ]);
    }
}
