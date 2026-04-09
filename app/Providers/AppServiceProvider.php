<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Pet;
use App\Policies\PetPolicy;
use App\Models\MedicalRecord;
use App\Policies\MedicalRecordPolicy;
use App\Models\Appointment;
use App\Observers\AppointmentObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Pet::class, PetPolicy::class);
        Gate::policy(MedicalRecord::class, MedicalRecordPolicy::class);

        // Register the observer for Appointment model
        Appointment::observe(AppointmentObserver::class);
    }
}
