<?php


namespace App\Services;


use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Session;


class CartService
{
    private $cartRepository,
            $cartItemRepository;

    public function __construct(CartRepository $cartRepository,
                                CartItemRepository $cartItemRepository

    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function items($guest_id){
        return $this->cartRepository->itemsByGuestId($guest_id);
    }

    public function saveItem($request){
        if (!Session::has('guest_id')){
            Session::put('guest_id',time());

            Session::put('cartId', $this->cartRepository->save(null, [
                'guest_id' => Session::get('guest_id')
            ])->id);
        }

        return $this->cartItemRepository->save(null, [
            'cart_id' => Session::get('cartId'),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    }

    public function updateQuantity($id, $quantity){
        return $this->cartItemRepository->save($id, [
            'quantity' => $quantity
        ]);
    }

    public function deleteItem($itemId){
        return $this->cartItemRepository->delete($itemId);
    }
}
