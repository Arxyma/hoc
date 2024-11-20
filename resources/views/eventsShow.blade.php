<x-app-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-white border rounded-xl shadow-xl overflow-hidden p-6">
            <div class="grid md:grid-cols-5 gap-8">
                <!-- Gambar Event -->
                <div class="md:col-span-2 aspect-square">
                    @if($event->image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="Gambar Event"
                                class="w-full h-full object-cover rounded-lg shadow-md">
                        </div>
                    @else
                        <div class="aspect-square bg-gray-200 flex items-center justify-center text-gray-500 text-lg rounded-lg shadow-md">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Detail Event -->
                <div class="md:col-span-3">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-2">{{ $event->nama_event }}</h1>
                        <p class="text-neutral-700 text-sm">Diselenggarakan oleh: {{ $event->user->name ?? 'Unknown' }}</p>
                        <p class="text-neutral-500 text-xs">
                            Dimulai pada: {{ $event->tanggal_mulai->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-neutral-100 p-4 rounded-lg shadow-inner">
                        <h2 class="text-lg font-semibold text-neutral-800 mb-2">Deskripsi Event</h2>
                        <p class="text-neutral-600">{{ $event->description ?? 'Tidak ada deskripsi yang tersedia' }}</p>
                    </div>

                    <!-- Form Join Event -->
                    <div class="mt-6">
                        <form action="{{ route('events.join', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Join Event
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Peserta -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold">Daftar Peserta</h2>
                <div class="mt-4 space-y-4">
                    @forelse($event->participants as $participant)
                        <div
                            class="flex items-center bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex-shrink-0">
                                <svg class="w-12 h-12 text-indigo-600 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 17h5l-1.404 1.404A2.25 2.25 0 0116.5 21h-9a2.25 2.25 0 01-2.096-1.696L4 17h5m6-10V9m0 0V6m0 3h-9M16 6h-4m-1 10h2.586a1.5 1.5 0 001.415-1h0a1.5 1.5 0 00-1.415-1H15m0 0V9" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <span class="text-lg font-semibold">{{ $participant->name }}</span>
                                <p class="text-sm text-gray-500">{{ $participant->email }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada peserta yang terdaftar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
