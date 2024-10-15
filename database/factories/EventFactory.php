<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $organizer = User::factory()->create(['role' => Role::ORGANIZER->value]);

        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'location' => $this->faker->address,
            'organizer_id' => $organizer->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Event $event) {
            $tickets = Ticket::factory()->count(3)->create([
                'event_id' => $event->id,
            ]);

            $tickets->each(function ($ticket) {
                Attendee::factory()->count(5)->create([
                    'ticket_id' => $ticket->id,
                ]);
            });
        });
    }
}
