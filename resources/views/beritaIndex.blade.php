<x-app-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-white rounded-xl p-6">
            <div class="">
                <h1 class="text-3xl font-bold text-blue-500 lg:text-5xl">Daftar Berita</h1>
            </div>
            <div class="mt-10">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-sm mx-auto md:max-w-full mt-4">
                    @forelse ($beritas as $berita)
                        <div
                            class="bg-white border rounded-xl shadow-xl overflow-hidden hover:scale-105 transition-transform duration-300">
                            <div class="relative aspect-video overflow-hidden">
                                <a href="{{ route('eventShow', $berita->slug) }}">
                                    <img class="w-full h-full object-cover absolute"
                                        src="{{ asset('/storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                                </a>
                            </div>
                            <div class="grid gap-4 p-6">
                                <div class="grid">
                                    <a href="{{ route('eventShow', $berita->slug) }}"
                                        class="text-xl font-semibold hover:text-blue-500 transition-colors duration-300">
                                        {{ $berita->judul }}
                                    </a>
                                    <span
                                        class="text-sm text-neutral-500">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                                </div>
                                <p class="line-clamp-2">
                                    {{ $berita->isi_berita }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 bg-red-200 text-red-700 rounded p-4 border border-red-700">
                            Ups, belum ada berita yang tersedia.
                        </div>
                    @endforelse
                </div>
                <!-- Pagination Links -->
                @if ($beritas->hasPages())
                    <div class="mt-6">
                        {{ $beritas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

</x-app-layout>
