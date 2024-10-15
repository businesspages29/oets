<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => Role::ADMIN->value,
        ]);

        User::factory()->create([
            'name' => 'organizer',
            'email' => 'organizer@organizer.com',
            'role' => Role::ORGANIZER->value,
        ]);

        User::factory()->create([
            'name' => 'attendee',
            'email' => 'attendee@attendee.com',
            'role' => Role::ATTENDEE->value,
        ]);

        $this->call(EventSeeder::class);
    }
}
