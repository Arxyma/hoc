<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Persetujuan Membership</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingMemberships as $user)
                    <tr>
                        <td class="py-2 px-4 border">{{ $user->name }}</td>
                        <td class="py-2 px-4 border">{{ $user->email }}</td>
                        <td class="py-2 px-4 border">
                            <!-- Tombol Approve -->
                            <form action="{{ route('membership.approve', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-white bg-blue-500 px-4 py-1 rounded">Approve</button>
                            </form>

                            <!-- Tombol Reject -->
                            <form action="{{ route('membership.reject', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-white bg-red-500 px-4 py-1 rounded">Reject</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">Tidak ada membership yang perlu disetujui.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
