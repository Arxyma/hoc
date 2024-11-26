<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Peserta untuk: ') }} {{ $event->nama_event }}
            </h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Jumlah Peserta: {{ $countParticipants }} / {{ $kuota }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Sort Dropdown -->
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('events.showParticipants', $event) }}" id="sortForm" class="max-w-md">
                            <div class="flex flex-col">
                                <label for="sort" class="block text-sm font-semibold text-gray-800 mb-2 text-left">Sortir Berdasarkan</label>
                                <select name="sort" id="sort" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out" onchange="document.getElementById('sortForm').submit()">
                                    <option value="">Pilih</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                                    <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Tanggal (Terbaru)</option>
                                    <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Tanggal (Terlama)</option>
                                </select>
                            </div>
                        </form>
                        <div>

                            <a href="{{ route('events.pendingParticipants', $event) }}" class="bg-yellow-500 text-white px-4 py-2 rounded mr-2">
                                Lihat Presensi Peserta
                            </a>
                            <a href="{{ route('events.exportParticipants', $event) }}" class="bg-green-500 text-white px-4 py-2 rounded">
                                Export to Excel
                            </a>
                        </div>
                    </div>

                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Peserta</th>
                                <th class="px-4 py-2">Usia</th>
                                <th class="px-4 py-2">Alamat</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Nomor HP</th>
                                <th class="px-4 py-2">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $participant)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $participant->name }}</td>
                                    <td class="px-4 py-2">{{ $participant->usia }}</td>
                                    <td class="px-4 py-2">{{ $participant->alamat }}</td>
                                    <td class="px-4 py-2">{{ $participant->email }}</td>
                                    <td class="px-4 py-2">{{ $participant->no_telp }}</td>
                                    <td class="px-4 py-2">{{ $participant->pivot->created_at->translatedFormat('d F Y') }}</td>
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
    </div>
</x-app-layout>
