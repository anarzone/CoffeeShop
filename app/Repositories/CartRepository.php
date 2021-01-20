<?php


namespace App\Repositories;


use App\Models\Products\Carts\Cart;

class CartRepository extends BaseRepository
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function itemsByGuestId($guest_id){
        return $this->model->where('guest_id',$guest_id)->with(['items' => function($query){
            $query->with('product');
        }])->first();
    }

    public function itemsByCartId($cart_id){
        return $this->find($cart_id)->items;
    }
}
