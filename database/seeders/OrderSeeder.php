<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses=config('default.status');
        $users=User::all();
        foreach($users as $user){
           Order::create([
            'user_id'=>$user->id,
            'total_price'=>fake()->numberBetween(1000,5000),
            'status'=>fake()->randomElement($statuses),
            ]);
        }
    }
}
