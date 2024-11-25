<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
                {{ __('Events') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('events.index') }}" id="sortForm" class="max-w-md">
                            <div class="flex flex-col">
                                <label for="sort" class="block text-sm font-semibold text-gray-800 mb-2 text-left">
                                    Sortir Berdasarkan
                                </label>
                                <select name="sort" id="sort"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out"
                                    onchange="document.getElementById('sortForm').submit()">
                                    <option value="">Pilih</option>
                                    <option value="nama_event_asc"
                                        {{ request('sort') == 'nama_event_asc' ? 'selected' : '' }}>
                                        Nama (A-Z)
                                    </option>
                                    <option value="nama_event_desc"
                                        {{ request('sort') == 'nama_event_desc' ? 'selected' : '' }}>
                                        Nama (Z-A)
                                    </option>
                                    <option value="tanggal_mulai_asc"
                                        {{ request('sort') == 'tanggal_mulai_asc' ? 'selected' : '' }}>
                                        Tanggal (Terlama)
                                    </option>
                                    <option value="tanggal_mulai_desc"
                                        {{ request('sort') == 'tanggal_mulai_desc' ? 'selected' : '' }}>
                                        Tanggal (Terbaru)
                                    </option>
                                </select>
                            </div>
                        </form>

                        <a href="{{ route('events.create') }}"
                            class="w-fit px-6 py-2 rounded-full bg-orange-400 text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 12h8" />
                                <path d="M12 8v8" />
                            </svg>
                            Tambah Event
                        </a>
                    </div>

                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Event</th>
                                <th class="px-4 py-2">Tanggal Mulai</th>
                                <th class="px-4 py-2">Mentor</th>
                                <th class="px-4 py-2">Tag</th>
                                <th class="px-4 py-2">Daftar Peserta</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $index => $event)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('eventShow', $event->slug) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $event->nama_event }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $event->mentors->pluck('name')->join(', ') }}
                                    </td>
                                    <td class="px-4 py-2">{{ $event->tag }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('events.showParticipants', $event) }}"
                                            class="text-blue-400 hover:text-blue-600">
                                            Lihat Peserta
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('events.edit', $event) }}"
                                                class="text-green-400 hover:text-green-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="delete-form" id="delete-form-{{ $event->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" 
                                                   class="delete-button text-red-400 hover:text-red-600" 
                                                   data-title="{{ $event->nama_event }}">
                                                    Hapus
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">Tidak ada event</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('message') || session('berhasil'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('message'))
                    Swal.fire({
                        title: 'Informasi',
                        text: "{{ session('message') }}",
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                @endif

                @if (session('berhasil'))
                    Swal.fire({
                        title: 'Sukses!',
                        text: "{{ session('berhasil') }}",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                @endif
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
    
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = this.getAttribute('data-title'); // Ambil judul event dari atribut data-title
    
                    Swal.fire({
                        title: `Hapus <span style="font-weight: bold; color: red;">${title}</span> ?`,
                        text: "Item akan dihapus permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Yakin Hapus'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('.delete-form').submit(); // Submit form untuk hapus event
                        }
                    });
                });
            });
        });
    </script>
    
</x-app-layout>
