<div>
    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Postingan dalam Komunitas: ') }} {{ $community->name }}
    </h3>
    <div class="mb-4">
        <a href="{{ route('communities.posts.create', $community) }}" class="text-blue-500 hover:text-blue-700">Buat
            Postingan Baru</a>
    </div>

    <div class="mt-6 space-y-4">
        @if ($posts->isEmpty())
            <p class="text-gray-500">Tidak ada postingan dalam komunitas ini.</p>
        @else
            <ul>
                @foreach ($posts as $post)
                    <li class="border-b border-gray-200 p-4">
                        <p><strong>{{ $post->user->name }}</strong>: {{ $post->content }}</p>
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mt-2">
                        @endif
                        <div class="text-right">
                            @can('update', $post)
                                <a href="{{ route('communities.posts.edit', [$community, $post]) }}"
                                    class="text-green-500">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('communities.posts.destroy', [$community, $post]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Hapus</button>
                                </form>
                            @endcan
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
