<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function downloadAppointmentReceipt(Appointment $appointment)
    {
        if (auth()->user()->hasRole('Client') && auth()->id() !== $appointment->pet->owner_id) {
            abort(403);
        }
        $pdf = Pdf::loadView('pdf.appointment', compact('appointment'));
        return $pdf->download('appointment_receipt_' . $appointment->id . '.pdf');
    }

    public function downloadAppointmentsReport()
    {
        $appointments = Appointment::with(['pet.owner', 'vet'])
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_date', 'asc')
            ->get();
        $pdf = Pdf::loadView('pdf.appointments-report', compact('appointments'));
        return $pdf->download('appointments_report_' . today()->format('Y-m-d') . '.pdf');
    }

    public function downloadPetsMultipleRecordsReport()
    {
        $pets = Pet::withCount('medicalRecords')
            ->groupBy('pets.id')  // Fix for SQLite
            ->having('medical_records_count', '>', 2)
            ->orderBy('medical_records_count', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.pets-multiple-records', compact('pets'));
        return $pdf->download('pets_multiple_records_' . now()->format('Y-m-d') . '.pdf');
    }
}
