<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Halaman Admin Pengajuan Promosi</h2>
        </div>
    </header>
    <div class="container mx-auto px-10 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h1 class="text-lg font-medium text-gray-900 dark:text-gray-100">Pengajuan Promosi</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Lihat dan kelola pengajuan promosi produk.
                    </p>

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <thead class="">
                                <tr>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gambar Produk</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-52">Nama Produk</th>
                                    {{-- <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</th> --}}
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <a href="{{ route('promosis.pengajuan', ['sort' => $sortOrder === 'desc' ? 'asc' : 'desc']) }}" 
                                            class="flex items-center justify-center">
                                            Tanggal diupload
                                            @if($sortOrder === 'desc')
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
                                @foreach($promosis as $index => $promosi)
                                    <tr class="border-b dark:border-gray-900">
                                        <td class="px-4 py-2 text-center text-gray-900 dark:text-gray-200">{{ $index + 1 }}</td>                                        
                                        <td class="px-4 py-8 flex items-center justify-center">
                                            <a href="{{ route('promosis.detail', $promosi->id) }}" class="block">
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
                                            <a href="{{ route('promosis.detail', $promosi->id) }}" class="block">
                                                {{ Str::limit($promosi->judul, 35) }}
                                            </a>
                                        </td>
                                        {{-- <td class="px-4 py-2 max-w-xs text-gray-900 dark:text-gray-200 text-justify">{{ Str::limit($promosi->deskripsi, 250) }}</td> --}}
                                        <td class="px-4 py-2 text-center text-gray-900 dark:text-gray-200">{{ $promosi->created_at->format('d/m/Y') ?? 'Unknown' }}</td>
                                        <td class="px-4 py-2 text-center text-gray-900 dark:text-gray-200">{{ $promosi->user->name ?? 'Unknown' }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <form action="{{ route('promosis.approve', $promosi->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-wider hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Setujui</button>
                                            </form>
                                            <form action="{{ route('promosis.reject', $promosi->id) }}" method="POST" class="inline ml-2">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-wider hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Tolak</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
</x-app-layout>
