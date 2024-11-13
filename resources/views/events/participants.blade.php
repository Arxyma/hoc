<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Daftar Peserta untuk : ') }} {{ $event->nama_event }}
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
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Peserta</th>
                            <th scope="col" class="px-6 py-3">Usia</th>
                            <th scope="col" class="px-6 py-3">Alamat</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participants as $participant)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $participant->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $participant->usia }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $participant->alamat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $participant->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $participant->no_telp }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
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
