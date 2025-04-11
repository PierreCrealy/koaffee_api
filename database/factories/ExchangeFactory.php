<?php

namespace Database\Factories;

use App\Services\ExchangeServices;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exchange>
 */
class ExchangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'access'       => ExchangeServices::encryptAES(fake()->randomNumber(8)),
            'login'        => ExchangeServices::encryptAES(fake()->name),
            'password'     => ExchangeServices::encryptAES(fake()->password),

            'created_at'   => fake()->dateTimeBetween('-1 years', '+1 years'),
        ];
    }
}
