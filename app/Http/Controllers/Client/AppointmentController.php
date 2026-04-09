<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $petIds = Auth::user()->pets->pluck('id');
        $appointments = Appointment::whereIn('pet_id', $petIds)
            ->with(['pet', 'vet'])
            ->orderBy('appointment_date', 'desc')
            ->get();
        return view('client.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $petIds = Auth::user()->pets->pluck('id');
        if (!$petIds->contains($appointment->pet_id)) {
            abort(403, 'You cannot view this appointment.');
        }
        return view('client.appointments.show', compact('appointment'));
    }

    public function create()
    {
        $pets = Auth::user()->pets;
        $vets = User::role('Vet')->get();
        return view('client.appointments.create', compact('pets', 'vets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'vet_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
            'reason' => 'required|string|max:500',
        ]);

        $pet = Auth::user()->pets()->find($validated['pet_id']);
        if (!$pet) {
            abort(403, 'You cannot book an appointment for a pet you do not own.');
        }

        $validated['status'] = 'scheduled';
        $validated['notes'] = null;

        Appointment::create($validated);

        return redirect()->route('client.appointments.index')
            ->with('success', 'Appointment booked successfully.');
    }
}
