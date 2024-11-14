<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Daftar Peserta untuk: ') }} {{ $event->nama_event }}
                    </h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Jumlah Peserta: {{ $countParticipants }} / {{ $kuota }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('events.exportParticipants', $event) }}" class="bg-green-500 text-white px-4 py-2 rounded">
                        Export to Excel
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sort Dropdown -->
            <div class="mb-4">
                <form method="GET" action="{{ route('events.showParticipants', $event) }}">
                    <label for="sort" class="mr-2 text-gray-700 dark:text-gray-300">Sort by:</label>
                    <select id="sort" name="sort" onchange="this.form.submit()" class="px-4 py-2 rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                        <option value="">Select</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                        <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Tanggal (Terbaru)</option>
                        <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Tanggal (Terlama)</option>
                    </select>
                </form>
            </div>

            <!-- Participants Table -->
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama Peserta</th>
                            <th scope="col" class="px-6 py-3">Usia</th>
                            <th scope="col" class="px-6 py-3">Alamat</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Nomor HP</th>
                            <th scope="col" class="px-6 py-3">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participants as $participant)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $participant->name }}</td>
                                <td class="px-6 py-4">{{ $participant->usia }}</td>
                                <td class="px-6 py-4">{{ $participant->alamat }}</td>
                                <td class="px-6 py-4">{{ $participant->email }}</td>
                                <td class="px-6 py-4">{{ $participant->no_telp }}</td>
                                <td class="px-6 py-4">{{ $participant->pivot->created_at->translatedFormat('d F Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No participants found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
