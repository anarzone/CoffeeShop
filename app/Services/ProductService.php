<?php


namespace App\Services;

use App\Models\Products\Product;
use App\Repositories\ProductRepository;


class ProductService
{

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(){
        return [
            'products' => $this->productRepository->all()
        ];
    }

    public function checkout(){

    }
}
