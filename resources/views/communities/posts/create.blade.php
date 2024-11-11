<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Postingan Baru dalam Komunitas: ') }} {{ $community->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('communities.posts.store', $community) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required>{{ old('content') }}</textarea>
                        </div>

                        <!-- Image Upload with Preview -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image
                                (optional)</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*"
                                onchange="previewImage(event)">

                            <!-- Preview Container -->
                            <div class="mt-4">
                                <img id="preview" alt="Image Preview" class="w-1/4 hidden">
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Post</button>
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
