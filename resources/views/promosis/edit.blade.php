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
                <input type="file" name="foto_produk[]" id="foto_produk" class="border-gray-300 mt-1 block w-full" multiple onchange="previewImages(event)">

                <!-- Area untuk pratinjau semua gambar -->
                <div class="mt-4 flex gap-2">
                    @php
                        $foto_produk = json_decode($promosi->foto_produk);
                    @endphp

                    @if($foto_produk)
                        @foreach($foto_produk as $foto)
                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Produk" class="w-32 h-32 object-cover rounded border">
                        @endforeach
                    @else
                        <p class="text-gray-500">No images available.</p>
                    @endif
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Promosi</button>
        </form>
    </div>

    <script>
        function previewImages(event) {
            const files = event.target.files;
            const previewContainer = document.querySelector('.grid');

            // Kosongkan pratinjau sebelumnya
            previewContainer.innerHTML = '';

            // Loop setiap file dan tampilkan sebagai gambar
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-32', 'h-32', 'object-cover', 'rounded', 'border');
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
</x-app-layout>
