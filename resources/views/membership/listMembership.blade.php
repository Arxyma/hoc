<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <!-- Flexbox untuk menata judul dan tombol -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700">Daftar Membership</h2>
            <!-- Tombol Daftar Membership di kanan -->
            <a href="{{ route('membership.export') }}" 
               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Export Excel
            </a>
        </div>
        <!-- Sort Dropdown -->
        <div class="mb-4">
            <form method="GET" action="{{ route('membership.listMembership') }}">
                <label for="sort" class="mr-2 text-gray-700">Sort by:</label>
                <select id="sort" name="sort" onchange="this.form.submit()" class="px-4 py-2 rounded border-gray-300">
                    <option value="">Select</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Tanggal (Terbaru)</option>
                    <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Tanggal (Terlama)</option>
                </select>
            </form>
        </div>

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
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border">{{ $user->name }}</td>
                        <td class="py-2 px-4 border">{{ $user->email }}</td>
                        <td class="py-2 px-4 border">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $members->links() }}
        </div>
    </div>
</x-app-layout>
