<x-app-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="container mx-auto px-10 py-12 bg-white rounded-xl ">
            <h1 class="text-3xl font-bold text-blue-500 lg:text-md text-center">Daftar Berita</h1>
            @if ($beritas->isEmpty())
                <div class="bg-red-500 text-white p-3 rounded shadow-sm mb-3">
                    Data Belum Tersedia!
                </div>
            @else
                <div class="grid grid-cols-1 max-w-md md:max-w-full mx-auto md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @foreach ($beritas as $berita)
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:scale-105 transition-transform duration-300 group">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                                    class="w-full h-48 object-cover ">
                            @endif
                            <div class="p-4">
                                <h2 class="text-lg font-semibold">{{ $berita->judul }}</h2>
                                <p class="text-sm text-gray-500 mb-4">{{ $berita->slug }}</p>
                                <p class="text-gray-600 mt-2">{{ Str::limit($berita->isi_berita, 55) }}
                                    <a href="{{ route('beritaTampil', $berita->slug) }}"
                                        class="text-blue-500 hover:underline inline-block">lihat selengkapnya</a>
                                </p>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-4">
                {{ $beritas->links() }}
            </div>
        </div>
    </section>

</x-app-layout>
