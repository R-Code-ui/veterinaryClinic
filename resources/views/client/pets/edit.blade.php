<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pet') }}: {{ $pet->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('client.pets.update', $pet) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Pet Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $pet->name) }}" class="w-full border rounded px-3 py-2" required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="species" class="block text-gray-700 font-bold mb-2">Species</label>
                            <input type="text" name="species" id="species" value="{{ old('species', $pet->species) }}" class="w-full border rounded px-3 py-2" required>
                            @error('species') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="breed" class="block text-gray-700 font-bold mb-2">Breed (optional)</label>
                            <input type="text" name="breed" id="breed" value="{{ old('breed', $pet->breed) }}" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="birth_date" class="block text-gray-700 font-bold mb-2">Birth Date (optional)</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $pet->birth_date?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Current Photo</label>
                            @if($pet->photo)
                                <img src="{{ Storage::url($pet->photo) }}" class="w-32 h-32 object-cover rounded mb-2">
                            @else
                                <p class="text-gray-500">No photo uploaded.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="photo" class="block text-gray-700 font-bold mb-2">Replace Photo (optional)</label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="w-full border rounded px-3 py-2">
                            @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('client.pets.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Pet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
