<!-- Komunitas Detail -->
<div class="bg-white shadow-sm rounded-lg mb-6 p-6">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between">
        <!-- Bagian Kiri: Nama dan Deskripsi Komunitas -->
        <div class="w-full lg:w-9/12">
            <h3 class="text-2xl font-bold text-gray-700 mb-2">{{ $selectedCommunity->name }}</h3>
            <p class="text-gray-600 text-sm">{!! $selectedCommunity->description !!}</p>
            @if ($community->jml_anggota)
                <div class="flex items-center text-gray-500 text-sm mt-1">
                    <svg viewBox="0 0 16 16" class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                        class="bi bi-person">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z">
                            </path>
                        </g>
                    </svg>
                    <span>{{ $community->jml_anggota }} anggota</span>
                </div>
            @endif
        </div>

        <!-- Tombol Tambah Postingan -->
        <a href="{{ route('communities.posts.create', $community) }}"
            class="text-sm w-full lg:w-1/6 px-4 py-2 text-center bg-blue-500 text-white rounded hover:bg-blue-600 mt-4 lg:mt-0 transition duration-200">
            + Tambah Postingan
        </a>
    </div>
</div>

<!-- Daftar Postingan -->
<div class="max-w-7xl mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

        <!-- Formulir Pencarian (Hanya tampil jika ada postingan) -->
        @if ($posts->count() || request('search'))
            <div class="pr-6 pt-6 justify-items-end">
                <form method="GET" action="{{ route('communities.index', $selectedCommunity->id) }}"
                    class="flex items-center space-x-2">
                    <input type="text" name="search" placeholder="Cari postingan..." value="{{ request('search') }}"
                        class="px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                        Cari
                    </button>

                    <!-- Tampilkan Tombol Reset Jika Tidak Ada Postingan & Sedang Dalam Mode Pencarian -->
                    @if ((!$posts->count() && request('search')) || request('search'))
                        <a href="{{ route('communities.index', $selectedCommunity->id) }}"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition duration-200">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        @endif



        <div class="p-6 text-gray-900 dark:text-gray-100" id="post-list">
            {{-- Loop Daftar Postingan --}}
            @forelse ($posts as $post)
                <div onclick="window.location='{{ route('communities.posts.show', [$community, $post]) }}'"
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
                                {!! Str::limit($post->content, 150, '...') !!}
                            </p>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="mt-3 rounded-lg max-w-md w-10/12 object-cover">
                            @endif
                        </div>
                    </div>

                    <!-- Comments Count dan Action Buttons -->
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
                                    onclick="event.stopPropagation()"
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
                                    onclick="event.stopPropagation()" class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center text-red-500 hover:text-red-600 transition duration-200 delete-button">
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
            @empty
                <p class="text-gray-500 dark:text-gray-400">Belum ada postingan di komunitas ini.</p>
            @endforelse
        </div>

        {{-- Tombol untuk "Load More" --}}
        @if ($posts->hasMorePages())
            <div class="flex justify-center">
                <button id="load-more"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                    Muat Lagi
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
            loadMoreButton.innerText = "Sedang Memuat...";
            loadMoreButton.disabled = true;

            currentPage += 1;
            const search = "{{ request('search') }}"; // Mendapatkan query pencarian
            fetch(
                    `{{ route('communities.index', $community->id) }}?page=${currentPage}&search=${search}`
                )
                .then(response => response.text())
                .then(html => {
                    const newPosts = new DOMParser().parseFromString(html, 'text/html')
                        .querySelector('#post-list').innerHTML;
                    document.querySelector('#post-list').insertAdjacentHTML('beforeend', newPosts);

                    loadMoreButton.innerText = originalButtonText;
                    loadMoreButton.disabled = false;

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
                    title: `Yakin menghapus postingan ini?`,
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
