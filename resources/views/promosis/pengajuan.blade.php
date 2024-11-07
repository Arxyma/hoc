<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Pengajuan Promosi</h1>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">No</th>
                    <th class="py-2">Gambar</th>
                    <th class="py-2">Nama Produk</th>
                    <th class="py-2">Deskripsi</th>
                    <th class="py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promosis as $index => $promosi)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2 flex items-center justify-center">
                            @if ($promosi->foto_produk)
                                @php
                                    // Mendekode JSON dan mengambil gambar pertama
                                    $foto_produk = json_decode($promosi->foto_produk);
                                    $foto_pertama = $foto_produk[0] ?? null;
                                @endphp
                                @if ($foto_pertama)
                                    <img src="{{ asset('storage/' . $foto_pertama) }}" alt="Foto Produk" class="w-32 h-32 object-cover">
                                @else
                                    <div class="w-32 h-32 bg-gray-200 flex items-center justify-center text-gray-500">
                                        No Image
                                    </div>
                                @endif
                            @else
                                <div class="w-32 h-32 bg-gray-200 flex items-center justify-center text-gray-500">
                                    No Image
                                </div>
                            @endif
                        </td>
                        
                        <td class="border px-4 py-2 text-center justify-center">{{ $promosi->judul }}</td>
                        <td class="border px-4 py-2 max-w-xs">{{ Str::limit(($promosi->deskripsi), 250) }}</td>
                        <td class="border px-4 py-2 text-center">
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
