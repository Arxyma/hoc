<x-main-layout>
    <!-- component -->
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">All Events</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($events as $event)
                    <div class="lg:flex bg-slate-100 rounded-md">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64"
                            src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->nama_event }}">

                        <div class="flex flex-col justify-between py-6 lg:mx-6">
                            <a href="{{ route('eventShow', $event->id) }}"
                                class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                                {{ $event->nama_event }}
                            </a>

                            <span
                                class="text-sm text-white dark:text-gray-300 bg-indigo-400 rounded-md p-2">{{ $event->mentor->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>