<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <!-- Title Section -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-blue-600 mb-2">{{ $promosi->judul }}</h1>
                    <p class="text-gray-700 text-sm">Posted by: {{ $promosi->user->name ?? 'Unknown' }}</p>
                    <p class="text-gray-500 text-xs">{{ $promosi->created_at->format('d M Y, H:i') }}</p>
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
                        <div class="w-80 h-80 bg-gray-200 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif
                </div>
    
                <!-- Description Section -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h2>
                    <p class="text-gray-600">{{ $promosi->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper Initialization Script -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
    </script>

    <!-- Swiper Styles -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</x-app-layout>
