<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $community->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl mb-4">Posts in {{ $community->name }}</h3>

                    {{-- Link untuk menambahkan postingan baru --}}
                    <a href="{{ route('communities.posts.create', $community) }}"
                        class="text-blue-500 hover:underline mb-4 inline-block">Create New Post</a>

                    {{-- Daftar postingan --}}
                    @forelse ($posts as $post)
                        <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <h4 class="font-semibold text-lg">{{ $post->user->username }}</h4>
                            <p class="mt-2">{{ $post->content }}</p>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="mt-2 rounded-lg max-w-full h-auto">
                            @endif
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                {{ $post->created_at->diffForHumans() }}</div>

                            {{-- Action buttons for editing and deleting posts --}}
                            @can('update', $post)
                                <a href="{{ route('communities.posts.edit', [$community, $post]) }}"
                                    class="text-green-500 hover:underline mr-2">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('communities.posts.destroy', [$community, $post]) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="text-red-500 hover:underline">Delete</button>
                                </form>
                            @endcan
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 mt-4">No posts available in this community.</p>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
