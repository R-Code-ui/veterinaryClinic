<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['pet.owner', 'vet'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(15);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }
}
