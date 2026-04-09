<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold">Pets List</h3>
                        <a href="{{ route('admin.pets.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Add New Pet
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Photo</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Species</th>
                                <th class="border px-4 py-2">Breed</th>
                                <th class="border px-4 py-2">Owner</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pets as $pet)
                            <tr>
                                <td class="border px-4 py-2 text-center">
                                    @if($pet->photo)
                                        <img src="{{ Storage::url($pet->photo) }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <span class="text-gray-400">No image</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $pet->name }}</td>
                                <td class="border px-4 py-2">{{ $pet->species }}</td>
                                <td class="border px-4 py-2">{{ $pet->breed ?? '—' }}</td>
                                <td class="border px-4 py-2">{{ $pet->owner->name }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.pets.show', $pet) }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">View</a>
                                    <a href="{{ route('admin.pets.edit', $pet) }}"
                                       class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                    <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-2 text-center">No pets found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $pets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
