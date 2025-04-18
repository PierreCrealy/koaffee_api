<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name'        => fake()->name(),
            'description' => fake()->text(100),
            'price'       => fake()->numberBetween(10,120),

            'highlight'        => fake()->boolean(),
            'proposed'         => fake()->boolean(),
        ];
    }
}
