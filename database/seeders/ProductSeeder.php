<?php

namespace Database\Seeders;

use App\Models\Products\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $products = [
            [
                'title' => 'Cappucino',
                'description' => 'Cappucino',
                'sku' => 'cpn12',
                'price' => 5.90,
                'sale_price' => 4.99,
                'quantity' => 100,
                'image' => 'images/1.jpg',
            ],
            [
                'title' => 'Latte',
                'description' => 'Latte is best',
                'sku' => 'lte390',
                'price' => 6.15,
                'sale_price' => 5.65,
                'quantity' => 100,
                'image' => 'images/2.jpg',
            ],
            [
                'title' => 'Macchiato',
                'description' => 'Macchiato is better',
                'sku' => 'macc',
                'price' => 6.55,
                'sale_price' => 5.65,
                'quantity' => 100,
                'image' => 'images/3.jpg',
            ],
        ];

        foreach ($products as $product){
            Product::firstOrCreate(['title' => $product['title']], $product);
        }
        Schema::enableForeignKeyConstraints();
    }
}
