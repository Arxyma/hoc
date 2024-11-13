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
                            <p class="mt-2 text-gray-700 dark:text-gray-300">
                                {{ Str::limit($post->content, 150, '...') }}
                            </p>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="mt-3 rounded-lg max-w-md w-11/12 object-cover">
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

                {{-- Form untuk menambahkan komentar --}}
                @if (auth()->check())
                    <div class="mt-4">
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <textarea name="content" class="w-full p-2 border border-gray-300 rounded" rows="3"
                                placeholder="Write a comment..."></textarea>
                            <button type="submit"
                                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Post
                                Comment</button>
                        </form>
                    </div>
                @else
                    <p class="mt-4 text-gray-500">Please <a href="{{ route('login') }}" class="text-blue-500">log
                            in</a>
                        to comment.</p>
                @endif

                {{-- Daftar komentar --}}
                <div class="mt-6">
                    <h5 class="text-lg font-semibold">Comments</h5>
                    @foreach ($post->comments as $comment)
                        <div
                            class="mt-2 p-4 border border-gray-200 dark:border-gray-700 rounded-lg flex justify-between items-start">
                            <div class="flex items-start space-x-4">
                                <!-- Foto Profil Komentar -->
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full"
                                        src="{{ $comment->user->foto_profil ? asset('storage/' . $comment->user->foto_profil) : asset('images/default-profile.png') }}"
                                        alt="Foto Profil Komentar">
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                    <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $comment->content }}</p>
                                </div>
                            </div>

                            <!-- Tombol Hapus Komentar -->
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-400 flex hover:text-red-600 transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.136 21H7.864a2 2 0 01-1.997-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m7 0H5" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
