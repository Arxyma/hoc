<x-app-layout>
    <div class="container mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">All Promosi</h1>
        <a href="{{ route('promosis.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Promosi</a>

        <table class="min-w-full mt-4">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Judul</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">Upload by</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promosis as $promosi)
                    <tr>
                        <td class="border px-4 py-2">
                            @if ($promosi->foto_produk)
                                <img src="{{ asset('storage/' . $promosi->foto_produk) }}" alt="" class="w-20 h-auto">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $promosi->judul }}</td>
                        <td class="border px-4 py-2">{{ $promosi->deskripsi }}</td>
                        <td class="border px-4 py-2">{{ $promosi->user->name ?? 'Unknown' }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('promosis.edit', $promosi->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                            <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-app-layout>