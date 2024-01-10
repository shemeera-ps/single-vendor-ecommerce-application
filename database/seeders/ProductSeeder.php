<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
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
                'product_type_id'=>ProductType::inRandomOrder()->first()->id,
                'category_id' => $categories->first()->id,
                'name' => $product['name'],
                'slug' => $product['slug'],
                'description' => $product['description'],
                
            ]);
        }
    }
}
