<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('client.pets.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Add New Pet
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($pets->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($pets as $pet)
                                <div class="border rounded-lg p-4 shadow">
                                    @if($pet->photo)
                                        <img src="{{ Storage::url($pet->photo) }}" class="w-full h-32 object-cover rounded mb-2">
                                    @else
                                        <div class="w-full h-32 bg-gray-200 flex items-center justify-center rounded mb-2">No photo</div>
                                    @endif
                                    <h5 class="font-bold">{{ $pet->name }}</h5>
                                    <p class="text-sm">{{ $pet->species }} @if($pet->breed) - {{ $pet->breed }} @endif</p>
                                    <div class="mt-2 flex justify-between">
                                        <a href="{{ route('client.pets.edit', $pet) }}" class="text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('client.pets.destroy', $pet) }}" method="POST" onsubmit="return confirm('Delete this pet?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">You haven't added any pets yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
