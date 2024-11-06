<x-app-layout>
    <div class="container mx-auto px-10 py-4">
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="flex flex-col items-center">
                <h1 class="text-4xl font-bold mb-2">{{ $promosi->judul }}</h1>
                <p class="text-gray-600 mb-4">{{ $promosi->deskripsi }}</p>

                @if ($promosi->foto_produk)
                    <img src="{{ asset('storage/' . $promosi->foto_produk) }}" 
                         alt="{{ $promosi->judul }}" 
                         class="w-[500px] h-[500px] object-cover rounded-lg mb-4">
                @else
                    <div class="w-[500px] h-[500px] bg-gray-200 flex items-center justify-center text-gray-500 mb-4">
                        No Image
                    </div>
                @endif

                <div class="text-gray-500 text-sm">
                    <p>Posted by: {{ $promosi->user->name ?? 'Unknown' }}</p>
                    <p>Created at: {{ $promosi->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
