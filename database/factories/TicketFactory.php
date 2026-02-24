<?php

namespace Database\Factories;

use App\Enums\TicketTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => null,
            'type' => fake()->randomElement(array_column(TicketTypeEnum::cases(), 'value')),
            'price' => fake()->randomFloat(2, 50, 5000),
            'quantity' => fake()->numberBetween(1, 500),
        ];
    }
}
