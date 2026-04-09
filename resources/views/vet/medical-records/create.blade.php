<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Medical Record for') }}: {{ $pet->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('vet.medical-records.store', $pet) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="appointment_id" class="block text-gray-700 font-bold mb-2">Linked Appointment (optional)</label>
                            <select name="appointment_id" id="appointment_id" class="w-full border rounded px-3 py-2">
                                <option value="">None</option>
                                @foreach($completedAppointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->appointment_date->format('M d, Y') }} - {{ $appointment->reason }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="diagnosis" class="block text-gray-700 font-bold mb-2">Diagnosis *</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('diagnosis') }}</textarea>
                            @error('diagnosis') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="treatment" class="block text-gray-700 font-bold mb-2">Treatment *</label>
                            <textarea name="treatment" id="treatment" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('treatment') }}</textarea>
                            @error('treatment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prescription" class="block text-gray-700 font-bold mb-2">Prescription (optional)</label>
                            <textarea name="prescription" id="prescription" rows="2" class="w-full border rounded px-3 py-2">{{ old('prescription') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="document" class="block text-gray-700 font-bold mb-2">Upload Document (image/PDF, max 5MB)</label>
                            <input type="file" name="document" id="document" class="w-full border rounded px-3 py-2">
                            @error('document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.pets.show', $pet) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
