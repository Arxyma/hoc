<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Postingan dalam Komunitas: ') }} {{ $community->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('communities.posts.update', [$community, $post]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required>{{ old('content', $post->content) }}</textarea>
                        </div>

                        <!-- Image Upload with Preview -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Gambar
                                (opsional)</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*"
                                onchange="previewImage(event)">

                            <!-- Preview Container -->
                            <div class="mt-4">
                                <img id="preview" src="{{ $post->image ? asset('storage/' . $post->image) : '' }}"
                                    alt="Current Image" class="w-1/4 {{ $post->image ? '' : 'hidden' }}">
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui
                            Postingan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            var preview = document.getElementById('preview');
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
