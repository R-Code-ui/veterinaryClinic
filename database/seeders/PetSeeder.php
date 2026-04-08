<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run()
    {
        $clients = User::where('role', 'client')->get();

        if ($clients->isEmpty()) {
            $client = User::create([
                'name' => 'Default Client',
                'email' => 'default@example.com',
                'password' => bcrypt('password'),
                'role' => 'client',
            ]);
            if (class_exists(\Spatie\Permission\Models\Role::class)) {
                $client->assignRole('Client');
            }
            $clients = collect([$client]);
        }

        $speciesList = ['Dog', 'Cat', 'Bird', 'Rabbit', 'Hamster'];
        $breedsList = [
            'Dog' => ['Labrador', 'Beagle', 'Bulldog', 'Poodle', 'Golden Retriever'],
            'Cat' => ['Persian', 'Maine Coon', 'Siamese', 'Bengal'],
            'Bird' => ['Cockatiel', 'Parakeet', 'African Grey'],
            'Rabbit' => ['Holland Lop', 'Netherland Dwarf'],
            'Hamster' => ['Syrian', 'Dwarf']
        ];

        $imageList = [
            'pets/dialga.png',
            'pets/diglett.png',
            'pets/heatran.png',
            'pets/palkia.png',
            'pets/rayquaza.png',
        ];

        foreach ($clients as $client) {
            $numPets = rand(2, 4);
            for ($i = 0; $i < $numPets; $i++) {
                $species = $speciesList[array_rand($speciesList)];
                $breeds = $breedsList[$species] ?? ['Mixed'];
                $breed = $breeds[array_rand($breeds)];
                $randomImage = $imageList[array_rand($imageList)];

                Pet::create([
                    'owner_id' => $client->id,
                    'name' => fake()->firstName(),
                    'species' => $species,
                    'breed' => $breed,
                    'birth_date' => fake()->dateTimeBetween('-10 years', 'now'),
                    'photo' => $randomImage,
                ]);
            }
        }
    }
}
