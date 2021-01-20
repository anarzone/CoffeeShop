<?php


namespace App\Services;


use App\Models\Orders\Order;
use App\Repositories\AddressRepository;
use App\Repositories\CartRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use MongoDB\Driver\Session;


class OrderService
{
    private $orderRepository,
            $orderItemRepository,
            $addressRepository,
            $cartRepository,
            $customerRepository
    ;

    public function __construct(OrderRepository $orderRepository,
                                OrderItemRepository $orderItemRepository,
                                AddressRepository $addressRepository,
                                CartRepository $cartRepository,
                                CustomerRepository $customerRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->addressRepository = $addressRepository;
        $this->cartRepository = $cartRepository;
        $this->customerRepository = $customerRepository;
    }

    public function save($request){
        $cartItems = $this->cartRepository->itemsByCartId(session('cartId'));
        $customer = $this->customerRepository->save(null, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $this->addressRepository->save(null, [
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'phone' => $request->phone,
            'customer_id' => $customer->id,
        ]);


        $order = $this->orderRepository->save(null, [
            'customer_id' => $customer->id,
            "shipping_address" => $request->address,
            "shipping_country" => $request->name,
            "shipping_city" => $request->name,
            "note" => $request->note ? $request->note : ' ',
            'status' => Order::STATUS_PENDING,
            'subtotal' => $request->subtotal,
            'delivery' => 0,
            'total' => $request->total,
        ]);

        foreach ($cartItems as $cartItem){
            $this->orderItemRepository->save(null, [
                'order_id' => $order->id,
                'price' => $cartItem->price,
                'product_name' => $cartItem->product->title,
                'quantity' => $cartItem->quantity,
                'image' => $cartItem->product->image
            ]);
        }

        session()->remove('cartId');
        session()->remove('guest_id');
        return $order;
    }
}
