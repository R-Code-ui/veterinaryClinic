<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pets with More Than 2 Medical Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Pets with >2 Medical Records</h3>
                        <a href="{{ route('admin.reports.pets-multiple-records.pdf') }}"
                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            📄 Export to PDF
                        </a>
                    </div>

                    @if($pets->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border">
                                <thead>
                                    <tr>
                                        <th class="border px-4 py-2">Pet Name</th>
                                        <th class="border px-4 py-2">Species</th>
                                        <th class="border px-4 py-2">Owner</th>
                                        <th class="border px-4 py-2">Medical Records Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pets as $pet)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $pet->name }}</td>
                                        <td class="border px-4 py-2">{{ $pet->species }}</td>
                                        <td class="border px-4 py-2">{{ $pet->owner->name }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $pet->medical_records_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No pets have more than 2 medical records.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
