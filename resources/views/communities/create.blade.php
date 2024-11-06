<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Komunitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('communities.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-gray-700">Nama Komunitas</label>
                            <input type="text" name="name" id="name"
                                class="border rounded w-full px-3 py-2 mt-1" required>
                        </div>
                        <div class="mt-4">
                            <label for="description" class="block text-gray-700">Deskripsi</label>
                            <textarea name="description" id="description" class="border rounded w-full px-3 py-2 mt-1" required></textarea>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Simpan Komunitas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
