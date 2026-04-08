<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Appointment') }} #{{ $appointment->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Pet</label>
                            <p class="border rounded px-3 py-2 bg-gray-100">{{ $appointment->pet->name }} ({{ $appointment->pet->owner->name }})</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Vet</label>
                            <p class="border rounded px-3 py-2 bg-gray-100">Dr. {{ $appointment->vet->name }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Date & Time</label>
                            <p class="border rounded px-3 py-2 bg-gray-100">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Reason</label>
                            <p class="border rounded px-3 py-2 bg-gray-100">{{ $appointment->reason }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                            <select name="status" id="status" class="w-full border rounded px-3 py-2">
                                <option value="scheduled" {{ $appointment->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block text-gray-700 font-bold mb-2">Internal Notes (staff only)</label>
                            <textarea name="notes" id="notes" rows="3" class="w-full border rounded px-3 py-2">{{ old('notes', $appointment->notes) }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Back</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
