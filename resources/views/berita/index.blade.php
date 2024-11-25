<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
                {{ __('Berita') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('berita.index') }}" id="sortForm" class="max-w-md">
                            <div class="flex flex-col">
                                <label for="sort"
                                    class="block text-sm font-semibold text-gray-800 mb-2 text-left">Sortir
                                    Berdasarkan</label>
                                <select name="sort" id="sort"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out"
                                    onchange="document.getElementById('sortForm').submit()">
                                    <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>
                                        Terbaru</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama
                                    </option>
                                </select>
                            </div>
                        </form>

                        <a href="{{ route('berita.create') }}"
                            class="w-fit px-6 py-2 rounded-full bg-orange-400 text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-plus">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 12h8" />
                                <path d="M12 8v8" />
                            </svg>
                            Tambah Berita
                        </a>
                    </div>

                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Judul</th>
                                <th class="px-4 py-2">Isi Berita</th>
                                <th class="px-4 py-2">Gambar</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beritas as $index => $berita)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('beritaTampil', $berita->slug) }}"
                                            class="text-blue-600 hover:underline">{{ $berita->judul }}</a>
                                    </td>
                                    <td class="px-4 py-2">{{ Str::limit($berita->isi_berita, 100) }}</td>
                                    <td class="px-4 py-2">
                                        @if ($berita->gambar)
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                                                class="w-20 h-20 object-cover">
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('berita.edit', $berita->id) }}"
                                                class="text-green-400 hover:text-green-600">Edit</a>
                                            <form action="{{ route('berita.destroy', $berita->id) }}" method="post"
                                                id="delete-form-{{ $berita->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" onclick="confirmDelete({{ $berita->id }})"
                                                    class="text-red-400 hover:text-red-600">Hapus</a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengkonfirmasi, kirim form
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
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
</x-app-layout>
