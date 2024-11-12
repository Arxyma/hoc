<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Komunitas') }} - {{ $community->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('communities.update', $community) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Komunitas -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Komunitas</label>
                            <input type="text" name="name" id="name" value="{{ $community->name }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $community->description }}</textarea>
                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*"
                                onchange="previewThumbnail(event)">

                            <!-- Thumbnail Saat Ini -->
                            @if ($community->thumbnail)
                                <div class="mt-4">
                                    <img src="{{ asset('storage/' . $community->thumbnail) }}" alt="Current Thumbnail"
                                        class="w-1/4">
                                </div>
                            @endif

                            <!-- Thumbnail Baru -->
                            <div class="mt-4">
                                <img id="thumbnail-preview" alt="Thumbnail Preview" class="w-1/4 hidden">
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update
                            Community</button>
                    </form>

                    <!-- Form Hapus -->
                    <form action="{{ route('communities.destroy', $community) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">Hapus
                            Community</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewThumbnail(event) {
            var preview = document.getElementById('thumbnail-preview');
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>