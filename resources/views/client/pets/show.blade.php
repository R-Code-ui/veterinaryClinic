<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Pet') }}: {{ $pet->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex">
                        <div class="w-1/3">
                            @if($pet->photo)
                                <img src="{{ Storage::url($pet->photo) }}" class="w-full rounded-lg shadow">
                            @else
                                <div class="bg-gray-200 h-48 flex items-center justify-center rounded-lg">No photo</div>
                            @endif
                        </div>
                        <div class="w-2/3 pl-6">
                            <p><strong>Name:</strong> {{ $pet->name }}</p>
                            <p><strong>Species:</strong> {{ $pet->species }}</p>
                            <p><strong>Breed:</strong> {{ $pet->breed ?? '—' }}</p>
                            <p><strong>Birth Date:</strong> {{ $pet->birth_date?->format('M d, Y') ?? '—' }}</p>
                            <p><strong>Member since:</strong> {{ $pet->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Medical History Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-bold mb-4">Medical History</h3>
                        @if($pet->medicalRecords->count())
                            <div class="space-y-4">
                                @foreach($pet->medicalRecords as $record)
                                    <div class="border rounded-lg p-4 bg-gray-50">
                                        <p><strong>Date:</strong> {{ $record->created_at->format('M d, Y') }}</p>
                                        <p><strong>Diagnosis:</strong> {{ $record->diagnosis }}</p>
                                        <p><strong>Treatment:</strong> {{ $record->treatment }}</p>
                                        @if($record->prescription)
                                            <p><strong>Prescription:</strong> {{ $record->prescription }}</p>
                                        @endif
                                        @if($record->document_path)
                                            <p><strong>Document:</strong> <a href="{{ Storage::url($record->document_path) }}" target="_blank" class="text-blue-500">View file</a></p>
                                        @endif
                                        @if($record->appointment)
                                            <p><strong>Linked Appointment:</strong> {{ $record->appointment->appointment_date->format('M d, Y') }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No medical records yet.</p>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('client.pets.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to My Pets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
