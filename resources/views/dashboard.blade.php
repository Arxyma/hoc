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
                    <form action="{{ route('membership.request') }}" method="POST">
                        @csrf
                        <a href="/login" class="block w-fit px-6 py-2 rounded-full bg-orange-400 font-bold">Get
                            Started</a>
                    </form>
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
                        class="bg-white border rounded-xl shadow-xl overflow-hidden hover:scale-105 cursor-pointer transition-transform duration-300" onclick="window.location='{{ route('eventShow', $event->slug) }}'" >
                        <div class="relative aspect-video overflow-hidden">
                            <a href="{{ route('eventShow', $event->slug) }}">
                                <img class="w-full h-full object-cover absolute"
                                    src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->nama_event }}">
                            </a>
                        </div>
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
                            <div class="mentors">
                                @php
                                    // Ambil maksimal 3 mentor pertama
                                    $mentors = $event->mentors->take(3);
                                    $extraMentorsCount = $event->mentors->count() - 3; // Hitung mentor lainnya
                                @endphp
                    
                                @foreach ($mentors as $mentor)
                                    <div class="flex gap-4 items-center">
                                        <img class="inline-block size-10 rounded-full" src="{{ asset('/storage/' . $mentor->image) }}" alt="{{ $mentor->name }}">
                                        <div>
                                            <div class="font-bold">
                                                {{ $mentor->name }}
                                            </div>
                                            <div class="text-xs">
                                                Mentor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                    
                                @if ($extraMentorsCount > 0)
                                    <div class="text-sm text-gray-500">
                                        + {{ $extraMentorsCount }} mentor lainnya
                                    </div>
                                @endif
                            </div>                      
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('eventIndex') }}"
                    class="inline-block bg-orange-400 hover:bg-orange-300 transition-colors duration-300 text-white rounded-full font-bold px-6 py-2">See
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

                        @guest
                            <a href="{{ route('login') }}"
                                class="block w-fit mt-5 px-6 py-2 rounded-full bg-orange-400 font-bold">
                                Join Membership
                            </a>
                        @endguest
                        @can('multi-role', 'level1|level2')
                            <a href="{{ route('membership.request') }}"
                                class="block w-fit mt-5 px-6 py-2 rounded-full bg-orange-400 font-bold">
                                Join Membership
                            </a>
                        @endcan
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
                        <div class="text-lg">Mendapatkan informasi terbaru yang ada di House of community</div>
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
                        <div class="text-lg">Akses penuh untuk mendaftar dan mengikuti semua event yang diadakan</div>
                    </div>
                </div>
                <div class="flex gap-6 bg-white p-6 rounded-xl border shadow-xl">
                    <div class="text-orange-400"><svg class="size-10 md:size-16" xmlns="http://www.w3.org/2000/svg"
                            width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-cog">
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
                        <div class="text-lg">Dukungan khusus melalui mentor dan ahli untuk mengembangkan bisnis UMKM
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
                        <div class="text-lg">Peluang menerima rekomendasi untuk kolaborasi atau pendanaan jika bisnis
                            memenuhi kriteria tertentu.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="text-center">
            <div class="text-blue-500 font-bold text-3xl md:text-5xl">Produk Unggulan Peserta HOC</div>
            <div class="text-base md:text-xl mt-2">Beragam produk inovatif yang dihasilkan dari pelatihan di House of
                Community. <span class="block">Temukan karya kreatif, teknologi baru, dan produk berkualitas dari para
                    inovator lokal.</span></div>
        </div>
        <div class="grid grid-cols-1 max-w-md md:max-w-full mx-auto md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @foreach ($promosis as $promosi)
                <div class="hover:scale-105 transition-transform duration-300">
                    <a href="{{ route('promosis.detail', $promosi->id) }}"
                        class="bg-white shadow border rounded-xl overflow-hidden aspect-[5/4] relative block">
                        @php
                            $foto_produk = json_decode($promosi->foto_produk);
                            $foto_pertama = $foto_produk[0] ?? null;
                        @endphp
                        @if ($foto_pertama)
                            <img src="{{ asset('storage/' . $foto_pertama) }}" alt="Foto Produk"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif
                        <div
                            class="absolute h-full w-full top-0 bg-gradient-to-t from-black/90 to-70% to-transparent flex flex-col justify-end">
                            <div class="text-white p-4">
                                <div class="text-xl font-bold">{{ $promosi->judul }}</div>
                                <div class="flex gap-1 items-center text-xs text-neutral-300 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>{{ $promosi->user->name ?? 'Unknown' }}
                                </div>
                                <div class="flex gap-1 items-center text-xs text-neutral-300 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-calendar">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                    {{ $promosi->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('promosis.index') }}"
                class="inline-block bg-orange-400 hover:bg-orange-300 transition-colors duration-300 text-white rounded-full font-bold px-6 py-2">See
                More</a>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="text-center">
            <h2 class="text-blue-500 font-bold text-3xl md:text-5xl">Berita & Artikel HoC</h2>
            <p class="text-base md:text-xl mt-2">Dapatkan informasi terbaru, artikel inspiratif dan cerita sukses
                dari
                komunitas House of Community.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10 ">
            @foreach ($beritas as $berita)
                <a href="{{ route('beritaTampil', $berita->slug) }}"
                    class="bg-white shadow border rounded-xl overflow-hidden aspect-video first:row-span-2 first:aspect-auto relative block hover:scale-105 transition-transform duration-300">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Foto Produk"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif
                    <div
                        class="absolute h-full w-full top-0 bg-gradient-to-t from-black/90 to-70% to-transparent flex flex-col justify-end">
                        <div class="text-white p-4">
                            <div class="text-xl font-bold line-clamp-1">{{ $berita->judul }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('beritaIndex') }}"
                class="inline-block bg-orange-400 hover:bg-orange-300 transition-colors duration-300 text-white rounded-full font-bold px-6 py-2">See
                More</a>
        </div>
    </section>
</x-app-layout>
