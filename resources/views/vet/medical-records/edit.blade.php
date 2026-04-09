<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Medical Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('vet.medical-records.update', $medicalRecord) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="diagnosis" class="block text-gray-700 font-bold mb-2">Diagnosis *</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('diagnosis', $medicalRecord->diagnosis) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="treatment" class="block text-gray-700 font-bold mb-2">Treatment *</label>
                            <textarea name="treatment" id="treatment" rows="3" class="w-full border rounded px-3 py-2" required>{{ old('treatment', $medicalRecord->treatment) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="prescription" class="block text-gray-700 font-bold mb-2">Prescription</label>
                            <textarea name="prescription" id="prescription" rows="2" class="w-full border rounded px-3 py-2">{{ old('prescription', $medicalRecord->prescription) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Current Document</label>
                            @if($medicalRecord->document_path)
                                <a href="{{ Storage::url($medicalRecord->document_path) }}" target="_blank" class="text-blue-500">View file</a>
                            @else
                                <p>No file uploaded.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="document" class="block text-gray-700 font-bold mb-2">Replace Document (optional)</label>
                            <input type="file" name="document" id="document" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.pets.show', $medicalRecord->pet) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
