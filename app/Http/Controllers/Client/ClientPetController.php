<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientPetController extends Controller
{
    public function index()
    {
        $pets = auth()->user()->pets;
        return view('client.pets.index', compact('pets'));
    }

    public function create()
    {
        return view('client.pets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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

        $validated['owner_id'] = auth()->id();

        Pet::create($validated);

        return redirect()->route('client.pets.index')
            ->with('success', 'Pet added successfully.');
    }

    public function edit(Pet $pet)
    {
        $this->authorize('update', $pet);
        return view('client.pets.edit', compact('pet'));
    }

    public function show(Pet $pet)
    {
        $this->authorize('view', $pet);
        return view('client.pets.show', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($pet->photo) {
                Storage::disk('public')->delete($pet->photo);
            }
            $path = $request->file('photo')->store('pets', 'public');
            $validated['photo'] = $path;
        }

        $pet->update($validated);

        return redirect()->route('client.pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);

        if ($pet->photo) {
            Storage::disk('public')->delete($pet->photo);
        }
        $pet->delete();

        return redirect()->route('client.pets.index')
            ->with('success', 'Pet deleted successfully.');
    }
}
