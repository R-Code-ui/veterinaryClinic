<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    /**
     * Display a listing of the pets.
     */
    public function index()
    {
        $pets = Pet::with('owner')->latest()->paginate(10);
        return view('admin.pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new pet.
     */
    public function create()
    {
        $owners = User::role('Client')->get(); // only clients can be owners
        return view('admin.pets.create', compact('owners'));
    }

    /**
     * Store a newly created pet in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('pets', 'public');
            $validated['photo'] = $path;
        }

        Pet::create($validated);

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet created successfully.');
    }

    /**
     * Display the specified pet.
     */
    public function show(Pet $pet)
    {
        return view('admin.pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified pet.
     */
    public function edit(Pet $pet)
    {
        $owners = User::role('Client')->get();
        return view('admin.pets.edit', compact('pet', 'owners'));
    }

    /**
     * Update the specified pet in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($pet->photo) {
                Storage::disk('public')->delete($pet->photo);
            }
            $path = $request->file('photo')->store('pets', 'public');
            $validated['photo'] = $path;
        }

        $pet->update($validated);

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    /**
     * Remove the specified pet from storage.
     */
    public function destroy(Pet $pet)
    {
        if ($pet->photo) {
            Storage::disk('public')->delete($pet->photo);
        }
        $pet->delete();

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet deleted successfully.');
    }
}
