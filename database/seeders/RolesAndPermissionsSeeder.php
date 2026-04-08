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
        // Reset cached roles and permissions (IMPORTANT!)
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            // Pet permissions
            'view pets', 'create pets', 'edit pets', 'delete pets',
            // Appointment permissions
            'view appointments', 'create appointments', 'edit appointments', 'delete appointments',
            // Medical record permissions
            'view medical records', 'create medical records', 'edit medical records', 'delete medical records',
            // User & report permissions
            'manage users', 'view reports',
        ];

        // Create permissions using firstOrCreate (safe for re-running)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Admin: gets all permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Vet: can view/edit pets, appointments, medical records
        $vetRole = Role::firstOrCreate(['name' => 'Vet']);
        $vetRole->givePermissionTo([
            'view pets', 'view appointments', 'edit appointments',
            'view medical records', 'create medical records', 'edit medical records',
        ]);

        // Receptionist: can view/create pets and appointments
        $receptionistRole = Role::firstOrCreate(['name' => 'Receptionist']);
        $receptionistRole->givePermissionTo([
            'view pets', 'create pets',
            'view appointments', 'create appointments', 'edit appointments',
        ]);

        // Client: can manage their own pets and appointments (will be enforced by policies, but give base permissions)
        $clientRole = Role::firstOrCreate(['name' => 'Client']);
        $clientRole->givePermissionTo([
            'view pets', 'create pets', 'edit pets', 'delete pets',
            'view appointments', 'create appointments', 'edit appointments',
        ]);
    }
}
