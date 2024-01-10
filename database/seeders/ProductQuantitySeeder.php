<?php

namespace Database\Seeders;

use App\Models\Quantity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductQuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products=Product::all();
        foreach($products as $product){
            Quantity::create([
                'product_id'=>$product->id,
                'quantity'=>fake()->numberBetween(1,10),
            ]);
        }
    }
}
