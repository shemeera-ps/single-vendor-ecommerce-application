<?php

namespace Database\Seeders;

use App\Models\AddressTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addressTags = config('default.addressTag');
        foreach($addressTags as $tag){
            
            AddressTag::create([
                'tag'=>$tag,
            ]);
        }

    }
}
