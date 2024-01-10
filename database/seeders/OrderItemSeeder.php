<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders=Order::all();
        foreach($orders as $order){
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>Product::inRandomOrder()->first()->id,
                'price'=>fake()->numberBetween(450,1500),
                'count'=>fake()->numberBetween(1,5),
            ]);
         }
    }
}
