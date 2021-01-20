<?php


namespace App\Repositories;


use App\Models\Orders\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
