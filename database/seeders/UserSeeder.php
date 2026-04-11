<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        // Admin (update if exists)
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );
        $admin->assignRole('Admin');

        // Vet (update if exists)
        $vet = User::updateOrCreate(
            ['email' => 'vet@example.com'],
            [
                'name' => 'Dr. Sarah Vet',
                'password' => bcrypt('vet123'),
                'role' => 'vet',
            ]
        );
        $vet->assignRole('Vet');

        // 5 Clients (update if exists)
        //example:
        //email: client1@example.com      password: client123
        for ($i = 1; $i <= 5; $i++) {
            $client = User::updateOrCreate(
                ['email' => "client$i@example.com"],
                [
                    'name' => "Client $i",
                    'password' => bcrypt('client123'),
                    'role' => 'client',
                ]
            );
            $client->assignRole('Client');
        }
    }
}
