<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    public function view(User $user, Appointment $appointment): bool
    {
        // Client can only view their own appointments (via pet owner)
        if ($user->hasRole('Client')) {
            return $user->id === $appointment->pet->owner_id;
        }
        // Admin/Vet can view all
        return $user->hasRole(['Admin', 'Vet']);
    }

    public function update(User $user, Appointment $appointment): bool
    {
        // Only Admin/Vet can update (change status, add notes)
        return $user->hasRole(['Admin', 'Vet']);
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        // Only Admin can delete
        return $user->hasRole('Admin');
    }

    public function create(User $user): bool
    {
        // Any authenticated client can create an appointment for their own pets
        return $user->hasRole('Client') || $user->hasRole(['Admin', 'Vet']);
    }
}
