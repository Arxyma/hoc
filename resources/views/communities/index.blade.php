<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Communities') }}
        </h2>
    </x-slot>

    <div class="flex py-6">
        <!-- Sidebar -->
        <aside class="w-1/4 px-6">
            <div class="mb-4">
                <a href="{{ route('communities.create') }}"
                    class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Buat Komunitas
                </a>
            </div>

            <ul>
                @foreach ($communities as $community)
                    <li class="py-2">
                        <a href="{{ route('communities.index', $community->id) }}"
                            class="text-blue-500 hover:underline @if ($selectedCommunity && $selectedCommunity->id == $community->id) font-bold @endif">
                            {{ $community->name }}
                        </a>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="w-3/4 px-6">
            @if ($selectedCommunity)
                @include('communities.posts.index', ['community' => $selectedCommunity, 'posts' => $posts])
            @else
                <div class="text-center text-gray-500">
                    <p>Please select a community from the sidebar to view posts.</p>
                </div>
            @endif
        </main>
    </div>
</x-app-layout>
