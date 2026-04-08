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

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                        <!-- Quick Stats Card -->
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

                    <div class="mt-8">
                        <h4 class="text-md font-semibold mb-2">Quick Links</h4>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.pets.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manage Pets</a>
                            <a href="{{ route('admin.appointments.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Manage Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
