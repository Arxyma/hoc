<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Riwayat Event - {{ $user->name }}</h2>

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Nama Event</th>
                    <th class="py-2 px-4 border">Tanggal</th>
                    <th class="py-2 px-4 border">Jenis Event</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $loop->iteration }} <!-- Menambahkan nomor urut -->
                        </td>
                        <td class="py-2 px-4 border">{{ $event->nama_event }}</td>
                        <td class="py-2 px-4 border">{{ $event->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4 border">{{ $event->tag }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum mengikuti event.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
