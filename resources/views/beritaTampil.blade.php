<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tightx">
            {{ $berita->judul }}
        </h2>
    </x-slot>

    <div class="py-20 bg-gray-50">
        <div class="max-w-3xl mx-auto px-6 lg:px-0">
            <!-- Tanggal dan Ikon Media Sosial -->
            <div class="flex justify-center items-center space-x-6 text-gray-600 text-sm mb-4">
                <!-- Tanggal Pembuatan -->
                <p>{{ $berita->created_at->format('d F Y') }}</p>

                <!-- Ikon Media Sosial -->
                <div class="flex space-x-4">
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="hover:text-gray-900">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="hover:text-gray-900">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                        class="hover:text-gray-900">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Judul -->
            <h1 class="text-4xl font-serif font-bold text-center text-gray-900 mb-10 leading-snug">
                {{ $berita->judul }}
            </h1>

            <!-- Gambar -->
            @if ($berita->gambar)
                <div class="flex justify-center mb-12">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                        class="rounded-lg shadow-lg object-cover w-full max-h-[500px] md:w-3/4 lg:w-2/3">
                </div>
            @endif

            <!-- Isi Berita -->
            <article class="prose prose-lg mx-auto text-gray-800 leading-relaxed font-serif">
                <p>{{ $berita->isi_berita }}</p>
            </article>
        </div>
    </div>

</x-app-layout>
