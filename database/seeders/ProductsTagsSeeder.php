<?php

namespace Database\Seeders;

use App\Models\ProductsTags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Product;
use App\Models\ProductTag;

class ProductsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products=Product::all();
        foreach($products as $product){
            for($i=0;$i<2;$i++){
                ProductTag::create([
                    'product_id'=>$product->id,
                    'tag_id'=>Tag::inRandomOrder()->first()->id,
                ]);
            }
    }
    }
}
