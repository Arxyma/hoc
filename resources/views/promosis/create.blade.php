<x-app-layout>
    <div class="container mx-auto px-10 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h1 class="text-lg font-medium text-gray-900 dark:text-gray-100">Buat Promosi Baru</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Promosikan produk anda di komunitas sekarang juga!
                    </p>
                    <form action="{{ route('promosis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="mb-4">
                            <label for="judul" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mt-4">Nama Produk</label>
                            <input type="text" name="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                placeholder="Tulis nama produk Anda disini.." required="required">
                        </div>
                    
                        <div class="mb-4">
                            <label for="deskripsi" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Deskripsi Produk</label>
                            <textarea name="deskripsi" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                rows="4" placeholder="Tuliskan deskripsi produk Anda" required="required"></textarea> 
                        </div>
                    
                        <div class="mb-4">
                            <label for="foto_produk" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pilih Foto (Maksimal 4)</label>
                            <div id="drop-area" class="border-2 border-dashed bg-gray-50 border border-gray-300 p-10 rounded-lg text-center">
                                <p class="text-gray-500">Seret dan lepas foto di sini atau klik untuk memilih (maksimal 4 foto)</p>
                                <input type="file" name="foto_produk[]" id="foto_produk" class="hidden" multiple accept="image/*" onchange="previewImages(event)">
                            </div>
    
                            <!-- Area untuk pratinjau gambar -->
                            <div id="imagePreviewContainer" class="mt-4 flex gap-2"></div>
                        </div>
                    
                        <div class="flex justify-between">
                            <button type="submit" class="bg-blue-500 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Promosikan Sekarang!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      
    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('foto_produk');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        let selectedFiles = []; // Array untuk menyimpan file yang dipilih
    
        // Event listener for click on drop area
        dropArea.addEventListener('click', () => fileInput.click());
    
        // Handle drag-and-drop
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('bg-gray-100');
        });
    
        dropArea.addEventListener('dragleave', () => dropArea.classList.remove('bg-gray-100'));
    
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('bg-gray-100');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });
    
        fileInput.addEventListener('change', (event) => handleFiles(event.target.files));
    
        function handleFiles(files) {
            imagePreviewContainer.innerHTML = ''; // Clear previous previews
            selectedFiles = Array.from(files); // Simpan file yang dipilih
    
            if (selectedFiles.length > 4) {
                alert("Anda hanya dapat mengunggah maksimal 4 foto.");
                fileInput.value = ''; // Reset input file
                selectedFiles = [];
                return;
            }
    
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.classList.add('relative', 'w-32', 'h-32', 'inline-block');
    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('object-cover', 'w-full', 'h-full', 'rounded', 'border');
                    
                    // Buat tombol hapus
                    const removeButton = document.createElement('button');
                    removeButton.classList.add('absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'p-1', 'text-xs');
                    removeButton.innerHTML = 'X';
                    removeButton.onclick = function () {
                        removeImage(index);
                    };
    
                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeButton);
                    imagePreviewContainer.appendChild(imgContainer);
                };
                reader.readAsDataURL(file);
            });
        }
    
        function removeImage(index) {
            selectedFiles.splice(index, 1); // Hapus file dari array
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file)); // Tambahkan kembali file yang tidak dihapus
    
            fileInput.files = dataTransfer.files; // Perbarui file input
            handleFiles(dataTransfer.files); // Perbarui tampilan pratinjau
        }
    </script>
              
</x-app-layout>
  