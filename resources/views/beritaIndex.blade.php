<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tightx">
            Berita
        </h2>
    </x-slot>
    <section class="max-w-screen-xl mx-auto px-6 mt-10">
        <div
            class="container mx-auto px-10 py-12 bg-gradient-to-r from-blue-50 via-white to-blue-50 rounded-xl shadow-md">
            <h1 class="text-3xl font-bold text-blue-600 lg:text-2xl text-center mb-6">Daftar Berita</h1>

            @if ($beritas->isEmpty())
                <div class="bg-red-100 text-red-700 border border-red-300 p-4 rounded shadow-sm text-center">
                    Data Belum Tersedia!
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                    @foreach ($beritas as $berita)
                        <a href="{{ route('beritaTampil', $berita->slug) }}"
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:scale-105 transition-transform duration-300 group border border-gray-200">

                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                                    class="w-full h-48 object-cover">
                            @endif

                            <div class="p-4">
                                <h2
                                    class="text-lg font-semibold text-blue-700 group-hover:text-blue-900 transition-colors duration-300">
                                    {{ $berita->judul }}
                                </h2>
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ $berita->created_at->format('d M Y') }}
                                </p>
                                <p class="text-gray-600 text-sm leading-relaxed mt-3">
                                    {{ Str::limit($berita->isi_berita, 55) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="mt-10">
                {{ $beritas->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

</x-app-layout>
