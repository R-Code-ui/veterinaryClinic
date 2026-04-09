<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Pet;

class ReportController extends Controller
{
    public function todayAppointments()
    {
        $appointments = Appointment::with(['pet.owner', 'vet'])
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_date', 'asc')
            ->get();
        return view('admin.reports.appointments', compact('appointments'));
    }

    public function petsWithMultipleRecords()
    {
        $pets = Pet::withCount('medicalRecords')
            ->groupBy('pets.id')  // Fix for SQLite
            ->having('medical_records_count', '>', 2)
            ->orderBy('medical_records_count', 'desc')
            ->get();
        return view('admin.reports.pets-multiple-records', compact('pets'));
    }
}
