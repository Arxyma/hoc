<x-app-layout>
    <div x-data="{ open: false }" class="flex flex-col lg:flex-row py-6">
        <!-- Sidebar (Mobile Popup) -->
        <div class="lg:hidden">
            <button @click="open = !open"
                class="lg:hidden inline-flex items-center mx-4 text-md px-4 py-2 bg-blue-500 text-white rounded shadow mb-4">
                <svg class="icon icon-tabler-news w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11">
                    </path>
                </svg>
                <span class="ml-2">Daftar Komunitas</span>
            </button>

            <!-- Popup Sidebar -->
            <div x-show="open" class="fixed inset-0 z-50 lg:hidden" x-cloak>
                <!-- Overlay untuk menutup sidebar jika diklik di luar -->
                <div @click="open = false" class="absolute inset-0 bg-black bg-opacity-50"></div>

                <!-- Sidebar Konten -->
                <div class="relative w-3/4 max-w-xs bg-white dark:bg-gray-800 shadow-lg p-4 overflow-y-auto h-full">
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl font-bold text-gray-700">Komunitas</h3>
                        <button @click="open = false" class="text-gray-500 hover:text-gray-700 transition duration-200">
                            &times;
                        </button>
                    </div>

                    <!-- Daftar Komunitas -->
                    <ul class="mt-4 space-y-3">
                        @foreach ($communities as $community)
                            <li @click="open = false; window.location='{{ route('communities.index', $community->id) }}'"
                                class="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-blue-400 hover:underline rounded-lg p-4 transition duration-200 hover:bg-gray-200 dark:hover:bg-gray-600 shadow-sm cursor-pointer">
                                <div class="flex items-center">
                                    @if ($community->thumbnail)
                                        <img src="{{ asset('storage/' . $community->thumbnail) }}"
                                            alt="Thumbnail {{ $community->name }}"
                                            class="w-8 h-8 object-cover rounded mr-3">
                                    @endif
                                    <p class="font-semibold">{{ Str::limit($community->name, 20) }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <!-- Sidebar (Desktop) -->
        <aside class="hidden lg:block lg:w-1/4 px-4 mb-6 lg:mb-0 top-4 sticky max-h-[calc(100vh-2rem)] overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                <h3 class="text-2xl font-bold text-center text-gray-700 mb-2">Komunitas</h3>
                @can('create', App\Models\Community::class)
                    <a href="{{ route('communities.create') }}"
                        class="inline-block w-full text-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 shadow transition duration-200">
                        + Buat Komunitas
                    </a>
                @endcan
                <ul class="space-y-3 mt-3">
                    @foreach ($communities as $community)
                        <li onclick="window.location='{{ route('communities.index', $community->id) }}'"
                            class="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-blue-400 hover:underline rounded-lg p-4 transition duration-200 hover:bg-gray-200 dark:hover:bg-gray-600 shadow-sm cursor-pointer">
                            <div class="flex items-center">
                                @if ($community->thumbnail)
                                    <img src="{{ asset('storage/' . $community->thumbnail) }}"
                                        alt="Thumbnail {{ $community->name }}"
                                        class="w-12 h-12 object-cover rounded mr-3">
                                @endif
                                <p class="font-semibold">{{ Str::limit($community->name, 28) }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="w-full lg:w-3/4 px-4">
            @if ($selectedCommunity)
                @include('communities.posts.index', ['community' => $selectedCommunity, 'posts' => $posts])
            @else
                <div class="text-center text-gray-500">
                    <p>Silakan pilih komunitas dari sidebar untuk melihat postingan.</p>
                </div>
            @endif
        </main>
    </div>
</x-app-layout>
