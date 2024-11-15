<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
                {{ __('Berita') }}
            </h2>
            <div>
                <a href="{{ route('berita.create') }}"
                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Tambah Berita
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="table-auto w-full border-collapse text-center">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Judul</th>
                                <th class="px-4 py-2">Slug</th>
                                <th class="px-4 py-2">Isi</th>
                                <th class="px-4 py-2">Gambar</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beritas as $index => $berita)
                                <tr>
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $berita->judul }}</td>
                                    <td class="px-4 py-2">{{ $berita->slug }}</td>
                                    <td class="px-4 py-2">{{ Str::limit($berita->isi_berita, 50) }}</td>
                                    <td class="px-4 py-2">
                                        @if ($berita->gambar)
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                                                class="w-20 h-20">
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('berita.edit', $berita->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('berita.destroy', $berita->id) }}" method="post"
                                            style="display:inline;" class="inline-block"
                                            id="delete-form-{{ $berita->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                onclick="confirmDelete({{ $berita->id }})">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
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
    </script>
</x-app-layout>
