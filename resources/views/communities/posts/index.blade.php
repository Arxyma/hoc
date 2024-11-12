<!-- Komunitas Detail -->
<div class="bg-white shadow-sm rounded-lg mb-6 p-6">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between">
        <!-- Bagian Kiri: Nama dan Deskripsi Komunitas -->
        <div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">{{ $selectedCommunity->name }}</h3>
            <p class="text-gray-600">{{ $selectedCommunity->description }}</p>
        </div>

        <!-- Tombol Tambah Postingan -->
        <a href="{{ route('communities.posts.create', $community) }}"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-4 transition duration-200">
            + Tambah Postingan
        </a>
    </div>
</div>

<!-- Daftar Postingan -->
<div class="max-w-7xl mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100" id="post-list">
            {{-- Loop Daftar Postingan --}}
            @forelse ($posts as $post)
                <a href="{{ route('communities.posts.show', [$community, $post]) }}" class="block">
                    <div
                        class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-lg transition duration-200 cursor-pointer mb-4">
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
                                <p class="mt-2 text-gray-700 dark:text-gray-300">
                                    {{ Str::limit($post->content, 150, '...') }}
                                </p>
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                        class="mt-3 rounded-lg max-w-md w-10/12 object-cover">
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons (Edit & Delete) -->
                        <div class="mt-3 flex justify-end space-x-4 text-sm">
                            @can('update', $post)
                                <a href="{{ route('communities.posts.edit', [$community, $post]) }}"
                                    class="flex items-center text-blue-500 hover:text-blue-600 transition duration-200">
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
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center text-red-500 hover:text-red-600 transition duration-200">
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
                </a>

            @empty
                <p class="text-gray-500 dark:text-gray-400">Belum ada postingan di komunitas ini.</p>
            @endforelse
        </div>

        {{-- Tombol untuk "Load More" --}}
        @if ($posts->hasMorePages())
            <div class="flex justify-center">
                <button id="load-more"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                    Load More
                </button>
            </div>
        @endif
    </div>
</div>

{{-- Script untuk infinite scroll atau "Load More" --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadMoreButton = document.getElementById('load-more');
        let currentPage = {{ $posts->currentPage() }};
        const originalButtonText = loadMoreButton?.innerText;

        loadMoreButton?.classList.add('mb-6'); // Tambahkan margin bawah pada tombol "Load More"

        loadMoreButton?.addEventListener('click', function() {
            loadMoreButton.innerText = "Sedang Memuat..."; // Tampilkan teks "Sedang Memuat" saat diklik
            loadMoreButton.disabled = true;

            currentPage += 1;
            fetch(`{{ route('communities.index', $community->id) }}?page=${currentPage}`)
                .then(response => response.text())
                .then(html => {
                    const newPosts = new DOMParser().parseFromString(html, 'text/html')
                        .querySelector('#post-list').innerHTML;
                    document.querySelector('#post-list').insertAdjacentHTML('beforeend', newPosts);

                    // Mengembalikan teks dan enable tombol setelah selesai memuat
                    loadMoreButton.innerText = originalButtonText;
                    loadMoreButton.disabled = false;

                    // Sembunyikan tombol jika tidak ada halaman berikutnya
                    if (currentPage >= {{ $posts->lastPage() }}) {
                        loadMoreButton.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error loading more posts:', error);
                    loadMoreButton.innerText = originalButtonText;
                    loadMoreButton.disabled = false;
                });
        });
    });
</script>