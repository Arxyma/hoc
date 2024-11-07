<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold text-blue-700 mb-8 text-center">Event Yang Diikuti</h2>

        @if($events->isEmpty())
            <div class="text-center text-gray-600">
                <p>Anda belum mengikuti event apapun.</p>
            </div>
        @else
            <ul class="space-y-6">
                @foreach($events as $event)
                    <li class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->nama_event }}" 
                                 class="rounded-lg object-cover"
                                 style="width: 158px; height: 109.27px;">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-blue-700">{{ $event->nama_event }}</h3>
                            <p class="text-gray-500">{{ $event->tanggal_mulai->format('d-m-Y') }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
