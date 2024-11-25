<x-app-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-10">
        <div class="bg-white border rounded-xl shadow-xl overflow-hidden p-6">
            <!-- Informasi Mentor -->
            <div class="flex items-center gap-6">
                <img class="inline-block rounded-full w-24 h-24 object-cover"
                    src="{{ asset('storage/' . $mentor->image) }}" alt="{{ $mentor->name }}">
                <div>
                    <h1 class="text-3xl font-bold">{{ $mentor->name }}</h1>
                    <p class="text-sm text-neutral-500">Mentor</p>
                </div>
            </div>

            <!-- Event yang Diikuti oleh Mentor -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold">Mentor di Event :</h2>
                @if ($events->isEmpty())
                    <p>Tidak ada event yang terkait dengan mentor ini.</p>
                @else
                    <div class="mt-4">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-sm mx-auto md:max-w-full">
                            @foreach ($events as $event)
                                <div class="bg-white border rounded-xl shadow-xl overflow-hidden hover:scale-105 cursor-pointer transition-transform duration-300"
                                    onclick="window.location='{{ route('eventShow', $event->slug) }}'">
                                    <div class="relative aspect-video overflow-hidden">
                                        <a href="{{ route('eventShow', $event->slug) }}">
                                            <img class="w-full h-full object-cover absolute"
                                                src="{{ asset('/storage/' . $event->image) }}"
                                                alt="{{ $event->nama_event }}">
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
                                            {!! $event->description !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Paginasi -->
                        <div class="mt-6">
                            {{ $events->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
