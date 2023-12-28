<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'address_line1'=>fake()->address,
            'address_line2'=>fake()->address,
            'city'=>fake()->city,
            'state'=>fake()->country,
            'pincode'=>fake()->citySuffix,
        ];
    }
}
