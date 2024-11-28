<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tightx">
            Berita
        </h2>
    </x-slot>
    <section class="max-w-screen-xl mx-auto px-6 mt-5">
        <div
            class="container mx-auto px-10 py-12 bg-gradient-to-br from-blue-100 via-white to-blue-200 rounded-xl shadow-lg border border-gray-200">
            <h1 class="text-3xl font-bold text-blue-700 lg:text-3xl text-center mb-2">Daftar Berita</h1>
            <div class="flex justify-center items-center mb-8">
                <div class="h-1 bg-gradient-to-r from-orange-500 to-yellow-300 w-24 rounded-full"></div>
                <svg class="w-6 h-6 mx-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                </svg>
                <div class="h-1 bg-gradient-to-r from-yellow-300 to-orange-500 w-24 rounded-full"></div>
            </div>

            @if ($beritas->isEmpty())
                <div class="bg-red-50 text-red-800 border border-red-300 p-4 rounded shadow-sm text-center">
                    Data Belum Tersedia!
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                    @foreach ($beritas as $berita)
                        <a href="{{ route('beritaTampil', $berita->slug) }}"
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:scale-105 transition-transform duration-300 group border border-gray-300 hover:shadow-xl">

                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                                    class="w-full h-48 object-cover rounded-t-lg">
                            @endif

                            <div class="p-4 bg-gradient-to-b from-white to-gray-50">
                                <h2
                                    class="text-lg font-semibold text-gray-900 group-hover:text-blue-800 transition-colors duration-300">
                                    {{ $berita->judul }}
                                </h2>
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ $berita->created_at->format('d M Y') }}
                                </p>
                                <p class="text-gray-600 text-sm leading-relaxed mt-3">
                                    {!! Str::limit($berita->isi_berita, 55) !!}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>


        <div class="mt-10">
            {{ $beritas->links('pagination::tailwind') }}
        </div>
        </div>
    </section>

</x-app-layout>
