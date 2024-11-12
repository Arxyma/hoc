<x-app-layout>
    {{-- <div class="container mx-auto px-4 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <!-- Title Section -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-blue-600 mb-2">{{ $promosi->judul }}</h1>
                    <p class="text-neutral-700 text-sm">Posted by: {{ $promosi->user->name ?? 'Unknown' }}</p>
                    <p class="text-neutral-500 text-xs">{{ $promosi->created_at->format('d M Y, H:i') }}</p>
                </div>
    
                <!-- Image Section as Slider -->
                <div class="flex justify-center mb-6">
                    @if ($promosi->foto_produk)
                        <div class="swiper-container w-80 h-80">
                            <div class="swiper-wrapper">
                                @foreach (json_decode($promosi->foto_produk) as $foto)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $foto) }}" alt="Foto Produk" class="w-full h-full object-cover rounded border">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Swiper navigation buttons -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- Swiper pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    @else
                        <div class="w-80 h-80 bg-neutral-200 flex items-center justify-center text-neutral-500">
                            No Image
                        </div>
                    @endif
                </div>
    
                <!-- Description Section -->
                <div class="bg-neutral-100 p-4 rounded-lg shadow-inner">
                    <h2 class="text-lg font-semibold text-neutral-800 mb-2">Deskripsi Produk</h2>
                    <p class="text-neutral-600">{{ $promosi->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Swiper Initialization Script -->
    {{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.swiper-container', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                spaceBetween: 10,  // space between slides
                centeredSlides: true  // centers the slides for better alignment
            });
        });
    </script> --}}

    <!-- Swiper Styles -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> --}}

    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-white border rounded-xl shadow-xl overflow-hidden hover p-6">
            <div class="grid md:grid-cols-5 gap-8">
                <!-- Slider -->
                <div data-hs-carousel='{
                        "loadingClasses": "opacity-0",
                        "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-neutral-200 rounded-full cursor-pointer bg-white",
                        "isDraggable": true,
                        "isInfiniteLoop": true
                        {{-- "slidesQty": {
                            "xs": 1,
                            "lg": 3
                        } --}}
                    }'
                    class="relative md:col-span-2 aspect-square">
                    <div class="hs-carousel w-full h-full overflow-hidden bg-white rounded-lg">
                        <div class="relative -mx-1">
                            <!-- transition-transform duration-700 -->
                            <div id="carousel"
                                class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap opacity-0 transition-transform duration-700">
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

                    <button type="button"
                        class="hs-carousel-prev hs-carousel-disabled:text-neutral-400 hs-carousel-disabled:pointer-events-none absolute p-2 justify-center items-center top-1/2 -translate-y-1/2 left-4 rounded-full bg-white text-neutral-800">
                        <span class="text-2xl" aria-hidden="true">
                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
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
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </span>
                    </button>

                    <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2">
                    </div>
                </div>
                <!-- End Slider -->
                <div class="md:col-span-3">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-2">{{ $promosi->judul }}</h1>
                        <p class="text-neutral-700 text-sm">Diupload oleh : {{ $promosi->user->name ?? 'Unknown' }}</p>
                        <p class="text-neutral-500 text-xs">{{ $promosi->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="bg-neutral-100 p-4 rounded-lg shadow-inner">
                        <h2 class="text-lg font-semibold text-neutral-800 mb-2">Deskripsi Produk</h2>
                        <p class="text-neutral-600">{{ $promosi->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('script')
        @vite('resources/js/detail-promosi.js')
    @endpush
</x-app-layout>
