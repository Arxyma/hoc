<x-app-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-gradient-to-r from-blue-500 to-80% to-blue-900 text-white p-10 rounded-xl">
            <h2 class="text-5xl font-bold text-center" style="font-family: 'Montserrat', sans-serif;">Promosi</h2>
            <p class="text-center">Ingin mempromosikan produk Anda?</p>
            @can('multi-role', 'level2|admin')
                <div class="flex justify-center mt-6">
                    <a href="{{ route('promosis.create') }}"
                        class="w-fit px-6 py-2 rounded-full bg-orange-400 font-bold flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-plus">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M8 12h8" />
                            <path d="M12 8v8" />
                        </svg>
                        Buat Promosi Produk
                    </a>
                </div>
            @endcan
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="grid grid-cols-1 max-w-md md:max-w-full mx-auto md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($promosis as $promosi)
                <div class="">
                    <a href="{{ route('promosis.detail', $promosi->id) }}"
                        class="bg-white shadow border rounded-xl overflow-hidden aspect-[5/4] relative block">
                        @php
                            $foto_produk = json_decode($promosi->foto_produk);
                            $foto_pertama = $foto_produk[0] ?? null;
                        @endphp
                        @if ($foto_pertama)
                            <img src="{{ asset('storage/' . $foto_pertama) }}" alt="Foto Produk"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif
                        <div
                            class="absolute h-full w-full top-0 bg-gradient-to-t from-black/90 to-70% to-transparent flex flex-col justify-end">
                            <div class="text-white p-4">
                                <div class="text-xl font-bold">{{ $promosi->judul }}</div>
                                <div class="flex gap-1 items-center text-xs text-neutral-300 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>{{ $promosi->user->name ?? 'Unknown' }}
                                </div>
                                <div class="flex gap-1 items-center text-xs text-neutral-300 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                    {{ $promosi->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </a>
                    @can('admin')
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <a href="{{ route('promosis.edit', $promosi->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 text-center rounded-xl">
                                Edit
                            </a>
                            <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white py-2 text-center rounded-xl w-full"
                                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-animation-modal"
                                    data-hs-overlay="#hs-scale-animation-modal">
                                    Delete
                                </button>

                                <div id="hs-scale-animation-modal"
                                    class="hs-overlay-backdrop-open:backdrop-blur hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
                                    role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
                                    <div
                                        class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                                        <div
                                            class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                                            <div class="flex justify-between items-center py-3 px-4 border-b">
                                                <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800">
                                                    Hapus Promosi
                                                </h3>
                                                <button type="button"
                                                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                                                    aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                                                    <span class="sr-only">Close</span>
                                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M18 6 6 18"></path>
                                                        <path d="m6 6 12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-4 overflow-y-auto">
                                                <p class="mt-1 text-gray-800">
                                                    Apakah Anda yakin ingin menghapus promosi ini?
                                                </p>
                                            </div>
                                            <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                                                <button type="button"
                                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                    data-hs-overlay="#hs-scale-animation-modal">
                                                    Close
                                                </button>
                                                <button type="submit"
                                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endcan
                </div>
            @endforeach
        </div>
    </section>
    <div class="container mx-auto px-10 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Pagination -->
            <div class="mt-6">
                {{ $promosis->links() }}
            </div>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus promosi ini?');
        }
    </script>
</x-app-layout>
