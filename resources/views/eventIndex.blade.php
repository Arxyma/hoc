<x-main-layout>
    <section class="bg-white dark:bg-gray-900 max-w-screen-xl mx-auto px-6 mt-10 rounded-lg">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-[#1B4E95] capitalize lg:text-5xl dark:text-white mb-2">Events</h1>
            <h3 class="mt-0 mb-0">Event ini bertujuan untuk membantu seluruh incubatories mengembangkan skill, keterampilan, dan pengetahuan dengan dipandu oleh para praktisi berpengalaman, event ini memberikan kesempatan belajar langsung dan praktik yang dapat diaplikasikan segera.</h3>
            <h2 class="mt-2 mb-0 text-lg font-bold">Info Upcoming Event</h2>

            <div class="mt-5">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-sm mx-auto md:max-w-full">
                    @foreach ($events as $event)
                        <div class="bg-white border rounded-xl shadow-xl overflow-hidden hover:scale-105 transition-transform duration-300">
                            <img class="aspect-video object-cover" src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->nama_event }}">

                            <div class="grid gap-4 p-6">
                                <div class="grid">
                                    <a href="{{ route('eventShow', $event->id) }}" class="text-xl font-semibold hover:text-blue-500 transition-colors duration-300">
                                        {{ $event->nama_event }}
                                    </a>
                                    <span class="text-sm text-neutral-500">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}</span>
                                </div>
                                <p class="line-clamp-2">
                                    {{ $event->description }}
                                </p>
                                <div class="flex gap-4 items-center">
                                    <img class="inline-block size-10 rounded-full" src="{{ asset('/storage/' . $event->mentor->image) }}" alt="{{ $event->mentor->name }}">
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

                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
