<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Halaman Admin Promosi</h2>
        </div>
    </header>
    <div class="container mx-auto px-10 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h1 class="text-lg font-medium text-gray-900 dark:text-gray-100">Semua Promosi</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Lihat dan kelola semua promosi.
                    </p>

                    <!-- Search Form -->
                    <form action="{{ route('promosis.semuapromosi') }}" method="GET" class="flex items-center gap-4 mt-4">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari nama produk..." 
                            value="{{ request('search') }}" 
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                        >
                            Cari
                        </button>
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <thead class="">
                                <tr>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gambar Produk</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-52">Nama Produk</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <a href="{{ route('promosis.semuapromosi', ['search' => request('search'), 'sort' => $sortOrder === 'desc' ? 'asc' : 'desc']) }}" 
                                            class="flex items-center justify-center">
                                            Tanggal diupload
                                            @if ($sortOrder === 'desc')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M6 9l6 6 6-6" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M6 15l6-6 6 6" />
                                                </svg>
                                            @endif
                                        </a>
                                    </th>                                  
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Diupload Oleh</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($promosis as $index => $promosi)
                                    <tr class="border-b dark:border-gray-900">
                                        <td class="px-4 py-2 text-center text-gray-900 dark:text-gray-200">{{ $index + 1 }}</td>
                                        <td class="px-4 py-8 flex items-center justify-center">
                                            <a href="{{ route('promosis.detail', $promosi->slug) }}" class="block">
                                                @if ($promosi->foto_produk)
                                                    @php
                                                        $foto_produk = json_decode($promosi->foto_produk);
                                                        $foto_pertama = $foto_produk[0] ?? null;
                                                    @endphp
                                                    @if ($foto_pertama)
                                                        <img src="{{ asset('storage/' . $foto_pertama) }}" alt="Foto Produk" class="w-24 h-24 object-cover rounded-lg shadow">
                                                    @else
                                                        <div class="w-24 h-24 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                                            No Image
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="w-24 h-24 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                                        No Image
                                                    </div>
                                                @endif
                                            </a>
                                        </td>
                                        <td class="px-4 py-2 text-center font-semibold text-blue-500 dark:text-blue-400">
                                            <a href="{{ route('promosis.detail', $promosi->slug) }}" class="block">
                                                {{ Str::limit($promosi->judul, 35) }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2 text-center text-gray-900 dark:text-gray-200">{{ $promosi->created_at->format('d/m/Y') ?? 'Unknown' }}</td>
                                        <td class="px-4 py-2 text-center text-gray-900 dark:text-gray-200">{{ $promosi->user->name ?? 'Unknown' }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST" class="inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="redirect" value="semuapromosi">
                                                <button type="button" class="bg-red-500 text-white px-2 py-1 mt-2 rounded delete-button" data-title="{{ $promosi->judul }}">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada data ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pt-8 mt-4">
                    {{ $promosis->links() }}
                </div>
            </div>
        </div>
    </div>    

    {{-- Alert Hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const title = this.getAttribute('data-title'); // Ambil judul promosi dari atribut data-title

                    Swal.fire({
                        title: `Hapus <span style="font-weight: bold; color: red;">${title}</span> ?`,
                        text: "Item akan dihapus permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Yakin Hapus'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('.delete-form').submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
