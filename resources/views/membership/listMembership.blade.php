<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Daftar Membership </h2>

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $user)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $loop->iteration }} <!-- Menambahkan nomor urut -->
                        </td>
                        <td class="py-2 px-4 border">{{ $user->name }}</td>
                        <td class="py-2 px-4 border">{{ $user->email }}</td>
                        <td class="py-2 px-4 border">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $members->links() }} <!-- Menampilkan pagination -->
        </div>
    </div>
</x-app-layout>
