<?php

namespace Database\Factories;

use App\Enums\ExchangeStatusEnum;
use App\Models\Exchange;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status'       => ExchangeStatusEnum::Pending,
            'exchange_id'  => Exchange::all()->random()->id,
            'created_at'   => fake()->dateTimeBetween('-1 years', '+1 years'),
        ];
    }
}
