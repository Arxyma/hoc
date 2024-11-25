<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Event - ') }} {{ $user->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Sort Dropdown -->
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('membership.history', $user->id) }}" id="sortForm" class="max-w-md">
                            <div class="flex flex-col">
                                <label for="sort" class="block text-sm font-semibold text-gray-800 mb-2 text-left">Sortir Berdasarkan</label>
                                <select name="sort" id="sort"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out"
                                    onchange="document.getElementById('sortForm').submit()">
                                    <option value="">Pilih</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama Event (A-Z)</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Event (Z-A)</option>
                                    <option value="tag_asc" {{ request('sort') == 'tag_asc' ? 'selected' : '' }}>Jenis Event (A-Z)</option>
                                    <option value="tag_desc" {{ request('sort') == 'tag_desc' ? 'selected' : '' }}>Jenis Event (Z-A)</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Events Table -->
                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Event</th>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Jenis Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('eventShow', $event->slug) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $event->nama_event }}
                                        </a>
                                    </td>
                                    
                                    <td class="px-4 py-2">{{ $event->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-2">{{ $event->tag }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-500">Belum mengikuti event.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
