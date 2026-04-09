<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                    <!-- Quick Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-blue-800">Total Pets</h4>
                            <p class="text-2xl">{{ \App\Models\Pet::count() }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-green-800">Total Appointments</h4>
                            <p class="text-2xl">{{ \App\Models\Appointment::count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-yellow-800">Scheduled Appointments</h4>
                            <p class="text-2xl">{{ \App\Models\Appointment::where('status', 'scheduled')->count() }}</p>
                        </div>
                    </div>

                    <!-- Complex Query 1: Top 3 Breeds -->
                    <div class="mt-8">
                        <h4 class="text-md font-semibold mb-2">🏆 Top 3 Pet Breeds (Completed Appointments - Last 30 Days)</h4>
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            @if($topBreeds->count())
                                <table class="min-w-full">
                                    <thead>
                                        <tr><th class="text-left">Breed</th><th class="text-left">Appointments</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topBreeds as $breed)
                                        <tr class="border-b">
                                            <td class="py-2">{{ $breed->breed }}</td>
                                            <td class="py-2">{{ $breed->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-gray-500">No completed appointments in the last 30 days.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Complex Query 2: Appointments per Vet (Monthly) -->
                    <div class="mt-8">
                        <h4 class="text-md font-semibold mb-2">📊 Appointments per Vet (Last 6 Months)</h4>
                        <div class="bg-gray-50 p-4 rounded-lg shadow overflow-x-auto">
                            @if($appointmentsPerVet->count())
                                <table class="min-w-full">
                                    <thead>
                                        <tr><th>Vet</th><th>Month</th><th>Total</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($appointmentsPerVet as $item)
                                        <tr class="border-b">
                                            <td class="py-2">Dr. {{ $item->vet_name }}</td>
                                            <td class="py-2">{{ \Carbon\Carbon::parse($item->month)->format('M Y') }}</td>
                                            <td class="py-2">{{ $item->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-gray-500">No appointment data available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-md font-semibold mb-2">Quick Links</h4>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.pets.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manage Pets</a>
                            <a href="{{ route('admin.appointments.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Manage Appointments</a>
                            <a href="{{ route('admin.reports.pets-multiple-records') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Pets with >2 Medical Records</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
