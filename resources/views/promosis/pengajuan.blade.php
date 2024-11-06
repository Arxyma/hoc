<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Promosi Menunggu Persetujuan</h1>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Nama Produk</th>
                    <th class="py-2">Deskripsi</th>
                    <th class="py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promosis as $promosi)
                    <tr>
                        <td class="border px-4 py-2">{{ $promosi->judul }}</td>
                        <td class="border px-4 py-2">{{ $promosi->deskripsi }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('promosis.approve', $promosi->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Setujui</button>
                            </form>
                            <form action="{{ route('promosis.reject', $promosi->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
