<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes =config('attributes.attributes');
        foreach($attributes as  $attribute=>$value){
            Attribute::create([
                "attribute"=>$attribute,
                'values'=>json_encode($value)
                
            ]);
        }
    }
}
