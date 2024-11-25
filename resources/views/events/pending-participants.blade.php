<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <!-- Flexbox untuk menata judul dan tombol -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Presensi Peserta untuk: {{ $event->nama_event }}</h2>
            <!-- Tombol kembali ke daftar peserta -->
            <a href="{{ route('events.showParticipants', $event) }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Kembali ke Daftar Peserta
            </a>
        </div>

        @if (session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <table class="min-w-full bg-white border dark:bg-gray-800 dark:text-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingParticipants as $participant)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $participant->name }}</td>
                        <td class="px-4 py-2">{{ $participant->email }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <!-- Tombol Approve -->
                            <form action="{{ route('events.approveParticipant', [$event->id, $participant->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-white bg-green-500 px-4 py-1 rounded hover:bg-green-600">Hadir</button>
                            </form>
                            <!-- Tombol Reject -->
                            <form action="{{ route('events.rejectParticipant', [$event->id, $participant->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-white bg-red-500 px-4 py-1 rounded hover:bg-red-600">Tidak Hadir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada peserta yang presensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
</x-app-layout>
