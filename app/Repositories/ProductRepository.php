<?php


namespace App\Repositories;


use App\Models\Products\Product;
use App\Repositories\Contractors\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

}
