<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mentors') }}
            </h2>
            <div>
                <a href="{{ route('mentors.create') }}" class="dark:text-white hover:text-slate-200">New Mentor</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form method="GET" action="{{ route('mentors.index') }}">
                    <label for="sort" class="mr-2 text-gray-700 dark:text-gray-300">Sort by:</label>
                    <select id="sort" name="sort" onchange="this.form.submit()" class="px-4 py-2 rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                        <option value="">Select</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="updated_at_asc" {{ request('sort') == 'updated_at_asc' ? 'selected' : '' }}>Last Updated (Earliest)</option>
                        <option value="updated_at_desc" {{ request('sort') == 'updated_at_desc' ? 'selected' : '' }}>Last Updated (Latest)</option>
                    </select>
                </form>
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Mentor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto Mentor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mentors as $mentor)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $mentor->name }}
                                </th>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/' . $mentor->image) }}" alt="Foto Mentor" class="w-16 h-16 rounded-full">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('mentors.edit', $mentor) }}" class="text-green-400 hover:text-green-600">Edit</a>
                                        <form method="POST" action="{{ route('mentors.destroy', $mentor) }}" onsubmit="return confirm('Are you sure you want to delete this mentor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-600">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No mentors found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
