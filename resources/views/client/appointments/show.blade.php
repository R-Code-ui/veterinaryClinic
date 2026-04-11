<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('client.appointments.index') }}" class="text-blue-500 hover:underline">&larr; Back to My Appointments</a>
                    </div>

                    <div class="border rounded-lg p-6 bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold mb-4">Appointment #{{ $appointment->id }}</h3>
                                <p><strong>Pet:</strong> {{ $appointment->pet->name }}</p>
                                <p><strong>Veterinarian:</strong> Dr. {{ $appointment->vet->name }}</p>
                                <p><strong>Date & Time:</strong> {{ $appointment->appointment_date->format('F d, Y h:i A') }}</p>
                                <p><strong>Reason:</strong> {{ $appointment->reason }}</p>
                                <p><strong>Status:</strong>
                                    <span class="px-2 py-1 rounded text-xs
                                        @if($appointment->status == 'scheduled') bg-yellow-100 text-yellow-800
                                        @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </p>
                                @if($appointment->notes)
                                    <p><strong>Notes:</strong> {{ $appointment->notes }}</p>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('client.appointments.pdf', $appointment) }}"
                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    📄 Download PDF Receipt
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
