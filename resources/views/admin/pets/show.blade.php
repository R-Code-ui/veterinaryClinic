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
                    <div class="mt-4">
                        <a href="{{ route('admin.pets.edit', $pet) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit Pet</a>
                        <a href="{{ route('admin.pets.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
