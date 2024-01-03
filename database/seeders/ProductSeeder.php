<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::inRandomOrder()->get();
        
        $products = config('product.products');
        
        foreach ($products as $product) {
            Product::create([
                'category_id' => $categories->first()->id,
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'description' => $product['description'],
                'quantity'=>fake()->numberBetween(2,10),
            ]);
        }
    }
}
