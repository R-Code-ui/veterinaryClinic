<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    public function definition()
    {
        return [
            'pet_id' => Pet::factory(),
            'vet_id' => User::factory(),
            'appointment_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'reason' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'notes' => $this->faker->optional()->text(),
        ];
    }
}
