<x-app-layout>
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Events') }}
            </h2>
            <div>
                <a href="{{ route('events.create') }}" class="dark:text-white hover:text-slate-200">New Event</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form method="GET" action="{{ route('events.index') }}">
                    <label for="sort" class="mr-2 text-gray-700 dark:text-gray-300">Sort by:</label>
                    <select id="sort" name="sort" onchange="this.form.submit()"
                        class="px-4 py-2 rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                        <option value="">Select</option>
                        <option value="nama_event_asc" {{ request('sort') == 'nama_event_asc' ? 'selected' : '' }}>Name
                            (A-Z)</option>
                        <option value="nama_event_desc" {{ request('sort') == 'nama_event_desc' ? 'selected' : '' }}>
                            Name (Z-A)</option>
                        <option value="tanggal_mulai_asc"
                            {{ request('sort') == 'tanggal_mulai_asc' ? 'selected' : '' }}>Date (Earliest)</option>
                        <option value="tanggal_mulai_desc"
                            {{ request('sort') == 'tanggal_mulai_desc' ? 'selected' : '' }}>Date (Latest)</option>
                    </select>
                </form>
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th> <!-- Menambahkan kolom No. -->
                            <th scope="col" class="px-6 py-3">Nama Event</th>
                            <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                            <th scope="col" class="px-6 py-3">Mentor</th>
                            <th scope="col" class="px-6 py-3">Tag</th>
                            <th scope="col" class="px-6 py-3">Daftar Peserta</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }} <!-- Menampilkan nomor urut -->
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ route('eventShow', $event->slug) }}" class="text-blue-500 hover:underline">
                                        {{ $event->nama_event }}
                                    </a>
                                </th>                                
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->mentors->pluck('name')->join(', ') }}                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->tag }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('events.showParticipants', $event) }}"
                                        class="text-blue-400 hover:text-blue-600">
                                        Lihat Peserta
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('events.edit', $event) }}"
                                            class="text-green-400 hover:text-green-600">Edit</a>
                                        <form method="POST" class="text-red-400 hover:text-red-600"
                                            action="{{ route('events.destroy', $event) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('events.destroy', $event) }}"
                                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                                Delete
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No events found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
