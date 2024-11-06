<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('berita.create') }}"
                        class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-plus"></i> Tambah Berita
                    </a>
                    <table class="table-auto w-full border-collapse text-center">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Judul</th>
                                <th class="px-4 py-2">Slug</th>
                                <th class="px-4 py-2">Isi</th>
                                <th class="px-4 py-2">Gambar</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beritas as $berita)
                                <tr>
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
                                        <a href="{{ route('berita.show', $berita->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('berita.edit', $berita->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('berita.destroy', $berita->id) }}" method="post"
                                            style="display:inline;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
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
</x-app-layout>
