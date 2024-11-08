<x-app-layout>
    {{-- <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Promosi</h2>
        </div>
    </header> --}}
    <div class="container mx-auto px-10 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-blue-500 text-white p-4 rounded-lg">
                <h2 class="text-5xl font-bold text-center" style="font-family: 'Montserrat', sans-serif;">Promosi</h2>
                <p class="text-center mb-4">Ingin mempromosikan produk Anda?</p>
                @can('multi-role', 'level2|admin')    
                <div class="flex justify-center">
                    <a href="{{ route('promosis.create') }}" class="bg-white text-blue-500 hover:bg-blue-100 rounded-md text-center">
                        <button class="bg-white text-blue-500 hover:bg-blue-100 rounded-md px-4 py-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Promosi Produk
                        </button>
                    </a>
                </div>
                 @endcan
            </div>
            
            
    
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($promosis as $promosi)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                        <div class="h-48 overflow-hidden mb-4">
                            @if ($promosi->foto_produk)
                                @php
                                    // Mendekode JSON dan mengambil gambar pertama
                                    $foto_produk = json_decode($promosi->foto_produk);
                                    $foto_pertama = $foto_produk[0] ?? null;
                                @endphp
                                @if ($foto_pertama)
                                    <img src="{{ asset('storage/' . $foto_pertama) }}" alt="Foto Produk" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                        No Image
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    No Image
                                </div>
                            @endif
                            {{-- @if ($promosi->foto_produk)
                                <img src="{{ asset('storage/' . $promosi->foto_produk) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    No Image
                                </div>
                            @endif --}}
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold mb-2">
                                <a href="{{ route('promosis.detail', $promosi->id) }}" class="text-blue-500 hover:underline">
                                    {{ $promosi->judul }}
                                </a>
                            </h2>
                                <div class="text-gray-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2a5 5 0 100 10 5 5 0 000-10zM4 18a8 8 0 0116 0v1a1 1 0 01-1 1H5a1 1 0 01-1-1v-1z" />
                                </svg>
                                <span>{{ $promosi->user->name ?? 'Unknown' }}</span>
                            </div>                            
                            
                            <div class="text-gray-500 text-sm flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M8 2a1 1 0 00-1 1v1H5a3 3 0 00-3 3v12a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3h-2V3a1 1 0 10-2 0v1H9V3a1 1 0 00-1-1zM4 10h16v9a1 1 0 01-1 1H5a1 1 0 01-1-1v-9z"/>
                                </svg>
                                <span>{{ $promosi->created_at->diffForHumans() }}</span>
                            </div>                            
                            
                            @can('admin')
                                <td class="border px-4 py-2">
                                    <form action="{{ route('promosis.edit', $promosi->id) }}" method="GET" class="inline-block">
                                        <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                    </form>
                                    <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 mt-2 rounded">Delete</button>
                                    </form>
                                </td>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-6">
                {{ $promosis->links() }}
            </div>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus promosi ini?');
        }
    </script>
</x-app-layout>
