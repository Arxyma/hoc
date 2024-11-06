<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('berita.update', $berita->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="judul">
                                    Judul
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                    id="judul" type="text" name="judul" value="{{ $berita->judul }}" required>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="gambar">
                                    Gambar
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                    id="gambar" type="file" name="gambar" accept="image/*">
                                @if ($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                                        class="w-20 h-20">
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="isi">
                                    Isi
                                </label>
                                <textarea
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                    id="isi" name="isi_berita" required>{{ $berita->isi_berita }}</textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                            Perbarui Berita
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
