<?php

namespace App\Http\Controllers\Vet;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function create(Pet $pet)
    {
        $this->authorize('create', MedicalRecord::class);
        $completedAppointments = Appointment::where('pet_id', $pet->id)
            ->where('status', 'completed')
            ->get();
        return view('vet.medical-records.create', compact('pet', 'completedAppointments'));
    }

    public function store(Request $request, Pet $pet)
    {
        $this->authorize('create', MedicalRecord::class);

        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'diagnosis' => 'required|string|max:500',
            'treatment' => 'required|string|max:500',
            'prescription' => 'nullable|string|max:500',
            'document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB
        ]);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('medical-records', 'public');
            $validated['document_path'] = $path;
        }

        $validated['pet_id'] = $pet->id;
        $validated['created_by'] = auth()->id();

        MedicalRecord::create($validated);

        return redirect()->route('admin.pets.show', $pet)
            ->with('success', 'Medical record added successfully.');
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $this->authorize('update', $medicalRecord);
        return view('vet.medical-records.edit', compact('medicalRecord'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $this->authorize('update', $medicalRecord);

        $validated = $request->validate([
            'diagnosis' => 'required|string|max:500',
            'treatment' => 'required|string|max:500',
            'prescription' => 'nullable|string|max:500',
            'document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($request->hasFile('document')) {
            if ($medicalRecord->document_path) {
                Storage::disk('public')->delete($medicalRecord->document_path);
            }
            $path = $request->file('document')->store('medical-records', 'public');
            $validated['document_path'] = $path;
        }

        $medicalRecord->update($validated);

        return redirect()->route('admin.pets.show', $medicalRecord->pet)
            ->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $this->authorize('delete', $medicalRecord);
        if ($medicalRecord->document_path) {
            Storage::disk('public')->delete($medicalRecord->document_path);
        }
        $medicalRecord->delete();
        return redirect()->back()->with('success', 'Medical record deleted.');
    }
}
