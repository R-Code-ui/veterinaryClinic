<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 5 sample users (clients)
        User::factory()->count(5)->create();

        // Create 2 vet users
        User::factory()->create([
            'name' => 'Dr. Smith',
            'email' => 'vet@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Dr. Johnson',
            'email' => 'vet2@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->call(UserSeeder::class);

        // Seed pets, appointments, medical records
        $this->call(PetSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(MedicalRecordSeeder::class);

    }
}
