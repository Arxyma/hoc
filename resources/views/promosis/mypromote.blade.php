<x-app-layout>
    <div class="container mx-auto px-10">
        <div class="container mx-auto py-4 px-4">
            {{-- <h1 class="text-2xl font-bold mb-4">Halaman Promosi</h1> --}}
    
            <div class="bg-blue-500 text-white p-4 rounded-lg">
                <h2 class="text-5xl font-bold text-center" style="font-family: 'Montserrat', sans-serif;">Promosi Saya</h2>
            </div>
            
    
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($promosis as $promosi)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                        <div class="h-48 overflow-hidden mb-4">
                            @if ($promosi->foto_produk)
                                <img src="{{ asset('storage/' . $promosi->foto_produk) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    No Image
                                </div>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold mb-2">{{ $promosi->judul }}</h2>
                            <p class="text-gray-600">Uploaded by: {{ $promosi->user->name ?? 'Unknown' }}</p>
                            <td class="border px-4 py-2">
                                {{-- <a href="{{ route('promosis.edit', $promosi->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a> --}}
                                <a href="{{ route('promosis.edit', ['promosi' => $promosi->id, 'redirect' => 'mypromote']) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="redirect" value="mypromote">
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </form>                                
                            </td>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
</x-app-layout>
