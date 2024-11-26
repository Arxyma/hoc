<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
                {{ __('Mentors') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('mentors.index') }}" id="sortForm" class="max-w-md">
                            <div class="flex flex-col">
                                <label for="sort" class="block text-sm font-semibold text-gray-800 mb-2 text-left">
                                    Sortir Berdasarkan
                                </label>
                                <select name="sort" id="sort"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out"
                                    onchange="document.getElementById('sortForm').submit()">
                                    <option value="">Pilih</option>
                                    <option value="name_asc"
                                        {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                        Nama (A-Z)
                                    </option>
                                    <option value="name_desc"
                                        {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                        Nama (Z-A)
                                    </option>
                                    <option value="updated_at_asc"
                                        {{ request('sort') == 'updated_at_asc' ? 'selected' : '' }}>
                                        Tanggal (Terlama)
                                    </option>
                                    <option value="updated_at_desc"
                                        {{ request('sort') == 'updated_at_desc' ? 'selected' : '' }}>
                                        Tanggal (Terbaru)
                                    </option>
                                </select>
                            </div>
                        </form>
                        <a href="{{ route('mentors.create') }}"
                            class="w-fit px-6 py-2 rounded-full bg-orange-400 text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-plus">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 12h8" />
                                <path d="M12 8v8" />
                            </svg>
                            Tambah Mentor
                        </a>
                    </div>

                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Mentor</th>
                                <th class="px-4 py-2">Foto Mentor</th>
                                @cannot('pimpinan')
                                    <th class="px-4 py-2">Aksi</th>
                                @endcannot
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mentors as $mentor)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2"><a href="{{ route('mentors.events', $mentor->id) }} " 
                                        class="text-blue-600 hover:underline">
                                        {{ $mentor->name }}
                                    </a></td>
                                    <td class="px-4 py-2">
                                        <img src="{{ asset('storage/' . $mentor->image) }}" alt="Foto Mentor"
                                            class="w-20 h-20 object-cover rounded-full">
                                    </td>
                                    @cannot('pimpinan')
                                        <td class="px-4 py-2">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('mentors.edit', $mentor) }}"
                                                    class="text-green-400 hover:text-green-600">Edit</a>
                                                    <form method="POST" action="{{ route('mentors.destroy', $mentor) }}" class="delete-form" 
                                                    onsubmit="return confirm('Are you sure you want to delete this mentor?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="delete-button text-red-400 hover:text-red-600" 
                                                        data-title="{{ $mentor->name }}">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endcannot
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No mentors found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $mentors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @elseif (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
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
