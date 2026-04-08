<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // First, seed roles and permissions
        $this->call(RolesAndPermissionsSeeder::class);

        // Create Admin user (if not exists)
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );
        $admin->assignRole('Admin');

        // Create Vet user
        $vet = User::firstOrCreate(
            ['email' => 'vet@example.com'],
            [
                'name' => 'Dr. Sarah Vet',
                'password' => bcrypt('vet123'),
                'role' => 'vet',
            ]
        );
        $vet->assignRole('Vet');

        // Create Receptionist
        $receptionist = User::firstOrCreate(
            ['email' => 'reception@example.com'],
            [
                'name' => 'Jane Reception',
                'password' => bcrypt('reception123'),
                'role' => 'receptionist',
            ]
        );
        $receptionist->assignRole('Receptionist');

        // Create 5 regular clients (if they don't exist)
        for ($i = 1; $i <= 5; $i++) {
            $client = User::firstOrCreate(
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
