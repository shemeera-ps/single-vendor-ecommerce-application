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
        $categories=Category::all();
        
        foreach($categories as $category){
            
            for($i=0;$i<20;$i++){
                $name=fake()->name;
                Product::create([
                    'category_id'=>$category->id,
                    'name'=>$name,
                    'slug'=>Str::slug($name),
                    'price'=>499.80,
                    'description'=>fake()->paragraphs(2,true),
                ]);
            }
        }
    }
}
