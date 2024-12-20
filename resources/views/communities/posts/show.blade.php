<x-app-layout>
    <div class="py-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
                    {{ __('Postingan di ') }} {{ $community->name }}
                </h2>

                {{-- Postingan Details --}}
                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg mb-4">
                    <div class="flex items-start space-x-4">
                        <img src="{{ $post->user->profileImageUrl }}" alt="Foto Profil"
                            class="w-12 h-12 rounded-full object-cover">
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold text-lg text-gray-800">{{ $post->user->name }}</h4>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <p class="mt-2 text-gray-700 dark:text-gray-300 break-words whitespace-normal">
                                {!! $post->content !!}
                            </p>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="mt-3 rounded-lg max-w-md w-11/12 object-cover">
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons (Edit & Delete) -->
                    <div class="mt-3 flex justify-between items-center text-sm">
                        <!-- Comments Count -->
                        <div class="text-gray-600 dark:text-gray-400 flex ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 dark:text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 8h10M7 12h5m-5 4h6m4 1.1c1.2 0 2.1-1 2.1-2.1V7.5c0-1.2-1-2.1-2.1-2.1H6.5C5.4 5.4 4.5 6.3 4.5 7.5v9.9c0 1.2 1 2.1 2.1 2.1h10.9L19 21v-2.9z" />
                            </svg>
                            <p class="p-1 font-bold">
                                {{ $post->comments->count() }} Komentar
                            </p>
                        </div>

                        <!-- Action Buttons (Edit & Delete) -->
                        <div class="flex space-x-4">
                            @can('update', $post)
                                <a href="{{ route('communities.posts.edit', [$community, $post]) }}"
                                    class="flex items-center text-blue-500 hover:text-blue-600 transition duration-200 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 4.232a1.5 1.5 0 012.121 0l2.414 2.414a1.5 1.5 0 010 2.121l-12 12a1.5 1.5 0 01-.708.394l-4 1a1 1 0 01-1.213-1.213l1-4a1.5 1.5 0 01.394-.708l12-12z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7l1.5 1.5" />
                                    </svg>
                                    Edit
                                </a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('communities.posts.destroy', [$community, $post]) }}" method="POST"
                                    class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-title="postingan"
                                        class="flex items-center text-red-500 hover:text-red-600 transition duration-200 delete-postingan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.136 21H7.864a2 2 0 01-1.997-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m7 0H5" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>

                {{-- Form untuk menambahkan komentar --}}
                @if (auth()->check())
                    <div class="mt-4">
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <textarea name="content" class="w-full p-2 border border-gray-300 rounded" rows="3"
                                placeholder="Tambah komentar..."></textarea>
                            <button type="submit"
                                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Buat
                                Komentar</button>
                        </form>
                    </div>
                @else
                    <p class="mt-4 text-gray-500">Please <a href="{{ route('login') }}" class="text-blue-500">log
                            in</a>
                        to comment.</p>
                @endif

                {{-- Daftar komentar --}}
                <div class="mt-6">
                    <h5 class="text-lg font-semibold">Komentar</h5>
                    @foreach ($comments as $comment)
                        <div
                            class="mt-2 p-4 border border-gray-200 dark:border-gray-700 rounded-lg flex justify-between items-start">
                            {{-- Konten komentar --}}
                            <div class="flex items-start w-full lg:w-11/12 sm:w-full">
                                <img class="w-8 h-8 rounded-full"
                                    src="{{ $comment->user->foto_profil ? asset('storage/' . $comment->user->foto_profil) : asset('images/default-profile.png') }}"
                                    alt="Foto Profil Komentar">
                                <div class="flex-1 ml-3">
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $comment->created_at->diffForHumans() }}</p>
                                    <!-- Batasan 150 huruf dan tombol "Baca Selengkapnya" -->
                                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                                        @if (strlen(strip_tags($comment->content)) > 150)
                                            <span class="short-text">{!! Str::limit(strip_tags($comment->content, '<b><i><u><strong><em>'), 150) !!}</span>
                                            <span class="full-text hidden">{!! strip_tags($comment->content, '<b><i><u><strong><em>') !!}</span>
                                            <button class="read-more text-blue-500 hover:underline">Baca
                                                Selengkapnya</button>
                                        @else
                                            {!! strip_tags($comment->content, '<b><i><u><strong><em>') !!}
                                        @endif
                                    </p>

                                </div>
                            </div>
                            <!-- Tombol Hapus Komentar -->
                            @can('delete', $comment)
                                <div class="w-1/5 lg:w-1/12 sm:w-5/6 flex justify-end">
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                        class="inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-title="komentar"
                                            class="text-red-400 hover:text-red-600 transition duration-200 flex items-center delete-komentar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.136 21H7.864a2 2 0 01-1.997-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m7 0H5" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    @endforeach

                    {{-- Tombol Pagination --}}
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

{{-- alert success --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreButtons = document.querySelectorAll('.read-more');

        readMoreButtons.forEach(button => {
            button.addEventListener('click', function() {
                const commentContainer = this.closest('.mt-2');
                const shortText = commentContainer.querySelector('.short-text');
                const fullText = commentContainer.querySelector('.full-text');

                shortText.classList.toggle('hidden');
                fullText.classList.toggle('hidden');

                // Ubah teks tombol
                if (this.innerText === 'Baca Selengkapnya') {
                    this.innerText = 'Tampilkan lebih sedikit';
                } else {
                    this.innerText = 'Baca Selengkapnya';
                }
            });
        });
    });
</script>


{{-- alert hapus postingan --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-postingan');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const title = this.getAttribute(
                    'data-title'); // Ambil judul promosi dari atribut data-title

                Swal.fire({
                    title: `Yakin hapus ${title}?`,
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

{{-- alert hapus komentar --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-komentar');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const title = this.getAttribute(
                    'data-title'); // Ambil judul promosi dari atribut data-title

                Swal.fire({
                    title: `Yakin hapus komentar?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('.delete-form').submit();
                    }
                });
            });
        });
    });
</script>
