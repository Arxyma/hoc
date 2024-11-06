<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tightx">
            {{ $berita->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4 text-center">{{ $berita->judul }}</h3>
                    <p class="text-sm text-gray-600 mb-2"> {{ $berita->slug }}</p>
                    <p class="text-sm text-gray-600 mb-4">Dibuat pada: {{ $berita->created_at->format('d-m-Y H:i') }}</p>
                    <div class="flex justify-center">
                        @if ($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="mb-4 w-1/2">
                        @endif
                    </div>
                    <div class="text-gray-700 text-justify">
                        <p>{{ $berita->isi_berita }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
