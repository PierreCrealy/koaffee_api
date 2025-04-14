<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    public function definition(): array
    {

        return [
            'name'        => fake()->name(),
            'description' => fake()->text(100),
            'category'    => fake()->randomElement(Product::CATEGORIES),
            'price'       => fake()->numberBetween(1,20),

            'highlight'        => fake()->boolean(),
            'fidelity_program' => fake()->boolean(),
            'proposed'         => fake()->boolean(),

        ];
    }
}
