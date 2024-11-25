<x-app-layout>
    <div class="container mx-auto px-10 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h1 class="text-lg font-medium text-gray-900 dark:text-gray-100">Edit Promosi</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Perbarui detail promosi produk Anda.
                    </p>
                    <form action="{{ route('promosis.update', $promosi->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="judul"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300 mt-4">Nama
                                Produk</label>
                            <input type="text" name="judul" value="{{ $promosi->judul }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">Deskripsi
                                Produk</label>
                            <textarea name="deskripsi"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                rows="4" required>{!! $promosi->deskripsi !!}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="foto_produk"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">Foto Produk</label>
                            <div id="drop-area"
                                class="border-2 border-dashed bg-gray-50 border border-gray-300 p-10 rounded-lg text-center">
                                <p class="text-gray-500">Seret dan lepas foto di sini atau klik untuk memilih (maksimal
                                    4 foto)</p>
                                <input type="file" name="foto_produk[]" id="foto_produk" class="hidden" multiple
                                    accept="image/*" onchange="previewImages(event)">
                            </div>

                            <!-- Area untuk pratinjau gambar -->
                            <div id="imagePreviewContainer" class="mt-4 flex gap-2">
                                @php
                                    $foto_produk = json_decode($promosi->foto_produk);
                                @endphp

                                @if ($foto_produk)
                                    @foreach ($foto_produk as $foto)
                                        <img src="{{ asset('storage/' . $foto) }}" alt="Foto Produk"
                                            class="w-32 h-32 object-cover rounded border">
                                    @endforeach
                                @else
                                    <p class="text-gray-500">Tidak ada gambar.</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="submit"
                                class="bg-blue-500 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Update Promosi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const dropArea = document.getElementById('drop-area');
            const fileInput = document.getElementById('foto_produk');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');

            dropArea.addEventListener('click', () => fileInput.click());

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
                imagePreviewContainer.innerHTML = '';
                if (files.length > 4) {
                    alert("Anda hanya dapat mengunggah maksimal 4 foto.");
                    fileInput.value = '';
                    return;
                }

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-32', 'h-32', 'object-cover', 'rounded', 'border');
                        imagePreviewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>
    </div>
</x-app-layout>
