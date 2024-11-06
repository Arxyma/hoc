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
                <input type="file" name="foto_produk" id="foto_produk" class="border-gray-300 mt-1 block w-full" onchange="previewImage(event)">

                <!-- Area untuk pratinjau gambar -->
                <div class="mt-4">
                    <img id="imagePreview" src="{{ $promosi->foto_produk ? asset('storage/' . $promosi->foto_produk) : '' }}" 
                         class="w-32 h-32 object-cover rounded border {{ $promosi->foto_produk ? '' : 'hidden' }}" alt="Pratinjau Gambar">
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Promosi</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
