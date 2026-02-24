<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizers = User::where('role', 'organizer')->get();

        Event::factory()->count(5)->create([
            'created_by' => $organizers->random()->id,
        ]);
    }
}
