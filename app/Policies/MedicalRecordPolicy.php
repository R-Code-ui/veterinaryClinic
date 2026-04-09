<?php

namespace App\Policies;

use App\Models\MedicalRecord;
use App\Models\User;

class MedicalRecordPolicy
{
    public function view(User $user, MedicalRecord $medicalRecord): bool
    {
        // Client can only view records of their own pets
        if ($user->hasRole('Client')) {
            return $user->id === $medicalRecord->pet->owner_id;
        }
        // Admin/Vet can view all
        return $user->hasRole(['Admin', 'Vet']);
    }

    public function create(User $user): bool
    {
        // Only Admin and Vet can create medical records
        return $user->hasRole(['Admin', 'Vet']);
    }

    public function update(User $user, MedicalRecord $medicalRecord): bool
    {
        // Only Admin or the creator (vet) can update
        return $user->hasRole('Admin') || $user->id === $medicalRecord->created_by;
    }

    public function delete(User $user, MedicalRecord $medicalRecord): bool
    {
        // Only Admin can delete
        return $user->hasRole('Admin');
    }
}
