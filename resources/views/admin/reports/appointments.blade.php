<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments Report - Today') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Appointments for {{ now()->format('F d, Y') }}</h3>
                        <a href="{{ route('admin.reports.appointments.pdf') }}"
                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            📄 Export to PDF
                        </a>
                    </div>

                    @if($appointments->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border">
                                <thead>
                                    <tr>
                                        <th class="border px-4 py-2">Time</th>
                                        <th class="border px-4 py-2">Pet</th>
                                        <th class="border px-4 py-2">Owner</th>
                                        <th class="border px-4 py-2">Vet</th>
                                        <th class="border px-4 py-2">Reason</th>
                                        <th class="border px-4 py-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $appointment->appointment_date->format('h:i A') }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->pet->name }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->pet->owner->name }}</td>
                                        <td class="border px-4 py-2">Dr. {{ $appointment->vet->name }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->reason }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst($appointment->status) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No appointments scheduled for today.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
