<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Promosi</h1>

        <form action="{{ route('promosis.update', $promosi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium">Nama Produk</label>
                <input type="text" name="judul" value="{{ $promosi->judul }}" class="border-gray-300 mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium">Deskripsi Produk</label>
                <textarea name="deskripsi" class="border-gray-300 mt-1 block w-full" rows="5" required>{{ $promosi->deskripsi }}</textarea>
            </div>

            <div class="mb-4">
                <label for="foto_produk" class="block text-sm font-medium">Foto Produk</label>
                <input type="file" name="foto_produk" class="border-gray-300 mt-1 block w-full">
                @if ($promosi->foto_produk)
                    <img src="{{ asset('storage/' . $promosi->foto_produk) }}" alt="Image" class="w-20 h-auto mt-2">
                @endif
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Promosi</button>
        </form>
    </div>
</x-app-layout>