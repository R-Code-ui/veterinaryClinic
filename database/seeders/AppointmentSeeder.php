<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $pets = Pet::all();
        $vets = User::role('Vet')->get();

        if ($pets->isEmpty() || $vets->isEmpty()) {
            return;
        }

        foreach ($pets as $pet) {
            // Create 1-3 appointments per pet
            $num = rand(1, 3);
            for ($i = 0; $i < $num; $i++) {
                Appointment::create([
                    'pet_id' => $pet->id,
                    'vet_id' => $vets->random()->id,
                    'appointment_date' => now()->addDays(rand(1, 30))->addHours(rand(9, 17)),
                    'reason' => fake()->sentence(),
                    'status' => fake()->randomElement(['scheduled', 'completed', 'cancelled']),
                    'notes' => fake()->optional()->text(),
                ]);
            }
        }
    }
}
