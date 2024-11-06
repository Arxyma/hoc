<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Postingan Baru di Komunitas: ') }} {{ $community->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('communities.posts.store', $community) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="community_id" value="{{ $community->id }}">

                        <div>
                            <label for="content" class="block font-medium text-sm text-gray-700">Isi Postingan</label>
                            <textarea name="content" id="content" class="border-gray-300 rounded-md shadow-sm mt-1 block w-full" required></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Gambar
                                (opsional)</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full">
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buat
                                Postingan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
