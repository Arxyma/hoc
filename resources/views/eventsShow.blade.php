<x-app-layout>
    <section class="max-w-screen-xl mx-auto px-6 mt-10">
        <div class="bg-white border rounded-xl shadow-xl overflow-hidden p-6">
            <!-- Konten Event -->
            <div class="grid md:grid-cols-5 gap-8">
                <!-- Gambar Event dan Detail Event -->
                <div class="md:col-span-2 aspect-square">
                    @if ($event->image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="Gambar Event"
                                class="w-full h-full object-cover rounded-lg shadow-md">
                        </div>
                    @else
                        <div
                            class="aspect-square bg-gray-200 flex items-center justify-center text-gray-500 text-lg rounded-lg shadow-md">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Detail Event -->
                <div class="md:col-span-3">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-2">{{ $event->nama_event }}</h1>
                        <p class="text-neutral-700 text-sm">
                            Dimulai pada: {{ $event->tanggal_mulai->translatedFormat('d F Y') }}
                            {{ $event->start_time->format('H:i') }}
                        </p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-neutral-100 p-4 rounded-lg shadow-inner">
                        <h2 class="text-lg font-semibold text-neutral-800 mb-2">Deskripsi Event</h2>
                        <p class="text-neutral-600">{!! $event->description ?? 'Tidak ada deskripsi yang tersedia' !!}</p>
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

            <!-- Daftar Mentor -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold">Mentor</h2>
                <div class="flex flex-wrap gap-6 mt-4">
                    @foreach ($mentors as $mentor)
                        <div class="flex gap-4 items-center">
                            <img class="inline-block size-10 rounded-full"
                                src="{{ asset('/storage/' . $mentor->image) }}" alt="{{ $mentor->name }}">
                            <div>
                                <a href="{{ route('mentors.events', $mentor->id) }}">
                                    {{ $mentor->name }}
                                </a>
                                <div class="text-xs">Mentor</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Daftar Peserta -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold">Peserta</h2>
                Peserta Yang Sudah Daftar : {{ $countParticipants }} / {{ $kuota }}
            </div>

            <!-- Pesan Alert -->
            @if (session('message') || session('berhasil'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        @if (session('message'))
                            Swal.fire({
                                title: 'Informasi',
                                text: "{{ session('message') }}",
                                icon: 'info',
                                confirmButtonText: 'OK'
                            });
                        @endif

                        @if (session('berhasil'))
                            Swal.fire({
                                title: 'Sukses!',
                                text: "{{ session('berhasil') }}",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        @endif
                    });
                </script>
            @endif
        </div>

        <!-- Rekomendasi Event -->
        <section class="mt-10">
            <h2 class="text-xl font-bold mb-4">Rekomendasi Event untuk Anda</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-sm mx-auto md:max-w-full mt-4">
                @foreach ($rekomendasiEvent as $rekomendasi)
                    <div class="bg-white border rounded-xl shadow-xl overflow-hidden hover:scale-105 cursor-pointer transition-transform duration-300"
                        onclick="window.location='{{ route('eventShow', $rekomendasi->slug) }}'">
                        <div class="relative aspect-video overflow-hidden">
                            <a href="{{ route('eventShow', $rekomendasi->slug) }}">
                                <img class="w-full h-full object-cover absolute"
                                    src="{{ asset('/storage/' . $rekomendasi->image) }}"
                                    alt="{{ $rekomendasi->nama_event }}">
                            </a>
                        </div>
                        <div class="grid gap-4 p-6">
                            <div class="grid">
                                <a href="{{ route('eventShow', $rekomendasi->slug) }}"
                                    class="text-xl font-semibold hover:text-blue-500 transition-colors duration-300">
                                    {{ $rekomendasi->nama_event }}
                                </a>
                                <span
                                    class="text-sm text-neutral-500">{{ \Carbon\Carbon::parse($rekomendasi->tanggal_mulai)->translatedFormat('d F Y') }}</span>
                            </div>
                            <p class="line-clamp-2">
                                {!! $rekomendasi->description !!}
                            </p>
                            <div class="mentors">
                                @php
                                    // Ambil maksimal 3 mentor pertama
                                    $mentors = $rekomendasi->mentors->take(3);
                                    $extraMentorsCount = $rekomendasi->mentors->count() - 3; // Hitung mentor lainnya
                                @endphp

                                @foreach ($mentors as $mentor)
                                    <div class="flex gap-4 items-center">
                                        <img class="inline-block size-10 rounded-full"
                                            src="{{ asset('/storage/' . $mentor->image) }}" alt="{{ $mentor->name }}">
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
        </section>
    </section>
</x-app-layout>
