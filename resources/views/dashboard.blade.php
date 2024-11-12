<x-app-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        @if (session('status'))
            <div class="bg-green-500 text-white text-center p-4 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        <div class="bg-gradient-to-r from-blue-500 to-80% to-blue-900 rounded-xl text-white p-10">
            <div class="grid md:grid-cols-2">
                <div class="grid gap-4">
                    <div class="font-bold text-5xl">
                        # Ide <span class="text-orange-400">jadi solusi</span>
                    </div>
                    <div class="text-xl">
                        Pemecahan masalah interaktif yang menyenangkan dan efektif. Wujudkan ide menjadi solusi dalam
                        komunitas setiap hari
                    </div>
                    <a href="" class="block w-fit px-6 py-2 rounded-full bg-orange-400 font-bold">Get Started</a>
                    {{-- <form action="{{ route('membership.request') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-fit px-6 py-2 rounded-full bg-orange-400 font-bold">Get Started</button>
                    </form> --}}
                </div>
                <div class="relative hidden md:block">
                    <img src="{{ asset('woman-one.png') }}" alt=""
                        class="absolute w-auto h-[350px] -bottom-10 right-0">
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="text-center">
            <div class="text-blue-500 font-bold text-3xl md:text-5xl">Dirancang untuk Membangun, Bersama Komunitas</div>
            <div class="text-base md:text-xl mt-2">Event House of Community mendorong sinergi dan inovasi untuk
                menciptkan
                kolaborasi dan
                dampak positif bagi ekosistem lokal</div>
        </div>
        <div class="mt-10">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-sm mx-auto md:max-w-full">
                @foreach ($events as $event)
                    <div
                        class="bg-white border rounded-xl shadow-xl overflow-hidden hover:scale-105 transition-transform duration-300">
                        <a href="{{ route('eventShow', $event->slug) }}">
                            <img class="aspect-video object-cover" src="{{ asset('/storage/' . $event->image) }}"
                                alt="{{ $event->nama_event }}">
                        </a>

                        <div class="grid gap-4 p-6">
                            <div class="grid">
                                <a href="{{ route('eventShow', $event->slug) }}"
                                    class="text-xl font-semibold hover:text-blue-500 transition-colors duration-300">
                                    {{ $event->nama_event }}
                                </a>
                                <span
                                    class="text-sm text-neutral-500">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}</span>
                            </div>
                            <p class="line-clamp-2">
                                {{ $event->description }}
                            </p>
                            <div class="flex gap-4 items-center">
                                <img class="inline-block size-10 rounded-full"
                                    src="{{ asset('/storage/' . $event->mentor->image) }}"
                                    alt="{{ $event->mentor->name }}">
                                <div class="">
                                    <div class="font-bold">
                                        {{ $event->mentor->name }}
                                    </div>
                                    <div class="text-xs">
                                        Mentor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('eventIndex') }}"
                    class="inline-block bg-orange-400 hover:bg-orange-300 transition-colors duration-300 text-white rounded-full text-xl font-bold px-10 py-4">See
                    More</a>
            </div>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-gradient-to-r from-blue-500 to-80% to-blue-900 rounded-xl text-white p-10">
            <div class="grid md:grid-cols-4">
                <div class="col-span-1 relative hidden md:block z-10">
                    <img src="{{ asset('woman-two.png') }}" alt=""
                        class="absolute h-[250px] min-w-fit -bottom-10 -left-20">
                </div>
                <div class="md:col-span-3 z-20">
                    <div class="w-fit mx-auto">
                        <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold">Let's join
                            Membership</div>
                        <a href="{{ route('membership.request') }}"
                            class="block w-fit px-6 py-2 rounded-full bg-orange-400 font-bold">
                            Join Membership
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <div class="text-blue-500 font-bold text-3xl md:text-4xl text-center">
                Kenapa Harus Bergabung di Komunitas HOC?
            </div>
            <div class="grid md:grid-cols-2 gap-6 mt-10">
                <div class="flex gap-6 bg-white p-6 rounded-xl border shadow-xl">
                    <div class="text-orange-400">
                        <svg class="size-10 md:size-16" xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-pen">
                            <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
                            <path d="M2 6h4" />
                            <path d="M2 10h4" />
                            <path d="M2 14h4" />
                            <path d="M2 18h4" />
                            <path
                                d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                        </svg>
                    </div>
                    <div class="md:text-xl">
                        <div class="font-bold">Mendapatkan informasi terbaru</div>
                        <div class="">Mendapatkan informasi terbaru yang ada di House of community</div>
                    </div>
                </div>
                <div class="flex gap-6 bg-white p-6 rounded-xl border shadow-xl">
                    <div class="text-orange-400">
                        <svg class="size-10 md:size-16" xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rocket">
                            <path
                                d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
                            <path
                                d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
                            <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" />
                            <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                        </svg>
                    </div>
                    <div class="md:text-xl">
                        <div class="font-bold">Dapat mendaftar semua Event </div>
                        <div class="">Akses penuh untuk mendaftar dan mengikuti semua event yang diadakan</div>
                    </div>
                </div>
                <div class="flex gap-6 bg-white p-6 rounded-xl border shadow-xl">
                    <div class="text-orange-400"><svg class="size-10 md:size-16" xmlns="http://www.w3.org/2000/svg"
                            width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cog">
                            <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" />
                            <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                            <path d="M12 2v2" />
                            <path d="M12 22v-2" />
                            <path d="m17 20.66-1-1.73" />
                            <path d="M11 10.27 7 3.34" />
                            <path d="m20.66 17-1.73-1" />
                            <path d="m3.34 7 1.73 1" />
                            <path d="M14 12h8" />
                            <path d="M2 12h2" />
                            <path d="m20.66 7-1.73 1" />
                            <path d="m3.34 17 1.73-1" />
                            <path d="m17 3.34-1 1.73" />
                            <path d="m11 13.73-4 6.93" />
                        </svg></div>
                    <div class="md:text-xl">
                        <div class="font-bold">Fasilitasi Pendampingan Usaha</div>
                        <div class="">Dukungan khusus melalui mentor dan ahli untuk mengembangkan bisnis UMKM
                            atau
                            startup digital.</div>
                    </div>
                </div>
                <div class="flex gap-6 bg-white p-6 rounded-xl border shadow-xl">
                    <div class="text-orange-400"><svg class="size-10 md:size-16" xmlns="http://www.w3.org/2000/svg"
                            width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-book-marked">
                            <path d="M10 2v8l3-3 3 3V2" />
                            <path
                                d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20" />
                        </svg></div>
                    <div class="md:text-xl">
                        <div class="font-bold">Mendapatkan Rekomendasi Usaha </div>
                        <div class="">Peluang menerima rekomendasi untuk kolaborasi atau pendanaan jika bisnis
                            memenuhi kriteria tertentu.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold text-blue-700 mb-4">Berita & Artikel HoC</h2>
            <p class="text-gray-600 mb-8">Dapatkan informasi terbaru, artikel inspiratif dan cerita sukses dari
                komunitas House of Community.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($beritas as $berita)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($berita->gambar)
                            <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $berita->gambar) }}"
                                alt="Gambar Berita">
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $berita->judul }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($berita->isi_berita, 55) }}
                                <a href="{{ route('beritaTampil', $berita->id) }}"
                                    class="text-blue-500 hover:underline inline-block">baca selengkapnya</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $beritas->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
