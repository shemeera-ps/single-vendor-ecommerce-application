<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types=config('default.productTypes');
        foreach($types as $type){
            $randomAttributeIds = Attribute::pluck('id')->random(2);
            ProductType::create([
                'product_type'=>$type,
                'applicable_attributes'=>$randomAttributeIds,
                'description'=>fake()->paragraphs(2,true)
            ]);
            
        }
        
    }
}
