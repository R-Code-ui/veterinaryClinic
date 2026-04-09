<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    public function run()
    {
        $pets = Pet::all();
        $vets = User::role('Vet')->get();

        if ($pets->isEmpty() || $vets->isEmpty()) {
            return;
        }

        foreach ($pets as $pet) {
            // Create 1-3 medical records per pet
            $num = rand(1, 3);
            for ($i = 0; $i < $num; $i++) {
                MedicalRecord::create([
                    'pet_id' => $pet->id,
                    'appointment_id' => null,
                    'diagnosis' => fake()->sentence(3),
                    'treatment' => fake()->paragraph(1),
                    'prescription' => fake()->optional()->sentence(5),
                    'document_path' => null,
                    'created_by' => $vets->random()->id,
                ]);
            }
        }
    }
}
