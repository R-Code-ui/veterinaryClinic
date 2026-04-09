<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pet Details') }}: {{ $pet->name }}
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
                            <p><strong>Owner:</strong> {{ $pet->owner->name }} ({{ $pet->owner->email }})</p>
                            <p><strong>Member since:</strong> {{ $pet->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Medical History Section -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold">Medical History</h3>
                            @role('Admin|Vet')
                                <a href="{{ route('vet.medical-records.create', $pet) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">+ Add Medical Record</a>
                            @endrole
                        </div>

                        @if($pet->medicalRecords->count())
                            <div class="space-y-4">
                                @foreach($pet->medicalRecords as $record)
                                    <div class="border rounded-lg p-4 bg-gray-50">
                                        <div class="flex justify-between">
                                            <div>
                                                <p><strong>Date:</strong> {{ $record->created_at->format('M d, Y') }}</p>
                                                <p><strong>Diagnosis:</strong> {{ $record->diagnosis }}</p>
                                                <p><strong>Treatment:</strong> {{ $record->treatment }}</p>
                                                @if($record->prescription)
                                                    <p><strong>Prescription:</strong> {{ $record->prescription }}</p>
                                                @endif
                                                @if($record->document_path)
                                                    <p><strong>Document:</strong> <a href="{{ Storage::url($record->document_path) }}" target="_blank" class="text-blue-500">View file</a></p>
                                                @endif
                                                <p><strong>Added by:</strong> {{ $record->creator->name }}</p>
                                            </div>
                                            @role('Admin|Vet')
                                                <div>
                                                    <a href="{{ route('vet.medical-records.edit', $record) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                                                    <form action="{{ route('vet.medical-records.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Delete this record?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                                    </form>
                                                </div>
                                            @endrole
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No medical records yet.</p>
                        @endif
                    </div>

                    <!-- QR Code Section (Admin) -->
                    <div class="mt-8 border-t pt-6">
                        <h3 class="text-lg font-bold mb-4">QR Code for Pet Profile</h3>
                        <div class="flex items-center space-x-6">
                            <div class="bg-white p-4 rounded-lg shadow">
                                {!! QrCode::size(150)->generate(route('admin.pets.show', $pet->id)) !!}
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Scan this QR code to open the pet's profile page.</p>
                                <a href="{{ route('admin.pets.qrcode-png', $pet) }}"
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download QR Code (PNG)
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.pets.edit', $pet) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit Pet</a>
                        <a href="{{ route('admin.pets.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
