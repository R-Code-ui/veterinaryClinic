<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view pets', 'create pets', 'edit pets', 'delete pets',
            'view appointments', 'create appointments', 'edit appointments', 'delete appointments',
            'view medical records', 'create medical records', 'edit medical records', 'delete medical records',
            'manage users', 'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Admin
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Vet
        $vetRole = Role::firstOrCreate(['name' => 'Vet']);
        $vetRole->givePermissionTo([
            'view pets', 'view appointments', 'edit appointments',
            'view medical records', 'create medical records', 'edit medical records',
        ]);

        // Client
        $clientRole = Role::firstOrCreate(['name' => 'Client']);
        $clientRole->givePermissionTo([
            'view pets', 'create pets', 'edit pets', 'delete pets',
            'view appointments', 'create appointments', 'edit appointments',
        ]);
    }
}
