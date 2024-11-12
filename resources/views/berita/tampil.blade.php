<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $berita->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">{{ $berita->judul }}</h3>
                    <p class="text-sm text-gray-600 mb-2">Slug: {{ $berita->slug }}</p>
                    <p class="text-sm text-gray-600 mb-4">Dibuat pada: {{ $berita->created_at->format('d-m-Y H:i') }}</p>

                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="mb-4">
                    @endif

                    <div class="text-gray-700">
                        <p>{{ $berita->isi_berita }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('berita.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
