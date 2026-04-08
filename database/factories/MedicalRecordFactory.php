<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    public function definition()
    {
        return [
            'pet_id' => Pet::factory(),
            'appointment_id' => null,
            'diagnosis' => $this->faker->sentence(),
            'treatment' => $this->faker->paragraph(),
            'prescription' => $this->faker->optional()->text(),
            'document_path' => null,
            'created_by' => User::factory(),
        ];
    }
}
