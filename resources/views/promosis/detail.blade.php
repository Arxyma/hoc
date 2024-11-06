<x-app-layout>
    <div class="container mx-auto px-10 py-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Title Section -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-blue-600 mb-2">{{ $promosi->judul }}</h1>
                <p class="text-gray-700 text-sm">Posted by: {{ $promosi->user->name ?? 'Unknown' }}</p>
                <p class="text-gray-500 text-xs">{{ $promosi->created_at->format('d M Y, H:i') }}</p>
            </div>

            <!-- Image Section as Slider -->
            <div class="flex justify-center mb-6">
                @if ($promosi->foto_produk)
                    <div class="swiper-container w-[300px] h-[300px]">
                        <div class="swiper-wrapper">
                            @foreach (json_decode($promosi->foto_produk) as $foto)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Produk" class="w-full h-full object-cover rounded border">
                                </div>
                            @endforeach
                        </div>
                        <!-- Swiper navigation buttons -->
                        <div class="swiper-button-next  mx-auto px-10 py-4"></div>
                        <div class="swiper-button-prev  mx-auto px-10 py-4"></div>
                        <!-- Swiper pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <div class="w-[300px] h-[300px] bg-gray-200 flex items-center justify-center text-gray-500 mb-4">
                        No Image
                    </div>
                @endif
            </div>

            <!-- Description Section -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $promosi->judul }}</h2>
                <p class="text-gray-600 mb-4">{{ $promosi->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
            </div>
        </div>
    </div>

    <!-- Swiper Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.swiper-container', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script>
</x-app-layout>
