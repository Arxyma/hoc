<x-app-layout>
    <div class="container mx-auto px-10 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="m-2 p-2 flex justify-between">
                <h3 class="mb-4 text-2xl font-bold text-indigo-700">{{ $event->nama_event }}</h3>
                <div class="flex space-x-2">
                    From:
                    <span class="mx-2">{{ $event->tanggal_mulai->format('m/d/Y') }}</span>
                </div>
            </div>
            <div class="mb-16 flex flex-wrap">
                <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
                    <div class="flex flex-col">
                        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                            data-te-ripple-init data-te-ripple-color="light">
                            <img src="{{ asset('/storage/' . $event->image) }}" class="w-full" alt="Louvre" />
                            <a href="#!">
                                <div
                                    class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                                </div>
                            </a>
                        </div>
                        <div class="flex flex-col p-4">
                            <span class="text-indigo-600 font-semibold">Host Info</span>
                            <div class="flex space-x-4 mt-6 bg-slate-200 p-2 rounded-md">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg></span>
                                <div class="flex flex-col">
                                    <span class="text-2xl">{{ $event->user->name }}</span>
                                    <span class="text-2xl">{{ $event->user->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="w-full shrink-0 grow-0 lg:w-6/12 lg:pl-6 bg-slate-50 rounded-md p-2">
                    <p class="mb-6 text-sm text-yellow-600 dark:text-neutral-400">
                        Start: <time>{{ $event->start_time }}</time>
                    </p>
                    <p class="mb-6 mt-4 text-neutral-500 dark:text-neutral-300">
                        {{ $event->description }}
                    </p>
                    <form action="{{ route('events.join', $event->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Join Event
                        </button>
                    </form>
                </div>
                @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <h2 class="mt-6 text-xl font-semibold">Participants</h2>
                    <div class="mt-2 space-y-4">
                        @foreach($event->participants as $participant)
                            <div class="flex items-center bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex-shrink-0">
                                    <svg class="w-12 h-12 text-indigo-600 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.404 1.404A2.25 2.25 0 0116.5 21h-9a2.25 2.25 0 01-2.096-1.696L4 17h5m6-10V9m0 0V6m0 3h-9M16 6h-4m-1 10h2.586a1.5 1.5 0 001.415-1h0a1.5 1.5 0 00-1.415-1H15m0 0V9" />
                                    </svg>
                                </div>
                                <div class="flex-grow">
                                    <span class="text-lg font-semibold">{{ $participant->name }}</span>
                                    <p class="text-sm text-gray-500">{{ $participant->email }}</p>
                                </div>
                            </div>
                        @endforeach
            </div>

        </div>
    </div>

</x-app-layout>