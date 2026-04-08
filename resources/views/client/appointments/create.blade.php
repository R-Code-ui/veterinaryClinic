<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book an Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('client.appointments.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="pet_id" class="block text-gray-700 font-bold mb-2">Select Pet</label>
                            <select name="pet_id" id="pet_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Choose a pet</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                        {{ $pet->name }} ({{ $pet->species }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="vet_id" class="block text-gray-700 font-bold mb-2">Select Veterinarian</label>
                            <select name="vet_id" id="vet_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Choose a vet</option>
                                @foreach($vets as $vet)
                                    <option value="{{ $vet->id }}" {{ old('vet_id') == $vet->id ? 'selected' : '' }}>
                                        Dr. {{ $vet->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vet_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="appointment_date" class="block text-gray-700 font-bold mb-2">Date & Time</label>
                            <input type="datetime-local" name="appointment_date" id="appointment_date"
                                   value="{{ old('appointment_date') }}" class="w-full border rounded px-3 py-2" required>
                            @error('appointment_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="reason" class="block text-gray-700 font-bold mb-2">Reason for Visit</label>
                            <textarea name="reason" id="reason" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('reason') }}</textarea>
                            @error('reason') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('client.appointments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Book Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
