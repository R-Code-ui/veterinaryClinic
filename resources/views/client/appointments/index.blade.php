<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('client.appointments.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Book Appointment
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($appointments->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border">
                                <thead>
                                    <tr>
                                        <th class="border px-4 py-2">Pet</th>
                                        <th class="border px-4 py-2">Vet</th>
                                        <th class="border px-4 py-2">Date & Time</th>
                                        <th class="border px-4 py-2">Reason</th>
                                        <th class="border px-4 py-2">Status</th>
                                        <th class="border px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $appointment->pet->name }}</td>
                                        <td class="border px-4 py-2">Dr. {{ $appointment->vet->name }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->reason }}</td>
                                        <td class="border px-4 py-2">
                                            <span class="px-2 py-1 rounded text-xs
                                                @if($appointment->status == 'scheduled') bg-yellow-100 text-yellow-800
                                                @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('client.appointments.show', $appointment) }}"
                                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">You have no appointments. Click "Book Appointment" to schedule one.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
