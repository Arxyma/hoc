<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Detail Produk</h2>
        </div>
    </header>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-white border rounded-xl shadow-xl overflow-hidden hover p-6">
            <div class="grid md:grid-cols-5 gap-8 pb-10">
                <!-- Slider -->
                <div data-hs-carousel='{
                        "loadingClasses": "opacity-0",
                        "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-neutral-200 rounded-full cursor-pointer bg-white",
                        "isDraggable": true,
                        "isInfiniteLoop": true
                    }'
                    class="relative md:col-span-2 aspect-square">
                    <div class="hs-carousel w-full h-full overflow-hidden bg-white rounded-lg">
                        <div class="relative -mx-1">
                            <div id="carousel"
                                class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap opacity-0 transition-transform duration-700">
                                @php
                                    $foto_produk = json_decode($promosi->foto_produk);
                                    $foto_pertama = $foto_produk[0] ?? null;
                                @endphp
                                @if ($foto_pertama)
                                    @foreach (json_decode($promosi->foto_produk) as $foto)
                                        <div class="hs-carousel-slide px-1" aria-haspopup="dialog" aria-expanded="false"
                                            aria-controls="hs-scale-animation-modal"
                                            data-hs-overlay="#hs-scale-animation-modal"
                                            data-image="{{ asset('storage/' . $foto) }}">
                                            <div class="aspect-square relative">
                                                <img src="{{ asset('storage/' . $foto) }}" alt="Foto Produk"
                                                    class="absolute w-full h-full object-cover">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="hs-carousel-slide px-1">
                                        <div class="aspect-square relative">
                                            <span
                                                class="h-full w-full absolute flex justify-center items-center bg-gray-200 text-gray-500 text-xl">No
                                                Image</span>
                                        </div>
                                    </div>
                                    {{-- <div
                                        class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                        No Image
                                    </div> --}}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div id="hs-scale-animation-modal"
                        class="hs-overlay hs-overlay-backdrop-open:backdrop-blur hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
                        tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
                        <div
                            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                                <div class="flex justify-end items-center py-3 px-4 border-b">
                                    <button type="button"
                                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                                        aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                                        <span class="sr-only">Close</span>
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 6 6 18"></path>
                                            <path d="m6 6 12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="overflow-y-auto">
                                    <img id="modalImage" src="" alt="Foto Produk"
                                        class="w-full h-full rounded-b-xl">
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $foto_produk = json_decode($promosi->foto_produk);
                        $foto_pertama = $foto_produk[0] ?? null;
                    @endphp
                    @if ($foto_pertama)
                        <button type="button"
                            class="hs-carousel-prev hs-carousel-disabled:text-neutral-400 hs-carousel-disabled:pointer-events-none absolute p-2 justify-center items-center top-1/2 -translate-y-1/2 left-4 rounded-full bg-white text-neutral-800">
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                            </span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button type="button"
                            class="hs-carousel-next hs-carousel-disabled:text-neutral-400 hs-carousel-disabled:pointer-events-none absolute p-2 justify-center items-center top-1/2 -translate-y-1/2 right-4 rounded-full bg-white text-neutral-800">
                            <span class="sr-only">Next</span>
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </span>
                        </button>

                        <div
                            class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2">
                        </div>
                    @endif
                </div>
                <!-- End Slider -->
                <div class="md:col-span-3">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-2">{{ $promosi->judul }}</h1>
                        <p class="text-neutral-700 text-sm">Diupload oleh : {{ $promosi->user->name ?? 'Unknown' }}</p>
                        <p class="text-neutral-500 text-xs">{{ $promosi->created_at->translatedFormat('l, d M Y') }}</p>
                    </div>
                    <div class="bg-neutral-100 p-4 rounded-lg shadow-inner">
                        <h2 class="text-lg font-semibold text-neutral-800 mb-2">Deskripsi Produk</h2>
                        <p class="text-neutral-600">{!! $promosi->deskripsi ?? 'Deskripsi tidak tersedia' !!}}</p>
                    </div>
                </div>
            </div>

            {{-- rekomendasi produk --}}
            <section class="mt-20">
                <hr class="border-gray-300 mt-12 mb-6">
                <h2 class="text-xl font-bold mb-4">Rekomendasi untuk Anda</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($rekomendasiPromosi as $rekomendasi)
                        <div class="bg-white border rounded-lg overflow-hidden shadow-md">
                            <a href="{{ route('promosis.detail', $rekomendasi->slug) }}">
                                <img src="{{ asset('storage/' . json_decode($rekomendasi->foto_produk)[0]) }}"
                                    alt="{{ $rekomendasi->judul }}" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold">{{ $rekomendasi->judul }}</h3>
                                    <p class="text-sm text-gray-600">{!! Str::limit($rekomendasi->deskripsi, 50) !!}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </section>
    @push('script')
        @vite('resources/js/detail-promosi.js')
    @endpush
</x-app-layout>
