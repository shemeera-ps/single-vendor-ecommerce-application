<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products=Product::all();
        foreach($products as $product){
            for($i=0;$i<2;$i++){
                DB::table('product_tag')->insert([
                    'product_id'=>$product->id,
                    'tag_id'=>Tag::inRandomOrder()->first()->id,
                ]);
            }
    }
    }
}
