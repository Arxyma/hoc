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
                        <button @click="open = false"
                            class="text-gray-100 hover:text-gray-50 bg-red-500 hover:bg-red-600 p-2 transition duration-200">
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
                                            alt="Thumbnail {!! $community->name !!}"
                                            class="w-8 h-8 object-cover rounded mr-3">
                                    @endif
                                    <div class="flex-1">
                                        <p class="font-semibold">
                                            {!! Str::limit($community->name, auth()->user()->can('update', $community) ? 28 : 37) !!}
                                        </p>
                                        @if ($community->jml_anggota)
                                            <div class="flex items-center text-gray-500 text-sm mt-1">
                                                <svg viewBox="0 0 16 16" class="h-4 w-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#000000"
                                                    class="bi bi-person">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
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
                                    @can('update', $community)
                                        <div class="flex items-center space-x-1 ml-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('communities.edit', $community->id) }}"
                                                class="text-green-500 hover:text-green-700 transition duration-200"
                                                title="Edit Komunitas">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.232 4.232a1.5 1.5 0 012.121 0l2.414 2.414a1.5 1.5 0 010 2.121l-12 12a1.5 1.5 0 01-.708.394l-4 1a1 1 0 01-1.213-1.213l1-4a1.5 1.5 0 01.394-.708l12-12z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16 7l1.5 1.5" />
                                                </svg>
                                            </a>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('communities.destroy', $community->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus komunitas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 transition duration-200"
                                                    title="Hapus Komunitas">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.136 21H7.864a2 2 0 01-1.997-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m7 0H5" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
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
                            class="bg-gray-100 dark:bg-gray-700 text-blue-600 dark:text-blue-400 hover:underline rounded-lg p-4 transition duration-200 hover:bg-gray-300 dark:hover:bg-gray-600 shadow-sm cursor-pointer {{ $selectedCommunity && $selectedCommunity->id == $community->id ? 'bg-gray-300' : '' }}">
                            <div class="flex items-center">
                                @if ($community->thumbnail)
                                    <img src="{{ asset('storage/' . $community->thumbnail) }}"
                                        alt="Thumbnail {!! $community->name !!}"
                                        class="w-12 h-12 object-cover rounded mr-3">
                                @endif

                                <div class="flex-1">
                                    <p class="font-semibold">
                                        {!! Str::limit($community->name, auth()->user()->can('update', $community) ? 28 : 37) !!}
                                    </p>
                                    @if ($community->jml_anggota)
                                        <div class="flex items-center text-gray-500 text-sm mt-1">
                                            <svg viewBox="0 0 16 16" class="h-4 w-4 mr-1"
                                                xmlns="http://www.w3.org/2000/svg" fill="#000000" class="bi bi-person">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
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
                                @can('update', $community)
                                    <div class="flex items-center space-x-1 ml-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('communities.edit', $community->id) }}"
                                            class="text-green-500 hover:text-green-700 transition duration-200"
                                            title="Edit Komunitas">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.232 4.232a1.5 1.5 0 012.121 0l2.414 2.414a1.5 1.5 0 010 2.121l-12 12a1.5 1.5 0 01-.708.394l-4 1a1 1 0 01-1.213-1.213l1-4a1.5 1.5 0 01.394-.708l12-12z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7l1.5 1.5" />
                                            </svg>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('communities.destroy', $community->id) }}" method="POST"
                                            onclick="event.stopPropagation()" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 delete-button transition duration-200"
                                                title="Hapus Komunitas" data-title="{{ $community->name }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.136 21H7.864a2 2 0 01-1.997-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m7 0H5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
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
