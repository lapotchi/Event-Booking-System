<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\BookingStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'ticket_id' => null,
            'quantity' => fake()->numberBetween(1, 500),
            'status' => fake()->randomElement(array_column(BookingStatusEnum::cases(), 'value'))
        ];
    }
}
