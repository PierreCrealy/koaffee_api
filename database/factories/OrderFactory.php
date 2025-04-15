<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{

    public function definition(): array
    {

        return [
            'total' => fake()->numberBetween(1,50),
            'table' => fake()->numberBetween(1,20),
            'fidelity_pts_earned' => fake()->numberBetween(1,80),
            'status' => fake()->randomElement(Order::STATUS),

            'user_id' => fake()->numberBetween(1,6),
        ];
    }
}
