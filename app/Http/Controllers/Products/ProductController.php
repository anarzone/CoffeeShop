<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class ProductController extends Controller
{
    private $productService, $cartService;

    public function __construct(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function index(){
        return view('pages.index', $this->productService->index());
    }

    public function checkout(){
        $items = $this->cartService->items(session()->has('guest_id') ? session()->get('guest_id') : null)->items;
        return view('pages.checkout', [
            'items' => $items,
            'total' => $this->calcSalePrice($items)
        ]);
    }

    function calcSalePrice($items){
        $total = 0;
        foreach ($items as $item){
            $total += $item->product->sale_price;
        }

        return $total;
    }
}
