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
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{!! $community->description !!}</textarea>
                        </div>

                        {{-- Jumlah Anggota --}}
                        <div class="mb-4">
                            <label for="jml_anggota" class="block text-sm font-medium text-gray-700">Jumlah Anggota
                                (Opsional)</label>
                            <input type="number" name="jml_anggota" id="jml_anggota"
                                value="{{ $community->jml_anggota }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Gambar
                                (Opsional)</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*"
                                onchange="previewThumbnail(event)">

                            <!-- Preview Thumbnail -->
                            <div class="mt-4">
                                <img id="thumbnail-preview"
                                    src="{{ $community->thumbnail ? asset('storage/' . $community->thumbnail) : '' }}"
                                    alt="Thumbnail Sekarang" class="w-1/4 {{ $community->thumbnail ? '' : 'hidden' }}">
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui
                            Komunitas</button>
                    </form>

                    <!-- Form Hapus -->
                    <form action="{{ route('communities.destroy', $community) }}" method="POST"
                        class="mt-4 inline-block delete-form">
                        @csrf
                        @method('DELETE')
                        <button data-title="{{ $community->name }}" type="submit"
                            class="bg-red-500 text-white delete-button px-4 py-2 rounded">Hapus
                            Komunitas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Script SweetAlert -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

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

    {{-- alert hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = this.getAttribute(
                        'data-title'); // Ambil judul promosi dari atribut data-title

                    Swal.fire({
                        title: `Hapus <span style="font-weight: bold; color: red;">${title}</span> ?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Yakin Hapus'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('.delete-form').submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
