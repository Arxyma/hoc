<x-main-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-white rounded-xl p-6">
            <div class="">
                <h1 class="text-3xl font-bold text-blue-500 lg:text-5xl">Events</h1>
                <h3 class="mt-4">Event ini bertujuan untuk membantu seluruh incubatories mengembangkan skill,
                    keterampilan, dan pengetahuan dengan dipandu oleh para praktisi berpengalaman, event ini memberikan
                    kesempatan belajar langsung dan praktik yang dapat diaplikasikan segera.</h3>
            </div>

            <div class="mt-10">
                <h2 class="mt-2 mb-0 text-lg font-bold">Info Upcoming Event</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-sm mx-auto md:max-w-full mt-4">
                    @foreach ($events as $event)
                        <div class="bg-white border rounded-xl shadow-xl overflow-hidden hover:scale-105 cursor-pointer transition-transform duration-300"
                            onclick="window.location='{{ route('eventShow', $event->slug) }}'">
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
                                   {!! Str::limit($event->description, 100) !!}
                                </p>
                                <div class="mentors">
                                    @php
                                        // Ambil maksimal 3 mentor pertama
                                        $mentors = $event->mentors->take(3);
                                        $extraMentorsCount = $event->mentors->count() - 3; // Hitung mentor lainnya
                                    @endphp

                                    @foreach ($mentors as $mentor)
                                        <div class="flex gap-4 items-center">
                                            <img class="inline-block size-10 rounded-full"
                                                src="{{ asset('/storage/' . $mentor->image) }}"
                                                alt="{{ $mentor->name }}">
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
                <!-- Pagination Links -->
                @if ($events->hasPages())
                    <div class="mt-6">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-main-layout>
