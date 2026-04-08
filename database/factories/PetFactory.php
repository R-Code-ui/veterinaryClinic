<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    public function definition()
    {
        return [
            'owner_id' => User::factory(),
            'name' => $this->faker->firstName(),
            'species' => $this->faker->randomElement(['Dog', 'Cat', 'Bird', 'Rabbit']),
            'breed' => $this->faker->word(),
            'birth_date' => $this->faker->date(),
            'photo' => null,
            'qr_code_path' => null,
        ];
    }
}
