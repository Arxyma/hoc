<x-app-layout>
  <div class="container mx-auto">
      <h1 class="text-2xl font-bold mb-4">Buat promosi baru</h1>

    <form action="{{ route('promosis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium">Nama Produk</label>
            <input type="text" name="judul" class="border-gray-300 mt-1 block w-full" placeholder="Tulis nama produk Anda disini.." required>
        </div>
    
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium">Deskripsi Produk</label>
            <textarea name="deskripsi" class="border-gray-300 mt-1 block w-full" rows="4" placeholder="Tuliskan deskripsi produk Anda"></textarea>
        </div>
    
        <div class="mb-4">
            <label for="foto_produk" class="block text-sm font-medium">Pilih Foto (Maksimal 4)</label>
            <input type="file" name="foto_produk[]" id="foto_produk" class="border-gray-300 mt-1 block w-full" multiple accept="image/*" onchange="previewImages(event)">
            
            <!-- Area untuk pratinjau gambar -->
            <div id="imagePreviewContainer" class="mt-4 flex gap-2"></div>
        </div>
    
        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Promosikan Sekarang!</button>
        </div>
    </form>
    
    <script>
        function previewImages(event) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = ''; // Kosongkan container pratinjau
            const files = event.target.files;
            if (files.length > 4) {
                alert("Anda hanya dapat mengunggah maksimal 4 foto.");
                event.target.value = ''; // Reset input file
                return;
            }
    
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-32', 'h-32', 'object-cover', 'rounded', 'border');
                    container.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    
</x-app-layout>
