<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikedProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id'    => fake()->numberBetween(1,15),
            'product_id' => fake()->numberBetween(1,30),
        ];
    }
}
