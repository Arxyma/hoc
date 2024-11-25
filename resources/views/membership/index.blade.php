<x-app-layout>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
                <!-- Flexbox untuk menata judul dan tombol -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Persetujuan Membership</h2>
                    <!-- Tombol Daftar Membership di kanan -->
                    <a href="{{ route('membership.listMembership') }}" 
                       class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Daftar Membership
                    </a>
                </div>
        @if (session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="px-4 py-2 border">Event yang Diikuti</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingMemberships as $user)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $loop->iteration }} <!-- Menambahkan nomor urut -->
                        </td>
                        <td class="py-2 px-4 border">{{ $user->name }}</td>
                        <td class="py-2 px-4 border">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            @if ($user->events->isEmpty())
                                <p>Tidak ada event yang diikuti</p>
                            @else
                                <ul class="list-disc ml-4">
                                    @foreach ($user->events as $event)
                                        <!-- Link ke halaman riwayat event -->
                                        <div><a href="{{ route('membership.history', ['userId' => $user->id]) }}"
                                                class="text-blue-500">{{ $event->name }}
                                                <p>Lihat event yang diikuti</p>
                                            </a></div>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td class="py-2 px-4 border">
                            <!-- Tombol Approve -->
                            <form action="{{ route('membership.approve', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-white bg-blue-500 px-4 py-1 rounded">Setujui</button>
                            </form>

                            <!-- Tombol Reject -->
                            <form action="{{ route('membership.reject', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-white bg-red-500 px-4 py-1 rounded">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">Tidak ada pengajuan membership</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
