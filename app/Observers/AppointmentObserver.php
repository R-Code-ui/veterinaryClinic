<?php

namespace App\Observers;

use App\Jobs\SendAppointmentConfirmation;
use App\Models\Appointment;


class AppointmentObserver
{
    public function created(Appointment $appointment): void
    {
        // Dispatch job to send email via queue
        SendAppointmentConfirmation::dispatch($appointment);
    }

    public function updated(Appointment $appointment): void
    {
        // Optional: send email when status changes to completed/cancelled
    }

    public function deleted(Appointment $appointment): void
    {
        //
    }
}
