<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
                Daftar Membership
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('membership.listMembership') }}" id="sortForm"
                            class="max-w-md">
                            <div class="flex flex-col">
                                <label for="sort" class="block text-sm font-semibold text-gray-800 mb-2 text-left">
                                    Sortir Berdasarkan
                                </label>
                                <select name="sort" id="sort"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300 transition duration-150 ease-in-out"
                                    onchange="document.getElementById('sortForm').submit()">
                                    <option value="">Pilih</option>
                                    <option value="name_asc"
                                        {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                        Nama (A-Z)
                                    </option>
                                    <option value="name_desc"
                                        {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                        Nama (Z-A)
                                    </option>
                                    <option value="updated_at_asc"
                                        {{ request('sort') == 'updated_at_asc' ? 'selected' : '' }}>
                                        Tanggal (Terlama)
                                    </option>
                                    <option value="updated_at_desc"
                                        {{ request('sort') == 'updated_at_desc' ? 'selected' : '' }}>
                                        Tanggal (Terbaru)
                                    </option>
                                </select>
                            </div>
                        </form>

                        <a href="{{ route('membership.export') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                            Export to Excel
                        </a>
                    </div>

                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50">
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
                                    <td class="py-2 px-4 border">{{ $user->created_at->translatedFormat('d F Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $members->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
