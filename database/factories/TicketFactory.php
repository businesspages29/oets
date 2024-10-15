<?php

namespace Database\Factories;

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
            'type' => $this->faker->randomElement(['Early Bird', 'Regular', 'VIP']),
            'price' => $this->faker->numberBetween(10, 200),
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}
