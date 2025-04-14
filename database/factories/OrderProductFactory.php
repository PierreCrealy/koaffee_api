<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderProductFactory extends Factory
{

    public function definition(): array
    {

        return [
            'product_id' => fake()->numberBetween(1,30),
            'order_id'   => fake()->numberBetween(1,50),
        ];
    }
}
