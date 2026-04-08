<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;

class PetPolicy
{
    public function view(User $user, Pet $pet): bool
    {
        return $user->id === $pet->owner_id || $user->hasRole(['Admin', 'Vet']);
    }

    public function update(User $user, Pet $pet): bool
    {
        return $user->id === $pet->owner_id || $user->hasRole(['Admin', 'Vet']);
    }

    public function delete(User $user, Pet $pet): bool
    {
        return $user->id === $pet->owner_id || $user->hasRole(['Admin', 'Vet']);
    }

    public function create(User $user): bool
    {
        // Any logged-in client can create a pet (owner_id will be set to themselves)
        return $user->hasRole('Client') || $user->hasRole(['Admin', 'Vet']);
    }
}
